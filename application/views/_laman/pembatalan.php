			<div class="col-md-9 content"><!--mulai konten-->
				<p class="home"><a href="<?php echo base_url('Dashboard');?>">Home</a> > <strong> Pembatalan</strong></p>
				<?php echo form_open('Pembatalan/create_action'); ?>
				<legend>Pembatalan Transaksi</legend>
				<?php echo $this->session->userdata('message') <> '' ? '<span class="alert alert-success" role="alert">'.$this->session->userdata('message') : ''.'</span>'; ?><br>
				<div class="col-md-4">
					<div class="form-group">
                        <label for="int">Kode Transaksi</label>
                        <input type="text" class="kode form-control" name="kode" required="" id="kode" placeholder="tekan angka, akan muncul prediksi " />
                    </div>
                    <div class="form-group">
                        <label for="int">Id Produk</label>
                        <input type="text" class="id_produk form-control" name="id_produk" required="" id="id_produk"/>
                    </div>
                    <div class="form-group">
                        <label for="int">Nama Produk</label>
                        <input type="text" class="nama_produk form-control" name="nama_produk" required="" id="nama_produk"/>
                    </div>
                    <div class="form-group">
                        <label for="int">Nilai Transaksi</label>
                        <input type="hidden" class="modal form-control" name="modal" required="" id="modal" placeholder="Modal yang dibatalkan" />
                        <input type="text" readonly="" class="penjualan form-control" name="penjualan" required="" id="penjualan" placeholder="Penjualan yang dibatalkan"/>
                        <label>Profit</label>
                        <input type="text" readonly="" class="profit form-control" name="profit" required="" id="profit" placeholder="Profit yang dibatalkan" />
                    </div>
                    <div class="form-group">
                        <label for="int">Jumlah</label>
                        <input type="text" class="jumlah form-control" name="jumlah" required="" id="jumlah" placeholder="Jumlah pembelian"/>
                    </div>
                    <hr>
                    <input class="btn btn-primary pull-left" type="submit" value="PROSES" name="submit" onclick="return confirm('Proses Pembatalan?')">
                </div>
                <?php echo form_close();
                 ?>
                <div class="col-md-4">
                	<legend>Data Pembatalan</legend>
                	<table class="table table-striped table-responsive" >
                		<tr>
                			<td>Tanggal</td>
                			<td>User</td>
                			<td>Kode</td>
                			<td>Produk</td>
                			<td>Jumlah</td>
                			<td>Nilai dibatalkan</td>
                		</tr>
                		<?php foreach ($data_pembatalan as $pembatalan) { ?>
                		<tr>
                			<td><?php echo $pembatalan->tanggal; ?></td>
                			<td><?php echo $pembatalan->username; ?></td>
                			<td><?php echo $pembatalan->kode; ?></td>
                			<td><?php echo $pembatalan->nama; ?></td>
                			<td><?php echo $pembatalan->jumlah; ?></td>
                			<td><?php echo $pembatalan->penjualan; ?></td>
                		</tr>	

                		<?php } ?>
                	</table>
                </div>
                <script type="text/javascript">
			    $(document).ready(function(){    
			    $('[name="kode"]').each(function(i,e){   
			        $(this).autocomplete({
			            source: function (request, response) {
			                $.get("<?php echo base_url('Pembatalan/cari_data/?');?>", request,function(data){
			                    jsonData = JSON.parse(data);
			                    console.log(jsonData);
			                    response($.map(jsonData, function (value, key) {
			                        return {
			                            label: value.kode,
			                            data: value,
			                        }
			                    }));
			                });
			            },
			            select: function (event, ui){
			                $('[name="kode"]').val(ui.item.data.kode);
			                $('[name="id_produk"]').val(ui.item.data.id_produk);
                            $('[name="nama_produk"]').val(ui.item.data.nama);
			                $('[name="modal"]').val(ui.item.data.modal);
			                $('[name="penjualan"]').val(ui.item.data.jual);
			                $('[name="jumlah"]').val(ui.item.data.jumlah);
                            //$('[name="profit"]').val(ui.item.data.profit);
			            }
			        })
			    })
			    })
			    </script>

			    <script type="text/javascript">
						$(document).ready(function(){
			          		$(document).on("blur", ".kode", function(){
			          			var modal = $("#modal").val();
			    				var jual = $("#penjualan").val();
			          			$("input[type=text][name=profit]").val(parseInt(jual) - parseInt(modal));	
			            	})
			        	});
				</script>
			</div><!--col-md-9-->
</body>
</html>
			