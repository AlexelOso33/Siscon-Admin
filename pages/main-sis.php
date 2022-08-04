<?php
  include_once dirname(__FILE__, 2).'/funciones/sesiones.php';
  include_once '../templates/header.php';
  include_once '../templates/barra.php';
  include_once '../templates/navegacion.php';

 include_once '../funciones/bd_conexion.php';

    // Nuevos usuarios sin enviar el correo
  try {
    $sql = "SELECT COUNT(id_demo) AS nuevos FROM `demos_data` WHERE `mail_sent` = 0";
    $req = $conn->query($sql);
    $demos = $req->fetch_assoc();
    $nuevos = $demos['nuevos'];
  } catch (\Throwable $th) {
    echo "Error: ".$th->getMessage();
  }
  
    // Nuevos usuarios para crear BD
    try {
        $sql1 = "SELECT COUNT(operation_ds) as cuenta FROM `data_sent_site` WHERE (`operation_ds` = 0 OR `operation_ds` = 1)";
        $req1 = $conn->query($sql1);
        $n_mail = $req1->fetch_assoc();
        $n_mail = $n_mail['cuenta'];
    } catch (\Throwable $th) {
        echo "Error: ".$th->getMessage();
    }
  
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1> Estadísticas generales </h1>
      </section>
      <!-- Main content -->
      <section class="content">

        <div class="row">
          <!-- Inscripciones de demostraciones -->
          <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-black">
              <div class="inner">
                <h3 id="demos-insc"><?php echo $nuevos; ?></h3>
                <p>Inscripciones demos</p>
              </div>
              <a href="nueva-demo.php" class="small-box-footer">Ir al enlace <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ******************* -->
          
          <!-- Nuevos usuarios para crear BD -->
          <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-black">
              <div class="inner">
                <h3 id="demos-insc"><?php echo $n_mail; ?></h3>
                <p>Pendiente de BD</p>
              </div>
              <a href="generar-crud.php" class="small-box-footer">Ir al enlace <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ******************* -->
          
        </div>

        <section class="content-header">
            <h1> Accesos directos </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-lg-6 col-xs-12">
                    <div class="small-box bg-blue">
                    <div class="inner">
                        <h3>Nueva contratación</h3>
                        <p>Crear nuevo usuario</p>
                    </div>
                    <a href="contrato-plan.php" class="small-box-footer">Ir al enlace <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row text-right"><p style="font-style:italic;padding-right:20px;">Última actualización <?php
          $hoy = date('Y-m-d h:i:s');
          $hoy = strtotime('-3 hour', strtotime($hoy));
          $hoy = date('d/m/Y h:i:s', $hoy);
          echo $hoy;
        ?></p></div>
      </section>
      <!-- /.content -->
   
  </div>
  <!-- /.content-wrapper -->

<?php include_once '../templates/footer.php'; ?>
