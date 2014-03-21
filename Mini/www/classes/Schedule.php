<?php
session_start();
set_time_limit(600);
error_reporting(0);
/*?*/
/*ce*/
static $tablename = "schedule";
static $db_fields = array("id", "course_id" , "from", "to","day");
	
	//public function __construct ($course_id = "", $from = "", $to = "" , $day = "" , $id=null)
	//{
	//	$this->id = $id;
	//	$this->course_id = $course_id;
	//	$this->from = $from;
	//	$this->to = $to;
	//	$this->day = $day;
	//}
require_once("database.php");
require_once("database_objects.php");
require_once("../includes/connection.php");
require_once("../includes/functions.php");
require_once("CourseClass.php");
require_once("Room.php");
require_once("HashMap.php");

// Number of working hours per day
define("DAY_HOURS", 12);
// Number of days in week
define("DAYS_NUM", 5);

// Schedule chromosome
class Schedule
{
	// Number of crossover points of parent's class tables
	private $_numberOfCrossoverPoints;

	// Number of classes that is moved randomly by single mutation operation
	private $_mutationSize;

	// Probability that crossover will occure
	private $_crossoverProbability;

	// Probability that mutation will occure
	private $_mutationProbability;

	// Fitness value of chromosome
	public $_fitness;

	// Flags of class requiroments satisfaction
	private $_criteria = array();

	// Time-space slots, one entry represent one hour in one classroom
	private $_slots = array();

	// Class table for chromosome
	// Used to determine first time-space slot used by class
	private $_classes;

	// Initializes chromosomes with configuration block (setup of chromosome)
	public function __construct($numberOfCrossoverPoints, $mutationSize, $crossoverProbability, $mutationProbability)
	{
		$this->_mutationSize = $mutationSize;
		$this->_numberOfCrossoverPoints = $numberOfCrossoverPoints;
		$this->_crossoverProbability = $crossoverProbability;
		$this->_mutationProbability = $mutationProbability;
		$this->_fitness = 0;
		
                global $connect;
                $query = "SELECT * FROM rooms"; 
                $result = mysql_query($query , $connect);
                $numberOfRooms = mysql_num_rows($result);
                
		// reserve space for time-space slots in chromosomes code
		$this->_slots = array_pad($this->_slots, DAYS_NUM * DAY_HOURS * $numberOfRooms, '');
                
                $query2 = "SELECT * FROM course_class"; 
                $result2 = mysql_query($query2 , $connect);
                $numberOfCourseClasses = mysql_num_rows($result2);
                
		// reserve space for flags of class requirements
		$this->_criteria = array_pad($this->_criteria, $numberOfCourseClasses * 5, '');

		$this->_classes = new HashMap;

	}
	// Copy constructor
	public function copyConstruct($c, $setupOnly) {
		if( !$setupOnly )
		{
			// copy code
			$this->_slots = $c->_slots;
			$this->_classes = $c->_classes;

			// copy flags of class requirements
			$this->_criteria = $c->_criteria;

			// copy fitness
			$this->_fitness = $c->_fitness;
		}
		else
		{
                    global $connect;
                    $query = "SELECT * FROM rooms"; 
                    $result = mysql_query($query , $connect);
                    $numberOfRooms = mysql_num_rows($result);

                    // reserve space for time-space slots in chromosomes code
                    for($i = 0; $i < DAYS_NUM * DAY_HOURS * $numberOfRooms; $i++)
                    	$this->_slots[$i] = array();

                    $query2 = "SELECT * FROM course_class"; 
                    $result2 = mysql_query($query2 , $connect);
                    $numberOfCourseClasses = mysql_num_rows($result2);
                    
                    // reserve space for flags of class requirements
                    for($i = 0; $i < $numberOfCourseClasses * 5; $i++)
                    	$this->_criteria[$i] = NULL;
                    //$this->_criteria = array_pad($this->_criteria, $numberOfCourseClasses * 5, '');

					$this->_classes = new HashMap;
		}

		// copy parameters
		$this->_numberOfCrossoverPoints = $c->_numberOfCrossoverPoints;
		$this->_mutationSize = $c->_mutationSize;
		$this->_crossoverProbability = $c->_crossoverProbability;
		$this->_mutationProbability = $c->_mutationProbability;
	}

