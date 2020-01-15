            <div class="col-md-9 content"><!--mulai konten-->
                <p class="home"><a href="<?php echo base_url('Dashboard');?>">Home</a> > <strong> Laporan Bulanan</strong></p>
                    <h3>Laporan Bulanan</h3>    	   
                            <?php echo form_open('Laporan/bulanan', array('method'=>'get'));?>
        						<input type="text" name="tanggal" class="date datepicker" placeholder="Pilih tanggal" value="<?php echo date('Y-m-d');?>">
        						<input type="submit" name="cari" value="Cari">
    						<?php form_close();?>
                            <table class="table table-striped table-responsive" border="0" cellpadding="0" style="font-size: 12px">
                                     <tr>
                                         <th>Tanggal</th>
                                         <th>Modal</th>
                                         <th>Jual</td>
                                         <th>Profit</th>
                                     </tr>
                                     <?php $sum_modal=0; $sum_jual = 0; $sum_profit = 0; foreach ($bulanan as $bulanan) { ?>
                                     <tr>
                                         <td><?php echo substr($bulanan->tanggal, 0,7); ?></td>
                                         <td><?php echo number_format($bulanan->total_modal);?></td>
                                         <td><?php echo number_format($bulanan->total_jual);?></td>
                                         <td><?php echo number_format($bulanan->profit);?></td>
                                     </tr>
                                    <?php $sum_jual += $bulanan->total_jual;
                                    $sum_modal += $bulanan->total_modal;
                                    $sum_profit += $bulanan->profit;
                                    } ?>
                                     <tr>
                                         <td><strong>Total</strong></td>
                                         <td><?php echo number_format($sum_modal);?></td>
                                         <td><?php echo number_format($sum_jual);?></td>
                                         <td><?php echo number_format($sum_profit);?></td>
                                     </tr>
                            </table>

                            
                            <a href="<?php echo site_url('Laporan/cetak_bulanan?tanggal='."$bulanan->tanggal"); ?>" target="_blank" class="btn btn-success">Cetak/PDF</a>
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