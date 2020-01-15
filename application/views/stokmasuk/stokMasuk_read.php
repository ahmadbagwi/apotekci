            <div class="col-md-9 content"><!--mulai konten-->
                <p class="home"><a href="<?php echo base_url('Dashboard');?>">Home</a> > <strong> Detail Stok Masuk</strong></p>
                <legend>Detail Transaksi Stok Masuk</legend>
                    <table class="table">
            	    <tr><td>Id User</td><td><?php echo $idUser; ?></td></tr>
            	    <tr><td>Id Suplier</td><td><?php echo $idSuplier; ?></td></tr>
            	    <tr><td>Nama Produk</td><td><?php echo $namaProduk; ?></td></tr>
            	    <tr><td>Id Produk</td><td><?php echo $idProduk; ?></td></tr>
            	    <tr><td>Tanggal</td><td><?php echo $tanggal; ?></td></tr>
            	    <tr><td>Jumlah</td><td><?php echo $jumlah; ?></td></tr>
            	    <tr><td>Harga Modal</td><td><?php echo $modal; ?></td></tr>
                    <tr><td>Harga Jual</td><td><?php echo $jual; ?></td></tr>
            	    <tr><td></td><td><a href="<?php echo site_url('stokmasuk') ?>" class="btn btn-default">Cancel</a></td></tr>
            	    </table>
            </div>