<style>
  h3{
    text-align: center;
    margin-bottom: 40px;
  }
  th,td{
    text-align: center;
  }
  .id{
    width: 10%;
  }
  .user{
    width: 25%;
  }
  .passwd{
    width: 25%;
  }
  .action{
    width: 40%;
  }
  #feedback{ 
    font-size: 1.4em; 
  }
  #selectable .ui-selecting{ 
    background: #FECA40; 
  }
  #selectable .ui-selected{ 
    background: #F39814; 
    color: white; 
  }
  #selectable{ 
    list-style-type: none; 
    margin: 0; 
    padding: 0; 
    width: 60%; 
  }
  #selectable li{ 
    margin: 3px; 
    padding: 0.4em;
    font-size: 1.4em;
    height: 18px; 
  }
</style>

  <div class="container">
    <div class="row">   
      <div class="col-md-1"></div>
      <div class="col-md-10">
        <h3>Administracion Usuarios</h3>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-2">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create_user">Crear Usuario</button>
      </div>
      <div class="col-md-10"></div>
      <div class="col-md-12">
        <table class="table table-striped table-bordered tabla">
          <thead>
          <tr>
            <th class="id">ID</th>
            <th class="user">USUARIO</th>
            <th class="action">ACCIONES</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td>1</td>
            <td id="nombres">jorge</td>
            <td>
              <a href="crear_usuario"><span class="glyphicon glyphicon-pencil"></span></a>
              <a href="crear_usuario"><span class="glyphicon glyphicon-trash"></span></a>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div id="uno">
      
    </div>
  </div>
  <div class="modal fade" id="create_user" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="usuarios_mensaje">Crear Usuario</h4>
        </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="new_user_name" class="control-label">Usuario</label>
            <input id="new_user_name" type="text" class="form-control" autocomplete="off" required > 
          </div>
          <div class="form-group">
            <label for="new_user_password" class="control-label">Contraseña</label>
            <input id="new_user_password" type="password" class="form-control" autocomplete="off" required>
          </div>
          <div class="form-group">
            <label for="Departamento" class="control-label">Departamento</label>
            <br />
          <select id="Departamento" >
            <option value="1">Administracion</option>
            <option value="2">Secretaria</option>
            <option value="3">Medico</option>
            <option value="4">Medico Diagnostico</option>
          </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button id="create_new_user" type="button" class="btn btn-primary" data-dismiss="modal">Crear Usuario</button>
      </div>
      </div>
    </div>
  </div>

<script>
  (function(){
    $('#nombres').html('Karla');
    $('#create_new_user').click(function(e){
          var data = { 
            NameUser:       $('#new_user_name').val(),
            PasswordUser:   Sha256.hash($('#new_user_password').val()),
            DepartmentUser: $('#Departamento').val()
          };
          $.ajax({
            type:          "post",
            url:           "./model/class/create_user.php",
            async:         true,
            cache:         false,
            data:          JSON.stringify(data),
            contentType:   "application/json; charset=utf-8",
            dataType :     "json",
            beforeSend:    function(response){
            },
            success:       function(response){
              if(response.Success){
                $('#new_user_name').val(''),
                $('#new_user_password').val(''),
                $('#Departamento').val(1),
                $("#create_user").modal('toggle');
              }
              else{
                $('#new_user_name').val(''),
                $('#new_user_password').val(''),
                $('#Departamento').val(''),
                $("#create_user").modal('toggle');
              }
            },
            error:         function(response, error){
              alert("Error Interno: " + error);
            }  
          });
        return false;  
      });
  })();
</script>