	// Makes copy ot chromosome
	public function MakeCopy($setupOnly) {
		$s = new Schedule;
		$s->copyConstruct($this, $setupOnly);
		return $s;
	}

	// Makes new chromosome with same setup but with randomly chosen code
	public function MakeNewFromPrototype() {
		// number of time-space slots
		$size = count($this->_slots);

		// make new chromosome, copy chromosome setup
		$newChromosome = new Schedule;
		$newChromosome->copyConstruct( $this, true );

		// place classes at random position
		$corcla = new CourseClass;
		$c = $corcla->find_all();
		//const list<CourseClass*>& c = Configuration::GetInstance().GetCourseClasses();

                global $connect;
                $query = "SELECT * FROM rooms"; 
                $result = mysql_query($query , $connect);
                $numberOfRooms = mysql_num_rows($result);
		for( $i = 0; $i < count($c); $i++ )
		{
			// determine random position of class
			$nr = $numberOfRooms;
			$dur = $c[$i]->get("duration");
			$day = rand() % DAYS_NUM;
			$room = rand() % $nr;
			$time = rand() % ( DAY_HOURS + 1 - $dur );
			$pos = $day * $nr * DAY_HOURS + $room * DAY_HOURS + $time;
			// fill time-space slots, for each hour of class
			for( $j = $dur - 1; $j >= 0; $j-- )
				array_push($newChromosome->_slots[$pos + $j], $c[$i]);

			// insert in class table of chromosome
			//echo $pos." ";
			$newChromosome->_classes->setValue($c[$i], $pos);
		}
		//$keys = $newChromosome->_classes->getAllKeys();
		//$values = $newChromosome->_classes->getAllValues();
		//echo "<br >";
		//for($i = 0; $i < count($keys); $i++) {
		//	echo $keys[$i]->id." ".$newChromosome->_classes->getValue($keys[$i])."<br />";
		//}
		$newChromosome->CalculateFitness();

		// return smart pointer
		return $newChromosome;
	}

	// Performes crossover operation using to chromosomes and returns pointer to offspring
	public function Crossover($parent2) {
		// check probability of crossover operation
		if( rand() % 100 > $this->_crossoverProbability ) {
			// no crossover, just copy first parent
			$newChromosome = new Schedule;
			$newChromosome->copyConstruct( $this, false );
			return $newChromosome;
		}

		// new chromosome object, copy chromosome setup
		$n = new Schedule;
		$n->copyConstruct( $this, true );

		// number of classes
		$size = (int)$this->_classes->count();
		
		$cp = array();
		$cp = array_pad($cp, $size, 0);

		// determine crossover point (randomly)
		for( $i = $this->_numberOfCrossoverPoints; $i > 0; $i-- )
		{
			while( 1 )
			{
				$p = rand() % $size;
				if( !$cp[$p] )
				{
					$cp[$p] = true;
					break;
				}
			}
		}

		$values1 = $this->_classes->getAllValues();
		$keys1 = $this->_classes->getAllKeys();
		$values2 = $parent2->_classes->getAllValues();
		$keys2 = $parent2->_classes->getAllKeys();

		// make new code by combining parent codes
		$first = rand() % 2 == 0;
		for( $i = 0; $i < $size; $i++ )
		{
			if( $first )
			{
				// insert class from first parent into new chromosome's calss table
				$n->_classes->setValue($keys1[$i], $values1[$i]);
				// all time-space slots of class are copied
				for( $j = $keys1[$i]->get("duration") - 1; $j >= 0; $j-- )
					array_push($n->_slots[$values1[$i] + $j], $keys1[$i]);
			}
			else
			{
				// insert class from second parent into new chromosome's calss table
				$n->_classes->setValue($keys2[$i], $values2[$i]);
				// all time-space slots of class are copied
				for( $j = $keys2[$i]->get("duration") - 1; $j >= 0; $j-- )
					array_push($n->_slots[$values2[$i] + $j], $keys2[$i]);
			}

			// crossover point
			if( $cp[$i] )
				// change soruce chromosome
				$first = !$first;
		}

		$n->CalculateFitness();
		// return smart pointer to offspring
		return $n;
	}

