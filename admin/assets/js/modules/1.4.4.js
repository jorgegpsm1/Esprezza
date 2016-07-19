var SuccessCreatATC  =  function(){
  var template="";
  template+= "<div class='alert alert-success fade in'>";
  template+= "<span class='close' data-dismiss='alert'>×</span>";
  template+= "<i class='fa fa-check fa-2x pull-left'></i>";
  template+= "<p>ATC creado satisfactoriamente.</p>";
  template+= "</div>";
  return template;
};
var RestartCreateATC  = function(){
  $("#Equipo").selectpicker('destroy');
  $("#Equipo").empty();
  $("#Usuarios").selectpicker('destroy');
  $("#Usuarios").empty();
}
var getATCID = function(){
  $.getJSON(Setting.base_url+'/controller/trigger/catalogo.php?urls=1.4.4&action=1', function(){
  })
  .done(function(Response,statusText,jqXhr){
    if(Response.Success){
      if(Response.Data==0){
        $("#noATC").html("1");
      }
      else{
        $("#noATC").html(Response.Data);
      }
    }
  })
  .fail(function(){
    $("#noATC").html("1");
  });
}
var getProyectName = function(){
  $.getJSON(Setting.base_url+'/controller/trigger/catalogo.php?urls=1.4.4&action=2', function(){
  })
  .done(function(Response,statusText,jqXhr){
    if(Response.Success){
      var SelectProyect = "";
      if(Response.Data){
        for(var x=0; x<Response.Data[0].length; x++){
          SelectProyect+="<option value="+Response.Data[0][x][0]+">"+Response.Data[1][x][0]+"</option>";
        }
        $("#Equipo").append(SelectProyect);
        $("#Equipo").attr("title","Proyectos");
       }
       else{
        $("#Equipo").prop("disabled",true);
        $("#Equipo").attr("title","Sin registros");
       }
    }
  },function(){
    $("#Equipo").selectpicker({ 
      style: 'form-control',
      size: 4
    });
  })
  .fail(function(){
  });
}
var getUserName = function(){
  $.getJSON(Setting.base_url+'/controller/trigger/catalogo.php?urls=1.4.4&action=3', function(){
  })
  .done(function(Response,statusText,jqXhr){
    if(Response.Success){
      var SelectProyect = "";
      if(Response.Data){
        for(var x=0; x<Response.Data.length; x++){
          SelectProyect+="<option value="+Response.Data[x][0]+">"+Response.Data[x][1]+"</option>";
        }
        $("#Usuarios").append(SelectProyect);
        $("#Usuarios").attr("title","Proyectos");
       }
       else{
        $("#Usuarios").prop("disabled",true);
        $("#Usuarios").attr("title","Sin registros");
       }
    }
  },function(){
    $("#Usuarios").selectpicker({ 
      style: 'form-control',
      size: 4
    });
  })
  .fail(function(){
  });
}
var EventsCreate = function(){
  "use strict";
  $("#CreateInput").click(function(event){
    event.preventDefault();
    if($("#Equipo").attr('title') == "Sin registros" || $("#Usuarios").attr('title') == "Sin registros"){
      return false;
    }
    var data = {
      TeamID        : $("#Equipo").val(),
      UserID        : $("#Usuarios").val()
    };
    $.ajax({
      type:          "post",
      url:           Setting.base_url+'/controller/trigger/catalogo.php?urls=1.4.4&action=4',
      async:         false,
      cache:         false,
      data:          JSON.stringify(data),
      contentType:   "application/json; charset=utf-8",
      dataType :     "json",
      beforeSend:    function(Response){
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
          $("#CreateContent").addClass('hidden');
          RestartCreateATC();
        };
      },
      success:       function(Response){
        getATCID();
        getProyectName();
        getUserName();
        $("#CreateContent").removeClass('hidden');
        if(Response.Success){
          $("#CreatePanel .panel-body").prepend(SuccessCreatATC());
        }
        else{
          $("#CreatePanel .panel-body").prepend(SuccessCreatATC());
        }
      },
      error:         function(Response, error){

      }  
    });
  });  
}

var restartEdit = function(){
  $("#myTable").DataTable().destroy();
  $("#myTable").empty();
};
var templateEditProyect  =  function(){
  var template="";
  template+= "<thead></thead>";
  template+= "<tbody></tbody>";
  return template;
};
var getEditTable = function(){
  $.getJSON(Setting.base_url+'/controller/trigger/catalogo.php?urls=1.4.4&action=5', function(){
    restartEdit();
    $("#myTable").append(templateEditProyect());
  })
  .done(function(Response,statusText,jqXhr){
    if(Response.Success){
      var dataTableHead = "";
      var dataTableBody = "";
      dataTableHead+="<tr><th>ID ATC</th><th>Equipo</th><th>ATC</th></tr>";
      if(Response.Data){
        for(var x=0; x<Response.Data[0].length; x++){
          dataTableBody+="<tr>";
          dataTableBody+="<td>"+Response.Data[0][x][0]+"</td>";
          dataTableBody+="<td>"+Response.Data[2][x][0]+"</td>";
          dataTableBody+="<td>"+Response.Data[3][x][0]+"</td>";
          dataTableBody+="</tr>";
        }
      }
      $("#myTable thead").append(dataTableHead);
      $("#myTable tbody").append(dataTableBody);
    }
  },function(){
    if($('#myTable').length !== 0){
      $('#myTable').DataTable({
        responsive: true,
        destroy: true
      });
    }
  })
  .fail(function(){
 
  });
}

var CreateATC = function(){
  "use strict";
  getATCID();
  getProyectName();
  getUserName();
  EventsCreate();
}

var EditATC = function(){
  "use strict";
  getEditTable();
}

var Init = function(){
  "use strict";
  CreateATC();
  EditATC();
  $("#CreateContent").removeClass("hidden");
  $("#EditContent").removeClass("hidden");


  $($("#CreatePanel").parent()).find("[data-click=panel-reload]").click(function(){
      $("#CreateContent").addClass('hidden');
      RestartCreateATC();
      CreateATC();
      $("#CreateContent").removeClass('hidden');
  });

  $($("#EditPanel").parent()).find("[data-click=panel-reload]").click(function(){
    $("#EditContent").addClass('hidden');
		EditATC();
    $("#EditContent").removeClass('hidden');
  });
};


var ATC = function (){
  "use strict";
  return {
    init: function () {
      Init();
    }
  };
}();