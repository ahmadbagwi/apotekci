			<div class="col-md-9 content"><!--mulai konten-->
				<p class="home"><a href="<?php echo base_url('Dashboard');?>">Home</a> > <strong> Tutup Kas</strong></p>
				<h4>Tutup Kasir</h4>
                <ul style="padding: 1rem">
                    <li>Klik jam mulai dan jam tutup, akan muncul otomatis pilihan jam</li>
                    <li>Kemudian pindah kolom isian dengan <strong>tombol Tab</strong></li>
                    <li>Jika berpindah dengan <strong>Tab</strong> total penjualan, total transaksi, kas tersedia, total kas, selisih akan terisi otomatis</li>
                </ul><hr>
                <h4>Perhatian</h4>
                <ul>
                    <li><strong>Jam tutup terakhir</strong> adalah pada <strong><?php echo $tanggal_tutup_terakhir; ?> <?php echo $jam_tutup_terakhir; ?></strong></li>
                    <li>Jika anda akan melakukan tutup kasir maka <strong>jam mulai WAJIB</strong> diatas jam tutup terakhir (minimal lebih 1 menit dari <strong>jam tutup terakhir</strong>)</li>
                </ul>
                <div class="col-md-6">
                    <?php echo form_open('TutupKas/create_action'); ?>
                    <legend>Data Komputer</legend>
                    <div class="form-group">
                        <label for="int">Tanggal <?php echo form_error('tanggal'); ?></label>
                        <input type="text" class="form-control date datepicker" name="tanggal" required="" id="tanggal" value="<?php echo date('Y-m-d');?>"/>
                    </div><div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="int">Jam mulai <?php echo form_error('jam_mulai'); ?></label>
                                <input type="text" class="form-control" name="jam_mulai" required="" id="jam_mulai" required="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="int">Jam tutup <?php echo form_error('jam_tutup'); ?></label>
                                <input type="text" class="form-control" name="jam_tutup" required="" id="jam_tutup" required="" />
                            </div>
                        </div>      
                    </div>
                    <div class="form-group">
                        <label for="int">Kas awal <?php echo form_error('kas_awal'); ?></label>
                        <input type="text" class="kas_awal form-control" id="kas_awal" name="kas_awal" required="" value="0"/>
                    </div>
                    <div class="form-group">
                        <label for="int">Total penjualan <?php echo form_error('total_penjualan'); ?></label>
                        <input type="text" class="total_penjualan form-control" id="total_penjualan" name="total_penjualan" required=""/>
                    </div>
                    <div class="form-group">
                        <label for="int">Rawat inap</label>
                        <input type="text" class="rawat_inap form-control" id="rawat_inap" name="rawat_inap" value="0"/>
                    </div>
                    <div class="form-group">
                        <label for="int">Total transaksi <?php echo form_error('total_transaksi'); ?></label>
                        <input type="text" class="total_transaksi form-control" id="total_transaksi" name="total_transaksi" required="" />
                    </div>      
                </div>
                <div class="col-md-6">
                    <legend>Aktual Kas</legend  >
                    <div class="form-group">
                        <label for="int">Kas tersedia <?php echo form_error('kas_tersedia'); ?></label>
                        <input type="text" class="kas_tersedia form-control" id="kas_tersedia" name="kas_tersedia" value="0"/>
                    </div>
                    <div class="form-group">
                        <label for="int">Kartu debit</label>
                        <input type="text" class="kartu_debit form-control" id="kartu_debit" name="kartu_debit" value="0"/>
                    </div>
                    <div class="form-group">
                        <label for="int">Belum dibayar</label>
                        <input type="text" class="belum_dibayar form-control" id="belum_dibayar" name="belum_dibayar" value="0"/>
                    </div>
                    <div class="form-group">
                        <label for="int">Total kas <?php echo form_error('total_kas'); ?></label>
                        <input type="text" class="total_kas form-control" id="total_kas" name="total_kas" required="" value=""/>
                    </div>
                    <div class="form-group">
                        <label for="int">Selisih</label>
                        <input type="text" class="selisih form-control" id="selisih" name="selisih" value=""/>
                    </div>
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Proses tutup kas?')">Tutup Kasir</button> 
                    <?php echo form_close();?>
                </div>
			</div><!--col-md-9-->
            <script type="text/javascript">
                $(function() {
                    $("#jam_tutup").blur(function() {
                        var tgl = $("#tanggal").val();
                        var jam_mulai = $("#jam_mulai").val();
                        var jam_tutup = $("#jam_tutup").val();

                        $.get("<?php echo base_url('TutupKas/get_penjualan/');?>",{ tggl: tgl, jam_mulai: jam_mulai, jam_tutup: jam_tutup }, function(data, status){
                            console.log(data);
                            console.log(status);
                            $("#total_penjualan").val(data);
                            $("#total_transaksi").val(data); 
                        });
                    });
                });
            </script>

            <!--Mencari nilai total transaksi yang ada pada satu shift-->
            <script type="text/javascript">
                $(document).ready(function(){
                    $(document).on("blur", ".rawat_inap", function(){
                        var kas_awal = $("#kas_awal").val();
                        var total_penjualan = $("#total_penjualan").val();
                        var rawat_inap = $("#rawat_inap").val();
                        $("input[type=text][name=total_transaksi]").val(parseInt(kas_awal) + parseInt(total_penjualan) + parseInt(rawat_inap));  
                    })
                });
            </script>

            <!--Menginput nilai total aktual kas (data uang real) dan mencari total aktual kas yang ada pada satu shift-->
            <script type="text/javascript">
                $(document).ready(function(){
                    $(document).on("keyup", ".belum_dibayar", function(){
                        var kas_tersedia = $("#kas_tersedia").val();
                        var kartu_debit = $("#kartu_debit").val();
                        var belum_dibayar = $("#belum_dibayar").val();
                        $("input[type=text][name=total_kas]").val(parseInt(kas_tersedia) + parseInt(kartu_debit) + parseInt(belum_dibayar));    
                    })
                });
            </script>

            <!--Mencari selisih yang ada pada satu shift-->
            <script type="text/javascript">
                $(document).ready(function(){
                    $(document).on("blur", ".total_kas", function(){
                        $("input[type=text][name=selisih]").val(parseInt($("input[type=text][name=total_kas]").val()) - parseInt($("input[type=text][name=total_transaksi]").val()));
                    })
                });
            </script>

            <script>
                $(document).ready(function (){

                    $("body").on('focus', ' .datepicker', function () {
                        $(this).datepicker({
                            dateFormat: "yy-mm-dd"
                        });
                    });

                });
            </script>

            <script type="text/javascript">
                $('#jam_mulai').timepicker({ 'timeFormat': 'H:i:s' });
                $('#jam_tutup').timepicker({ 'timeFormat': 'H:i:s' });
            </script>
</body>
</html>
			