$(document).ready(function(){
	$.when($('#page-loader').addClass('hide')).done(function(){
	  $('#page-container').addClass('in');
	});
	function cargarContenido(div,URL){
	  $(div).load(URL);
	}
	var Check = $('#UserCheck').is(':checked');
	$('#UserCheck').change(function(){
	  Check = $('#UserCheck').is(':checked');
	});
	$('#user_login').click(function(e){
	  e.preventDefault();
	  var Modal = $('#Estado_Modal');
	  var data  = {
	    NameUser:       $('#UserName').val(),
	    PasswordUser:   Sha256.hash($('#UserPassword').val()),
	    CheckUser:      Check
	  };
	  $.ajax({
	    type:          "post",
	    url:           "./controller/trigger/login_trigger.php",
	    async:         true,
	    cache:         false,
	    data:          JSON.stringify(data),
	    contentType:   "application/json; charset=utf-8",
	    dataType :     "json",
	    beforeSend:    function(response){
	    },
	    success:       function(response){
	      if(response.Success){
	        Modal.html('Ingresando al sistema....');
	        $('#My_Modal').modal('show');
	        setTimeout(function(){
	            window.location.replace("./index.php");
	        }, 3000);
	      }
	      else{
	        Modal.html('Error al ingresar al sistema');
	        $('#My_Modal').modal('show');
	        setTimeout(function(){
	            $('#My_Modal').modal('hide');
	        }, 3000);   
	      }
	    },
	    error:         function(response, error){
	      alert("Error Interno: " + error);
	    }  
	  });
	return false;  
	});
    });
