<body class="hold-transition skin-green sidebar-mini fixed">
<!-- Site wrapper -->

<!-- TERMINA SECCIÓN MODALES -->
<div class="wrapper">

<header class="main-header">
    <!-- Logo -->
    <a href="main-sis.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>dm</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Administradores</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="../img/avatars/siscon160.png" class="user-image" alt="User Image">
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
              <img src="../img/avatars/siscon160.png" class="img-circle" alt="User Image">
              <p>
                  <small>Usuario: <b><?php echo $_SESSION['usuario']; ?></b></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div style="position:relative;">
                  <a href="../pages/login.php?cerrar_sesion=true" class="btn btn-default btn-flat bg-black" style="width:100%;"><i class="fa fa-sign-out"></i> Cerrar sesión</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
         <!--  <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->