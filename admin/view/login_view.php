<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="es_MX">
<!--<![endif]-->
  <head>
    <meta charset="utf-8" />
    <title>Esprezza | Login Panel </title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css'); ?>" rel="stylesheet" />
    <link href="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" />
    <link href="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" />
    <link href="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/animate/css/animate.min.css'); ?>" rel="stylesheet" />
    <link href="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/css/style.css'); ?>" rel="stylesheet" />
    <link href="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/css/style-responsive.css'); ?>" rel="stylesheet" />
    <link href="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/css/default.css'); ?>" rel="stylesheet" />
    <link href="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/pace/pace.min.js'); ?>" rel="stylesheet" id="theme" />
    <script src="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/pace/pace.min.js'); ?>"></script>
  </head>
  <body class="pace-top">
    <div id="page-loader" class="fade in "><span class="spinner"></span></div>
    <div id="page-container" class="fade">
      <div class="login bg-black animated fadeInDown">
        <div class="login-header">
          <div class="brand">
            <span class="logo"></span> Esprezza
            <small>Panel administrativo</small>
          </div>
          <div class="icon">
            <i class="fa fa-sign-in"></i>
          </div>
        </div>
        <div class="login-content">
          <form class="margin-bottom-0">
            <div class="form-group m-b-20">
              <input type="text" id="UserName" class="form-control input-lg" placeholder="Usuario" require="require" autocomplete="off" autofocus />
            </div>
            <div class="form-group m-b-20">
              <input type="text" id="UserPassword" class="form-control input-lg" placeholder="Contraseña" require="require" autocomplete="off" />
            </div>
            <div class="checkbox m-b-20">
              <label>
                <input id="UserCheck" type="checkbox" /> Recordar session
              </label>
            </div>
            <div class="login-buttons">
              <button id="user_login" type="submit" class="btn btn-success btn-block btn-lg">Ingresar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script src="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/jquery/jquery-1.9.1.min.js'); ?>"></script>
    <script src="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/jquery/jquery-migrate-1.1.0.min.js'); ?>"></script>
    <script src="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js'); ?>"></script>
    <script src="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <!--[if lt IE 9]>
      <script src="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/crossbrowserjs/html5shiv.js'); ?>"></script>
      <script src="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/crossbrowserjs/respond.min.js'); ?>"></script>
      <script src="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/crossbrowserjs/excanvas.min.js'); ?>"></script>
    <![endif]-->
    <script src="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/jquery-hashchange/jquery.hashchange.min.js'); ?>"></script>
    <script src="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/slimscroll/jquery.slimscroll.min.js'); ?>"></script>
    <script src="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/jquery-cookie/jquery.cookie.js'); ?>"></script>
    <script src="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/jquery-cookie/jquery.cookie.js'); ?>"></script>
    <script src="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/js/sha.js'); ?>"></script>
    <script src="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/js/script.js'); ?>"></script>

  </body>
</html>
