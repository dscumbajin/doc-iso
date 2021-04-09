<footer class="main-footer">
  <!-- /.content-wrapper -->
  <div class="pull-right hidden-xs">
    <b>Version</b> 1.0.0
  </div>
  <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="">Baterias<span>Ecuador</span></a>.</strong> Todos los derechos reservados
</footer><!-- ./wrapper -->
</div>


<!-- jQuery 2.2.3 -->
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>


<!-- iCheck -->
<script src="../plugins/iCheck/icheck.min.js"></script>
<script>
  $(function() {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>

<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<!-- SlimScroll -->
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>

<!-- Select2 -->
<script src="../plugins/select2/select2.full.min.js"></script>
<!-- page script -->
<script>
  $(function() {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });

    $(".select2").select2();
  });

  $(function() {
    $('#example3').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });

    $(".select2").select2();
  });
</script>

<script>
  $("#loader").fadeIn('slow');
  $(document).ready(function() {
    load(1);

  });


  function load(page) {
    var q2 = $("#q2").val();

    $.ajax({
      url: './action/search_file.php?action=ajax&page=' + page + '&q2=' + q2,
      beforeSend: function(objeto) {
        $('#loader').html('<img src="../images/ajax-loader.gif"> Cargando...');
      },
      success: function(data) {
        $('.outer_div').html(data).fadeIn('slow');
        $('#loader').html('');
      }
    })
  }
</script>
</body>

</html>