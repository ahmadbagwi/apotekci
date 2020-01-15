			<div class="col-md-9 content"><!--mulai konten-->
				<p class="home"><a href="<?php echo base_url('Dashboard');?>">Home</a> > <strong> Data Aset</strong></p>
                <h4>Data Aset</h4>
				<?php echo form_open('Aset/excel', array('method'=>'get'));?>
                    <input type="text" name="tanggal" class="date datepicker" placeholder="Cari tanggal" value="<?php echo date('Y-m-d');?>">
                    <input type="submit" name="cari" value="Cari"><br>
                <?php form_close();?>
                    <table class="table table-striped table-responsive">
                        <tr>
                            <td>No</td>
                            <td>Tanggal</td>
                            <td>Nilai Aset</td>
                            <td>Omset Shift 1</td>
                            <td>Omset Shift 2</td>
                            <td>Total Omset</td>
                            <td>Struk Shift 1</td>
                            <td>Struk Shift 2</td>
                            <td>Total Struk</td>
                            <td>Rata-rata Struk</td>
                            <td>Profit</td>
                            <td>Persentase Profit (%)</td>
                        </tr>
                        <?php foreach ($data_aset as $data_aset) { ?>
                        <tr>
                            <td><?php echo $data_aset->id;?></td>
                            <td><?php echo $data_aset->tanggal;?></td>
                            <td><?php echo number_format($data_aset->aset);?></td>
                            <td><?php echo number_format($data_aset->omset1);?></td>
                            <td><?php echo number_format($data_aset->omset2);?></td>
                            <td><?php echo number_format($data_aset->totalOmset);?></td>
                            <td><?php echo $data_aset->nota1;?></td>
                            <td><?php echo $data_aset->nota2;?></td>
                            <td><?php echo $data_aset->totalNota;?></td>
                            <td><?php echo number_format($data_aset->avgNota);?></td>
                            <td><?php echo number_format($data_aset->profit);?></td>
                            <td><?php echo number_format($data_aset->persenProfit);?></td>
                        </tr>   

                        <?php }
                        $tgl='';
                        if (isset($data_aset->tanggal)) {
                             $tgl = $data_aset->tanggal;
                         } ?>
                            
                    </table>

                    <a href="<?php echo site_url('Aset/export_excel?tanggal='."$tgl".''); ?>" target="_blank" class="btn btn-success">Export ke Excel</a>
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
			