			<div class="col-md-9 content"><!--mulai konten-->
				<p class="home"><a href="<?php echo base_url('Dashboard');?>">Home</a> > <strong> Data kas</strong></p>
                <legend>Data Tutup Kas</legend>
                <?php echo $this->session->userdata('message') <> '' ? '<span class="alert alert-success" role="alert">'.$this->session->userdata('message') : ''.'</span>'; ?><br>
				<?php echo form_open('TutupKas/data_kas', array('method'=>'get'));?>
                        <input type="text" name="tanggal" class="date datepicker" placeholder="Pilih tanggal">
                        <input type="submit" name="cari" value="Cari">   
                    <?php form_close(); ?>    
                    <table class="table table-striped table-responsive" cellpadding="2px">
                        <tr>
                            <td>Tanggal</td>
                            <td>Jam mulai</td>
                            <td>Jam tutup</td>
                            <td>No. slip</td>
                            <td>Ditutup oleh</td>
                            <td>No. struk akhir</td>
                            <td>Kas Awal</td>
                            <td>Penjualan</td>
                            <td>Bayar rawat inap</td>
                            <td>Total transaksi</td>
                            <td>Kas tersedia</td>
                            <td>Kartu debit</td>
                            <td>Belum dibayar</td>
                            <td>Total kas</td>
                            <td>SELISIH</td>
                            <td>Cetak</td>
                        </tr>
                        <?php foreach ($tutup_kas as $tutup_kas) { ?>
                        <tr>    
                            <td><?php echo substr($tutup_kas->tanggal, 0,10) ;?></td>
                            <td><?php echo $tutup_kas->jam_mulai;?></td>
                            <td><?php echo $tutup_kas->jam_tutup;?></td>
                            <td><?php echo $tutup_kas->no_slip;?></td>
                            <td><?php echo $tutup_kas->username;?></td>
                            <td><?php echo $tutup_kas->kode_akhir;?></td>
                            <td><?php echo number_format($tutup_kas->kas_awal);?></td>
                            <td><?php echo number_format($tutup_kas->total_penjualan);?></td>
                            <td><?php echo number_format($tutup_kas->rawat_inap);?></td>
                            <td><?php echo number_format($tutup_kas->total_transaksi);?></td>
                            <td><?php echo number_format($tutup_kas->kas_tersedia);?></td>
                            <td><?php echo number_format($tutup_kas->kartu_debit);?></td>
                            <td><?php echo number_format($tutup_kas->belum_dibayar);?></td>
                            <td><?php echo number_format($tutup_kas->total_kas);?></td>
                            <td><?php echo number_format($tutup_kas->selisih);?></td> 
                            <td><a href="<?php echo base_url('TutupKas/cetak_kas?no_slip='); echo $tutup_kas->no_slip.'&jam_mulai='.$tutup_kas->jam_mulai.'&jam_tutup='.$tutup_kas->jam_tutup.'&tanggal='.$tutup_kas->tanggal; ?>" target="_blank">Cetak</a></td>
                        </tr>
                        <?php } ?>
                    </table>
                    <br>
                    
                </div>

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
			