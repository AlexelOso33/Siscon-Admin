<?php 
  include_once '../funciones/sesiones.php';
  include_once '../funciones/bd_conexion.php';
  include_once '../templates/header.php'; 
  include_once '../templates/barra.php';
  include_once '../templates/navegacion.php';

  // header("Location: ../auth.html");

?>

  <div class="content-wrapper">
    <section class="content-header">
        <h1>
            Crear nuevos usuarios
            <small></small>
        </h1>
    </section>
    <section class="content">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title orange-icon">Generar usuarios</h3>
        </div>
        <form role="form" method="post" id="save-forms" action="../funciones/actions.php">
          <div class="box-body">
            <div class="col-md-4">
              <div class="form-group">
                <label for="usuario">Usuario</label>
                <input type="text" class="form-control" name="usuario" placeholder="Usuario" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="name" class="form-control" name="nombre" placeholder="Nombre de usuario" required>
              </div>    
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="nivel">Rol - Nivel</label>
                  <select name="nivel" class="form-control select2" style="width: 100%;" required>        
                    <option value="1">Administrador</option>
                    <option value="2">Desarrollador</option>
                  </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                  <label for="password">Contraseña</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
              </div>    
            </div>
            <div class="col-md-4">
              <div class="form-group">
              <label for="password-rep">Repita la contraseña</label>
              <input type="password" class="form-control" id="password-rep" placeholder="Repetir contraseña" required>
              </div>
            </div>
            <div class="col-md-4">
              <span id="resultado_password" class="help-block" style="margin-top: 30px;"></span>
            </div>
          </div> <!-- /.box-body -->

          <div class="box-footer cent-text">
            <input type="hidden" name="action" value="crear-usuario">
            <input type="submit" class="btn btn-primary bg-black" id="btn-submit" style="width:25%;margin:0 auto;" value="Crear usuario" disabled>
            <input type="reset" class="btn bg-white" style="width:25%;margin:0 auto;" value="Resetear">
          </div>
        </form>
      </div> <!-- /.box -->
    </section>
  </div>

<?php include_once '../templates/footer.php'; ?>