	// Performs mutation on chromosome
	public function Mutation() {
		// check probability of mutation operation
		if( rand() % 100 > $this->_mutationProbability )
			return;

		// number of classes
		$numberOfClasses = (int)$this->_classes->count();
		// number of time-space slots
		$size = (int)count($this->_slots);

		// move selected number of classes at random position
		for( $i = $this->_mutationSize; $i > 0; $i-- )
		{
			// select ranom chromosome for movement
			$mpos = rand() % $numberOfClasses;
			$pos1 = 0;
			$j = 0;
			$keys = $this->_classes->getAllKeys();
			$values = $this->_classes->getAllValues();
			for( ; $mpos > 0; $j++, $mpos-- );

			// current time-space slot used by class
			$pos1 = $values[$j];

			$cc1 = $keys[$j];
                        
                        global $connect;
                        $query = "SELECT * FROM rooms"; 
                        $result = mysql_query($query , $connect);
                        $numberOfRooms = mysql_num_rows($result);
                        
			// determine position of class randomly
			$nr = $numberOfRooms;
			$dur = $cc1->get("duration");
			$day = rand() % DAYS_NUM;
			$room = rand() % $nr;
			$time = rand() % ( DAY_HOURS + 1 - $dur );
			$pos2 = $day * $nr * DAY_HOURS + $room * DAY_HOURS + $time;

			// move all time-space slots
			for( $l = $dur - 1; $l >= 0; $l-- )
			{
				// remove class hour from current time-space slot
				$cl = $this->_slots[ $pos1 + $l ];

				for( $k = 0; $k < count($cl); $k++ )
				{
					if( $cl[$k]->id == $cc1->id )
					{
						array_splice($cl, $k, 1);
						break;
					}
				}

				// move class hour to new time-space slot
				array_push($this->_slots[ $pos2 + $l ], $cc1);
			}

			// change entry of class table to point to new time-space slots
			$this->_classes->setValue($cc1, $pos2);
		}
		$this->CalculateFitness();
	}

	// Calculates fitness value of chromosome
	public function CalculateFitness() {
		// chromosome's score
		$score = 0;
                
                global $connect;
                $query = "SELECT * FROM rooms"; 
                $result = mysql_query($query , $connect);
                $numberOfRooms = mysql_num_rows($result);
         
		$daySize = DAY_HOURS * $numberOfRooms;
		$ci = 0;

		$keys = $this->_classes->getAllKeys();
		$values = $this->_classes->getAllValues();
		$size = $this->_classes->count();

		// check criterias and calculate scores for each class in schedule
		for( $i = 0; $i < $size; $i++, $ci += 5 )
		{
			// coordinate of time-space slot
			$p = $values[$i];
			$day = (int)($p / $daySize);
			$time = $p % $daySize;
			$room = (int)($time / DAY_HOURS); //
			$time = $time % DAY_HOURS;

			$dur = $keys[$i]->get("duration");
			// check for professor time
			$pt = false;
			for($j = $dur - 1; $j >= 0; $j-- )
			{
				if( (($p + $j) < $keys[$i]->professor->From) || (($p + $j) > $keys[$i]->professor->To))
				{
					$pt = true;
					break;
				}
			}			
			if( !$pt )
				$score++;
				
			// check for room overlapping of classes
			$ro = false;
			for($j = $dur - 1; $j >= 0; $j-- )
			{
				if( count($this->_slots[ $p + $j ]) > 1 )
				{
					$ro = true;
					break;
				}
			}

			// on room overlaping
			if( !$ro )
				$score++;
			$this->_criteria[ $ci + 0 ] = !$ro;
			$cc = $keys[$i];

			$rinst = new Room;
			$r = $rinst->find_by_id($room+1); //

			// does current room have enough seats
			$this->_criteria[ $ci + 1 ] = $r->get("no_seats") >= $cc->get("numberOfSeats");
			if( $this->_criteria[ $ci + 1 ] )
				$score++;
			// does current room have computers if they are required
			$this->_criteria[ $ci + 2 ] = !$cc->get("lab") || ( $cc->get("lab") && $r->get("isLab") );
			if( $this->_criteria[ $ci + 2 ] )
				$score++;

			$po = false;
            $go = false;
			// check overlapping of classes for professors and student groups
			for( $j = $numberOfRooms, $t = $day * $daySize + $time; $j > 0; $j--, $t += DAY_HOURS )
			{
				// for each hour of class
				for( $k = $dur - 1; $k >= 0; $k-- )
				{
					// check for overlapping with other classes at same time
					$cl = $this->_slots[ $t + $k ];
					$clSize = count($cl);
					for( $f = 0; $f < $clSize; $f++ )
					{
						if( $cc->id != $cl[$f]->id )
						{
							// professor overlaps?
							if( !$po && $cc->ProfessorOverlaps( $cl[$f] ) ) //
								$po = true;

							// student group overlaps?
							if( !$go && $cc->GroupsOverlap( $cl[$f] ) )
								$go = true;

							// both type of overlapping? no need to check more
							if( $po && $go )
								goto total_overlap;
						}
					}
				}
			}

	total_overlap:
			// professors have no overlaping classes?
			if( !$po )
				$score++;
			$this_criteria[ $ci + 3 ] = !$po;
			// student groups has no overlaping classes?
			if( !$go )
				$score++;
			$this_criteria[ $ci + 4 ] = !$go;
		}
                
                global $connect;
                $query2 = "SELECT * FROM course_class"; 
                $result2 = mysql_query($query2 , $connect);
                $numberOfCourseClasses = mysql_num_rows($result2);
                
		// calculate fitess value based on score
		$this->_fitness = (float)$score / ( $numberOfCourseClasses * DAYS_NUM );
	}

