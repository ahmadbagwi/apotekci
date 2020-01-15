            <div class="col-md-9 content"><!--mulai konten-->
                <p class="home"><a href="<?php echo base_url('Dashboard');?>">Home</a> > <strong> Stok Masuk Masal</strong></p>
                <?php echo form_open('stokmasuk/create_mass_action'); ?>
                <legend>Stok Masuk Masal</legend>
                <div class="col-md-12">
                    <div class="col-xs-4">
                       <label>Tanggal</label>
                       <input type="text" name="tanggal" required=""  class="tanggal form-control input-sm" value="<?php echo date('Y-m-d'); ?>">
                       <label>Supplier</label>
                       <input type="text" name="suplier" required="" class="suplier form-control input-sm"><?php echo form_error('suplier') ?>
                       <label>Id Supplier</label>
                       <input type="text" name="id_suplier" required="" readonly="" class="id_suplier form-control input-sm"><?php echo form_error('id_suplier') ?>
                       <input type="hidden" id="user_id" name="user_id" class="form-control input-sm" required="" value="<?php echo $_SESSION['user_id'];?>">
                    </div>
                    <div class="col-md-12">
                       <table style="width: 100%" class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Id Produk</th>
                                    <th>Stok Awal</th>
                                    <th>Banyaknya</th>
                                    <th>Stok Akhir</th>
                                    <th>Modal</th>
                                    <th>Jual</th>
                                </tr>
                            </thead>
                            <tbody id="table-details">
                                <tr id="row1" class="jdr1">
                                    <td><span class="btn btn-sm btn-default">1</span><input type="hidden" value="6437" name="count[]"></td>
                                    <td><input type="text" name="nama_produk[]" autofocus="" required=""  class="nama_produk form-control input-sm"><?php echo form_error('nama_produk'); ?></td> 
                                    <td><input type="text" name="id_produk[]" required="" class="id_produk form-control input-sm"></td>
                                    <td><input type="text" name="stok_awal[]" required="" class="stok_awal form-control input-sm" ><?php echo form_error('stok_awal'); ?></td>
                                    <td><input type="text" name="jumlah[]" required="" class="jumlah form-control input-sm"><?php echo form_error('jumlah'); ?></td>
                                    <td><input type="text" name="stok_akhir[]" required="" class="stok_akhir form-control input-sm"><?php echo form_error('stok_akhir'); ?></td>
                                    <td><input type="text" name="modal[]" required="" class="form-control input-sm"><?php echo form_error('modal'); ?></td>
                                    <td><input type="text" name="jual[]" required="" class="jual form-control input-sm"><?php echo form_error('jual'); ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <button class="btn btn-primary btn-sm btn-add-more">Tambah</button>
                        <button class="btn btn-sm btn-warning btn-remove-detail-row">Hapus</button>
                    </div>
                    <div class="col-md-12">
                        <hr>
                        <input class="btn btn-primary pull-left" type="submit" value="PROSES" name="submit" onclick="return confirm('Simpan data??')">
                    </div>
                </div>
                <?php echo form_close(); ?>        
                        <script>
                            $(document).ready(function (){
                                $("body").on('click', '.btn-add-more', function (e) {
                                    e.preventDefault();
                                    var $sr = ($(".jdr1").length + 1);
                                    var rowid = Math.random();
                                    var $html = '<tr class="jdr1" id="' + rowid + '">' +
                                    '<td><span class="btn btn-sm btn-default">' + $sr + '</span><input type="hidden" required="" name="count[]" value="'+Math.floor((Math.random() * 10000) + 1)+'"></td>' + 
                                    '<td><input type="text" name="nama_produk[]" autofocus="" required=""  class="nama_produk form-control input-sm"></td>'+
                                    '<td><input type="text" name="id_produk[]" required="" class="id_produk form-control input-sm"></td>'+
                                    '<td><input type="text" name="stok_awal[]" required="" class="stok_awal form-control input-sm" ></td>'+
                                    '<td><input type="text" name="jumlah[]" required="" class="jumlah form-control input-sm"></td>'+
                                    '<td><input type="text" name="stok_akhir[]" required="" class="stok_akhir form-control input-sm"></td>'+
                                    '<td><input type="text" name="modal[]" required="" class="form-control input-sm"></td>'+
                                    '<td><input type="text" name="jual[]" required="" class="jual form-control input-sm"></td>'+
                                    '</tr>';
                                    $("#table-details").append($html);
                                });
                                $("body").on('click', '.btn-remove-detail-row', function (e) {
                                    e.preventDefault();
                                    if($("#table-details tr:last-child").attr('id') != 'row1'){
                                        $("#table-details tr:last-child").remove();
                                    }
                                });
                                $("body").on('focus', ' .datepicker', function () {
                                    $(this).datepicker({
                                        dateFormat: "yy-mm-dd"
                                    });
                                });
                            });
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
                            $(document).on("focus", ".table", function(){    
                                $('[name="nama_produk[]"]').each(function(i,e){   
                                    $(this).autocomplete({
                                        source: function (request, response) {
                                            $.get("<?php echo base_url('Penjualan/get_autocomplete/?');?>", request,function(data){
                                                jsonData = JSON.parse(data);
                                                //console.log(jsonData);
                                                response($.map(jsonData, function (value, key) {
                                                    return {
                                                        label: value.nama,
                                                        data: value,
                                                    }
                                                }));
                                            });
                                        },
                                        select: function (event, ui){
                                            tr = $(this).parents('tr');
                                            tr.find('[name="nama_produk[]"]').val(ui.item.data.nama);
                                            tr.find('[name="id_produk[]"]').val(ui.item.data.id_produk);
                                            tr.find('[name="modal[]"]').val(ui.item.data.modal);
                                            tr.find('[name="jual[]"]').val(ui.item.data.jual);
                                            tr.find('[name="stok_awal[]"]').val(ui.item.data.stok);
                                        }
                                    })
                                })
                            })
                        </script>

                        <script type="text/javascript">
                         $(document).ready(function(){
                          $(document).on("focus", ".table", function(){
                            $(".jumlah").blur(function(){
                              //$(".jumlah").each(function(i,e){
                                var stok_awal = $(this).parent().parent().find(".stok_awal");
                                var jumlah = $(this).parent().parent().find(".jumlah");
                                if (stok_awal.val() !== "" && jumlah.val() !== "")
                                {
                                    $(this).parent().parent().find(".stok_akhir").val(parseInt(stok_awal.val())+parseInt(jumlah.val()));
                                }
                            })
                           })
                         });
                        </script>
            </div>