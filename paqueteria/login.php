<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('./db_connect.php');
ob_start();
$system = $conn->query("SELECT * FROM system_settings")->fetch_array();
foreach ($system as $k => $v) {
  $_SESSION['system'][$k] = $v;
}
ob_end_flush();
?>
<?php
if (isset($_SESSION['login_id']))
  header("location:index.php?page=home");
?>
<?php include 'header.php' ?>

<style>
  body {
    position: relative;
  }

  body::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    /* Ajusta el último valor (0.6) para cambiar la opacidad */
    z-index: -1;
  }

  .login-box {
    z-index: 1;
    position: relative;
  }
</style>

<body class="hold-transition login-page" style="background: url('./bg.jpg') no-repeat center center fixed; background-size: cover;">
  <div class="login-box">
    <div class="login-logo">
      <a href="#" style="color: white; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);"><b><?php echo $_SESSION['system']['name'] ?> ConfiguroWeb</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card" style="background: rgba(255,255,255,0.9); backdrop-filter: blur(10px);">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Inicia sesión para comenzar tu sesión</p>
        <form action="" id="login-form">
          <div class="input-group mb-3">
            <input type="email" class="form-control" name="email" required placeholder="Correo">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" required placeholder="Contraseña">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Recuérdame
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-warning btn-block">Acceder</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->
  <script>
    $(document).ready(function() {
      $('#login-form').submit(function(e) {
        e.preventDefault()
        start_load()
        if ($(this).find('.alert-danger').length > 0)
          $(this).find('.alert-danger').remove();
        $.ajax({
          url: 'ajax.php?action=login',
          method: 'POST',
          data: $(this).serialize(),
          error: err => {
            console.log(err)
            end_load();
          },
          success: function(resp) {
            if (resp == 1) {
              location.href = 'index.php?page=home';
            } else {
              $('#login-form').prepend('<div class="alert alert-danger">El nombre de usuario o la contraseña son incorrectos.</div>')
              end_load();
            }
          }
        })
      })
    })
  </script>
  <?php include 'footer.php' ?>
</body>

</html>