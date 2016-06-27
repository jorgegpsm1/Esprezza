(function(){
	$.when($('#page-loader').addClass('hide')).done(function(){
	  $('#page-container').addClass('in');
	});
	function setOperationSystem() {
		var System;
	  var userAgent = navigator.userAgent || navigator.vendor || window.opera;
	  if( userAgent.match( /iPad/i ) || userAgent.match( /iPhone/i ) || userAgent.match( /iPod/i ) ){
	    System = 'IOS';
	  }
	  else if( userAgent.match( /Android/i ) ){
	  	System = 'ANDDROID';
	  }
	  else{
	    System ='UNKNOWN';
	  }
	  return System;
	}	
	function is_Mobile(){
		var Mobile 	= (/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase()));
		return Mobile;
	}
	function get_Browser(){
		var Browser = "UNKNOWN";
		var isOpera = (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
		var isFirefox = typeof InstallTrigger !== 'undefined';
		var isSafari = Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0;
		var isIE = /*@cc_on!@*/false || !!document.documentMode;
		var isEdge = !isIE && !!window.StyleMedia;
		var isChrome = !!window.chrome && !!window.chrome.webstore;
		if(isOpera == true){
			Browser = "OPERA";
		}
		else if(isFirefox == true){
			Browser = "FIREFOX";
		}
		else if(isSafari == true){
			if(!navigator.userAgent.match('CriOS')){
				Browser = "SAFARI";
			}
			else{
				Browser = "CHROME";
			}
		}
		else if(isIE == true){
			Browser = "IE";
		}
		else if(isEdge == true){
			Browser = "EDGE";
		}
		else if(isChrome == true){
			Browser = "CHROME";
		}
		return Browser;
	}

	function get_SystemOperative(){
		var System ='UNKNOWN';
		if(is_Mobile()==true){
			System = setOperationSystem();
		}
		else{
			if (navigator.appVersion.indexOf("Win")!=-1) System="WINDOWS";
			if (navigator.appVersion.indexOf("Mac")!=-1) System="MACOS";
			if (navigator.appVersion.indexOf("X11")!=-1) System="UNIX";
			if (navigator.appVersion.indexOf("Linux")!=-1) System="LINUX";
		}
		return System;
	}
	
	var Check = $('#UserCheck').is(':checked');
	$('#UserCheck').change(function(){
	  Check = $('#UserCheck').is(':checked');
	});

	$('#user_login').click(function(e){
	  e.preventDefault();
	  var data  = {
	    NameUser:       $('#UserName').val().trim(),//+"@esprezza.com",,
	    PasswordUser:   Sha256.hash($('#UserPassword').val().trim()),
	    CheckUser:      Check,
	    BrowserUser:    get_Browser(),
	    SystemrUser:    get_SystemOperative()
	  };
	  $.ajax({
	    type:          "post",
	    url:           "./controller/trigger/login.php?action=1",
	    async:         false,
	    cache:         false,
	    data:          JSON.stringify(data),
	    contentType:   "application/json; charset=utf-8",
	    dataType :     "json",
	    beforeSend:    function(Response){
	    },
	    success:       function(Response){
	      if(Response.Success){
	      	window.location.replace("./index.php");
	      }
	      else{
	      	alert("No entras");
	      }
	    },
	    error:         function(Response, Error){
	      alert("Error Interno: " + Error);
	    }  
	  });
	return false;  
	});
})();