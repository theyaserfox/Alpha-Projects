function createXHR()
{
    try 
    {
     return new XMLHttpRequest();
    } 
	catch (e) 
    {
	  var aVersions = [ "Microsoft.XMLHttp" , "MSXML2.XMLHttp.6.0" , "MSXML2.XMLHttp.3.0" , "MSXML2.XMLHttp" , "MSXML2.XMLHttp.4.0" , "MSXML2.XMLHttp.5.0"];
      for (var i = 0; i < aVersions.length; i++) 
	    {
         try 
		    {
             var oXHR = new ActiveXObject(aVersions[i]);
             return oXHR;
            }
	     catch (oError)
		    {
             alert("can't found");
            }
        }
    }
}

function search(name)
{
    var xmlhttp = createXHR();
    xmlhttp.onreadystatechange = function()
    {
     if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
         document.getElementById("suggestion").innerHTML = xmlhttp.responseText;
	    }
    }
    xmlhttp.open("POST","../search/search_ajax.php",true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("name="+name);
}

function click_suggestion()
{
   var suggestion = document.getElementById("suggestion");
   suggestion.addEventListener("click" ,  function (e) {click_event(e) });
}

function click_list()
    {
     var list = document.getElementById("list");
     list.addEventListener("click" , function (e) {click_event(e) });
    }

function click_event(event)
    {
     if(event.target && ( event.target.className == "name" || event.target.className == "new_message_name"))
        {  
		 if(document.getElementById(event.target.id+event.target.id) == null)
		    {
             var div_parent = document.createElement("div");
             div_parent.className = 'chat';
		 
             var p = document.createElement("p");
             p.innerHTML = event.target.id;
		     p.className = 'pChat';

             var div = document.createElement("div");
		     div.id = event.target.id + event.target.id;
		     div.className = "history";
		 
             var input = document.createElement("input");
		     input.type = "text";
		     input.className = "input";
     	     input.id = event.target.id ;
	         input.onkeypress = function(e)
		        {   
		         if (e.keyCode == 13 || e.which == 13) 
                    {
				     var name = e.target.id;
                     var message = e.target.value;
				     e.target.value = '';
                     var xmlhttp = createXHR();
                     xmlhttp.onreadystatechange = function()
                        {
                         if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                            {
                             var add_message = document.createElement("div");
		               	     add_message.innerHTML = xmlhttp.responseText;
						     add_message.className = 'message';
		                     document.getElementById(name+name).appendChild(add_message);
		                    }	
		                }
	                 xmlhttp.open("POST","../chat/send_message.php",true);
                     xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	                 xmlhttp.send("name="+name+"&message="+message);  
                    }
                };
             div_parent.appendChild(p);
             div_parent.appendChild(div);
             div_parent.appendChild(input);

             document.getElementById("chat_bar").appendChild(div_parent);
		     show_history(event.target.id);
            }
		}	
    }

function show_history(name)
{ 
  var xmlhttp = createXHR();
  xmlhttp.onreadystatechange = function()
    {
     if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
         document.getElementById(name+name).innerHTML = xmlhttp.responseText;
		 show_history_poll(name);
	    }
    }
  xmlhttp.open("POST","../chat/show_history.php",true);
  xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded"); 
  xmlhttp.send("name="+name);
}

function show_history_poll(name)
{
  var xmlhttp = createXHR();
  xmlhttp.ontimeout = function () {show_history_poll(name);};
  xmlhttp.onreadystatechange = function()
    {
     if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
		 var response = new Array();
		 response = JSON.parse(xmlhttp.responseText);
		 var user = response[0].split(" : ");
		 user_two = user[0];
		 for(var i = 0 ; i < response.length ; i++)
		    {
		     var div_chat = document.createElement("div");
		     div_chat.id = response[i]+response[i];
		     div_chat.className = 'message';
		     div_chat.innerHTML = response[i];
		     document.getElementById(user_two+user_two).appendChild(div_chat);	 
		    }
		 show_history_poll(user_two);
	    }
    }
    xmlhttp.open("POST","../chat/show_history_poll.php",true);
	xmlhttp.timeout = 80000;
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("name="+name);
}

function update_list()
{
    var xmlhttp = createXHR();
    xmlhttp.onreadystatechange = function()
    {
     if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
           {
		     document.getElementById("list").innerHTML = xmlhttp.responseText;
			 update_list_poll();
		   }
    }
    xmlhttp.open("POST","../search/update_list.php",true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("time="+Math.random());
}

function update_list_poll()
{
    var xmlhttp = createXHR();
    xmlhttp.ontimeout = function () { update_list_poll(); };
    xmlhttp.onreadystatechange = function()
    {
     if ( xmlhttp.readyState == 4 && xmlhttp.status == 200 )
        {
		 var response = new Array();
		 response = JSON.parse(xmlhttp.responseText);
		 if ( response.chat != false )
		    { 
		      for (var i = 0 ; i < response.chat.length ; i++) 
                {
				 if(document.getElementById(response.chat[i]+response.chat[i]) == null)
				    {
		             document.getElementById(response.chat[i]).className = 'new_message_name';
				     document.getElementById(response.chat[i]).onclick = function(event) 
				        { 
				         document.getElementById(event.target.id).className = 'name';
					    };
					}
				}			  
		    }	
		 if( response.list != false )
		    {
		     for(var i = 0 ; i< response.list.length ; i++)
		        {
		         var add_list = document.createElement("div");
			     add_list.innerHTML = response.list[i];
		         add_list.className = 'name';
		         add_list.id = response.list[i];
		         document.getElementById("list").appendChild(add_list);
		        }
			}
			
		    update_list_poll();			
		}	
    }
    xmlhttp.open("POST","../search/update_list_poll.php",true);
	xmlhttp.timeout = 80000;
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("time="+Math.random());
}

window.onload = update_list();
window.onload = setTimeout('click_list()' ,100);
window.onload = setTimeout('click_suggestion()' ,100);