<?php include('db_connect.php') ?>
<?php
$twhere = "";
if ($_SESSION['login_type'] != 1)
  $twhere = "  ";
?>
<style>
  .small-box .icon {
    font-size: 37.5px;
    position: absolute;
    right: 15px;
    top: 15px;
    opacity: 0.5;
    transition: all 0.3s ease;
  }

  .small-box:hover .icon {
    font-size: 45px;
    top: 10px;
    opacity: 0.8;
  }

  .small-box {
    overflow: hidden;
  }

  .small-box .inner {
    z-index: 10;
    position: relative;
  }

  .small-box .icon {
    z-index: 0;
    color: rgba(0, 0, 0, 0.15);
  }
</style>
<!-- Info boxes -->
<?php if ($_SESSION['login_type'] == 1): ?>
  <div class="row">
    <div class="col-12 col-sm-6 col-md-4">
      <div class="small-box bg-info shadow-sm border">
        <div class="inner">
          <h3><?php echo $conn->query("SELECT * FROM branches")->num_rows; ?></h3>
          <p>Total de Oficinas</p>
        </div>
        <div class="icon">
          <i class="fas fa-building"></i>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4">
      <div class="small-box bg-success shadow-sm border">
        <div class="inner">
          <h3><?php echo $conn->query("SELECT * FROM parcels")->num_rows; ?></h3>
          <p>Total de Paquetes</p>
        </div>
        <div class="icon">
          <i class="fas fa-box-open"></i>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4">
      <div class="small-box bg-warning shadow-sm border">
        <div class="inner">
          <h3><?php echo $conn->query("SELECT * FROM users where type != 1")->num_rows; ?></h3>
          <p>Total de Empleados</p>
        </div>
        <div class="icon">
          <i class="fas fa-user-tie"></i>
        </div>
      </div>
    </div>
    <hr>
    <?php
    $status_arr = array("Artículo aceptado por mensajería", "Recibida", "Enviada", "En-transito", "Llegó-al-destino", "En-salida-para-entrega", "Listo-para-recoger", "Entregados", "Recogida", "Intento-de-entrega-fallido");
    $icon_arr = array("fa-inbox", "fa-check", "fa-paper-plane", "fa-truck", "fa-map-marker-alt", "fa-box", "fa-hand-holding-box", "fa-check-circle", "fa-box-check", "fa-exclamation-circle");
    $color_arr = array("bg-info", "bg-success", "bg-warning", "bg-primary", "bg-secondary", "bg-danger", "bg-light", "bg-dark", "bg-info", "bg-danger");
    foreach ($status_arr as $k => $v):
    ?>
      <div class="col-12 col-sm-6 col-md-4">
        <div class="small-box <?php echo $color_arr[$k] ?> shadow-sm border">
          <div class="inner">
            <h3><?php echo $conn->query("SELECT * FROM parcels where status = {$k} ")->num_rows; ?></h3>
            <p><?php echo $v ?></p>
          </div>
          <div class="icon">
            <i class="fas <?php echo $icon_arr[$k] ?>"></i>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

<?php else: ?>
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        Hola de nuevo <?php echo $_SESSION['login_name'] ?>!
      </div>
    </div>
  </div>
<?php endif; ?>