	$(document).ready(function(){
		$('.menu_navigasi').click(function(){
			var menu = $(this).attr('id');
			if(menu == "home"){
				$('.content').load("<?php echo base_url('Dashboard');?>");						
			}else if(menu == "penjualan"){
				$('.content').load("<?php echo base_url('Penjualan');?>");						
			}else if(menu == "tutorial"){
				$('.badan').load('tutorial.php');						
			}else if(menu == "sosmed"){
				$('.badan').load('sosmed.php');						
			}
		});
 
 
		// halaman yang di load default pertama kali
		$('.content').load("<?php echo base_url('Dashboard');?>");						
 
	});