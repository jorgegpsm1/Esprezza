<?php @session_start(); ?>

<link href="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/data-tables/media/css/dataTables.bootstrap.css'); ?>" rel="stylesheet" />
<link href="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/data-tables/extensions/Responsive/css/responsive.bootstrap.css'); ?>" rel="stylesheet" />
<link href="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/bootstrap-select/dist/css/bootstrap-select.css'); ?>" rel="stylesheet" />

<style>
  #SelectColor{
    cursor: pointer;
  }
  #actions button{
    margin-left: 5px;
    margin-right: 5px;
  }
</style>
<div id="content" class="content">
  <h1 class="page-header"></h1>
  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 ui-sortable">
      <div id="CreatePanel" class="panel panel-inverse">
        <div class="panel-heading">
          <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
          </div>
          <h4 class="panel-title"><i class="glyphicon glyphicon-plus"></i>Crear Equipo</h4>
        </div>
        <div id="CreateBody" class="panel-body">
          <form class="form-bordered form-inline">
            <fieldset>
              <legend>Nuevo Equipo</legend>
                <div id="CreateContent" class="col-md-12 col-lg-12 hidden">
                  <form class="form-inline">
                    <div class="row">
                      <div class="col-md-2">
                        <div class="form-group">
                          <div class="input-group">
                            <label class="control-label">Equipo 
                              <a id="noEquipo" class="btn btn-inverse btn-icon btn-circle"></a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                      <div class="form-group pull-right">
                        <div class="input-group">
                          <label class="control-label">Proyecto 
                            <select id="Proyecto" class="selectpicker form-control" data-live-search="true" data-width="100px"></select>
                          </label>
                        </div>
                      </div>
                      </div>
                      <div class="col-md-4">
                      <div class="form-group pull-right">
                        <div class="input-group">
                          <label class="control-label">Usuarios 
                            <select id="Usuarios" class="selectpicker form-control" data-live-search="true" data-width="100px"></select>
                          </label>
                        </div>
                      </div>
                      </div>
                      <div class="col-md-2">
                      <div class="form-group pull-right">
                        <div class="input-group">
                          <label class="control-label"> 
                            <a id="CreateInput" class="btn btn-primary btn-icon btn-circle"><i class="glyphicon glyphicon-ok"></i></a>
                          </label>
                        </div>
                      </div>
                      </div>
                    </div>
                  </form>
                </div>
            </fieldset>
          </form>
        </div>
      </div>        
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 ui-sortable">
      <div id="EditPanel" class="panel panel-inverse">
          <div class="panel-heading">
            <div class="panel-heading-btn">
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title"><i class="glyphicon glyphicon-edit"></i>Editar Equipo</h4>
          </div>
          <div id="EditBody" class="panel-body">
            <fieldset>
              <legend>Equipos</legend>
                <div id="EditContent" class="col-md-12 col-lg-12 hidden">
                  <table id="myTable" class='table table-striped table-bordered'>
                    <thead><th></th></thead>
                    <tbody><tr><td></td></tr></tbody>
                  </table>
                </div>
            </fieldset>
          </div>
      </div>        
    </div>
  </div>
</div>
<script>
  App.setPageTitle('Catalogos | Equipos');
  App.restartGlobalFunction();
  $.getScript(Setting.base_url+'/assets/plugins/data-tables/media/js/jquery.dataTables.js').done(function() {
    $.getScript(Setting.base_url+'/assets/plugins/data-tables/media/js/dataTables.bootstrap.js').done(function() {
      $.getScript(Setting.base_url+'/assets/plugins/data-tables//extensions/Responsive/js/dataTables.responsive.js').done(function() {
        $.getScript(Setting.base_url+'/assets/plugins/bootstrap-select/dist/js/bootstrap-select.js').done(function(){
          $.getScript(Setting.base_url+'/assets/js/modules/1.4.1.js').done(function(){
             App.setController(Team);
          });
        });
      });
    });
  });
</script>