            <div class="col-md-9 content"><!--mulai konten-->
                <p class="home"><a href="<?php echo base_url('Dashboard');?>">Home</a> > <strong> Daftar Produk</strong></p>
                <legend>Daftar Produk</legend>
                <h2>Detail Produk</h2>
                <table class="table table-striped">
                   <tr><td>Nama</td><td><?php echo $nama; ?></td></tr>
                   <tr><td>Kategori</td><td><?php echo $kategori; ?></td></tr>
                   <tr><td>Deskripsi</td><td><?php echo $deskripsi; ?></td></tr>
                   <tr><td>Stok</td><td><?php echo $stok; ?></td></tr>
                   <tr><td>Harga modal</td><td><?php echo $modal; ?></td></tr>
                   <tr><td>Harga jual</td><td><?php echo $jual; ?></td></tr>
                   <tr><td>Dibuat</td><td><?php echo $dibuat; ?></td></tr>
                   <tr><td>Jenis</td><td><?php echo $jenis; ?></td></tr>
                   <tr><td></td><td><a href="<?php echo site_url('stok') ?>" class="btn btn-warning">Kembali</a></td></tr>
               </table>
           </div>
    