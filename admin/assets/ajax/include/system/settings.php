<?php session_start(); ?>

<div id="content" class="content">
<style>
  .btn {
    margin-bottom: 20px;
    font-family: "Montserrat", sans-serif;
    border: none;
    outline: none;
    padding: 15px 25px;
    border-radius: 3px;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
  }
  </style>
  <div class='profile-container'>
    <div class="row">
      <div class="profile-left col-xs-3 col-sm-3 col-md-3">
        <div class="sidebar-header col-xs-12 col-sm-12 col-md-12">
          <figure>
            <img src="http://localhost:8000/PROYECTOS/ESPREZZA/admin/assets/img/profile_img/default_avatar_male.jpg" alt="">
          </figure>
          <p>John Doe</p>
        </div>
        <div class="sidebar-menu-item sidebar-menu-item-active col-xs-12 col-sm-12 col-md-12">
          <i class="fa fa-user"></i>Perfil
        </div>
        <div class="sidebar-menu-item col-xs-12 col-sm-12 col-md-12">
          <i class="fa fa-lock"></i>Seguridad
        </div>
      </div>
      <div class="profile-right col-xs-9 col-sm-9 col-md-9">
        <div class='profile-content'>
          <div class='profile-content-avatar'>
            <figure class='profile-avatar-overlay'>
              <img class='sidebar-avatar' src="https://unsplash.it/30/?image=209" alt="">
              <p>John Doe</p>
            </figure>
          </div>
          <div class='settings-form'>
            <form action='#' method='post'>
              <div class="row">
                <div class="col-md-3">
                  
                </div>
                <div class="col-md-3">
                  
                </div>
                <div class="clearfix"></div>
                <div class="col-md-4">
                  
                </div>
                <div class="col-md-4">
                  
                </div>
                <div class="clearfix"></div>
              </div>
              <label class='settings-form-input-label'>Tu correo: </label>
              <input type='text' class='settings-form-input' value="jorge.garcia@esprezza.com" disabled>
              <hr class="divider">
              <label class='settings-form-input-label'>Tu nombre: </label>
              <input class='settings-form-input' placeholder='jorge' type='text'>
              <label class='settings-form-input-label'>Tu apellido paterno:</label>
              <input class='settings-form-input' placeholder='garcia' type='text'>
              <label class='settings-form-input-label'>Tu apellido materno:</label>
              <input class='settings-form-input' placeholder='padilla' type='text'>
            </form>
            <button class='btn settings-save-button'>Save</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>