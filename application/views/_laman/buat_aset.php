			<div class="col-md-9 content"><!--mulai konten-->
				<p class="home"><a href="<?php echo base_url('Dashboard');?>">Home</a> > <strong> Buat Aset</strong></p>
                <h4>Buat Aset</h4>
					<span>Pilih tanggal aset yang akan disimpan kemudian klik Buat Aset.</span><br><br>
						<?php echo form_open('Aset/create_action', array('method'=>'get'));?>
							<table cellpadding="2">
								<tr>
									<td style="padding: 5px"><label>Pilih Tanggal</label></td>
									<td style="padding: 5px"><input type="text" name="tanggal" required="" class="date datepicker" placeholder="Pilih Tanggal"></td>
									<td style="padding: 5px"><input class="btn btn-primary pull-left" type="submit" value="Buat Aset" name="submit" onclick="return confirm('Proses Aset?')"></td>
								</tr>
							</table>  
						<?php form_close(); ?>

						<script>
			            	$(document).ready(function (){
			            		
			            		$("body").on('focus', ' .datepicker', function () {
			            			$(this).datepicker({
			            				dateFormat: "yy-mm-dd"
			            			});
			            		});
			            	
			            	});
		                </script>
		    </div><!--col-md-9-->
</body>
</html>
			