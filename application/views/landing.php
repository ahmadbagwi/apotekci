<?php defined('BASEPATH') OR exit('No direct script access allowed');
//$_SESSION['user_id']='';
if (isset($_SESSION['user_id'])) {
    header('location:/dashboard');
    } 
  ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $nama_aplikasi;?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url('assets/new/css/bootstrap.css'); ?>" id="bootstrap-css">
  <link rel="stylesheet" href="<?php echo base_url('assets/new/css/fontawesome.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/new/css/apotek.css'); ?>">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script src="<?php echo base_url('assets/new/js/jquery-3.3.1.js'); ?>"></script>
</head>
<body>
  <div id="fullscreen_bg" class="fullscreen_bg"/>
    <div class="container">
      <?php echo form_open('User/login', 'class=form-signin'); ?>
      <h3 class="form-signin-heading text-muted"><img src="<?php echo base_url('assets/new/images/').$logo;?>" width="85px"><br>
      <?php echo $nama_aplikasi;?></h3>
      <input type="text" class="form-control" id="username" name="username" placeholder="username" required="" autofocus="">
      <input type="password" class="form-control" id="password" name="password" placeholder="password" required="">
      <button class="btn btn-lg btn-primary btn-block" type="submit">
        Masuk
      </button>
      <?php echo form_close();?>
    </div>
  </div>
</body>
</html>
