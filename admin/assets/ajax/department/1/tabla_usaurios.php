<?php @session_start(); ?>
<link href="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/data-tables/media/css/dataTables.bootstrap.css'); ?>" rel="stylesheet" />
<link href="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/data-tables/extensions/Responsive/css/responsive.bootstrap.css'); ?>" rel="stylesheet" />
<style>
  tr>th{
    font-size: 14px;
  }
  tr>td{
    font-size: 12px;
  }
  table a{
    margin: 0px 3px;
  }
  .botons{
    border-radius: 50%;
  }
  table i{
    color:#FFFFFF;
  }
</style>
<div class="panel panel-inverse">
  <div class="panel-heading">
  <div class="panel-heading-btn">
    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
  </div>
  <h4 class="panel-title">Tabla Empleados</h4>
  </div>
  <div class="panel-body">
    <table id="data-table" class="table table-striped table-bordered text-center">
      <thead></thead>
      <tbody></tbody>
    </table>
  </div>
</div>
<script>
  $.getJSON("<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/controller/trigger/usuarios.php?action=0'); ?>", function(){
    console.log("success");
    })
  .done(function(Response,statusText,jqXhr){
    if(Response.Success){
      var headers = "<tr>";
      headers+= "<th>"+Response.Columnas[0]+"</th>";
      headers+= "<th>"+Response.Columnas[1]+"</th>";
      headers+= "<th>"+Response.Columnas[2]+"</th>";
      headers+= "<th>"+Response.Columnas[3]+"</th>";
      headers+= "</tr>";

      var filas='';
      var id='';
      $.each(Response.Filas,function(){
          filas+="<tr>";
          $.each(this, function(Key, Value){
            if(Key==0){
              id=Value;
            }
            filas+="<td>"+Value+"</td>";
          });
          filas+="<td>";
          filas+="<a class='btn btn-inverse botons' href='descargar_expediente.php?info="+id+"'><i class='fa fa-pencil'></i></a>";
          filas+="<a class='btn btn-inverse botons' href='descargar_expediente.php?info="+id+"'><i class='fa fa-trash-o'></i></a>";
          filas+="</td>";
          filas+="</tr>";
      });

      $("#data-table > thead").append(headers);
      $("#data-table > tbody").append(filas);
    }
  })
  .fail(function(){
  })
  .always(function(){
  });
  App.restartGlobalFunction();
  $.getScript('<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/data-tables/media/js/jquery.dataTables.js'); ?>').done(function(){
    $.getScript('<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/data-tables/media/js/dataTables.bootstrap.js'); ?>').done(function(){
      $.getScript('<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/data-tables/extensions/Responsive/js/dataTables.responsive.js'); ?>').done(function(){
        $.getScript('<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/table-manage-default/js/table-manage-default.demo.js'); ?>').done(function(){
          TableManageDefault.init();
        });
      });
    });
  });
</script>