	// Returns fitness value of chromosome
	public function GetFitness() { return $this->_fitness; }

	// Returns reference to table of classes
	public function GetClasses() { return $this->_classes; }

	// Returns array of flags of class requiroments satisfaction
	public function GetCriteria() { return $this->_criteria; }

	// Return reference to array of time-space slots
	public function GetSlots() { return $this->_slots; }
}

// Genetic algorithm
class Algorithm
{

	// Population of chromosomes
	private $_chromosomes = array();

	// Inidicates wheahter chromosome belongs to best chromosome group
	private $_bestFlags = array();

	// Indices of best chromosomes
	private $_bestChromosomes = array();

	// Number of best chromosomes currently saved in best chromosome group
	private $_currentBestSize;

	// Number of chromosomes which are replaced in each generation by offspring
	private $_replaceByGeneration;

	// Pointer to algorithm observer
	//ScheduleObserver* _observer;

	// Prototype of chromosomes in population
	private $_prototype;

	// Current generation
	private $_currentGeneration;

	// State of execution of algorithm
	private $_state;

	// Synchronization of algorithm's state
	//CCriticalSection _stateSect;

	// Pointer to global instance of algorithm
	private $_instance;

	// Synchronization of creation and destruction of global instance
	//static CCriticalSection _instanceSect;

	// Initializes genetic algorithm
	public function __construct( $numberOfChromosomes, $replaceByGeneration, $trackBest, $prototype) {
		$this->_replaceByGeneration = $replaceByGeneration;
		$this->_currentBestSize = 0;
		$this->_prototype = $prototype;
		$this->_currentGeneration = 0;
		$this->_state = 0;

		// there should be at least 2 chromosomes in population
		if( $numberOfChromosomes < 2 )
			$numberOfChromosomes = 2;

		// and algorithm should track at least one of best chromosomes
		if( $trackBest < 1 )
			$trackBest = 1;

		if( $this->_replaceByGeneration < 1 )
			$this->_replaceByGeneration = 1;
		else if( $this->_replaceByGeneration > $numberOfChromosomes - $trackBest )
			$this->_replaceByGeneration = $numberOfChromosomes - $trackBest;

		// reserve space for population
		$this->_chromosomes = array_pad($this->_chromosomes, $numberOfChromosomes, NULL);
		$this->_bestFlags = array_pad($this->_bestFlags, $numberOfChromosomes, false);

		// reserve space for best chromosome group
		$this->_bestChromosomes = array_pad($this->_bestChromosomes, $trackBest, 0);

		// clear population
		for( $i = (int)count($this->_chromosomes) - 1; $i >= 0; --$i )
		{
			$this->_chromosomes[ $i ] = NULL;
			$this->_bestFlags[ $i ] = false;
		}
	}

	/*// Returns reference to global instance of algorithm
	static Algorithm& GetInstance();

	// Frees memory used by gloval instance
	static void FreeInstance();*/

