            <div class="col-md-9 content"><!--mulai konten-->
                <p class="home"><a href="<?php echo base_url('Dashboard');?>">Home</a> > <strong> Data Retur</strong></p>
                    <h3>Data Retur</h3>
                    <div class="row" style="margin-bottom: 10px">
                        <div class="col-md-4">
                            <?php echo anchor(site_url('retur/create'),'Retur Produk', 'class="btn btn-primary"'); ?>
                        </div>
                        <div class="col-md-4 text-center">
                            <div style="margin-top: 8px" id="message">
                                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                            </div>
                        </div>
                        <div class="col-md-1 text-right">
                        </div>
                        <div class="col-md-3 text-right">
                            <form action="<?php echo site_url('retur/index'); ?>" class="form-inline" method="get">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                                    <span class="input-group-btn">
                                        <?php 
                                            if ($q <> '')
                                            {
                                                ?>
                                                <a href="<?php echo site_url('retur'); ?>" class="btn btn-default">Reset</a>
                                                <?php
                                            }
                                        ?>
                                      <button class="btn btn-primary" type="submit">Cari</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <table class="table table-bordered" style="margin-bottom: 10px; font-size:12px;">
                        <tr>
                            <th>No</th>
            		<th>Id user</th>
            		<th>Id suplier</th>
            		<th>Nama produk</th>
            		<th>Id produk</th>
            		<th>Tanggal</th>
            		<th>Jumlah</th>
            		<th>Modal</th>
            		<th>Aksi</th>
                        </tr><?php
                        foreach ($retur_data as $retur)
                        {
                            ?>
                            <tr>
            			<td width="80px"><?php echo ++$start ?></td>
            			<td><?php echo $retur->user_id ?></td>
            			<td><?php echo $retur->id_supplier ?></td>
            			<td><?php echo $retur->nama ?></td>
            			<td><?php echo $retur->id_produk ?></td>
            			<td><?php echo $retur->tanggal ?></td>
            			<td><?php echo $retur->jumlah ?></td>
            			<td><?php echo $retur->modal ?></td>
            			<td style="text-align:center" width="200px">
            				<?php 
            				echo anchor(site_url('retur/read/'.$retur->id),'Detail'); 
            				echo ' | '; 
            				echo anchor(site_url('retur/update/'.$retur->id),'Ubah'); 
            				echo ' | '; 
            				echo anchor(site_url('retur/delete/'.$retur->id),'Hapus','onclick="javasciprt: return confirm(\'Yakin hapus data?\')"'); 
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
            		<?php echo anchor(site_url('retur/excel'), 'Export ke Excel', 'class="btn btn-primary"'); ?>
            	    </div>
                        <div class="col-md-6 text-right">
                            <?php echo $pagination ?>
                        </div>
                    </div>
            </div>