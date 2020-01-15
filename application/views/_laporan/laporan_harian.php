            <div class="col-md-9 content"><!--mulai konten-->
                <p class="home"><a href="<?php echo base_url('Dashboard');?>">Home</a> > <strong> Laporan Harian</strong></p>
                    <h3>Laporan Harian</h3>    	   
                            <?php echo form_open('Laporan/harian', array('method'=>'get'));?>
        						<input type="text" name="tanggal" class="date datepicker" placeholder="Pilih tanggal" value="<?php echo date('Y-m-d');?>">
        						<input type="submit" name="cari" value="Cari">
    						<?php form_close();?>
                            <table class="table table-striped table-responsive" border="0" cellpadding="0" style="font-size: 12px">
                                     <tr>
                                         <th>Kasir</th>
                                         <th>Tanggal</th>
                                         <th>Kode</th>
                                         <th>Modal</td>
                                         <th>Jual</th>
                                         <th>Profit</th>
                                     </tr>
                                     <?php foreach ($harian as $harian) { ?>
                                     <tr>
                                         <td><?php echo $harian->username; ?></td>
                                         <td><?php echo $harian->tanggal; ?></td>
                                         <td><?php echo $harian->kode; ?></td>
                                         <td><?php echo number_format($harian->total_modal);?></td>
                                         <td><?php echo number_format($harian->total_jual);?></td>
                                         <td><?php echo number_format($harian->profit);?></td>
                                     </tr>
                                    <?php } ?>
                                     <tr>
                                         <td colspan="3"><strong>Total</strong></td>
                                         <td><?php echo number_format($modal);?></td>
                                         <td><?php echo number_format($jual);?></td>
                                         <td><strong><?php echo number_format($total);?></strong></td>
                                     </tr>
                            </table>

                            <h4>Konsinyasi</h4>
                            <table class="table table-striped" border="0" cellpadding="0" style="font-size: 12px">
                                     <tr>
                                         <th>Kasir</th>
                                         <th>Kode</th>
                                         <th>Produk</td>
                                         <th>Jumlah</th>
                                         <th>Modal</th>
                                         <th>Jual</th>
                                         <td>Profit</td>
                                     </tr>
                                     <?php $sum_modal=0; $sum_jual = 0; $sum_profit = 0; foreach ($konsinyasi as $konsinyasi) { ?>
                                     <tr>
                                         <td><?php echo $konsinyasi->username; ?></td>
                                         <td><?php echo $konsinyasi->kode; ?></td>
                                         <td><?php echo $konsinyasi->nama;?></td>
                                         <td><?php echo $konsinyasi->jumlah;?></td>
                                         <td><?php echo number_format($jumlah_modal = $konsinyasi->jumlah*$konsinyasi->modal);?></td>
                                         <td><?php echo number_format($jumlah_jual = $konsinyasi->jumlah*$konsinyasi->jual);?></td>
                                         <td><?php echo number_format($jumlah_profit = $jumlah_jual - $jumlah_modal);?></td>
                                     </tr>
                                     <?php // $totalKonsinyasi = $konsinyasi->jumlah*$konsinyasi->modal; echo number_format($totalKonsinyasi); ?>
                                    <?php
                                    $sum_jual += $jumlah_jual;
                                    $sum_modal += $jumlah_modal;
                                    $sum_profit += $jumlah_profit;
                                    } ?>
                                    <tr>
                                        <td colspan="4"><strong>Total</strong></td>
                                        <td><?php echo number_format($sum_modal); ?></td>
                                        <td><?php echo number_format($sum_jual); ?></td>
                                        <td><?php echo number_format($sum_profit); ?></td>
                                    </tr>
                            </table>
                            <a href="<?php echo site_url('Laporan/cetak_harian?tanggal='."$tanggal"); ?>" target="_blank" class="btn btn-success">Cetak/PDF</a>
                            <script>
    		            	$(document).ready(function (){
    		            		
    		            		$("body").on('focus', ' .datepicker', function () {
    		            			$(this).datepicker({
    		            				dateFormat: "yy-mm-dd"
    		            			});
    		            		});
    		            	
    		            	});
    		                </script>

                            <script type="text/javascript">
                                $('#jam1').timepicker({ 'timeFormat': 'H:i:s' });
                                $('#jam2').timepicker({ 'timeFormat': 'H:i:s' });
                            </script>
            </div><!--/Konten-->