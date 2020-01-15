             <div class="col-md-4 col-sm-4">
                <div id="nota" style="font-size: 12px; line-height: 1.6">
                    <?php echo strtoupper($nama_aplikasi)."<br>"; ?>
                    <?php echo strtoupper($alamat)."<br>";?>
                    <?php echo strtoupper($kontak)."<br>";?>
                    ====================<br>
                    <?php echo "KASIR ".strtoupper($_SESSION['username']);?><br>
                    ====================<br>
                    <?php foreach ($penjualan as $tanggal) { echo strtoupper($tanggal['tanggal'])." ".$kode."<br>"; break;}?>
                    ====================<br>
                    <table class="table table-striped" border="1|0" cellpadding="5" style="font-size:2.5em">
                         <tr>
                         <td>PRODUK</td>
                         <td>HARGA</td>
                         <td>JUMLAH</td>
                         <td>SUB</td>
                         </tr>
                            <?php foreach ($penjualan as $penjualan) {?>
                             <tr>
                                 <td><?php echo strtoupper($penjualan['nama']);?></td>
                                 <td><?php echo strtoupper(number_format($penjualan['jual']));?></td>
                                 <td><?php echo strtoupper($penjualan['jumlah']);?></td>
                
                                 <td><?php echo strtoupper(number_format($penjualan['jumlah_jual']));?></td>
                             </tr>
                         <?php } ?>
                         <?php foreach ($pembayaran as $pembayaran) {?> 
                             <tr>
                                 <td></td>
                                 <td></td>
                                 <td>TOTAL</td>
                                 <td><?php echo number_format($pembayaran['total_jual']);?></td>
                             </tr>
                             <tr>
                                 <td></td>
                                 <td></td>
                                 <td>BAYAR</td>
                                 <td><?php echo number_format($pembayaran['bayar']);?></td>
                             </tr>
                             <tr>
                                 <td></td>
                                 <td></td>
                                 <td>KEMBALI</td>
                                 <td><?php echo number_format($pembayaran['kembali']); }?></td>
                             </tr>
                         </table>
                         ====================<br>
                         <span>TERIMA KASIH ATAS KUNJUNGAN ANDA</span>
                 </div>                              
             </div>

