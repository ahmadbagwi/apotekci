			<div class="col-md-9 content"><!--mulai konten-->
				<p class="home"><a href="<?php echo base_url('Dashboard');?>">Home</a> > <strong> Detail Harian</strong></p>
				<?php echo form_open('Laporan/detail', array('method'=>'get'));?>
                    <input type="text" name="tanggal" class="date datepicker" placeholder="Pilih tanggal">
                    <input type="submit" name="cari" value="Cari">
                    <?php form_close();?>
                    <br><legend>Detail Harian Tanggal <?php echo $tanggal;?></legend>
                       
                    <table class="table table-striped table-responsive">
                        <tr>
                            <td>Kode Transaksi</td>
                            <td>Tanggal</td>
                            <td>Kasir</td>
                            <td>Produk</td>
                            <td>Id Produk</td>
                            <td>Harga</td>
                            <td>Jumlah</td>
                            <td>Total</td>
                            <td>Status</td>
                        </tr>
                        <?php foreach ($detail as $detail) { ?> 
                        <tr>
                            <td><?php echo $detail->kode;?></td>
                            <td><?php echo $detail->tanggal;?></td>
                            <td><?php echo $detail->username;?></td>
                            <td><?php echo $detail->nama;?></td>
                            <td><?php echo $detail->id_produk;?></td>
                            <td><?php echo number_format($detail->jual);?></td>
                            <td><?php echo $detail->jumlah;?></td>
                            <td><?php echo number_format($detail->jumlah_jual);?></td>
                            <td><?php echo $detail->status;?></td>
                        </tr>
                    <?php } ?>
                    </table>  
                <script type="text/javascript">
                    $("body").on('focus', ' .datepicker', function () {
                        $(this).datepicker({
                            dateFormat: "yy-mm-dd"
                        });
                    });
                </script>
			</div><!--col-md-9-->
</body>
</html>
			