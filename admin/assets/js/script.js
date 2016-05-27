$(document).ready(function(){
	$.when($('#page-loader').addClass('hide')).done(function(){
	  $('#page-container').addClass('in');
	});
	var Check = $('#UserCheck').is(':checked');
	$('#UserCheck').change(function(){
	  Check = $('#UserCheck').is(':checked');
	});

	$('#user_login').click(function(e){
	  e.preventDefault();
	  var data  = {
	    NameUser:       $('#UserName').val(),
	    PasswordUser:   Sha256.hash($('#UserPassword').val()),
	    CheckUser:      Check
	  };
	  $.ajax({
	    type:          "post",
	    url:           "./controller/trigger/login_trigger.php",
	    async:         false,
	    cache:         false,
	    data:          JSON.stringify(data),
	    contentType:   "application/json; charset=utf-8",
	    dataType :     "json",
	    beforeSend:    function(response){
	    },
	    success:       function(response){
	      if(response.Success){
	      window.location.replace("./index.php");
	
	      }
	      else{
	      	alert("No entras");
	      
	      }
	    },
	    error:         function(response, error){
	      alert("Error Interno: " + error);
	    }  
	  });
	return false;  
	});
});
