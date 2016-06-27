var restartCreat = function(){
  $("#SelectColor").attr("class","form-control");
  $("#SelectColor").removeAttr("data-title");
};
var successCreateProyect  =  function(){
  var template="";
  template+= "<div class='alert alert-success fade in'>";
  template+= "<span class='close' data-dismiss='alert'>×</span>";
  template+= "<i class='fa fa-check fa-2x pull-left'></i>";
  template+= "<p>Proyecto creado satisfactoriamente.</p>";
  template+= "</div>";
  return template;
};
var getCreateID = function(){
  $.getJSON(Setting.base_url+'/controller/trigger/catalogo.php?urls=1.4.2&action=1', function(){
  })
  .done(function(Response,statusText,jqXhr){
    if(Response.Success){
      if(Response.Data==0){
        $("#noProyecto").text(1);
      }else{
        $("#noProyecto").text(Response.Data);
      }
    }
  })
  .fail(function(){
    $("#noProyecto").text(1);
    alert('Error Interno');
  });
}
var getCreateColors = function(){
  $.getJSON(Setting.base_url+'/controller/trigger/catalogo.php?urls=1.4.2&action=2', function(){
  })
  .done(function(Response,statusText,jqXhr){
    if(Response.Success){
    
        var Colors   =  ["verde","gris","amarillo","rojo","azul","morado","naranja","negro"];
        
        if(Response.Data){
          $.each(Response.NameProyect,function(Key, Value){
            Colors = jQuery.grep(Colors,function(val){
              return val != Value;
            });
          });
        }
        var ListColors = "";

        $.each(Colors,function(Key, Value){
          ListColors+="<li>";
          switch(Value){
            case "verde":
              ListColors+="<a data-title='Verde' data-toggle='tooltip' class='bg-green' href='javascript:;'>&nbsp;</a>";
            break;
            case "gris":
              ListColors+="<a data-title='Gris' data-toggle='tooltip' class='bg-grey' href='javascript:;'>&nbsp;</a>";
            break;
            case "amarillo":
              ListColors+="<a data-title='Amarillo' data-toggle='tooltip' class='bg-yellow' href='javascript:;'>&nbsp;</a>";
            break;
            case "rojo":
              ListColors+="<a data-title='Rojo' data-toggle='tooltip' class='bg-red' href='javascript:;'>&nbsp;</a>";
            break;
            case "azul":
              ListColors+="<a data-title='Azul' data-toggle='tooltip' class='bg-blue' href='javascript:;'>&nbsp;</a>";
            break;
            case "morado":
              ListColors+="<a data-title='Morado' data-toggle='tooltip' class='bg-purple' href='javascript:;'>&nbsp;</a>";
            break;
            case "naranja":
              ListColors+="<a data-title='Naranja' data-toggle='tooltip' class='bg-orange' href='javascript:;'>&nbsp;</a>";
            break;
            case "negro":
              ListColors+="<a data-title='Negro' data-toggle='tooltip' class='bg-black' href='javascript:;'>&nbsp;</a>";
            break;
          }
          ListColors+="</li>";
        });
        $("#Colors").html("");
        $("#Colors").append(ListColors);

        var ActionsList = "";
        ActionsList+= "<div class='col-md-12'>";
        ActionsList+= "<button id='addProyect' class='btn btn-md btn-success input-md'><i class='glyphicon glyphicon-ok'></i></button>";
        ActionsList+= "</div>";
        $("#actions").html("");
        $("#actions").append(ActionsList);

        $("#addProyect").css('cursor', 'not-allowed');

        $("#Colors a").click(function(){
          $("#SelectColor").attr("class","form-control "+$(this).attr("class")+"");
          $("#SelectColor").attr("data-title",""+$(this).attr("data-title")+"");
          $("#addProyect").css('cursor', 'pointer');
        });

        $('[data-toggle=tooltip]').tooltip();
        

        $("#addProyect").click(function(event){
          event.preventDefault();
          if(!$("#SelectColor").is("[data-title]")){
            return;
          }
          var data = {
            ProyectID       : $("#noProyecto").html(),
            ColorSelection  : $("#SelectColor").attr("data-title").toLowerCase()
          };
          $.ajax({
            type:          "post",
            url:           Setting.base_url+'/controller/trigger/catalogo.php?urls=1.4.2&action=3',
            async:         false,
            cache:         false,
            data:          JSON.stringify(data),
            contentType:   "application/json; charset=utf-8",
            dataType :     "json",
            beforeSend:    function(Response){

              var target = $("#create .panel");
              if (!$(target).hasClass('panel-loading')) {
                var targetBody = $(target).find('.panel-body');
                var spinnerHtml = '<div class="panel-loader"><span class="spinner-small"></span></div>';
                $(target).addClass('panel-loading');
                $(targetBody).prepend(spinnerHtml);
                setTimeout(function() {
                    $(target).removeClass('panel-loading');
                    $(target).find('.panel-loader').remove();
                }, 700);
              };
            },
            success:       function(Response){
              restartCreat();
              CreateProyect();
              if(Response.Success){
                $("#create .panel-body").prepend(successCreateProyect());
              }
              else{
                $("#create .panel-body").prepend(successCreateProyect());
              }
            },
            error:         function(Response, error){

            }  
          });
        });

    }
  })
  .fail(function(){

  });
}
var restartEdit = function(){
  $('#myTable').DataTable().destroy();
  $("#myTable").empty();
};
var templateEditProyect  =  function(){
  var template="";
  template+= "<thead></thead>";
  template+= "<tbody></tbody>";
  return template;
};
var getEditTable = function(){
  $.getJSON(Setting.base_url+'/controller/trigger/catalogo.php?urls=1.4.2&action=4', function(){
    restartEdit();
    $("#myTable").append(templateEditProyect());
  })
  .done(function(Response,statusText,jqXhr){
    if(Response.Success){
      var dataTableHead = "";
      var dataTableBody = "";
      dataTableHead+="<tr><th>ID_Proyecto</th><th>Proyecto</th></tr>";
      $.each(Response.Data,function(){
        dataTableBody+="<tr>";
        $.each(this,function(Key,Value){
          dataTableBody+="<td>"+Value+"</td>";
        });
        dataTableBody+="</tr>";
      });
      $("#myTable thead").append(dataTableHead);
      $("#myTable tbody").append(dataTableBody);
    }
  },function(){
    if ($('#myTable').length !== 0){
      $('#myTable').DataTable({
        responsive: true,
        destroy: true
      });
    }
  })
  .fail(function(){
 
  });
}


var CreateProyect = function(){
  "use strict";
  getCreateID();
  getCreateColors();
};

var EditProject = function(){
  "use strict";
  getEditTable();
};



var Init = function(){
  "use strict";
  CreateProyect();
  EditProject();
  $("#CreateProyect").removeClass('hidden');
  $("#EditProyect").removeClass('hidden');

  $(document).on("click","#create [data-click=panel-reload]", function(e) {
    $("#CreateProyect").addClass('hidden');
    restartCreat();
    CreateProyect();
    $("#CreateProyect").removeClass('hidden');
  });
  $(document).on("click", "#edit [data-click=panel-reload]", function(e) {
    $("#EditProyect").addClass('hidden');
    EditProject();
    $("#EditProyect").removeClass('hidden');
  });

};


var Proyect = function (){
  "use strict";
  return {
    init: function () {
      Init();
    }
  };
}();