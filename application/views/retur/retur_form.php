            <div class="col-md-9 content"><!--mulai konten-->
                <p class="home"><a href="<?php echo base_url('Dashboard');?>">Home</a> > <strong> Tambah/Ubah Retur</strong></p>            
                <h3>Tambah/Ubah Retur</h3>
                <div class="col-md-6">
                <form action="<?php echo $action; ?>" method="post">
        	    <div class="form-group">
                    <label for="int">Id User <?php echo form_error('user_id') ?></label>
                    <input type="text" class="form-control" name="user_id" id="user_id" value="<?php echo $_SESSION['user_id']; ?>" />
                </div>
                 <div class="form-group">
                        <label for="int">Nama supplier</label>
                        <input type="text" class="nama_supplier form-control" name="nama_supplier" id="nama_supplier">
                    </div>
        	    <div class="form-group">
                    <label for="int">Id Suplier <?php echo form_error('id_supplier') ?></label>
                    <input type="text" class="form-control" name="id_supplier" placeholder="IdSuplier" value="<?php echo $id_supplier; ?>" />
                </div>
        	    <div class="form-group">
                    <label for="varchar">Produk <?php echo form_error('nama') ?></label>
                    <input type="text" class="form-control" name="nama" value="<?php echo $nama; ?>" />
                </div>
        	    <div class="form-group">
                    <label for="int">Id Produk <?php echo form_error('id_produk') ?></label>
                    <input type="text" class="form-control" name="id_produk" value="<?php echo $id_produk; ?>" />
                </div>
                <div class="form-group">
                        <label for="int">Stok saat ini <?php echo form_error('stok') ?></label>
                        <input type="text" class="stok form-control" readonly="" name="stok" class="stok" placeholder="Stok produk yang ada di gudang" />
                    </div>
        	    <div class="form-group">
                    <label for="datetime">Tanggal retur<?php echo form_error('tanggal') ?></label>
                    <input type="text" class="form-control" name="tanggal" placeholder="Tanggal" value="<?php if($tanggal){ echo $tanggal; } else { echo date('Y-m-d H:i:s');} ?>" />
                </div>
        	    <div class="form-group">
                    <label for="int">Jumlah <?php echo form_error('jumlah') ?></label>
                    <input type="text" class="jumlah form-control" name="jumlah" placeholder="Jumlah barang yang diretur" value="<?php echo $jumlah; ?>" />
                </div>
                <div class="form-group">
                        <label for="int">Stok Akhir <?php echo form_error('stok_akhir') ?></label>
                        <input type="text" class="stok_akhir form-control" readonly="" name="stok_akhir" class="stok" placeholder="Stok produk setelah diretur"  />
                    </div>
        	    <div class="form-group">
                    <label for="int">Harga <?php echo form_error('modal') ?></label>
                    <input type="text" class="form-control" name="modal" placeholder="Harga (modal) produk yang diretur" value="<?php echo $modal; ?>" />
                </div>
        	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
        	    <button type="submit" class="btn btn-primary"  onclick="return confirm('Simpan data?')">Simpan</button> 
        	    <a href="<?php echo site_url('retur') ?>" class="btn btn-warning">Kembali</a>
                </form>
                </div>
            </div>
                <script type="text/javascript">
                    $(document).ready(function(){    
                    $('[name="nama_supplier"]').each(function(i,e){   
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
                                $('[name="nama_supplier"]').val(ui.item.data.name);
                                $('[name="id_supplier"]').val(ui.item.data.idSuplier);
                            }
                        })
                    })
                    })
                    </script>

                    <script type="text/javascript">
                    $(document).ready(function(){    
                    $('[name="nama"]').each(function(i,e){   
                        $(this).autocomplete({
                            source: function (request, response) {
                                $.get("<?php echo base_url('Penjualan/get_autocomplete/?');?>", request,function(data){
                                    jsonData = JSON.parse(data);
                                    console.log(jsonData);
                                    response($.map(jsonData, function (value, key) {
                                        return {
                                            label: value.nama,
                                            data: value,
                                        }
                                    }));
                                });
                            },
                            select: function (event, ui){
                                //tr = $(this).parents('tr');
                                $('[name="nama"]').val(ui.item.data.nama);
                                $('[name="id_produk"]').val(ui.item.data.id_produk);
                                $('[name="stok"]').val(ui.item.data.stok);
                                $('[name="modal"]').val(ui.item.data.modal);
                            }
                        })
                    })
                    })
                    </script>

                    <script type="text/javascript">
                       $(document).ready(function(){
                          //$(document).on("focus", ".jumlah", function(){
                              $(".jumlah").blur(function(){
                                var stokAwal = $(this).parent().parent().find(".stok");
                                var quantity = $(this).parent().parent().find(".jumlah");
                                if (stokAwal.val() !== "" && quantity.val() !== "")
                                  {
                                    $(this).parent().parent().find(".stok_akhir").val(parseInt(stokAwal.val())-parseInt(quantity.val()));
                                }
                                })
                            //})
                        });
                    </script>