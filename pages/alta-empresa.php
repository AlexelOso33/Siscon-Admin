<?php 
  include_once '../funciones/sesiones.php';
  include_once '../funciones/bd_conexion.php';
  include_once '../templates/header.php'; 
  include_once '../templates/barra.php';
  include_once '../templates/navegacion.php';

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Alta de nuevas empresas
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <div class="row">
      <div style="width:90%;margin: 0 auto;">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Alta empresa</h3>
          </div>
            <form role="form" method="post" id="save-forms" action="./funciones/actions.php">
              <div class="box-body">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="n-new-emp">Nº nueva emp.</label>
                    <input type="text" class="form-control" id="n-new-emp" value="<?php
                        try {
                            $sql = "SELECT `number_business` AS number FROM `business_data` ORDER BY `number_business` DESC limit 1";
                            $cons = $conn->query($sql);
                            $busi = $cons->fetch_assoc();
                            $n_business = $busi['number']+1;
                            echo str_pad($n_business, 10, "0", STR_PAD_LEFT);
                        } catch (\Throwable $th) {
                            echo "Error: ".$th->getMessage();
                        }
                    ?>" disabled>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="user-emp">S.USER emp.</label>
                    <input type="text" class="form-control" name="s-user-emp" id="s-user-emp" placeholder="Super Usuario" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="s-password-emp">S. PASS. emp.</label>
                    <input type="password" class="form-control" name="s-password-emp" id="s-password-emp" placeholder="Super Password" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name-emp">NAME emp.</label>
                    <input type="text" class="form-control" name="name-emp" id="name-emp" placeholder="Empresa BD" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name-bd">Nombre BD</label>
                    <input type="text" class="form-control" name="name-bd" id="name-bd" placeholder="Nombre de la BD" required>
                  </div>
                </div>
              </div> <!-- Finaliza box body -->
              <div class="box-footer cent-text">
                <input type="hidden" name="action" value="alta-business">
                <input type="hidden" name="usuario" value="<?php echo $_SESSION['usuario']; ?>">
                <input type="submit" class="btn bg-black" value="Guardar datos" style="width:25%;">
                <input type="reset" class="btn bg-white" value="Borrar formulario" style="width:25%;">
              </div>
            </form>
        </div>
      </div>
    </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include_once '../templates/footer.php'; ?>
