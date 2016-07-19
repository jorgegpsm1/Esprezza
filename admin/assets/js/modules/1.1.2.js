var RestartCreateUser = function(){
    $('#name').val("");
    $("#username").val("");
    $('#passwd').val("");
    $("#first_name").val("");
    $("#last_name").val("");
    $('#Genero').val("");
    $('#Jobs').val("");
    $('#Roles').val("");
    $("#Jobs").empty();
    $("#Roles").empty();
}
var SuccessCreateUser =  function(){
  var template="";
  template+= "<div class='alert alert-success fade in'>";
  template+= "<span class='close' data-dismiss='alert'>×</span>";
  template+= "<i class='fa fa-check fa-2x pull-left'></i>";
  template+= "<p>Empleado creado satisfactoriamente.</p>";
  template+= "</div>";
  return template;
};
var getJobs = function(){
    $.getJSON(Setting.base_url+'/controller/trigger/empleados.php?urls=1.1.2&action=1', function(){
    })
    .done(function(Response,statusText,jqXhr){
      var SelectJobs  = "";
      var SelectRoles = "";

      if(Response.Success){
        if(Response.Data){
          for(var x=0; x<Response.Data[0].length; x++){
            SelectJobs+="<option value="+Response.Data[0][x][0]+">"+Response.Data[0][x][1]+"</option>";
          }
          for(var x=0; x<Response.Data[1][0].length; x++){
            SelectRoles+="<option value="+Response.Data[1][0][x][0]+">"+Response.Data[1][0][x][1]+"</option>";
          }
          $("#Jobs").append(SelectJobs);
          $("#Jobs").attr("title","Puestos");

          $("#Roles").append(SelectRoles);
          $("#Roles").attr("title","Perfiles");
         }
       else{
        $("#Jobs").prop("disabled",true);
        $("#Jobs").attr("title","Sin registros");

        $("#Roles").prop("disabled",true);
        $("#Roles").attr("title","Sin registros");
       }
      }
      $(".selectpicker").selectpicker({ 
        style: 'form-control',
        size: 4
      });
    },function(Response){
      $("#Jobs").change(function(){
        $("#Roles").selectpicker('destroy');
        $("#Roles").empty();
        SelectRoles="";
        var Roles = $("#Jobs").val();
        if(Response.Data[1].length > 1){
          for(var x=0; x<Response.Data[1].length; x++){
            if(x==Roles-1){
              for(var y=0; y<Response.Data[1][x].length; y++){
                SelectRoles+="<option value="+Response.Data[1][x][y][0]+">"+Response.Data[1][x][y][1]+"</option>";
              }
            }
          }
          $("#Roles").append(SelectRoles);
          $("#Roles").attr("title","Perfiles");
        }
        else{
          $("#Roles").prop("disabled",true);
          $("#Roles").attr("title","Sin registros");
        }

        $("#Roles").selectpicker({ 
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
var getAccess = function(){
    $.getJSON(Setting.base_url+"/controller/trigger/empleados.php?urls=1.1.2&action=2", function(){
    })
    .done(function(Response,statusText,jqXhr){
        var TemplateDepartaments ="";
        var DeptID;
        var DeptsName=[];
        var DeptsID=[];

        TemplateDepartaments+="<div class='col-md-4 col-md-offset-4'>";
        TemplateDepartaments+="<div class='form-group'> ";
        TemplateDepartaments+="<h2 class='text-center'>DEPARTAMENTOS</h2>";
        TemplateDepartaments+="<hr />";
        TemplateDepartaments+="<ul class='list-group'>";
        $.each(Response.Data[0],function(){
          $.each(this, function(Key, Value){
            if(Key == 0){
              DeptID = Value;
              DeptsID.push(Value);
            }
            else{
              DeptsName.push(Value);
              TemplateDepartaments+="<li class='list-group-item'>";
              TemplateDepartaments+=Value; 
              TemplateDepartaments+="<div class='material-switch pull-right'>";
              TemplateDepartaments+="<input id='Dpt_"+DeptID+"' type='checkbox'  />";
              TemplateDepartaments+="<label for='Dpt_"+DeptID+"' class='label-success'></label>"; 
              TemplateDepartaments+="</div>";
              TemplateDepartaments+="</li>";
            }
          });     
        });
        TemplateDepartaments+="</ul>";
        TemplateDepartaments+="</div>";
        TemplateDepartaments+="</div>";
        $("#Permisos").append(TemplateDepartaments);


        $("#Permisos").append("<div class='clearfix'></div>");
        $("#Permisos").append("<h2 class='text-center'>AREAS</h2><hr>");


        var TemplateArea = "";
        var AreaID;
        var AreasName=[];
        var AreasID=[];
        Area=0;
        $.each(Response.Data[1],function(){
          TemplateArea+="<div class='col-md-3'>";
          TemplateArea+="<div class='form-group'> ";
          TemplateArea+="<h4 class='text-center'>"+DeptsName[Area]+"</h4>";
          TemplateArea+="<ul class='list-group'>";
          $.each(this, function(){
            $.each(this, function(Key, Value){
              if(Key == 0){
                AreaID = Value;
                AreasID.push(Value);
              }
              else{
                AreasName.push(Value);
                TemplateArea+="<li class='list-group-item'>";
                TemplateArea+=Value; 
                TemplateArea+="<div class='material-switch pull-right'>";
                TemplateArea+="<input id='Area_"+DeptsID[Area]+"_"+AreaID+"' type='checkbox' disabled />";
                TemplateArea+="<label for='Area_"+DeptsID[Area]+"_"+AreaID+"' class='label-success'></label>"; 
                TemplateArea+="</div>"; 
                TemplateArea+="</li>";
              }
            });
          });
          TemplateArea+="</ul>";
          TemplateArea+="</div>";
          TemplateArea+="</div>";
          Area++;
        });
        $("#Permisos").append(TemplateArea);
        $("#Permisos").append("<div class='clearfix'></div>");
        $("#Permisos").append("<h2 class='text-center'>MODULOS</h2><hr>");

        var TemplateModule = "";
        var ModuleID;
        Modulos=0;
        Areas=0;
        $.each(Response.Data[2],function(){
          $.each(this, function(){
            TemplateModule+="<div class='col-md-3'>";
            TemplateModule+="<div class='form-group'> ";
            TemplateModule+="<h4 class='text-center'>"+AreasName[Modulos]+"</h4>";
            TemplateModule+="<ul class='list-group'>";
            $.each(this, function(){
              $.each(this, function(Key, Value){
               // alert("Llave: "+Key+" Valor: "+Value);
                if(Key == 0){
                  ModuleID = Value;
                }
                else{
                  TemplateModule+="<li class='list-group-item'>";
                  TemplateModule+=Value; 
                  TemplateModule+="<div class='material-switch pull-right'>";
                  TemplateModule+="<input id='Modulo_"+DeptsID[Areas]+"_"+AreasID[Modulos]+"_"+ModuleID+"' type='checkbox' disabled />";
                  TemplateModule+="<label for='Modulo_"+DeptsID[Areas]+"_"+AreasID[Modulos]+"_"+ModuleID+"' class='label-success'></label>"; 
                  TemplateModule+="</div>"; 
                  TemplateModule+="</li>";
                }
              });
            });
            TemplateModule+="</ul>";
            TemplateModule+="</div>";
            TemplateModule+="</div>";
            Modulos++;
          });
          Areas++;
        });
        $("#Permisos").append(TemplateModule);
        $("#Permisos").append("<div class='clearfix'></div>");

    },function(){
      var CheckDept;
      $("input[id^='Dpt_']").change(function(){
        CheckDept = $(this).is(':checked');
        var Len = $(this).attr('id');
        var Str = Len.split('_',2);
        if(CheckDept){
          $("input[id^='Area_"+Str[1]+"']").prop("disabled",false);
        }
        else{
          $("input[id^='Area_"+Str[1]+"']").prop("disabled",true);
          $("input[id^='Area_"+Str[1]+"']").prop('checked', false);
          $("input[id^='Modulo_"+Str[1]+"']").prop("disabled",true);
          $("input[id^='Modulo_"+Str[1]+"']").prop('checked', false);
        }
      });
      var CheckArea;
      $("input[id^='Area_']").change(function(){
        CheckArea = $(this).is(':checked');
        var Len = $(this).attr('id');
        var Str = Len.split('_',3);
        if(CheckArea){
          $("input[id^='Modulo_"+Str[1]+"_"+Str[2]+"']").prop("disabled",false);
        }
        else{
          $("input[id^='Modulo_"+Str[1]+"_"+Str[2]+"']").prop("disabled",true);
          $("input[id^='Modulo_"+Str[1]+"_"+Str[2]+"']").prop('checked', false);
        }
      });
     
    }
    )
    .fail(function(){
    })
    .always(function(){
    });
}
var EventsCreate = function(){
  "use strict";
  $("#username").change(function(){
    $("#username").val($.trim($("#username").val().toLowerCase()));
    $.getJSON(Setting.base_url+'/controller/trigger/empleados.php?urls=1.1.2&action=4',
    { 
      Username : $("#username").val()+"@esprezza.com"
    },function(){
    })
    .done(function(Response,statusText,jqXhr){
      if(Response.Success){
        if(Response.Data==0){
          $("#Registro").removeClass("registros");
        }
        else{
          $("#Registro").addClass("registros");
        }
      }
    })
    .fail(function(){
    
    });
  });
  $("#Registro").click(function(event){
    event.preventDefault();

    if($("#Registro").hasClass("registros")){
      return false;
    }

    var Check_Departamento;
    var Check_Area;
    var Check_Module;

    var Departamentos_Access=[];
    var Area_Access=[];
    var Module_Access=[];
    var Val;

    Val=0;
    $("input[id^='Dpt_']").each(function(){
      Check_Departamento = $(this).is(':checked');
      var Len = $(this).attr('id');
      var Str = Len.split('_',2);
      Check_Departamento =  (Check_Departamento) ? 1 : 0;
      Departamentos_Access[Val] = [];
      Departamentos_Access[Val].push(Str[1],Check_Departamento);
      Val++;
    });
  
    Val=0;
    $("input[id^='Area_']").each(function(){
      Check_Area = $(this).is(':checked');
      var Len = $(this).attr('id');
      var Str = Len.split('_',3);
      Check_Area =  (Check_Area) ? 1 : 0;
      Area_Access[Val] = []
      Area_Access[Val].push(Str[1],Str[2],Check_Area);
      Val++;
    });

    Val=0;
    $("input[id^='Modulo_']").each(function(){
      Check_Module = $(this).is(':checked');
      var Len = $(this).attr('id');
      var Str = Len.split('_',4);
      Check_Module =  (Check_Module) ? 1 : 0;
      Module_Access[Val] = []
      Module_Access[Val].push(Str[1],Str[2],Str[3],Check_Module);
      Val++;
    });

    function ucfirst(str,force){
        str=force ? str.toLowerCase() : str;
        return str.replace(/(\b)([a-zA-Z])/,
                 function(firstLetter){
                    return   firstLetter.toUpperCase();
                 });
   }

    $("#username").val($.trim($("#username").val().toLowerCase()));
    $("#name").val($.trim($("#name").val().toLowerCase()));
    $("#first_name").val($.trim($("#first_name").val().toLowerCase()));
    $("#last_name").val($.trim($("#last_name").val().toLowerCase()));

    $("#first_name").val(ucfirst($("#first_name").val(),true));
    $("#last_name").val(ucfirst($("#first_name").val(),true));

    var Len = $('#name').val();
    var Str = Len.split(' ',2)
    Str[0] = ucfirst(Str[0],true);
    Str[1] = (Str[1]) ? (ucfirst(Str[1],true)) : "";

    var data = {
      Username        : $("#username").val()+"@esprezza.com",
      Passwd          : Sha256.hash($('#passwd').val()),
      Name_first      : Str[0],
      Name_last       : Str[1],
      FirstName       : $("#first_name").val(),
      LastName        : $("#last_name").val(),
      Gender          : $('#Genero').val(),
      Jobs            : $('#Jobs').val(),
      Rol             : $('#Roles').val(),
      Departaments    : Departamentos_Access,
      Areas           : Area_Access,
      Modules         : Module_Access

    };
    
    $.ajax({
      type:          "post",
      url:           Setting.base_url+'/controller/trigger/empleados.php?urls=1.1.2&action=3',
      async:         false,
      cache:         false,
      data:          JSON.stringify(data),
      contentType:   "application/json; charset=utf-8",
      dataType :     "json",
      beforeSend:    function(Response){
        $("#CreateContent").addClass('hidden');
        var target = $("#CreatePanel");
        if (!$(target).hasClass('panel-loading')){
          var targetBody = $(target).find('.panel-body');
          var spinnerHtml = '<div class="panel-loader"><span class="spinner-small"></span></div>';
          $(target).addClass('panel-loading');
          $(targetBody).prepend(spinnerHtml);
          setTimeout(function() {
            $(target).removeClass('panel-loading');
            $(target).find('.panel-loader').remove();
          }, 700);
        };
        RestartCreateUser();
        getJobs();
      },
      success:       function(Response){
        $("#CreateContent").removeClass('hidden');
        if(Response.Success){
          $("#CreatePanel .panel-body").prepend(SuccessCreateUser());
          $("#Registro").addClass("registros");
        }
        else{
          $("#CreatePanel .panel-body").prepend(SuccessCreateUser());
        }
      },
      error:         function(Response, error){

      }  
    });
  });  
}
var FormValidation = function(){
  "use strict";
  getJobs();
  getAccess();
  $("#wizard").bwizard({ validating: function (e, ui) { 
    if (ui.index == 0){
      if (false === $('form[name="form-wizard"]').parsley().validate('wizard-step-1')){
        return false;
      }
    } 
    else if (ui.index == 1){
      if (false === $('form[name="form-wizard"]').parsley().validate('wizard-step-2')){
        return false;
      }
    } 
    else if (ui.index == 2){
      if (false === $('form[name="form-wizard"]').parsley().validate('wizard-step-3')){
        return false;
      }
    }
  }
  });
};
var CreateUser = function(){
  "use strict";
  FormValidation();
  EventsCreate();
}
var EditUser = function(){
  "use strict";
  //getEditTable();
}
var Init = function(){
  "use strict";
  CreateUser();
  $("#CreateContent").removeClass("hidden");
  EditUser();
  $("#EditContent").removeClass("hidden");


  $($("#CreatePanel").parent()).find("[data-click=panel-reload]").click(function(){
      $("#CreateContent").addClass('hidden');
      RestartCreateUser();
      CreateUser();
      $("#CreateContent").removeClass('hidden');
  });

  $($("#EditPanel").parent()).find("[data-click=panel-reload]").click(function(){
    $("#EditContent").addClass('hidden');
      EditUser();
    $("#EditContent").removeClass('hidden');
  });
};
var Empleados = function (){
  "use strict";
  return {
    init: function (){
      Init();
    }
  };
}();