	// Starts and executes algorithm
	public function Start() {
		if( !$this->_prototype )
			return;
		//CSingleLock lock( &_stateSect, TRUE );//

		// do not run already running algorithm
		if( $this->_state == 2 )
			return;

		$this->_state = 2;

		//lock.Unlock();//

		/*if( _observer )
			// notify observer that execution of algorithm has changed it state
			_observer->EvolutionStateChanged( _state );*/

		// clear best chromosome group from previous execution
		$this->ClearBest();


		// initialize new population with chromosomes randomly built using prototype
		$i = 0;
		$cSize = count($this->_chromosomes);
		for( $j = 0; $j < $cSize; ++$j, ++$i )
		{
			// remove chromosome from previous execution
			if( $this->_chromosomes[$j] )
				$this->_chromosomes[$j] = NULL;

			// add new chromosome to population
			$this->_chromosomes[$j] = $this->_prototype->MakeNewFromPrototype();
			//echo "test ";
			$this->AddToBest( $i );
			//echo "test ";
		}
		$this->_currentGeneration = 0;

		for($i = 0; $i < 2; $i++) //2000
		{
			//lock.Lock();//

			// user has stopped execution?
			/*if( $this->_state != 2 )
			{
				//lock.Unlock();//
				break;
			}*/

			$best = $this->GetBestChromosome();
			$l = $best->Getslots();
			echo "<br />";
			/*for($i = 0; $i < 24; $i++) {
				if($i < 12) {
					printf('%02d %02d %02d %02d %02d | ',$l[$i][0]->id, $l[$i+24][0]->id, $l[$i+48][0], $l[$i+72][0]->id, $l[$i+96][0]->id);
					printf('%02d %02d %02d %02d %02d | ',$l[$i][1]->id, $l[$i+24][1]->id, $l[$i+48][1], $l[$i+72][1]->id, $l[$i+96][1]->id);
					printf('%02d %02d %02d %02d %02d | ',$l[$i][2]->id, $l[$i+24][2]->id, $l[$i+48][2], $l[$i+72][2]->id, $l[$i+96][2]->id);
					printf('%02d %02d %02d %02d %02d | ',$l[$i][3]->id, $l[$i+24][3]->id, $l[$i+48][3], $l[$i+72][3]->id, $l[$i+96][3]->id);
				}
				else {
					printf('%02d %02d %02d %02d %02d | ',$l[$i][0]->id, $l[$i+24][0]->id, $l[$i+48][0], $l[$i+72][0]->id, $l[$i+96][0]->id);
					printf('%02d %02d %02d %02d %02d | ',$l[$i][1]->id, $l[$i+24][1]->id, $l[$i+48][1], $l[$i+72][1]->id, $l[$i+96][1]->id);
					printf('%02d %02d %02d %02d %02d | ',$l[$i][2]->id, $l[$i+24][2]->id, $l[$i+48][2], $l[$i+72][2]->id, $l[$i+96][2]->id);
					printf('%02d %02d %02d %02d %02d | ',$l[$i][3]->id, $l[$i+24][3]->id, $l[$i+48][3], $l[$i+72][3]->id, $l[$i+96][3]->id);
				}
		
				/*echo $l[$i][0]->id." ";
				if(!$l[$i][0]->id)
					echo "** ";
				echo $l[$i+12][0]->id." ";
				if(!$l[$i+12][0]->id)
					echo "** ";
				echo $l[$i+24][0]->id." ";
				if(!$l[$i+24][0]->id)
					echo "** ";
				echo $l[$i+36][0]->id." ".$l[$i+48][0]->id." ";*/
				/*echo "<br />";
				echo $i.": ";
				for($j = 0; $j < count($l[$i]); $j++)
					echo $l[$i][$j]->id." ";*/
				/*echo "<br />";
				if($i == 11)
					echo "<br />";
			}
			for($i = 0; $i < 120; $i++) {
				echo "<br />";
				echo $i.": ";
				for($j = 0; $j < count($l[$i]); $j++)
					echo $l[$i][$j]->id." ";
			}
			$f = new HashMap; 
			$f = $best->GetClasses();
			$keys = $f->getAllKeys();
			$values = $f->getAllValues();
			for($i = 0; $i < count($keys); $i++)
				echo $keys[$i]->id." ".$values[$i]."<br />";
			// algorithm has reached criteria?*/
			//echo $best->GetFitness()." ";
			/*if( $best->GetFitness() >= 0.9 )
			{
				$this->_state = 1;
				//lock.Unlock();//
				break;
			}*/
			//lock.Unlock();//

			// produce offespring
			$offspring = array();
			$offspring = array_pad($offspring, $this->_replaceByGeneration, NULL);

			for( $j = 0; $j < $this->_replaceByGeneration; $j++ )
			{
				// selects parent randomly
				$p1 = $this->_chromosomes[ rand() % count($this->_chromosomes) ];
				$p2 = $this->_chromosomes[ rand() % count($this->_chromosomes) ];

				$offspring[ $j ] = $p1->Crossover( $p2 );
				$offspring[ $j ]->Mutation();
			}

			// replace chromosomes of current operation with offspring
			for( $j = 0; $j < $this->_replaceByGeneration; $j++ )
			{
				$ci;
				do
				{
					// select chromosome for replacement randomly
					$ci = rand() % (int)count($this->_chromosomes);

					// protect best chromosomes from replacement		
				} while( $this->IsInBest( $ci ) );
				// replace chromosomes
				$this->_chromosomes[ $ci ] = NULL;
				$this->_chromosomes[ $ci ] = $offspring[ $j ];

				// try to add new chromosomes in best chromosome group
				$this->AddToBest( $ci );
			}

			/*// algorithm has found new best chromosome
			if( $best != GetBestChromosome() && _observer )
				// notify observer
				//_observer->NewBestChromosome( *GetBestChromosome() ); ce*/

			$this->_currentGeneration++;


		}
		//echo "<br><br>";
		/*if( _observer )
			// notify observer that execution of algorithm has changed it state
			_observer->EvolutionStateChanged( _state );*/
		$sch = $this->GetBestChromosome();
		echo "<center>Schedule Fitness : ".$sch->GetFitness()."</center>";
		//$l = $sch->Getslots();
		//for($i = 0; $i < 24; $i++) {
				//if($i < 12) {
					//printf('%02d %02d %02d %02d %02d | ',$l[$i][0]->id, $l[$i+24][0]->id, $l[$i+48][0]->id, $l[$i+72][0]->id, $l[$i+96][0]->id);
					//printf('%02d %02d %02d %02d %02d | ',$l[$i][1]->id, $l[$i+24][1]->id, $l[$i+48][1]->id, $l[$i+72][1]->id, $l[$i+96][1]->id);
					//printf('%02d %02d %02d %02d %02d | ',$l[$i][2]->id, $l[$i+24][2]->id, $l[$i+48][2]->id, $l[$i+72][2]->id, $l[$i+96][2]->id);
					//printf('%02d %02d %02d %02d %02d | ',$l[$i][3]->id, $l[$i+24][3]->id, $l[$i+48][3]->id, $l[$i+72][3]->id, $l[$i+96][3]->id);
				//}
				//else {
					//printf('%02d %02d %02d %02d %02d | ',$l[$i][0]->id, $l[$i+24][0]->id, $l[$i+48][0]->id, $l[$i+72][0]->id, $l[$i+96][0]->id);
					//printf('%02d %02d %02d %02d %02d | ',$l[$i][1]->id, $l[$i+24][1]->id, $l[$i+48][1]->id, $l[$i+72][1]->id, $l[$i+96][1]->id);
					//printf('%02d %02d %02d %02d %02d | ',$l[$i][2]->id, $l[$i+24][2]->id, $l[$i+48][2]->id, $l[$i+72][2]->id, $l[$i+96][2]->id);
					//printf('%02d %02d %02d %02d %02d | ',$l[$i][3]->id, $l[$i+24][3]->id, $l[$i+48][3]->id, $l[$i+72][3]->id, $l[$i+96][3]->id);
				//}
		
				/*echo $l[$i][0]->id." ";
				if(!$l[$i][0]->id)
					echo "** ";
				echo $l[$i+12][0]->id." ";
				if(!$l[$i+12][0]->id)
					echo "** ";
				echo $l[$i+24][0]->id." ";
				if(!$l[$i+24][0]->id)
					echo "** ";
				echo $l[$i+36][0]->id." ".$l[$i+48][0]->id." ";*/
				/*echo "<br />";
				echo $i.": ";
				for($j = 0; $j < count($l[$i]); $j++)
					echo $l[$i][$j]->id." ";*/
				//echo "<br />";
				//if($i == 11)
				//	echo "<br />";
			//}
		$f = new HashMap; 
		$f = $sch->GetClasses();
		$keys = $f->getAllKeys();
		$values = $f->getAllValues();
		global $connect;
        $query = "SELECT * FROM rooms"; 
        $result = mysql_query($query , $connect);
        $nr = mysql_num_rows($result);
		for($i = 0; $i < count($keys); $i++) {
			$p = $values[$i];
			$time = $p % ( $nr * DAY_HOURS);
			$day = (int)($p / ( $nr * DAY_HOURS )) + 1;
			$roomId = (int)($time / DAY_HOURS);
			$time = $time % DAY_HOURS + 1;
			$quey = "UPDATE course_class SET room_id=".($roomId+1).", time=".$time.", day=".$day." WHERE id=".($i+1);
			//echo $quey."<br>";
			$result = mysql_query($quey , $connect);
			if(!$result)
			{

				//if query failed
				echo "didnt work ";
 
 
			}
			//else
			//{
				//if query succeeded   
				//echo "work ";
			//}
		//}
		//echo "<br>";
		//for($i = 0; $i < count($keys); $i++) {
			//echo $keys[$i]->id." ".$values[$i]."<br />";
		}
	}

