<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title id="page-title">Esprezza | Dashboard</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />

	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css'); ?>" rel="stylesheet" />
	<link href="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/bootstrap/css/bootstrap.css'); ?>" rel="stylesheet" />
	<link href="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/font-awesome/css/font-awesome.css'); ?>" rel="stylesheet" />
	<link href="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/animate/css/animate.css'); ?>" rel="stylesheet" />
	<link href="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/bootstrap-fileinput/css/fileinput.css'); ?>" rel="stylesheet" />
  <link href="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/css/style.css'); ?>" rel="stylesheet" />
	<link href="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/css/style-responsive.css'); ?>" rel="stylesheet" />

	<script src="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/pace/pace.js'); ?>"></script>
</head>
<body>
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<div id="header" class="header navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<a href="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/index.php'); ?>" class="navbar-brand">
					<span class="navbar-logo">
						<figure>
							<img src="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/img/login/esprezza_1.png'); ?>" alt="">
						</figure>
					</span>ESPREZZA</a>
					<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown navbar-user">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<img id="profile_img_header" src="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/img/profile_img/'.self::$USER_INFO[0]['IMG']) ?>" alt="" /> 
							<span class="hidden-xs"><?php echo (self::$USER_INFO[0]['NAME']) ?></span> <b class="caret"></b>
						</a>
						<ul class="dropdown-menu animated fadeInLeft" role="menu">
							<li class="arrow"></li>
							<li><a href="javascript:;" class="text-left"><i class="fa fa-user"></i>Perfil</a></li>
							<li><a href="javascript:;" class="text-left"><i class="fa fa-cog"></i>Ajustes</a></li>
							<li class="divider"></li>
							<li><a href="cerrar_session" class="text-center">Cerrar session</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
		<div id="sidebar" class="sidebar">
			<div data-scrollbar="true" data-height="100%">
				<ul class="nav">
					<li class="nav-profile">
						<div class="image">
							<div class="image-upload">
								<label for="file-input">
									<img id="profile_img_sidebar" src="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/img/profile_img/'.self::$USER_INFO[0]['IMG']) ?>">
								</label>
									<input type="file" id="file-input" accept="image/*" />
							</div>
						</div>
						<div class="info">
							<?php echo (self::$USER_INFO[0]['NAME']) ?>
							<small><?php echo (self::$USER_INFO[0]['ROLE_NAME']) ?></small>
						</div>
					</li>
				</ul>
				<ul class="nav">
					<li class="nav-header">Navegacion</li>
					<?php 
					$Department = count(self::$USER_ACCESS[0]);
					for($x=0; $x<$Department; $x++){
						switch(self::$USER_ACCESS[0][$x]){
							case 1:
								$Area = count(self::$USER_ACCESS[1][$x]);
								require_once($_SESSION['BASE_DIR_BACKEND'].'/view/include/1/departament.php');
							break;

							case 2:
								$Area = count(self::$USER_ACCESS[1][$x]);
								require_once($_SESSION['BASE_DIR_BACKEND'].'/view/include/2/departament.php');
							break;

							case 3:
								$Area = count(self::$USER_ACCESS[1][$x]);
								require_once($_SESSION['BASE_DIR_BACKEND'].'/view/include/3/departament.php');
							break;

							case 4:
								$Area = count(self::$USER_ACCESS[1][$x]);
								require_once($_SESSION['BASE_DIR_BACKEND'].'/view/include/4/departament.php');
							break;
						}	
					}
					?>
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
				</ul>
			</div>
		</div>
		<div class="sidebar-bg"></div>
		<div id="ajax-content"></div>

		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
	</div>
	
	<script src="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/jquery/jquery-1.9.1.min.js'); ?>"></script>
  <script src="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/jquery/jquery-migrate-1.1.0.min.js'); ?>"></script>
	<script src="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js'); ?>"></script>
	<script src="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/bootstrap/js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/bootstrap-fileinput/js/fileinput.min.js'); ?>"></script>
	<!--[if lt IE 9]>
		<script src="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/crossbrowserjs/html5shiv.js'); ?>"></script>
    <script src="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/crossbrowserjs/respond.min.js'); ?>"></script>
    <script src="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/crossbrowserjs/excanvas.min.js'); ?>"></script>
	<![endif]-->
	<script src="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/jquery-hashchange/jquery.hashchange.min.js'); ?>"></script>
	<script src="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/slimscroll/jquery.slimscroll.min.js'); ?>"></script>
	<script src="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/jquery-cookie/jquery.cookie.js'); ?>"></script>
	<script src="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/js/sha.js'); ?>"></script>
  <script src="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/js/apps.js'); ?>"></script>
  <script>
  	var Setting = {
  			base_url : "<?php echo ($_SESSION['BASE_DIR_FRONTEND']); ?>"
  	};
  </script>
</body>
</html>