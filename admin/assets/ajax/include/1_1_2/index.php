<?php @session_start(); ?>

<link href="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/bootstrap-wizard/css/bwizard.css'); ?>" rel="stylesheet" />
<link href="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/parsley/src/parsley.css'); ?>" rel="stylesheet" />
<link href="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/data-tables/media/css/dataTables.bootstrap.css'); ?>" rel="stylesheet" />
<link href="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/data-tables/extensions/Responsive/css/responsive.bootstrap.css'); ?>" rel="stylesheet" />
<link href="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/bootstrap-select/dist/css/bootstrap-select.css'); ?>" rel="stylesheet" />

<style>
  .registros{
    cursor:not-allowed;
  }
</style>

<div id="content" class="content">
  <h1 class="page-header"></h1>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ui-sortable">
      <div id="CreatePanel" class="panel panel-inverse">
        <div class="panel-heading">
          <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
          </div>
          <h4 class="panel-title"><i class="glyphicon glyphicon-plus"></i>Crear Empleado</h4>
        </div>
        <div id="CreateBody" class="panel-body">
          <fieldset>
            <legend>Nuevo Empleado</legend>
              <div id="CreateContent" class="col-md-12 col-lg-12 hidden">
                <form data-parsley-validate="true" name="form-wizard">
                  <div id="wizard">
                    <ol>
                      <li>
                        <label class="control-label">Acceso
                        </label>
                      </li>
                      <li>
                        <label class="control-label">Informacion del Empleado
                        </label>
                      </li>
                      <li>
                        <label class="control-label">Permisos
                        </label>
                      </li>
                      <li>
                        <label class="control-label">Validar Informacion
                        </label>
                      </li>
                    </ol>
                    <div class="wizard-step-1">
                      <fieldset>
                        <legend class="pull-left width-full">Acceso al sistema</legend>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group block1">
                              <label>Correo electronico</label>
                              <div class="input-group">
                                <input type="text" id="username" placeholder="Correo" class="form-control" data-parsley-group="wizard-step-1" required />
                                <span class="input-group-addon">@esprezza.com</span>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Contraseña personal</label>
                                <input type="password" id="passwd" placeholder="Contraseña" class="form-control" data-parsley-group="wizard-step-1" required />
                            </div>
                          </div>
                        </div>
                      </fieldset>
                    </div>
                    <div class="wizard-step-2">
                      <fieldset>
                        <legend class="pull-left width-full">Informacion del empleado</legend>
                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Nombre completo</label>
                              <input type="text" id="name" placeholder="Nombre" class="form-control" data-parsley-group="wizard-step-2" required />
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Apellido Paterno</label>
                              <input type="text" id="first_name" placeholder="Apellido paterno" class="form-control" data-parsley-group="wizard-step-2" required />
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Apellido Materno</label>
                              <input type="text" id="last_name" placeholder="Apellido materno" class="form-control" data-parsley-group="wizard-step-2"  required />
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Sexo
                                <select id="Genero" class="selectpicker form-control" data-parsley-group="wizard-step-2" data-width="100%">
                                  <option value="0">Hombre</option>
                                  <option value="1">Mujer</option>
                                </select>
                              </label>
                            </div>
                          </div>
                          <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                              <label>Departamento 
                                <select id="Jobs" class="selectpicker form-control" data-width="100%"></select>
                              </label>
                            </div>
                          </div>
                          <div class="col-md-6 col-lg-6">
                            <div class="form-group" id="new_roles">
                              <label>Puesto  
                                <select id="Roles" class="selectpicker form-control" data-width="100%"></select>
                              </label>
                            </div>
                          </div>
                        </div>
                      </fieldset>
                    </div>
                    <div class="wizard-step-3">
                      <fieldset>
                      <legend class="pull-left width-full">Permisos</legend>
                      <div id="Permisos" class="row">
                      </div>
                      </fieldset>
                    </div>
                    <div>
                    <div class="jumbotron m-b-0 text-center">
                      <h1>Verifique su informacion</h1>
                      <p><a id="Registro" class="btn btn-success btn-lg registros" role="button">Proceder con el registro</a></p>
                    </div>
                    </div>
                  </div>
                </form>
              </div>
          </fieldset>
        </div>
      </div>        
    </div>
    <div class="clearfix"></div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ui-sortable">
      <div id="EditPanel" class="panel panel-inverse">
          <div class="panel-heading">
            <div class="panel-heading-btn">
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            </div>
            <h4 class="panel-title"><i class="glyphicon glyphicon-edit"></i>Editar Empleados</h4>
          </div>
          <div id="EditBody" class="panel-body">
            <fieldset>
              <legend>Administracion Empleados</legend>
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
  App.setPageTitle('Sistemas | Empleados');
  App.restartGlobalFunction();
  $.getScript(Setting.base_url+'/assets/plugins/parsley/dist/parsley.js').done(function(){
    $.getScript(Setting.base_url+'/assets/plugins/bootstrap-wizard/js/bwizard.js').done(function(){  
      $.getScript(Setting.base_url+'/assets/plugins/data-tables/media/js/jquery.dataTables.js').done(function(){
        $.getScript(Setting.base_url+'/assets/plugins/data-tables/media/js/dataTables.bootstrap.js').done(function(){
          $.getScript(Setting.base_url+'/assets/plugins/data-tables//extensions/Responsive/js/dataTables.responsive.js').done(function(){
            $.getScript(Setting.base_url+'/assets/plugins/bootstrap-select/dist/js/bootstrap-select.js').done(function(){
              $.getScript(Setting.base_url+'/assets/js/modules/1.1.2.js').done(function(){
                App.setController(Empleados);
              });
            });
          });
        });
      });
    });
  });
</script>