var Obtener_Departamento = function(){
    $.getJSON(Setting.base_url+"/controller/trigger/usuarios.php?action=1", function(){
    })
    .done(function(Response,statusText,jqXhr){
        var Departamento ="";
        var Rol="";
        var Val;

        Val=1;
        $.each(Response.PUESTOS,function(){
          $.each(this, function(Key, Value){
            Departamento+="<option value="+Val+">"+Value+"</option>";
          });
          Val++;
        });

        Val=1;
        $.each(Response.ROLES,function(){
            if(Val == 1){
              $.each(this, function(Key, Value){
                Rol+="<option value="+(Key+1)+">"+Value+"</option>";
              });
            }
          Val++;
        });
        $("#departamentos").append(Departamento);
        $("#roles").append(Rol);
        $(".selectpicker").selectpicker({
          style: 'form-control',
          size: 4
        });
    },function(Response){
      $("#departamentos").change(function(){
        $("#roles").selectpicker('destroy');
        $("#new_roles").empty();
        var Val_user = $("#departamentos").val();
        var Val = 1;
        var Rol="";
        Rol+="<label>Puesto ";
        Rol+="<select id='roles' class='selectpicker form-control' data-parsley-group='wizard-step-2' data-width='100%'>";
        $.each(Response.ROLES,function(){
            if(Val == Val_user){
              $.each(this, function(Key, Value){
                Rol+="<option value="+(Key+1)+">"+Value+"</option>";
              });
            }
          Val++;
        });
        Rol+="</select>";
        Rol+="</label>";
        $("#new_roles").append(Rol);
        $(".selectpicker").selectpicker({ 
          style: 'form-control',
          size: 4
        });
      });
    })
    .fail(function(){
    })
    .always(function(){
    });
}
var Obtener_Permisos = function(){
    $.getJSON(Setting.base_url+"/controller/trigger/usuarios.php?action=2", function(){
    })
    .done(function(Response,statusText,jqXhr){
        $("#permisos").empty();
        var Departamentos ="";
        var Depts=[];
        var Areas="";
        var Val_1;
        var Val_2;
        Val_1=1;
        Departamentos+="<div class='col-md-4 col-md-offset-4'>";
        Departamentos+="<div class='form-group'> ";
        Departamentos+="<h4 class='text-center'>DEPARTAMENTOS</h4>";
        Departamentos+="<hr />";
        Departamentos+="<ul id='dept' class='list-group'>";
        $.each(Response.DEPARTAMENTOS,function(){
          $.each(this, function(Key, Value){
            Departamentos+="<li class='list-group-item'>";
            Departamentos+=Value; 
            Departamentos+="<div class='material-switch pull-right'>";
            Departamentos+="<input id='Dpt_"+Val_1+"' type='checkbox'  />";
            Departamentos+="<label for='Dpt_"+Val_1+"' class='label-success'></label>"; 
            Departamentos+="</div>"; 2
            Departamentos+="</li>";
            Depts.push(Value); 
          });           
          Val_1++;
        });
        Departamentos+="</ul>";
        Departamentos+="</div>";
        Departamentos+="</div>";
        Departamentos+="<div class='clearfix'></div>";
        $("#permisos").append(Departamentos);

        $("#permisos").append("<div class='clearfix'></div>");

        $("#permisos").append("<h4 class='text-center'>AREAS</h4><hr>");

          Val_2=1;
          $.each(Response.AREAS,function(){
            Areas+="<div id='Dep_1' class='col-md-3'>";
            Areas+="<div class='form-group'> ";
            Areas+="<h4>"+Depts[Val_2-1]+"</h4>";
            Areas+="<ul class='list-group'>";
            $.each(this, function(Key, Value){
              Areas+="<li class='list-group-item'>";
              Areas+=Value; 
              Areas+="<div class='material-switch pull-right'>";
              Areas+="<input id='Area_"+Val_2+"_"+(Key+1)+"' type='checkbox' disabled />";
              Areas+="<label for='Area_"+Val_2+"_"+(Key+1)+"' class='label-success'></label>"; 
              Areas+="</div>"; 
              Areas+="</li>";
            });
            Val_2++;
            Areas+="</ul>";
            Areas+="</div>";
            Areas+="</div>"
          });
          $("#permisos").append(Areas);

          $("#permisos").append("<div class='clearfix'></div>");

          $("#permisos").append("<h4 class='text-center'>MODULOS</h4><hr>");
    },function(){
      var Check;
      $("input[id^='Dpt_']").change(function(){
        Check = $(this).is(':checked');
        var Len = $(this).attr('id');
        var Str = Len.split('_',2);
        if(Check){
          $("input[id^='Area_"+Str[1]+"']").prop("disabled",false);
        }
        else{
          $("input[id^='Area_"+Str[1]+"']").prop("disabled",true);
          $("input[id^='Area_"+Str[1]+"']").prop('checked', false);
        }
      });
     
    })
    .fail(function(){
    })
    .always(function(){
    });
}

