<?php defined('BASEPATH') OR exit('No direct script access allowed');
if ($_SESSION['user_id']==null) {
    header('location:/apotek/');
    } else {
        if ($_SESSION['is_admin']==0) {
            $idadmin = $_SESSION['user_id'];
        }
        header('location:/apotek/Beranda');
    }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log in Apotek Budi Farma</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/'); ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/'); ?>/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/'); ?>/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/'); ?>apotek.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/'); ?>/plugins/iCheck/square/blue.css">
  <script src="<?php echo base_url('assets/js/'); ?>jquery-3.3.1.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body>
  <div id="fullscreen_bg" class="fullscreen_bg"/>
  <div class="container">
    <?php echo form_open('User/login'); ?>
    <form class="form-signin">
      <h1 class="form-signin-heading text-muted">Sistem Penjualan Apotek Budi Farma</h1>
      <input type="text" class="form-control" id="username" name="username" placeholder="username" required="" autofocus="">
      <input type="password" class="form-control" id="password" name="password" placeholder="password" required="">
      <button class="btn btn-lg btn-primary btn-block" type="submit">
        Masuk
      </button>
    </form>
    <?php echo form_close();?>
  </div>
</body>
</html>
