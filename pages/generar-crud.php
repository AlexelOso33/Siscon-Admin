<?php 
  include_once '../funciones/sesiones.php';
  include_once '../funciones/bd_conexion.php';
  include_once '../templates/header.php'; 
  include_once '../templates/barra.php';
  include_once '../templates/navegacion.php';

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Sin envío de mails -->
    <section class="content-header">
        <h1>
            Usuarios nuevos / pendientes de creción de DataBase
        </h1><br>
        <h1>Asegúrese de haber creado con anterioridad la base de datos en CPanel</h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <div class="row">
      <div style="width:90%;margin: 0 auto;">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Lista de usuarios</h3>
          </div>
          <div class="box-body">
            <table id="l-ventas" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nombre completo</th>
                  <th>Empresa</th>
                  <th>Teléfono</th>
                  <th>Correo</th>
                  <th>Sistema</th>
                  <th>Plan anual</th>
                  <th>Tipo plan</th>
                  <th>Fecha</th>
                  <th>Nombre BD</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  try {
                    $sql = "SELECT * FROM `data_sent_site` WHERE (`operation_ds` = 0 OR `operation_ds` = 1)";
                    $cons = $conn->query($sql);
                    while($us = $cons->fetch_assoc()){ ?>
                      <tr>
                        <td class="cent-text"><strong></b><?php echo $us['id_data_sent']; ?></strong></td>
                        <td><?php echo $us['name_ds']; ?></td>
                        <td><?php echo $us['business_ds']; ?></td>
                        <td><?php echo $us['phone_ds']; ?></td>
                        <td><?php echo $us['mail_ds']; ?></td>
                        <?php $sistema = ($us['tsystem_ds'] == 1) ? "POS" : "Distribución"; ?>
                        <td><?php echo $sistema; ?></td>
                        <td>
                        <?php
                          switch ($us['typeonesys_ds']) {
                            case 1:
                              echo "Mensual";
                              break;
                              case 2:
                                echo "Anual";
                                break;
                          }
                        ?>
                        <td>
                        <?php
                          switch ($us['typetwosys_ds']) {
                            case 1:
                              echo "Básico";
                              break;
                              case 2:
                                echo "Full";
                                break;
                          }
                        ?>
                        </td>
                        <td><?php echo $us['fec_includ']; ?></td>
                        <td>
                            <span>sisconsy_</span><input type="text" class="form-control name-bd">
                        </td>
                        <td>
                          <a href="#" data-id="<?php echo $us['id_data_sent']; ?>" class="btn bg-orange btn-flat make-crud">
                          <i class="fa fa-paper-plane"></i> Crear TyD
                          </a>
                        </td>
                      </tr>
                    <?php }
                  } catch (\Throwable $th) {
                    echo "Error: ".$th->getMessage();
                  }

                ?>
              </tbody>
              <tfoot>
                <tr>
                <th>ID</th>
                  <th>Nombre completo</th>
                  <th>Empresa</th>
                  <th>Teléfono</th>
                  <th>Correo</th>
                  <th>Sistema</th>
                  <th>Plan anual</th>
                  <th>Tipo plan</th>
                  <th>Fecha</th>
                  <th>Nombre BD</th>
                  <th>Acciones</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- /.content-wrapper -->

<?php include_once '../templates/footer.php'; ?>
