<?php 
  include_once '../funciones/sesiones.php';
  include_once '../funciones/bd_conexion.php';
  include_once '../templates/header.php'; 
  include_once '../templates/barra.php';
  include_once '../templates/navegacion.php';

  try {
    $sql = "SELECT price FROM prices_service WHERE id_price = 2";
    $query = $conn->query($sql);
    $price2 = $query->fetch_assoc();
    $price2 = number_format($price2['price'], 2, ',', '.');
  } catch (\Throwable $th) {
    echo "Error: ".$th->getMessage();
  }

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Contratación</h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <div class="row">
      <div style="width:90%;margin: 0 auto;">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Datos empresa</h3>
          </div>
            <form role="form" method="post" id="save-contract" action="./funciones/actions.php">
              <div class="box-body">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="n-new-emp">Razón social</label>
                    <input type="text" class="form-control" name="razon-social" id="razon-social" placeholder="Razón social" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="n-new-emp">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="n-new-emp">CUIT</label>
                    <input type="number" class="form-control" name="cuit" id="cuit" placeholder="Nº CUIT">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="n-new-emp">Teléfono</label>
                    <input type="number" class="form-control" name="telefono" id="telefono" placeholder="Nº Teléfono" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="n-new-emp">Dirección</label>
                    <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Dirección del negocio" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="n-new-emp">Correo electrónico</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="n-new-emp">Plan</label>
                    <select class="form-control select2" name="plan" id="plan_sel" style="width:100%;" required>
                        <option value="1">POS anual básico</option>
                        <option value="2" selected>POS anual full</option>
                        <option value="3">POS mensual básico</option>
                        <option value="4">POS mensual full</option>
                        <option value="5">Dist. anual básico</option>
                        <option value="6">Dist. anual full</option>
                        <option value="7">Dist. mensual básico</option>
                        <option value="8">Dist. mensual full</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="user-emp">Usuario</label><span style="float:right;font-size:1.2rem;display:none;" class="text-red" id="no-user">El usuario está tomado</span>
                    <input type="text" class="form-control text-blue" style="font-weight:bold;" name="usuario" id="usuario" placeholder="Usuario" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="name-bd">Nombre BD</label>
                    <input type="text" class="form-control text-blue" style="font-weight:bold;" name="name-bd" id="name-bd" placeholder="Nombre de la BD" required>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="content-header">
                    <h1 class="box-title">$&nbsp;<span id="price-plan"><?php echo $price2; ?></span></h1>
                  </div>
                </div>
              </div> <!-- Finaliza box body -->
              <div class="box-footer">
                <input type="hidden" name="action" value="alta-contrato">
                <input type="hidden" name="usuarioAuth" value="<?php echo $_SESSION['usuario']; ?>">
                <div class="col-md-3" style="margin-bottom: 10px;">
                    <input type="submit" class="btn bg-maroon" id="crearBD" value="Crear BD" style="width:100%;line-height:50px;">
                </div>
                <div class="col-md-3" style="margin-bottom: 10px;">
                    <input type="submit" class="btn bg-blue" id="cobrar" value="Cobrar" style="width:100%;line-height:50px;">
                </div>
                <div class="col-md-3" style="margin-bottom: 10px;">
                    <input type="submit" class="btn bg-olive" id="guardar" value="Guardar datos" style="width:100%;line-height:50px;">
                </div>
                <div class="col-md-3" style="margin-bottom: 10px;">
                <input type="submit" class="btn bg-black" id="enviar-inst" value="Enviar instrucciones" style="width:100%;line-height:50px;" disabled>
                </div>
                <div class="row">
                  <div class="col-md-4"></div>
                  <div class="col-md-4" style="margin-bottom: 10px;">
                      <input type="reset" class="btn bg-white" value="Cancelar" style="width:100%;line-height:50px;">
                  </div>
                </div>
              </div>
              <div class="row cent-text" style="margin-bottom: 15px;">
                    <a href="#" id="datos-cobro">Introducir datos de cobro</a>
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
