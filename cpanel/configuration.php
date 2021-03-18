<?php 

    $active4="active"; 
    include "header.php"; 

    $configuration=mysqli_query($con,"select * from configuration");
    $configuration_rw=mysqli_fetch_array($configuration);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Configuración</h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Configuración</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div id="result"></div>
              <!-- general form elements -->
              <div class="box box-yellow">
                <div class="box-header with-border">
                  <h3 class="box-title">Configuración del Sistema</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" name="upd" id="upd">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="url_base">URL BASE</label>
                      <input type="text" class="form-control" id="url_base" placeholder="http://localhost/fileshare" name="url_base" value="<?php echo $configuration_rw['url_base'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="email">Correo Electronico</label>
                      <input type="email" class="form-control" id="email" placeholder="email" name="email" value="<?php echo $configuration_rw['email_admin'] ?>">
                    </div>
                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" id="save_data" class="btn btn-success">Actualizar</button>
                  </div>
                </form>
              </div>
              <!-- /.box -->
            </div>
    </section>
</div>                
<?php include "footer.php" ?>
<script>
$( "#upd" ).submit(function( event ) {
  $('#upd_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/updconfig.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result").html(datos);
            $('#upd_data').attr("disabled", false);
            load(1);
          }
    });
  event.preventDefault();
})

</script>