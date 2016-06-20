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
<div id="content" class="content hidden">
  <h1 class="page-header">Tabla Empleados</h1>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ui-sortable">
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
    </div>
  </div>
</div>
<script>
  App.restartGlobalFunction();
  $.getScript('<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/data-tables/media/js/jquery.dataTables.js'); ?>').done(function(){
    $.getScript('<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/data-tables/media/js/dataTables.bootstrap.js'); ?>').done(function(){
      $.getScript('<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/data-tables/extensions/Responsive/js/dataTables.responsive.js'); ?>').done(function(){
        $.getScript('<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/js/modules/table-manage-default.demo.js'); ?>').done(function(){
          TableManageDefault.init();
        });
      });
    });
  });
</script>
