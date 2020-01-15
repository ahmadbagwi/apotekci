			<div class="col-md-9 content"><!--mulai konten-->
                <p class="home"><a href="<?php echo base_url('Dashboard');?>">Home</a> > <strong> Detail Retur</strong></p>
			        <h3>Detail Retur</h3>
			        <table class="table">
				    <tr><td>Id user</td><td><?php echo $user_id; ?></td></tr>
				    <tr><td>Id suplier</td><td><?php echo $id_supplier; ?></td></tr>
				    <tr><td>Nama produk</td><td><?php echo $nama; ?></td></tr>
				    <tr><td>Id produk</td><td><?php echo $id_produk; ?></td></tr>
				    <tr><td>Tanggal</td><td><?php echo $tanggal; ?></td></tr>
				    <tr><td>Jumlah</td><td><?php echo $jumlah; ?></td></tr>
				    <tr><td>Harga modal</td><td><?php echo $modal; ?></td></tr>
				    <tr><td></td><td><a href="<?php echo site_url('retur') ?>" class="btn btn-warning">Kembali</a></td></tr>
					</table>
			</div>
