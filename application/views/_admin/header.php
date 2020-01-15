<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if ($_SESSION['user_id'] == NULL && $_SESSION['username'] == NULL) {
    header('location:/');
    } else {
        if ($_SESSION['is_admin']==0) {
            $id_admin = $_SESSION['user_id'];
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $title; ?></title>
<link href="<?php echo base_url('assets/new/css/bootstrap.css');?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/new/css/jquery.timepicker.min.css');?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/new/css/jquery-ui.css');?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/new/css/style.css');?>" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo base_url('assets/new/css/nav.css');?>" rel="stylesheet" type="text/css" media="all"/>
<link rel="stylesheet" href="<?php echo base_url('assets/new/css/konten.css'); ?>">
<link href="<?php echo base_url('assets/new/css/jquery.timepicker.min.css');?>" rel="stylesheet" type="text/css" />
<link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<script src="<?php echo base_url('assets/new/js/jquery-3.3.1.js');?>"></script>
<script src="<?php echo base_url('assets/new/js/jquery-ui.js');?>"></script>
<script src="<?php echo base_url('assets/new/js/jquery.easydropdown.js');?>"></script>
<script src="<?php echo base_url('assets/new/js/bootstrap.js');?>"></script>
<script src="<?php echo base_url('assets/new/js/jquery.timepicker.min.js');?>"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>


<!----Calender -------->
  <link rel="stylesheet" href="<?php echo base_url('assets/new/css/clndr.css');?>" type="text/css" />
  <script src="<?php echo base_url('assets/new/js/underscore-min.js');?>"></script>
  <script src="<?php echo base_url('assets/new/js/moment-2.2.1.js');?>"></script>
  <script src="<?php echo base_url('assets/new/js/clndr.js');?>"></script>
  <script src="<?php echo base_url('assets/new/js/site.js');?>"></script>
<!----End Calender -------->
<script src="<?php echo base_url('assets/new/js/easyResponsiveTabs.js');?>" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$('#horizontalTab,#horizontalTab1,#horizontalTab2').easyResponsiveTabs({
			            type: 'default', //Types: default, vertical, accordion           
			            width: 'auto', //auto or any width like 600px
			            fit: true   // 100% fit in a container
			        });
	});
</script>
<script src="<?php echo base_url('assets/new/js/main.js');?>"></script> <!-- Resource jQuery -->
<!-- chart -->
 <script src="<?php echo base_url('assets/new/js/Chart1.js');?>"></script>
<!-- //chart -->
</head>
<body>
	<div class="total-content">
		<div class="col-md-3 side-bar">
			<div class="logo text-center">
				<a href="#"><h3>Apotek Budi Farma 1</h3></a>
			</div>
			<div class="navigation">
				<h3>Kasir</h3>
				<ul>
					<li><a href="#"><i class="chat"></i></a></li>
					<li><a href="<?php echo base_url('Dashboard');?>">Dashboard</a></li>
				</ul>
				<ul>
					<li><a href="#"><i class="rev"></i></a></li>
					<li><a href="<?php echo base_url('Penjualan');?>">Penjualan</a></li>
				</ul>
				<ul>
					<li><a href="#"><i class="rev"></i></a></li>
					<li><a href="<?php echo base_url('Pembatalan');?>">Pembatalan</a></li>
				</ul>
				<ul>
					<li><a href="#"><i class="art"></i></a></li>
					<li><a href="<?php echo base_url('Laporan/detail');?>">Detail Transaksi</a></li>
				</ul>
				<ul>
					<li><a href="#"><i class="art"></i></a></li>
					<li><a href="<?php echo base_url('Nota');?>">Nota</a></li>
				</ul>
			</div>
			<div class="navigation">
				<h3>Tutup Kasir</h3>
				<ul>
					<li><a href="#"><i class="cal"></i></a></li>
					<li><a href="<?php echo base_url('TutupKas');?>">Tutup Kasir</a></li>
				</ul>
				<ul>
					<li><a href="#"><i class="page"></i></a></li>
					<li><a href="<?php echo base_url('TutupKas/data_kas');?>">Data Tutup Kasir</a></li>
				</ul>
			</div>
			<div class="navigation">
				<h3>Data Master</h3>
				<ul>
					<li><a href="#"><i class="fat"></i></a></li>
					<li><a href="<?php echo base_url('Stok');?>">Produk</a></li>
				</ul>
				<ul>
					<li><a href="#"><i class="fat"></i></a></li>
					<li><a href="<?php echo base_url('Stokmasuk');?>">Stok Masuk</a></li>
				</ul>
				<ul>
					<li><a href="#"><i class="page"></i></a></li>
					<li><a href="<?php echo base_url('Supplier');?>">Supplier</a></li>
				</ul>
				<ul>
					<li><a href="#"><i class="page"></i></a></li>
					<li><a href="<?php echo base_url('Retur');?>">Retur</a></li>
				</ul>
			</div>
			<div class="navigation">
				<h3>Data Master</h3>
				<ul>
					<li><a href="#"><i class="dash"></i></a></li>
					<li><a href="<?php echo base_url('Laporan/harian');?>">Laporan Harian</a></li>
				</ul>
				<ul>
					<li><a href="#"><i class="dash"></i></a></li>
					<li><a href="<?php echo base_url('Laporan/bulanan');?>">Laporan Bulanan</a></li>
				</ul>
			</div>
			<div class="navigation">
				<h3>Aset</h3>
				<ul>
					<li><a href="#"><i class="fat"></i></a></li>
					<li><a href="<?php echo base_url('Aset/create');?>">Buat Aset</a></li>
				</ul>
				<ul>
					<li><a href="#"><i class="rev"></i></a></li>
					<li><a href="<?php echo base_url('Aset');?>">Data Aset</a></li>
				</ul>
				<ul>
					<li><a href="#"><i class="rev"></i></a></li>
					<li><a href="<?php echo base_url('Aset/excel');?>">Export Excel</a></li>
				</ul>
			</div>
			<div class="navigation">
				<h3>User</h3>
				<ul>
					<li><a href="#"><i class="page"></i></a></li>
					<li><a href="<?php echo base_url('User/data_akun');?>">Log Pengguna</a></li>
				</ul>
				<ul>
					<li><a href="#"><i class="user"></i></a></li>
					<li><a href="<?php echo base_url('User/logout');?>">Keluar</a></li>
				</ul>
			</div>
		</div>