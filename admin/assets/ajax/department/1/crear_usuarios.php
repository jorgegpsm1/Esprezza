<?php @session_start(); ?>
  <link href="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/bootstrap-wizard/css/bwizard.min.css'); ?>" rel="stylesheet" />
  <link href="<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/plugins/parsley/src/parsley.css'); ?>" rel="stylesheet" />


  <div class="panel panel-inverse">
  <div class="panel-heading">
  <div class="panel-heading-btn">
  <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
  <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
  <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
  <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
  </div>
  <h4 class="panel-title">Empleados</h4>
  </div>
  <div class="panel-body">
  <form action="/" method="POST" data-parsley-validate="true" name="form-wizard">
  <div id="wizard">
  <ol>
  <li>
  Identification 
  <small>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</small>
  </li>
  <li>
  Contact Information
  <small>Aliquam bibendum felis id purus ullamcorper, quis luctus leo sollicitudin.</small>
  </li>
  <li>
  Login
  <small>Phasellus lacinia placerat neque pretium condimentum.</small>
  </li>
  <li>
  Completed
  <small>Sed nunc neque, dapibus non leo sed, rhoncus dignissim elit.</small>
  </li>
  </ol>
  <div class="wizard-step-1">
  <fieldset>
  <legend class="pull-left width-full">Identification</legend>
  <div class="row">
  <div class="col-md-4">
  <div class="form-group block1">
  <label>First Name</label>
  <input type="text" name="firstname" placeholder="John" class="form-control" data-parsley-group="wizard-step-1" required />
  </div>
  </div>
  <div class="col-md-4">
  <div class="form-group">
  <label>Middle Initial</label>
  <input type="text" name="middle" placeholder="A" class="form-control" data-parsley-group="wizard-step-1" required />
  </div>
  </div>
  <div class="col-md-4">
  <div class="form-group">
  <label>Last Name</label>
  <input type="text" name="lastname" placeholder="Smith" class="form-control" data-parsley-group="wizard-step-1" required />
  </div>
  </div>
  </div>
  </fieldset>
  </div>
  <div class="wizard-step-2">
  <fieldset>
  <legend class="pull-left width-full">Contact Information</legend>
  <div class="row">
  <div class="col-md-6">
  <div class="form-group">
  <label>Phone Number</label>
  <input type="text" name="phone" placeholder="1234567890" class="form-control" data-parsley-group="wizard-step-2" data-parsley-type="number" required />
  </div>
  </div>
  <div class="col-md-6">
  <div class="form-group">
  <label>Email Address</label>
  <input type="email" name="email" placeholder="someone@example.com" class="form-control" data-parsley-group="wizard-step-2" data-parsley-type="email" required />
  </div>
  </div>
  </div>
  </fieldset>
  </div>
  <div class="wizard-step-3">
  <fieldset>
  <legend class="pull-left width-full">Login</legend>
  <div class="row">
  <div class="col-md-4">
  <div class="form-group">
  <label>Username</label>
  <div class="controls">
  <input type="text" name="username" placeholder="johnsmithy" class="form-control" data-parsley-group="wizard-step-3" required />
  </div>
  </div>
  </div>
  <div class="col-md-4">
  <div class="form-group">
  <label>Pasword</label>
  <div class="controls">
  <input type="password" name="password" placeholder="Your password" class="form-control" data-parsley-group="wizard-step-3" required />
  </div>
  </div>
  </div>
  <div class="col-md-4">
  <div class="form-group">
  <label>Confirm Pasword</label>
  <div class="controls">
  <input type="password" name="password2" placeholder="Confirmed password" class="form-control" />
  </div>
  </div>
  </div>
  </div>
  </fieldset>
  </div>
  <div>
  <div class="jumbotron m-b-0 text-center">
  <h1>Login Successfully</h1>
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consequat commodo porttitor. Vivamus eleifend, arcu in tincidunt semper, lorem odio molestie lacus, sed malesuada est lacus ac ligula. Aliquam bibendum felis id purus ullamcorper, quis luctus leo sollicitudin. </p>
  <p><a class="btn btn-success btn-lg" role="button">Proceed to User Profile</a></p>
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