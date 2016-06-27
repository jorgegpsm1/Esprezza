<?php @session_start(); ?>

<link href="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/data-tables/media/css/dataTables.bootstrap.css'); ?>" rel="stylesheet" />
<link href="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/data-tables/extensions/Responsive/css/responsive.bootstrap.css'); ?>" rel="stylesheet" />

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
    <div id="create" class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
      <div class="panel panel-inverse">
          <div class="panel-heading">
            <div class="panel-heading-btn">
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title"><i class="glyphicon glyphicon-plus"></i>Crear Proyecto</h4>
          </div>
          <div class="panel-body">
            <form class="form-bordered">
              <fieldset>
                <legend>Nuevo Proyecto</legend>
                  <div id="CreateProyect" class="col-md-12 col-lg-12 hidden">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                      <div class="form-group">
                        <label class="control-label">Proyecto No: </label>
                        <label class="control-label" id="noProyecto" ></label>
                      </div>
                    </div>
                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                      <div class="form-group">
                        <label class="col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label">Elegir Color </label>
                        <div class="col-xs-8 col-sm-6 col-md-8 col-lg-8">
                          <ul class="list-unstyled">
                            <li class="dropdown">
                              <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:;">
                                <input id="SelectColor" type="input" class="form-control input-md" readonly="readonly" data-toggle='tooltip' />
                              </a>
                              <ul id="Colors" role="menu" class="dropdown-menu input-md animated fadeInLeft">
                              </ul>
                            </li>
                          </ul>     
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-2 col-sm-2 1ol-md-2 col-lg-2">
                      <div class="form-group">
                        <div id="actions" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        </div>
                      </div>
                    </div>
                  </div>
              </fieldset>
            </form>
        </div>
      </div>        
    </div>
    <div id="edit" class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
      <div class="panel panel-inverse">
          <div class="panel-heading">
            <div class="panel-heading-btn">
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title"><i class="glyphicon glyphicon-edit"></i>Editar Proyecto</h4>
          </div>
          <div class="panel-body">
              <fieldset>
                <legend>Proyectos</legend>
                  <div id="EditProyect" class="col-md-12 col-lg-12 hidden">
                    <table id='myTable' class='table table-striped table-bordered'>
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
  App.setPageTitle('Catalogos | Proyectos');
  App.restartGlobalFunction();
  $.getScript(Setting.base_url+'/assets/plugins/data-tables/media/js/jquery.dataTables.js').done(function() {
    $.getScript(Setting.base_url+'/assets/plugins/data-tables/media/js/dataTables.bootstrap.js').done(function() {
      $.getScript(Setting.base_url+'/assets/plugins/data-tables//extensions/Responsive/js/dataTables.responsive.js').done(function() {
        $.getScript(Setting.base_url+'/assets/js/modules/1.4.2.js').done(function(){
          App.setController(Proyect);
        });
      });
    });
  });
</script>