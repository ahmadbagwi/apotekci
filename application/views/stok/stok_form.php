            <div class="col-md-9 content"><!--mulai konten-->
                <p class="home"><a href="<?php echo base_url('Dashboard');?>">Home</a> > <strong> Tambah/Ubah Produk</strong></p>
                <h3>Tambah/Ubah Produk</h3>
                <div class="col-md-6">
                    <form action="<?php echo $action; ?>" method="post">
                       <div class="form-group">
                        <label for="varchar">Nama <?php echo form_error('nama') ?></label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="" value="<?php echo $nama; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Kategori <?php echo form_error('kategori') ?></label>
                        <input type="text" class="form-control" name="kategori" id="kategori" placeholder="" value="<?php echo $kategori; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Deskripsi <?php echo form_error('deskripsi') ?></label>
                        <input type="text" class="form-control" name="deskripsi" id="deskripsi" placeholder="" value="<?php echo $deskripsi; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="int">Stok <?php echo form_error('stok') ?></label>
                        <input type="text" class="form-control" name="stok" id="stok" placeholder="" value="<?php echo $stok; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="int">Harga Modal <?php echo form_error('modal') ?></label>
                        <input type="text" class="form-control" name="modal" id="modal" placeholder="" value="<?php echo $modal; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="int">Harga Jual <?php echo form_error('jual') ?></label>
                        <input type="text" class="form-control" name="jual" id="jual" placeholder="" value="<?php echo $jual; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="timestamp">Dibuat <?php echo form_error('dibuat') ?></label>
                        <input type="text" class="form-control" name="dibuat" id="dibuat" placeholder="" value="<?php echo date('Y-m-d H:i:j') ?>" />
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="jenis" value="konsinyasi"> Konsinyasi
                        <!--<input type="text" class="form-control" name="jenis" id="jenis" placeholder="Isi 'konsinyasi' jika merupakan barang konsinyasi, atau isi 'umum'" value="<?php //echo $jenis; ?>" />-->
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Simpan data?')">Simpan</button> 
                    <a href="<?php echo site_url('stok') ?>" class="btn btn-warning">Kembali</a>
                </form>
            </div>
        </div>