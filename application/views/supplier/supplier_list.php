            <div class="col-md-9 content"><!--mulai konten-->
                <p class="home"><a href="<?php echo base_url('Dashboard');?>">Home</a> > <strong> Daftar Suplier</strong></p>
                    <h3>Daftar Supplier</h3>
                    <div class="row" style="margin-bottom: 10px">
                        <div class="col-md-4">
                            <?php echo anchor(site_url('supplier/create'),'+ Suplier', 'class="btn btn-primary"'); ?>
                        </div>
                        <div class="col-md-4 text-center">
                            <div style="margin-top: 8px" id="message">
                                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                            </div>
                        </div>
                        <div class="col-md-1 text-right">
                        </div>
                        <div class="col-md-3 text-right">
                            <form action="<?php echo site_url('supplier/index'); ?>" class="form-inline" method="get">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                                    <span class="input-group-btn">
                                        <?php 
                                            if ($q <> '')
                                            {
                                                ?>
                                                <a href="<?php echo site_url('supplier'); ?>" class="btn btn-default">Reset</a>
                                                <?php
                                            }
                                        ?>
                                      <button class="btn btn-primary" type="submit">Cari</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <table class="table table-bordered" style="margin-bottom: 10px; font-size: 12px">
                        <tr>
                            <th>No</th>
                    		<th>Nama</th>
                    		<th>Alamat</th>
                    		<th>Hp</th>
                    		<th>Jenis</th>
                    		<th>Aksi</th>
                        </tr><?php
                        foreach ($supplier_data as $supplier)
                        {
                            ?>
                            <tr>
            			<td width="80px"><?php echo ++$start ?></td>
            			<td><?php echo $supplier->nama ?></td>
            			<td><?php echo $supplier->alamat ?></td>
            			<td><?php echo $supplier->hp ?></td>
            			<td><?php echo $supplier->jenis ?></td>
            			<td style="text-align:center" width="200px">
            				<?php 
            				echo anchor(site_url('supplier/read/'.$supplier->id),'Detail'); 
            				echo ' | '; 
            				echo anchor(site_url('supplier/update/'.$supplier->id),'Ubah'); 
            				echo ' | '; 
            				echo anchor(site_url('supplier/delete/'.$supplier->id),'Hapus','onclick="javasciprt: return confirm(\'Yakin hapus data ?\')"'); 
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
            	    </div>
                        <div class="col-md-6 text-right">
                            <?php echo $pagination ?>
                        </div>
                    </div>
            </div>
               