	// Stops execution of algoruthm
	public function Stop() {
		if( $_state == 0 )
			$_state = 2;
	}

	// Returns pointer to best chromosomes in population
	public function GetBestChromosome() {
		return $this->_chromosomes[ $this->_bestChromosomes[ 0 ] ];
	}

	// Returns current generation
	public function GetCurrentGeneration() { return $_currentGeneration; }

	// Returns pointe to algorithm's observer
	//inline ScheduleObserver* GetObserver() const { return _observer; } /*ce*/

	// Tries to add chromosomes in best chromosome group
	private function AddToBest($chromosomeIndex) {
		// don't add if new chromosome hasn't fitness big enough for best chromosome group
		// or it is already in the group?
		if( ( $this->_currentBestSize == (int)count($this->_bestChromosomes) && 
			$this->_chromosomes[ $this->_bestChromosomes[ $this->_currentBestSize - 1 ] ]->GetFitness() >= 
			$this->_chromosomes[ $chromosomeIndex ]->GetFitness() ) || $this->_bestFlags[ $chromosomeIndex ] )
			return;

		// find place for new chromosome
		$i = $this->_currentBestSize;

		for( ; $i > 0; $i-- )
		{
			// group is not full?
			if( $i < (int)count($this->_bestChromosomes) )
			{
				// position of new chromosomes is found?
				if( $this->_chromosomes[ $this->_bestChromosomes[ $i - 1 ] ]->GetFitness() > 
					$this->_chromosomes[ $chromosomeIndex ]->GetFitness() )
					break;

				// move chromosomes to make room for new
				$this->_bestChromosomes[ $i ] = $this->_bestChromosomes[ $i - 1 ];
			}
			else
				// group is full remove worst chromosomes in the group
				$this->_bestFlags[ $this->_bestChromosomes[ $i - 1 ] ] = false;
		}

		// store chromosome in best chromosome group
		$this->_bestChromosomes[ $i ] = $chromosomeIndex;
		$this->_bestFlags[ $chromosomeIndex ] = true;

		// increase current size if it has not reached the limit yet
		if( $this->_currentBestSize < (int)count($this->_bestChromosomes) )
			$this->_currentBestSize++;
	}

	// Returns TRUE if chromosome belongs to best chromosome group
	private function IsInBest($chromosomeIndex) {
		return $this->_bestFlags[ $chromosomeIndex ];
	}

	// Clears best chromosome group
	private function ClearBest() {
		for( $i = (int)count($this->_bestFlags) - 1; $i >= 0; --$i )
			$this->_bestFlags[ $i ] = false;

		$this->_currentBestSize = 0;
	}
} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">

<title>View Table</title>

<link href="stylesheets/table.css" rel="stylesheet">

<script type="text/javascript" src="../javaScripts/jquery-1.6.1.js"></script>
<script type="text/javascript" src="../javaScripts/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="../javaScripts/table.js"></script>

</head>

<body bgcolor="#dedede">

<?php

$prototype = new Schedule(2,2,80,3);

$run = new Algorithm(100, 8, 5, $prototype);

$run->start();

redirect_to("../AdminTable.php");

?>

</body>
</html>