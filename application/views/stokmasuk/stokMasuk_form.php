            <div class="col-md-9 content"><!--mulai konten-->
                <p class="home"><a href="<?php echo base_url('Dashboard');?>">Home</a> > <strong> Tambah/Ubah Stok Masuk</strong></p>
                <form action="<?php echo $action; ?>" method="post">
                <legend>Tambah/Ubah Stok Masuk</legend>
                <div class="col-md-6">
                	    <div class="form-group hidden">
                            <label for="int">Id User <?php echo form_error('user_id') ?></label>
                            <input type="text" class="form-control" readonly="" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="int">Nama Supplier <?php echo form_error('suplier') ?></label>
                            <input type="text" class="suplier form-control" name="suplier" autofocus="" placeholder="tekan huruf, akan muncul prediksi"/>
                        </div>
                	    <div class="form-group hidden">
                            <label for="int">Id Suplier <?php echo form_error('id_suplier') ?></label>
                            <input type="text" class="form-control" readonly="" name="id_suplier" value="<?php echo $id_suplier; ?>" />
                        </div>
                	    <div class="form-group">
                            <label for="int">Nama Produk <?php echo form_error('nama_produk') ?></label>
                            <input type="text" class="nama_produk form-control" name="nama_produk" placeholder="tekan huruf, akan muncul prediksi" value="<?php echo $nama_produk; ?>"/>
                        </div>
                	    <div class="form-group hidden" >
                            <label for="int">Id Produk <?php echo form_error('id_produk') ?></label>
                            <input type="text" class="id_produk form-control" readonly="" name="id_produk" value="<?php echo $id_produk; ?>" />
                        </div>
                	    <div class="form-group">
                            <label for="timestamp">Tanggal <?php echo form_error('tanggal') ?></label>
                            <input type="text" class="form-control" name="tanggal" value="<?php echo date('Y-m-d H:i:s'); ?>" />
                        </div>
                        <div class="form-group">
                            <label for="int">Stok</label>
                            <input type="text" class="stok_awal form-control" readonly="" name="stok_awal" placeholder="Stok produk yang ada" />
                        </div>
                	    <div class="form-group">
                            <label for="int">Jumlah produk masuk <?php echo form_error('jumlah') ?></label>
                            <input type="text" class="jumlah form-control" name="jumlah" placeholder="Jumlah Barang Masuk" value="<?php echo $jumlah; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="int">Stok setelah ditambahkan</label>
                            <input type="text" class="stok_akhir form-control" readonly="" name="stok_akhir" />
                        </div>
                	    <div class="form-group">
                            <label for="int">Harga (modal)<?php echo form_error('modal') ?></label>
                            <input type="text" class="form-control" name="modal" placeholder="Harga modal/beli dari supplier" value="<?php echo $modal; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="int">Harga (jual)<?php echo form_error('modal') ?></label>
                            <input type="text" class="form-control" name="jual" placeholder="Harga jual barang" value="<?php echo $jual; ?>" />
                        </div>
                	    <button type="submit" class="btn btn-primary"  onclick="return confirm('Simpan data?')">Simpan</button> 
                	    <a href="<?php echo site_url('stokmasuk') ?>" class="btn btn-warning">Kembali</a>
                </div>
                </form>
                    <script type="text/javascript">
                    $(document).ready(function(){    
                    $('[name="nama_produk"]').each(function(i,e){   
                        $(this).autocomplete({
                            source: function (request, response) {
                                $.get("<?php echo base_url('Stokmasuk/get_autocomplete/?');?>", request,function(data){
                                    jsonData = JSON.parse(data);
                                    console.log(jsonData);
                                    response($.map(jsonData, function (value, key) {
                                        return {
                                            label: value.name,
                                            data: value,
                                        }
                                    }));
                                });
                            },
                            select: function (event, ui){
                                //tr = $(this).parents('tr');
                                $('[name="nama_produk"]').val(ui.item.data.name);
                                $('[name="id_produk"]').val(ui.item.data.id_produk);
                                $('[name="stok_awal"]').val(ui.item.data.stokProduk);
                                $('[name="modal"]').val(ui.item.data.modal);
                                $('[name="jual"]').val(ui.item.data.jual);
                            }
                        })
                    })
                    })
                    </script>
                    <script type="text/javascript">
                        $(document).ready(function(){    
                            $('[name="suplier"]').each(function(i,e){   
                                $(this).autocomplete({
                                    source: function (request, response) {
                                        $.get("<?php echo base_url('Supplier/get_autocomplete/?');?>", request,function(data){
                                            jsonData = JSON.parse(data);
                                            console.log(jsonData);
                                            response($.map(jsonData, function (value, key) {
                                                return {
                                                    label: value.name,
                                                    data: value,
                                                }
                                            }));
                                        });
                                    },
                                    select: function (event, ui){
                                        //tr = $(this).parents('tr');
                                        $('[name="suplier"]').val(ui.item.data.name);
                                        $('[name="id_suplier"]').val(ui.item.data.idSuplier);
                                    }
                                })
                            })
                        })
                    </script>
                    <script type="text/javascript">
                       $(document).ready(function(){
                          //$(document).on("focus", ".jumlah", function(){
                              $(".jumlah").blur(function(){
                                var stok_awal = $(this).parent().parent().find(".stok_awal");
                                var jumlah = $(this).parent().parent().find(".jumlah");
                                if (stok_awal.val() !== "" && jumlah.val() !== "")
                                  {
                                    $(this).parent().parent().find(".stok_akhir").val(parseInt(stok_awal.val())+parseInt(jumlah.val()));
                                }
                                })
                            //})
                        });
                    </script>
            </div>