                <div id="nota" style="font-size: 12px">
                    <span  style="font-weight: bold">SLIP PENJUALAN</span><br>
                    ------------------------------------------
                    <table style="font-size: 12px" class="table table-stripped" cellpadding="2">
                        <tr>
                            <td>Tanggal</td>
                            <td><?php echo substr($data_kas->tanggal, 0,10); ?></td>
                        </tr>
                        <tr>
                            <td>Jam Tutup</td>
                            <td><?php echo $data_kas->jam_tutup; ?></td>
                        </tr>
                        <tr>
                            <td>No. Slip</td>
                            <td><?php echo $data_kas->no_slip; ?></td>
                        </tr>
                        <tr>
                            <td>Ditutup oleh</td>
                            <td><?php echo $data_kas->username; ?></td>
                        </tr>
                        <tr>
                            <td>No. Struk terakhir</td>
                            <td><?php echo $data_kas->kode_akhir; ?></td>
                        </tr>
                    </table>
                    ------------------------------------------
                    <table style="font-size: 12px" class="table table-stripped" cellpadding="2">
                        <span><u>DATA KOMPUTER</u></span>
                        <tr>
                            <td>Kas awal</td>
                            <td><?php echo number_format($data_kas->kas_awal); ?></td>
                        </tr>
                        <tr>
                            <td>Penjualan</td>
                            <td><?php echo number_format($data_kas->total_penjualan); ?></td>
                        </tr>
                        <tr>
                            <td>Rawat inap</td>
                            <td><?php echo number_format($data_kas->rawat_inap); ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold">Total transaksi</td>
                            <td style="font-weight: bold"><?php echo number_format($data_kas->total_transaksi); ?></td>
                        </tr>
                    </table>
                    ------------------------------------------
                    <table style="font-size: 12px" class="table table-stripped" cellpadding="2">
                        <u><span>AKTUAL KAS</span></u>
                        <tr>
                            <td>Kas tersedia</td>
                            <td><?php echo number_format($data_kas->kas_tersedia); ?></td>
                        </tr>
                        <tr>
                            <td>Kartu debit</td>
                            <td><?php echo number_format($data_kas->kartu_debit); ?></td>
                        </tr>
                        <tr>
                            <td>Belum dibayar</td>
                            <td><?php echo number_format($data_kas->belum_dibayar); ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold">Total kas</td>
                            <td style="font-weight: bold"><?php echo number_format($data_kas->total_kas); ?></td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td style="font-weight: bold">SELISIH</td>
                            <td style="font-weight: bold"><?php echo number_format($data_kas->selisih); ?></td>
                        </tr>
                   
                    </table>                                  
          
                    <br>

                    <span><?php echo $data_kas->username; ?> </span><br>
                    ----------------------<br><br><br>
                    

                     <span>KONSINYASI</span>
                     <table class="table table-striped" border="0" cellpadding="5" style="font-size: 12px">
                       <tr>
                           <th>Produk</td>
                               <th>Jumlah</th>
                               <th>Harga Modal</th>
                               <th>Total</th>
                           </tr>
                           <?php $sum=0; foreach ($data_konsinyasi as $konsinyasi) { ?>
                               <tr>
                                   <td><?php echo $konsinyasi->nama;?></td>
                                   <td><?php echo $konsinyasi->jumlah;?></td>
                                   <td><?php echo number_format($konsinyasi->modal);?></td>
                                   <td><?php $total_konsinyasi = $konsinyasi->jumlah*$konsinyasi->modal; echo number_format($total_konsinyasi); ?></td>
                               </tr>
                               <?php $sum += $total_konsinyasi; } ?>
                               <tr>
                                <td></td>
                                <td></td>
                                <td><strong>Total</strong></td>
                                <td><?php echo number_format($sum); ?></td>
                            </tr>
                        </table>
                </div>