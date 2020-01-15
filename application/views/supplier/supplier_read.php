            <div class="col-md-9 content"><!--mulai konten-->
                <p class="home"><a href="<?php echo base_url('Dashboard');?>">Home</a> > <strong> Detail Suplier</strong></p>
                    <h4>Detail Suplier</h4>
                    <table class="table">
            	    <tr><td>Nama</td><td><?php echo $nama; ?></td></tr>
            	    <tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
            	    <tr><td>Hp</td><td><?php echo $hp; ?></td></tr>
            	    <tr><td>Jenis</td><td><?php echo $jenis; ?></td></tr>
            	    <tr><td></td><td><a href="<?php echo site_url('supplier') ?>" class="btn btn-warning">Kembali</a></td></tr>
            	   </table>
            </div>
            