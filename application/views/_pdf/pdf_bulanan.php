                            <h4>Laporan Bulanan</h4> 
                            <table class="table table-striped table-responsive" border="0" cellpadding="2" style="font-size: 10px">
                                     <tr>
                                         <th>Tanggal</th>
                                         <th>Modal</th>
                                         <th>Jual</td>
                                         <th>Profit</th>
                                     </tr>
                                     <?php $sum_modal=0; $sum_jual = 0; $sum_profit = 0; foreach ($bulanan as $bulanan) { ?>
                                     <tr>
                                         <td><?php echo substr($bulanan->tanggal, 0,7) ?></td>
                                         <td style="text-align: right;"><?php echo number_format($bulanan->total_modal);?></td>
                                         <td style="text-align: right;"><?php echo number_format($bulanan->total_jual);?></td>
                                         <td style="text-align: right;"><?php echo number_format($bulanan->profit);?></td>
                                     </tr>
                                    <?php $sum_jual += $bulanan->total_jual;
                                    $sum_modal += $bulanan->total_modal;
                                    $sum_profit += $bulanan->profit;
                                    } ?>
                                     <tr>
                                         <td><strong>Total</strong></td>
                                         <td style="text-align: right;"><?php echo number_format($sum_modal);?></td>
                                         <td style="text-align: right;"><?php echo number_format($sum_jual);?></td>
                                         <td style="text-align: right;"><?php echo number_format($sum_profit);?></td>
                                     </tr>
                            </table>