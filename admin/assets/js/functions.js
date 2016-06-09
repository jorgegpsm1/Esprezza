$(document).ready(function(){
  $.when($('#page-loader').addClass('hide')).done(function(){
    $('#page-container').addClass('in');
  });
  $('.sidebar .nav > .has-sub > a').click(function() {
      var target = $(this).next('.sub-menu');
      var otherMenu = '.sidebar .nav > li.has-sub > .sub-menu';
  
      if ($('.page-sidebar-minified').length === 0) {
          $(otherMenu).not(target).slideUp(250, function() {
              $(this).closest('li').removeClass('expand');
          });
          $(target).slideToggle(250, function() {
              var targetLi = $(this).closest('li');
              if ($(targetLi).hasClass('expand')) {
                  $(targetLi).removeClass('expand');
              } else {
                  $(targetLi).addClass('expand');
              }
          });
      }
  });
  $('.sidebar .nav > .has-sub .sub-menu li.has-sub > a').click(function() {
      if ($('.page-sidebar-minified').length === 0) {
          var target = $(this).next('.sub-menu');
          $(target).slideToggle(250);
      }
  });
  $('[data-click=sidebar-toggled]').click(function(e) {
        e.stopPropagation();
        var sidebarClass = 'page-sidebar-toggled';
        var targetContainer = '#page-container';

        if ($(targetContainer).hasClass(sidebarClass)) {
            $(targetContainer).removeClass(sidebarClass);
        } else if (sidebarProgress !== true) {
            $(targetContainer).addClass(sidebarClass);
        } else {
            sidebarProgress = false;
        }
        if ($(window).width() < 480) {
            $('#page-container').removeClass('page-right-sidebar-toggled');
        }
    });
  $('[data-click=sidebar-minify]').click(function(e) {
        e.preventDefault();
        var sidebarClass = 'page-sidebar-minified';
        var targetContainer = '#page-container';
        $('#sidebar [data-scrollbar="true"]').css('margin-top','0');
        $('#sidebar [data-scrollbar="true"]').removeAttr('data-init');
        $('#sidebar [data-scrollbar=true]').stop();
        if ($(targetContainer).hasClass(sidebarClass)) {
            $(targetContainer).removeClass(sidebarClass);
            if ($(targetContainer).hasClass('page-sidebar-fixed')) {
                if ($('#sidebar .slimScrollDiv').length !== 0) {
                    $('#sidebar [data-scrollbar="true"]').slimScroll({destroy: true});
                    $('#sidebar [data-scrollbar="true"]').removeAttr('style');
                }

                $('#sidebar [data-scrollbar=true]').trigger('mouseover');
            } else if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                if ($('#sidebar .slimScrollDiv').length !== 0) {
                    $('#sidebar [data-scrollbar="true"]').slimScroll({destroy: true});
                    $('#sidebar [data-scrollbar="true"]').removeAttr('style');
                }

            }
        } else {
            $(targetContainer).addClass(sidebarClass);
            
            if(!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                if ($(targetContainer).hasClass('page-sidebar-fixed')) {
                    $('#sidebar [data-scrollbar="true"]').slimScroll({destroy: true});
                    $('#sidebar [data-scrollbar="true"]').removeAttr('style');
                }
                $('#sidebar [data-scrollbar=true]').trigger('mouseover');
            } else {
                $('#sidebar [data-scrollbar="true"]').css('margin-top','0');
                $('#sidebar [data-scrollbar="true"]').css('overflow', 'visible');
            }
        }
        $(window).trigger('resize');
    });

        function cargarContenido(div,URL){
          $(div).load(URL);
        }
        
        $("a[href$='1_usuarios']").click(function(event){
            event.preventDefault();
            Pace.restart();
            cargarContenido(('#ajax-content'),'assets/ajax/department/1/usuarios.php');
            return false;
        });

        $("a[href$='3_Pasivo_Nomina']").click(function(event){
            event.preventDefault();
            Pace.restart();
            cargarContenido(('#ajax-content'),'assets/ajax/pasivos.php');
            return false;
        });
        
        $("a[href$='4_Head_Count']").click(function(event){
            event.preventDefault(); 
            Pace.restart();        
            cargarContenido(('#ajax-content'),'assets/ajax/head_count.php');
            return false;
        });

        $("a[href$='cerrar_session']").click(function(event){
            event.preventDefault();
            Pace.restart();
            cargarContenido(('#ajax-content'),'assets/ajax/cerrar_session.php');
            return false;
        });
});
