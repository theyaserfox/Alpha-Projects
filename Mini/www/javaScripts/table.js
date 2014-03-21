$(document).ready(function()
{
$(".edit_tr").click(function()
{
var ID=$(this).attr('id');
$("#saturday_"+ID).hide();
$("#monday_"+ID).hide();
$("#tuesday_"+ID).hide();
$("#wednesday_"+ID).hide();
$("#thursday_"+ID).hide();
$("#saturday_input_"+ID).show();
$("#monday_input_"+ID).show();
$("#tuesday_input_"+ID).show();
$("#wednesday_input_"+ID).show();
$("#thursday_input_"+ID).show();
}).change(function()
{
var ID=$(this).attr('id');
var saturday=$("#saturday_input_"+ID).val();
var monday=$("#monday_input_"+ID).val();
var tuesday=$("#tuesday_input_"+ID).val();
var wednesday=$("#wednesday_input_"+ID).val();
var thursday=$("#thursday_input_"+ID).val();
var dataString = 'id='+ ID +'&saturday='+saturday+'&monday='+monday+'&tuesday='+tuesday+'&wednesday='+wednesday+'&thursday='+thursday;
$("#saturday_"+ID).html('<img src="load.gif" />'); // Loading image

$.ajax({
type: "POST",
url: "table_edit_ajax.php",
data: dataString,
cache: false,
success: function(html)
{
$("#saturday_"+ID).html(saturday);
$("#monday_"+ID).html(monday);
$("#tuesday_"+ID).html(tuesday);
$("#wednesday_"+ID).html(wednesday);
$("#thursday_"+ID).html(thursday);
}
});

});

// Edit input box click action
$(".editbox").mouseup(function() 
{
return false
});

// Outside click action
$(document).mouseup(function()
{
$(".editbox").hide();
$(".text").show();
});

});	