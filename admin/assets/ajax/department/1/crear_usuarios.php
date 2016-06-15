  <?php @session_start(); ?>

  <link href="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/bootstrap-wizard/css/bwizard.css'); ?>" rel="stylesheet" />
  <link href="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/parsley/src/parsley.css'); ?>" rel="stylesheet" />
  <link href="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/bootstrap-select/dist/css/bootstrap-select.css'); ?>" rel="stylesheet" />
  <div class="panel panel-inverse">
    <div class="panel-heading">
      <div class="panel-heading-btn">
        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
      </div>
      <h4 class="panel-title">Registro de empleados</h4>
    </div>
    <div class="panel-body">
      <form data-parsley-validate="true" name="form-wizard">
        <div id="wizard">
          <ol>
            <li>
              <label class="control-label">Acceso
                <small>Datos de ingreso al sistema.</small>
              </label>
            </li>
            <li>
              <label class="control-label">Informacion del Contacto
                <small>Informacion y configuracion general.</small>
              </label>
            </li>
            <li>
              <label class="control-label">Permisos
                <small>Departamentos, Areas, Modulos.</small>
              </label>
            </li>
            <li>
              <label class="control-label">Verificar Informacion
                <small>Validar la informacion.</small>
              </label>
            </li>
          </ol>
          <div class="wizard-step-1">
            <fieldset>
              <legend class="pull-left width-full">Identificacion</legend>
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
                      <input type="password" id="username_passwd" placeholder="Contraseña" class="form-control" data-parsley-group="wizard-step-1" required />
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
                      <select id="genero" class="selectpicker form-control" data-parsley-group="wizard-step-2" data-width="100%">
                        <option value="0">Hombre</option>
                        <option value="1">Mujer</option>
                      </select>
                    </label>
                  </div>
                </div>
                <div class="col-md-6 col-lg-6">
                  <div class="form-group">
                    <label>Departamento 
                      <select id="departamentos" class="selectpicker form-control" data-parsley-group="wizard-step-2" data-width="100%"></select>
                    </label>
                  </div>
                </div>
                <div class="col-md-6 col-lg-6">
                  <div class="form-group" id="new_roles">
                    <label>Puesto  
                      <select id="roles" class="selectpicker form-control" data-parsley-group="wizard-step-2" data-width="100%"></select>
                    </label>
                  </div>
                </div>
              </div>
            </fieldset>
          </div>
          <div class="wizard-step-3">
            <fieldset>
            <legend class="pull-left width-full">Permisos</legend>
            <div id="permisos" class="row">
            </div>
            </fieldset>
          </div>
          <div>
          <div class="jumbotron m-b-0 text-center">
            <h1>Verifique su informacion</h1>
            <p><a id="Registro" class="btn btn-success btn-lg" role="button">Proceder con el registro</a></p>
          </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <script>
    App.restartGlobalFunction();
    $.getScript('<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/form-wizards-demo/js/form-wizards-validation.demo.js'); ?>').done(function(){
        FormWizardValidation.init();
    });
  </script>