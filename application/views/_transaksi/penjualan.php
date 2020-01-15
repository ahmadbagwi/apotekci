			<div class="col-md-9 content border"><!--mulai konten-->
				<p class="home"><a href="<?php echo base_url('Dashboard');?>">Home</a> > <strong> Penjualan</strong></p>
				<?php echo form_open('Penjualan/create_action'); ?>
					<legend>Transaksi Penjualan | <?php echo date('Y-m-d'); ?></legend>
					  <div class="col-xs-4">
                       <label>Jenis</label><input type="text" name="jenis" required=""  class="type form-control input-sm" value="umum">
                       <label>Pelanggan</label><input type="text" name="pelanggan" required="" class="customer form-control input-sm" value="umum">
                       <input type="hidden" id="user_id" name="user_id" class="form-control input-sm" required="" value="<?php echo $_SESSION['user_id'];?>">
                        <?php echo form_error('user_id') ?>
                      </div>
                      <div class="col-md-12">
					   <table style="width: 100%" class="table table-responsive">
							<thead>
								<tr>
									<th>No</th>
                                    <th hidden="">Id</th>
                                    <th>Nama Produk</th>
                                    <th hidden="">Modal</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Banyaknya</th>
                                    <th hidden="">Stok Akhir</th>
                                    <th hidden="">Total Modal</th>
                                    <th>Diskon (%)</th>
                                    <th>Sub total</th>
								</tr>
							</thead>
							<tbody id="table-details">
                                <tr id="row1" class="jdr1">
                                    <td><span class="btn btn-sm btn-default">1</span><input type="hidden" value="6437" name="count[]"></td>
                                    <td hidden="" ><input type="text" id="id_produk" name="id_produk[]" required=""  class="id_produk form-control input-sm"><?php echo form_error('id_produk'); ?></td> 
                                    <td><input type="text" id="nama" name="nama[]" autofocus="" required="" class="nama form-control input-sm"><?php echo form_error('nama'); ?></td>
                                    <td  hidden="" ><input type="text" name="modal[]" required="" class="modal form-control input-sm" ><?php echo form_error('modal'); ?></td>
                                    <td><input type="text" readonly="" name="jual[]" required="" class="jual form-control input-sm"><?php echo form_error('jual'); ?></td>
                                    <td><input type="text" name="stok_awal[]" readonly="" required="" class="stok_awal form-control input-sm"><?php echo form_error('istok_awal'); ?></td>
                                    <td><input type="text" name="jumlah[]" required="" class="jumlah form-control input-sm"><?php echo form_error('jumlah'); ?></td>
                                    <td hidden=""><input type="text" name="stok_akhir[]" required="" class="stok_akhir form-control input-sm"></td>
                                    <td hidden=""><input type="text" name="jumlah_modal[]" required="" class="jumlah_modal form-control input-sm" readonly ><?php echo form_error('jumlah_modal'); ?></td>
                                    <td><input type="text" name="diskon[]" class="diskon form-control input-sm" value="0"></td>
                                    <td><input type="text" name="jumlah_jual[]" required="" class="jumlah_jual form-control input-sm" readonly><?php echo form_error('jumlah_jual'); ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <button class="btn btn-primary btn-sm btn-add-more">Tambah</button>
                        <button class="btn btn-sm btn-warning btn-remove-detail-row">Hapus</button>
                       </div>
                        <div class="col-xs-4">
	                        <table style="width: 100%" class="hitungan table">
	                        
	                         <tr><td hidden=""><input type="text" name="total_modal"  required="" class="total_modal form-control input-sm" placeholder="Grand total modal" readonly><?php echo form_error('total_modal'); ?></td></tr> 
	                         <tr><td><input type="text" required="" name="total_jual" class="total_jual form-control input-sm" placeholder="Grand total jual" readonly><?php echo form_error('total_jual'); ?></td></tr>
	                         <tr><td><input type="text" class="bayar form-control input-sm" required="" placeholder="Bayar" name="bayar"><?php echo form_error('bayar'); ?></td></tr>
	                         <tr><td><input type="text"  required="" class="kembali form-control input-sm" placeholder="Kembali" name="kembali" readonly><?php echo form_error('kembali'); ?></td></tr> 
	                     	</table>
                     	</div>
                    <div class="col-md-12">
                        <hr>
                        <input class="btn btn-primary pull-left" type="submit" value="PROSES" name="submit" onclick="return confirm('Proses transaksi?')">
                    </div>
                <?php echo form_close();?>
                <div id="info" class="info"></div>
			    <script type="text/javascript">
				    $(document).on("focus", ".table", function(){    
					    $('[name="nama[]"]').each(function(i,e){   
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
					                tr.find('[name="nama[]"]').val(ui.item.data.nama);
					                tr.find('[name="id_produk[]"]').val(ui.item.data.id_produk);
					                tr.find('[name="modal[]"]').val(ui.item.data.modal);
					                tr.find('[name="jual[]"]').val(ui.item.data.jual);
					                tr.find('[name="stok_awal[]"]').val(ui.item.data.stok);
					            }
					        })
					    })
				    })
			    </script>
			    
			    <script>
			    	$(document).ready(function (){
			    		$("body").on('click', '.btn-add-more', function (e) {
			    			e.preventDefault();
			    			var $sr = ($(".jdr1").length + 1);
			    			var rowid = Math.random();
			    			var $html = '<tr class="jdr1" id="' + rowid + '">' +
			    			'<td><span class="btn btn-sm btn-default">' + $sr + '</span><input type="hidden" required="" name="count[]" value="'+Math.floor((Math.random() * 10000) + 1)+'"></td>' + 
			                '<td hidden=""><input type="text" name="id_produk[]" required="" class="id_produk form-control input-sm"></td>'+
			                '<td><input type="text" id="nama" name="nama[]" required="" autofocus="" class="nama form-control input-sm"></td>'+
			                '<td hidden=""><input type="text" name="modal[]" required="" class="modal form-control input-sm" ></td>'+
			                '<td><input type="text" readonly name="jual[]" required="" class="jual form-control input-sm" ></td>'+
			                '<td><input type="text" name="stok_awal[]" readonly="" required="" class="stok_awal form-control input-sm"></td>'+
			                '<td><input type="text" name="jumlah[]" required="" class="jumlah form-control input-sm"></td>'+
			                '<td hidden=""><input type="text" name="stok_akhir[]" required="" class="stok_akhir form-control input-sm"></td>'+
			                '<td hidden=""><input type="text" name="jumlah_modal[]" required="" class="jumlah_modal form-control input-sm" readonly></td>'+
			                '<td><input type="text" name="diskon[]" class="diskon form-control input-sm" value="0"></td>'+
			                '<td><input type="text" name="jumlah_jual[]" required="" class="jumlah_jual form-control input-sm" readonly></td>'+
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
			    <!--cari stok awal, kurangi dengan jumlah beli, simpan di stok akhir, update stok item belanja ke database dengan update_batch-->
			    <script type="text/javascript">
			       $(document).ready(function(){
			          $(document).on("focus", ".table", function(){
			              $(".jumlah").blur(function(){
			                var stok_awal = $(this).parent().parent().find(".stok_awal");
			                var jumlah = $(this).parent().parent().find(".jumlah");
			                if (stok_awal.val() !== "" && jumlah.val() !== "") {
			                    $(this).parent().parent().find(".stok_akhir").val(parseInt(stok_awal.val())-parseInt(jumlah.val()));
			                }
			                //if (stok_awal.val() < quantity.val()) {
			                    //alert('Jumlah stok tidak cukup, tersisa ' + stok_awal.val());
			                //}
			                //console.log(quantity.val());
			                //console.log(stok_awal.val());
			                })
			            })
			        });
			    </script>
			    <!--Tampilkan notifikasi jika stok kurang-->

			    <!--Mencari total modal dan total belanja-->
			    <script type="text/javascript">
			        $(document).ready(function(){
			          $(document).on("focus", ".table", function(){
				          $(".diskon").blur(function(){
				            var modal = $(this).parent().parent().find(".modal");
				            var jual = $(this).parent().parent().find(".jual");
				            var jumlah = $(this).parent().parent().find(".jumlah");
				            var diskon = $(this).parent().parent().find(".diskon");
				            var jumlah_diskon = parseInt(jual.val()) * parseInt(diskon.val()) / 100 * parseInt(jumlah.val());
				            console.log(jumlah_diskon);
				            if (jual.val() !== "" && jumlah.val() !== "")
				              {
				                $(this).parent().parent().find(".jumlah_jual").val(parseInt(jual.val()) * parseInt(jumlah.val()) - jumlah_diskon);
				         
				                //$(this).parent().parent().find(".total").val(jumlahAhir);
				                $(this).parent().parent().find(".jumlah_modal").val(parseInt(modal.val()) * parseInt(jumlah.val())); 
				              }
				            // mencari grand total;
				            var total_jual = 0;
				            $(".jumlah_jual").each(function(i,e){
				              if (e.value !== "")
				                total_jual += parseInt(e.value);
				            });
				            $(".total_jual").val(total_jual);

				            // mencari total modal
				            var total_modal = 0;
				            $(".jumlah_modal").each(function(i,e){
				              if (e.value !== "")
				                total_modal += parseInt(e.value);
				            });
				            $(".total_modal").val(total_modal);

				          });
			          });
			        });
			    </script>

			    <!--Mencari uang kembali-->
			    <script type="text/javascript">
			        $(document).ready(function(){
			           $(document).on("focus", ".table", function(){
			            var total_jual = $(this).parent().parent().find(".total_jual");
			            var bayar = $(this).parent().parent().find(".bayar");
			            if (total_jual.val() !== "")
			              {     
			                $(this).parent().parent().find(".kembali").val(parseInt(bayar.val()) - parseInt(total_jual.val()));
			              }
			          });
			        });
			    </script>
			</div><!--col-md-9-->
</body>
</html>
			