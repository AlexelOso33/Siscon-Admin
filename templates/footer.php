<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Versi贸n actual del sistema:</b> 1.0.0 <um></um>
  </div>
  <strong>SISCON庐</strong>. Sitio exclusivo para desarrolladores y administradores del sistema.
</footer>

    <!-- Control Sidebar en el futuro -->
    
  </div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../js/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="../js/select2.full.min.js"></script>
<!-- Morris.js charts -->
<script src="../js/raphael.min.js"></script>
<script src="../js/morris.min.js"></script>
<!-- InputMask -->
<script src="../js/jquery.inputmask.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.5/jquery.inputmask.min.js"></script> -->
<script src="../js/jquery.inputmask.extensions.js"></script>
<script src="../js/jquery.inputmask.date.extensions.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.js"></script>
<!-- bootstrap datepicker -->
<script src="../js/bootstrap-datepicker.min.js"></script>
<script src="../js/bootstrap-datepicker.es.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script> -->
<!-- Animate Number -->
<script src="../js/jquery.animateNumber.min.js"></script>
<!-- SlimScroll -->
<script src="../js/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="../js/icheck.min.js"></script>
<!-- FastClick -->
<!-- <script src="../js/fastclick.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.6/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="../js/adminlte.min.js"></script>
<!-- DataTable -->
<script src="../js/jquery.dataTables.min.js"></script>
<script src="../js/dataTables.bootstrap.min.js"></script>
<!-- SweetAlert2 -->
<script src="../js/sweetalert2.all.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../js/demo.js"></script>
<!-- Botones de dataTables -->
<script src="../js/dataTables.buttons.min.js"></script>
<script src="../js/buttons.print.min.js"></script>
<script src="../js/buttons.flash.min.js"></script>
<script src="../js/vfs_fonts.js"></script>
<!-- Llamado a los scripts de modificaci贸n -->
<script src="../js/app.js"></script>
<!-- Llamado a todas los js del sistema -->
<script src="../js/usuarios-ajax.js"></script>
<script>
  $('#l-ventas').dataTable({
        'paging'      : true,
        'searching'   : true,
        'lengthChange': true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,
        "scrollX": true,
        "bAutoWidth": true,
        scrollCollapse: true,
        'language'  : {
          paginate: {
            next: 'Siguiente',
            previous: 'Anterior',
            last: 'Último',
            first: 'Primero'
          },
          info: 'Mostrando _START_ a _END_ de _TOTAL_ resultados',
          emptyTable: 'No hay registros',
          infoEmpty: '0 registros',
          search: 'Buscar:',
          sZeroRecords: 'No se encontraron resultados',
          sInfoFiltered: '(Filtrados de _MAX_ registros)',
          sLengthMenu: 'Mostrar _MENU_ registros'
        }
    });
</script>
</body>
</html>