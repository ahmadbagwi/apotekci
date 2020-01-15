                            <h4>Laporan Harian</h4>    	   
                            <table class="table table-striped table-responsive" border="0" cellpadding="2" style="font-size: 10px">
                                     <tr>
                                         <th>Kasir</th>
                                         <th>Kode</th>
                                         <th>Modal</td>
                                         <th>Jual</th>
                                         <th>Profit</th>
                                     </tr>
                                     <?php foreach ($harian as $harian) { ?>
                                     <tr>
                                         <td><?php echo $harian->username; ?></td>
                                         <td><?php echo $harian->kode; ?></td>
                                         <td><?php echo number_format($harian->total_modal);?></td>
                                         <td><?php echo number_format($harian->total_jual);?></td>
                                         <td><?php echo number_format($harian->profit);?></td>
                                     </tr>
                                    <?php } ?>
                                     <tr>
                                         <td></td>
                                         <td><strong>Total</strong></td>
                                         <td><?php echo number_format($modal);?></td>
                                         <td><?php echo number_format($jual);?></td>
                                         <td><strong><?php echo number_format($total);?></strong></td>
                                     </tr>
                            </table>

                            <h4>Konsinyasi</h4>
                            <table class="table table-striped" border="0"  cellpadding="2" style="font-size: 10px">
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