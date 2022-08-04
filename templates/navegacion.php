  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
            <div class="pull-left image">
                <img src="../img/avatars/siscon160.png" class="img-circle" alt="User Image">
              </div>
        <div class="info">
          <p>     
            <?php echo $_SESSION['usuario']; ?>
          </p>
          <!-- <a href="#"><i class="fa fa-circle text-success"></i> En línea</a> -->
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Módulos</li>
        <li>
          <a href="../pages/main-sis.php">
            <span>Página principal</span>
            </span>
          </a>
        </li>
        <li class="treeview"><a href="#"><i class="fa fa-building"></i>
            <span>Empresas</span>
            <i class="fa fa-angle-left pull-right"></i><span class="label pull-right"></span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../pages/alta-empresa.php"> Alta empresa</a></li>
            <li><a href="../pages/contrato-plan.php"> Nuevo contrato</a></li>
            <li><a href="#"> Creación BD</a></li>
            <li><a href="#"> Administrar Emp.</a></li>
          </ul>
        </li>
        <li class="treeview"><a href="#"><i class="fa fa-mouse-pointer"></i>
            <span>Demostraciones</span>
            <i class="fa fa-angle-left pull-right"></i><span class="label pull-right"></span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../pages/nueva-demo.php"> Alta demostraciones</a></li>
            <li><a href="#"> Permisos de app</a></li>
            <li><a href="#"> Alta usuarios</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i>
            <span>Clientes</span>
            <i class="fa fa-angle-left pull-right"></i>
            <span class="label pull-right"></span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"> Clientes activos</a></li>
            <li><a href="#"> Potenciales clientes</a></li>
          </ul>
        </li>
        <li class="treeview"><a href="#"><i class="fa fa-user-circle-o"></i>
            <span>CRM</span>
            <i class="fa fa-angle-left pull-right"></i><span class="label pull-right"></span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"> Formularios activos</a></li>
            <li><a href="#"> Fuente de inscripciones</a></li>
            <li><a href="#"> RR.SS.</a></li>
          </ul>
        </li>
        <li class="treeview"><a href="#"><i class="fa fa-database"></i>
            <span>Base de datos</span>
            <i class="fa fa-angle-left pull-right"></i><span class="label pull-right"></span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"></i> BD Empresas</a></li>
            <li><a href="#"> BD admin</a></li>
            <li><a href="#"> BD data</a></li>
          </ul>
        </li>
        <?php if($_SESSION['usuario'] == 'masterKey'): ?>
        <li class="treeview">
        <a href="#">
            <i class="fa fa-users"></i>
            <span>Usuarios</span>
            <i class="fa fa-angle-left pull-right"></i>
            <span class="label pull-right"></span>
          </a>
        <ul class="treeview-menu">
          <li><a href="../pages/crear-usuario.php"><i class="fa fa-circle-o text-red"></i> <span>Crear usuarios</span></a></li>
          <li><a href="#"><i class="fa fa-circle-o text-orange"></i> <span>Lista de usuarios</span></a></li>
        </ul>
        <?php endif ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->
  