var handleBootstrapWizardsValidation = function(){
	"use strict";
  $("#content").removeClass('hidden');
	$("#wizard").bwizard({ validating: function (e, ui) { 
	        if (ui.index == 0){
                if (false === $('form[name="form-wizard"]').parsley().validate('wizard-step-1')){
                    return false;
                }
                Obtener_Departamento();
	        } 
            else if (ui.index == 1){
                if (false === $('form[name="form-wizard"]').parsley().validate('wizard-step-2')){
                    return false;
                }
                Obtener_Permisos();
	        } 
            else if (ui.index == 2){
                if (false === $('form[name="form-wizard"]').parsley().validate('wizard-step-3')){
                    return false;
                }
                
                $("#Registro").click(function(event){
                  event.preventDefault();
                  var Select_Genero = $('#genero').val();
                  var Select_Departamento = $('#departamentos').val();
                  var Select_Puesto = $('#roles').val();

                  var Check_Departamento;
                  var Check_Area;

                  var Departamentos_Access=[];
                  var Area_Access=[];

                  var Val;
                  Val = 0;
                  $("input[id^='Dpt_']").each(function(){
                     Check_Departamento = $(this).is(':checked');
                     var Len = $(this).attr('id');
                     var Str = Len.split('_',2);
                     Departamentos_Access[Val] = []
                     Departamentos_Access[Val].push(Str[1],Check_Departamento);
                     Val++;
                  });
                  Val = 0;
                  $("input[id^='Area_']").each(function(){
                     Check_Area = $(this).is(':checked');
                     var Len = $(this).attr('id');
                     var Str = Len.split('_',3);
                     Area_Access[Val] = []
                     Area_Access[Val].push(Str[1],Str[2],Check_Area);
                     Val++;
                  });

                    var Len = $('#name').val();
                    var Str = Len.split(' ',2)

                  var data  = {
                    NameUser:       $('#username').val()+"@exprezza.com",
                    PasswordUser:   Sha256.hash($('#username_passwd').val()),
                    Name_first:     Str[0],
                    Name_last:      Str[1],
                    first_name:     $('#first_name').val(),
                    last_name:      $('#last_name').val(),
                    Gener:          Select_Genero,
                    Departamento:   Select_Departamento,
                    Area:           Select_Puesto,
                    DepartmentUser: Departamentos_Access,
                    AreaUser:       Area_Access
                    };

                    $.ajax({
                    type:          "post",
                    url:           Setting.base_url+"/controller/trigger/usuarios.php?action=5",
                    async:         false,
                    cache:         false,
                    data:          JSON.stringify(data),
                    contentType:   "application/json; charset=utf-8",
                    dataType :     "json",
                    beforeSend:    function(response){
                    },
                    success:       function(response){
                    if(response.Success){
     
                    }
                    else{
 
                    }
                    },
                    error:         function(response, error){
                    alert("Error Interno: " + error);
                    }  
                    });
                });
	        }
	    } 
	});
};

var FormWizardValidation = function (){
	"use strict";
    return {
        init: function () {
            $.getScript(Setting.base_url+'/assets/plugins/parsley/dist/parsley.js').done(function(){
                $.getScript(Setting.base_url+'/assets/plugins/bootstrap-wizard/js/bwizard.js').done(function(){
                    $.getScript(Setting.base_url+'/assets/plugins/bootstrap-select/dist/js/bootstrap-select.js').done(function(){
                        handleBootstrapWizardsValidation();                 
                    });
                });
            });
        }
    };
}();