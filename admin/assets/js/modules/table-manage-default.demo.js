var Obtener_Resgistros = function(){
  $.getJSON(Setting.base_url+'/controller/trigger/empleados.php?action=1.3.0', function(){
  })
  .done(function(Response,statusText,jqXhr){
    if(Response.Status){
      var Headers = "<tr>";
      Headers+=     "<th>"+Response.Columnas[0]+"</th>";
      Headers+=     "<th>"+Response.Columnas[1]+"</th>";
      Headers+=     "<th>"+Response.Columnas[2]+"</th>";
      Headers+=     "<th>"+Response.Columnas[3]+"</th>";
      Headers+=     "</tr>";
      var Rows='';
      var ID='';
      $.each(Response.Filas,function(){
          Rows+="<tr>";
          $.each(this, function(Key, Value){
            if(Key==0){
              id=Value;
            }
            Rows+="<td>"+Value+"</td>";
          });
          Rows+="<td>";
          filas+="<a class='btn btn-inverse botons' href='descargar_expediente.php?info="+ID+"'><i class='fa fa-pencil'></i></a>";
          Rows+="<a class='btn btn-inverse botons' href='descargar_expediente.php?info="+ID+"'><i class='fa fa-trash-o'></i></a>";
          Rows+="</td>";
          Rows+="</tr>";
      });
      $("#data-table > thead").append(Headers);
      $("#data-table > tbody").append(Rows);
    }
  })
  .fail(function(){
  })
  .always(function(){
  });
}

var handleDataTableDefault = function(){
  "use strict";
  $("#content").removeClass('hidden');

  if ($('#data-table').length !== 0){
    $('#data-table').DataTable({
      responsive: true
    });
  }
};

var TableManageDefault = function (){
  "use strict";
  return {
    init: function () {
      handleDataTableDefault();
    }
  };
}();