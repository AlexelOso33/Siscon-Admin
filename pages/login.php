<?php 
  session_start();
  $cerrar_sesion = $_GET['cerrar_sesion'];
  $timeout_sesion = $_GET['tosession'];
  if($cerrar_sesion || $timeout_sesion) {
    session_destroy();
  }
  include_once dirname(__FILE__, 2).'/funciones/bd_conexion.php';
  include_once dirname(__FILE__, 2).'/templates/header.php'; 
?>

<body class="hold-transition login-page with-bggrad">
<div class="login-box" style="margin:18% auto!important;">

  <div class="box-user box-active-user" style="width:100%;">

    <p class="login-box-msg">Inicia sesión con tu credencial</p>

    <form method="post" id="login-admin-form" name="login-admin-form" action="../funciones/actions.php">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="usuario" placeholder="Usuario" style="margin-bottom:20px;" autocomplete="off">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Contraseña" style="margin-bottom:20px;" autocomplete="off">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <input type="hidden" name="login-admin" value="1">
          <?php if($_GET['tosession']){
            $idr = $_GET['idr'];
            ?>
            <input type="hidden" name="redir-url" value="<?php echo $idr; ?>">
          <?php } ?>
            <input type="submit" class="btn bg-black btn-block btn-flat" value="Ingresar" style="margin-bottom:20px;">
        </div>
      </div>
    </form>
  </div>

  <?php
    if($_GET['tosession']){ ?>
    <div class="col-md-12" style="margin-top:20px;">
      <div class="alert alert-danger alert-dismissible" style="text-align:center;">
          Su sesión se ha cerrado automáticamente después de <b>20 minutos de inactividad</b>.<br>Por favor vuelva a iniciar sesión.
      </div>
    </div>
  <?php } ?>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="../js/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../js/bootstrap.min.js"></script>
<!-- SweetAlert2 -->
<script src="../js/sweetalert2.all.min.js"></script>
<!-- SlimScroll -->
<script src="../js/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../js/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../js/adminlte.min.js"></script>
<!-- InputMask -->
<script src="../js/jquery.inputmask.js"></script>
<script src="../js/jquery.inputmask.extensions.js"></script>
<script src="../js/jquery.inputmask.date.extensions.js"></script>
<!-- Select2 -->
<script src="../js/select2.full.min.js"></script>
<!-- bootstrap datepicker -->
<script src="../js/bootstrap-datepicker.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="../js/icheck.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../js/demo.js"></script>
<!-- Llamado al modificador -->
<script src="../js/usuarios-ajax.js"></script>
<script>
    swal.fire(
            '¡Atención!',
            'Este sitio es para uso exclusivo de administradores y desarrolladores del sistema SISCON®.',
            'warning'
        )
</script>
</body>
</html>