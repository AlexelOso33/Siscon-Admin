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
            Usuarios sin correo recepción demo
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <div class="row">
      <div style="width:90%;margin: 0 auto;">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Nuevos usuarios sin envío de correo</h3>
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
                  <th>Posición</th>
                  <th>Sistema</th>
                  <th>Medio insc.</th>
                  <th>Fecha</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  try {
                    $sql = "SELECT * FROM `demos_data` WHERE `mail_sent` = 0";
                    $cons = $conn->query($sql);
                    while($demos = $cons->fetch_assoc()){ ?>
                      <tr>
                        <td class="cent-text"><strong></b><?php echo $demos['id_demo']; ?></strong></td>
                        <td><?php echo $demos['name_req']; ?></td>
                        <td><?php echo $demos['name_business']; ?></td>
                        <td><?php echo $demos['tel_req']; ?></td>
                        <td><?php echo $demos['mail_req']; ?></td>
                        <td><?php echo $demos['position_req']; ?></td>
                        <?php $sistema = ($demos['system_type'] == 1) ? "POS" : "Distribución"; ?>
                        <td><?php echo $sistema; ?></td>
                        <td>
                        <?php
                          switch ($demos['medium_req']) {
                            case 1:
                              echo "Página Demostración";
                              break;
                              case 2:
                                echo "RR.SS. Facebook";
                                break;
                                case 3:
                                  echo "RR.SS. Instagram";
                                  break;
                          }
                        ?>
                        </td>
                        <td><?php echo $demos['date_include']; ?></td>
                        <td>
                          <a href="#" data-id="<?php echo $demos['id_demo']; ?>" class="btn bg-orange btn-flat send-mail">
                          <i class="fa fa-paper-plane"></i> Enviar correo
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
                  <th>Posición</th>
                  <th>Sistema</th>
                  <th>Medio insc.</th>
                  <th>Fecha</th>
                  <th>Acciones</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Alta de demostraciones -->
    <section class="content-header">
        <h1>
            Alta de permisos para demostraciones
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <div class="row">
      <div style="width:90%;margin: 0 auto;">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Alta demostración</h3>
          </div>
            <form role="form" method="post" id="save-forms" action="../funciones/actions.php">
            <div class="box-body">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="n-new-demo">Nº demostración</label>
                    <input type="text" class="form-control" id="n-new-demo" value="000000" disabled>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="user-demo">Usuario DEMO</label>
                    <input type="text" class="form-control" name="user-demo" id="user-demo" placeholder="Usuario" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="password-demo">Contraseña DEMO</label>
                    <input type="text" class="form-control" name="password-demo" id="password-demo" placeholder="Contraseña" required>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="start-date-demo">F. inicio</label>
                    <input type="datetime-local" class="form-control" name="start-date-demo" id="start-date-demo" required>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="end-date-demo">F. final</label>
                    <input type="datetime-local" class="form-control" name="end-date-demo" id="end-date-demo" required>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="type-system">Tipo Sist.</label>
                    <select class="select2 form-control" name="type-system" style="width:100%;">
                      <option value="1">POS</option>
                      <option value="2">Distribución</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="name-business">Empresa</label>
                    <select name="name-business" class="form-control select2" id="name-business" style="width:100%;" required>
                      <?php
                        try {
                          $sql = "SELECT * FROM `business_data` ORDER BY `main_name_b_d` ASC";
                          $cons = $conn->query($sql);
                          while($emp = $cons->fetch_assoc()){ ?>
                      <option value="<?php echo $emp['id_business_data']; ?>"><?php echo $emp['main_name_b_d']; ?></option>
                      <?php }
                        } catch (\Throwable $th) {
                          echo "Error: ".$th->getMessage();
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-1" style="padding-top:25px;">
                  <a href="alta-empresa.php" class="btn btn-default" style="width:100%;">
                    <i class="fa fa-plus"></i>
                  </a>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="limit-login-chk">Establecer límite</label>
                    <div style="padding-top: 5px;">
                      <input type="radio" class="icheck" name="limit-login-chk" value="0" checked>&nbspNo
                      <input type="radio" class="icheck" name="limit-login-chk" value="1">&nbspSi
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="limit-login">Cant. login's</label>
                    <input type="number" class="form-control" name="limit-login" id="limit-login" maxlength="3" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="comment-business">Añadir comentarios</label>
                    <textarea class="form-control" name="comment-business" rows="3" maxlength="250"></textarea>
                  </div>
                </div>
            </div>
              <!-- Finaliza box body -->
              <div class="box-footer cent-text">
                <input type="hidden" name="action" value="alta-demo">
                <input type="hidden" name="usuario" value="<?php echo $_SESSION['usuario']; ?>">
                <input type="submit" class="btn bg-black" value="Generar alta" style="width:25%;">
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
