            <div class="col-md-9 content"><!--mulai konten-->
                <p class="home"><a href="<?php echo base_url('Dashboard');?>">Home</a> > <strong> Daftar Stok Masuk</strong></p>
                <legend>Daftar Stok Masuk</legend>
                    <div class="row" style="margin-bottom: 10px">
                        <div class="col-md-4">
                            <?php echo anchor(site_url('stokmasuk/create'),'+ Stok', 'class="btn btn-primary"'); ?>
                            <?php // echo anchor(site_url('stokmasuk/create_mass'),'+ Stok Masal', 'class="btn btn-primary"'); ?>
                        </div>
                        <div class="col-md-4 text-center">
                            <div style="margin-top: 8px" id="message">
                                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                            </div>
                        </div>
                        <div class="col-md-1 text-right">
                        </div>
                        <div class="col-md-3 text-right">
                            <form action="<?php echo site_url('stokmasuk/index'); ?>" class="form-inline" method="get">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                                    <span class="input-group-btn">
                                        <?php 
                                            if ($q <> '')
                                            {
                                                ?>
                                                <a href="<?php echo site_url('stokmasuk'); ?>" class="btn btn-default">Reset</a>
                                                <?php
                                            }
                                        ?>
                                      <button class="btn btn-primary" type="submit">Search</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <table class="table table-striped" style="margin-bottom: 10px;font-size:12px;">
                        <tr>
                            <th>No</th>
            		<th>Id User</th>
            		<th>Id Suplier</th>
            		<th>Nama Produk</th>
            		<th>Id Produk</th>
            		<th>Tanggal</th>
            		<th>Jumlah</th>
            		<th>Harga Modal</th>
                    <th>Harga Jual</th>
            		<th>Aksi</th>
                        </tr><?php
                        foreach ($stokmasuk_data as $stokmasuk)
                        {
                            ?>
                            <tr>
            			<td width="80px"><?php echo ++$start ?></td>
            			<td><?php echo $stokmasuk->user_id ?></td>
            			<td><?php echo $stokmasuk->id_suplier ?></td>
            			<td><?php echo $stokmasuk->nama_produk ?></td>
            			<td><?php echo $stokmasuk->id_produk ?></td>
            			<td><?php echo $stokmasuk->tanggal ?></td>
            			<td><?php echo $stokmasuk->jumlah ?></td>
            			<td><?php echo $stokmasuk->modal ?></td>
                        <td><?php echo $stokmasuk->jual ?></td>
            			<td style="text-align:center" width="200px">
            				<?php 
            				echo anchor(site_url('stokmasuk/read/'.$stokmasuk->id),'Read'); 
            				echo ' | '; 
            				echo anchor(site_url('stokmasuk/update/'.$stokmasuk->id),'Update'); 
            				echo ' | '; 
            				echo anchor(site_url('stokmasuk/delete/'.$stokmasuk->id),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
            				?>
            			</td>
            		</tr>
                            <?php
                        }
                        ?>
                    </table>
                    <div class="row">
                        <div class="col-md-6">
                            <a href="#" class="btn btn-primary">Total Data : <?php echo $total_rows ?></a>
            		<?php echo anchor(site_url('stokmasuk/excel'), 'Export ke Excel', 'class="btn btn-primary"'); ?>
            	    </div>
                        <div class="col-md-6 text-right">
                            <?php echo $pagination ?>
                        </div>
                    </div>
            </div>