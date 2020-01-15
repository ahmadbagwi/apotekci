                    <h4>Data Aset</h4>
                    <table class="table table-striped table-responsive" cellpadding="2" style="font-size: 11px;">
                        <tr>
                            <td>No</td>
                            <td>Tanggal</td>
                            <td>Nilai Aset</td>
                            <td style="text-align: right;">Omset Shift 1</td>
                            <td style="text-align: right;">Omset Shift 2</td>
                            <td style="text-align: right;">Total Omset</td>
                            <td>Struk Shift 1</td>
                            <td>Struk Shift 2</td>
                            <td>Total Struk</td>
                            <td style="text-align: right;">Rata-rata Struk</td>
                            <td style="text-align: right;">Profit</td>
                            <td style="text-align: right;">Persentase Profit (%)</td>
                        </tr>
                        <?php foreach ($data_aset as $data_aset) { ?>
                        <tr>
                            <td><?php echo $data_aset->id;?></td>
                            <td><?php echo $data_aset->tanggal;?></td>
                            <td><?php echo number_format($data_aset->aset);?></td>
                            <td style="text-align: right;"><?php echo number_format($data_aset->omset1);?></td>
                            <td style="text-align: right;"><?php echo number_format($data_aset->omset2);?></td>
                            <td style="text-align: right;"><?php echo number_format($data_aset->totalOmset);?></td>
                            <td><?php echo $data_aset->nota1;?></td>
                            <td><?php echo $data_aset->nota2;?></td>
                            <td><?php echo $data_aset->totalNota;?></td>
                            <td style="text-align: right;"><?php echo number_format($data_aset->avgNota);?></td>
                            <td style="text-align: right;"><?php echo number_format($data_aset->profit);?></td>
                            <td style="text-align: right;"><?php echo number_format($data_aset->persenProfit);?></td>
                        </tr>   

                        <?php } ?>
                            
                    </table>