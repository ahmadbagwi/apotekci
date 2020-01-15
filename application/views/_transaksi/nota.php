			<div class="col-md-9 content"><!--mulai konten-->
				<p class="home"><a href="<?php echo base_url('Dashboard');?>">Home</a> > <strong> Nota</strong></p>
				<div class="col-md-4 nota" style="margin-right: 10px; line-height: 1.6">
					<div class="row border jumbotron" style="font-size: 12px">
						<div class="col-md-12">
							<div id="nota">
								<?php echo "<strong>".$nama_aplikasi."</strong><br>"; ?>
								<?php echo "<strong>".$alamat."</strong><br>";?>
								<?php echo "<strong>".$kontak."</strong><br>";?>
								====================<br>
								<?php echo "<strong>Kasir ".$_SESSION['username']."</strong>";?><br>
								====================<br>
								<?php foreach ($penjualan as $tanggal) { echo $tanggal['tanggal']; break;} echo " ".$trx; ?>
								====================<br>
								<table class="table table-striped" style="font-size: 2.5empx">
									<tr>
										<th>Produk</th>
										<th>Harga</th>
										<th>Jumlah</th>

										<th>Total</th>
									</tr>
									<?php foreach ($penjualan as $penjualan) { ?>
										<tr>
											<td><?php echo $penjualan['nama'];?></td>
											<td><?php echo number_format($penjualan['jual']);?></td>
											<td><?php echo $penjualan['jumlah'];?></td>

											<td><?php echo number_format($penjualan['jumlah_jual']);?></td>
										</tr>
									<?php } ?>
									<?php foreach ($pembayaran as $pembayaran) {?> 
										<tr>
											<td></td>
											<td></td>
											<td><strong>Total</strong></td>
											<td><strong><?php echo number_format($pembayaran['total_jual']);?></strong></td>
										</tr>
										<tr>
											<td></td>
											<td></td>
											<td><strong>Bayar</strong></td>
											<td><strong><?php echo number_format($pembayaran['bayar']);?></strong></td>
										</tr>
										<tr>
											<td></td>
											<td></td>
											<td><strong>Kembali</strong></td>
											<td><strong><?php echo number_format($pembayaran['kembali']); }?></strong></td>
										</tr>
									</table>
									====================<br>
									<span>Terima kasih atas kunjungan anda</span>
								</div>
							</div>                              
					</div><!--row jumbotron-->
						<div class="row cetak">
							<a href="<?php echo site_url('penjualan') ?>" class="btn btn-success btn-sm">Transaksi lagi</a>
							<a href="<?php echo site_url('Nota/cetak_nota') ?>" target="_blank" class="btn btn-success btn-sm">Cetak/PDF</a>
						</div>
				</div>
				<div class="col-md-5 nota">
					<div class="row border jumbotron" style="font-size: 12px">
						<h4>Cetak Ulang Nota</h4>
						<div class="col-md-12">
							<?php echo form_open('Nota/cetak_nota', array('method'=>'get'));?>
							<input type="text" class="form form-control" name="kode" id="kode" placeholder="Tekan angka, akan muncul prediksi no nota"><hr>
							<button type="submit" class="btn btn-warning btn-sm" target="_blank">Cetak Ulang</button>
							<?php form_close();?>
						</div>
					</div>
				</div>

                <script type="text/javascript">
                $(document).ready(function(){    
                   $("#kode").autocomplete({
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
                        }
                        });
                })
                </script>
			</div><!--col-md-9-->
</body>
</html>
			