           <div class="col-md-9 content"><!--mulai konten-->
            <p class="home"><a href="<?php echo base_url('Dashboard');?>">Home</a> > <strong> Daftar Produk</strong></p>
            <legend>Daftar Produk</legend>
            <div class="row" style="margin-bottom: 10px">
                <div class="col-md-4">
                    <?php echo anchor(site_url('stok/create'),'+ Produk', 'class="btn btn-primary"'); ?>
                    <?php echo anchor(site_url('stok/create_mass'),'+ Produk Masal', 'class="btn btn-primary"'); ?>
                </div>
                <div class="col-md-4 text-center">
                    <div style="margin-top: 8px" id="message">
                        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                    </div>
                </div>
                <div class="col-md-1 text-right">
                </div>
                <div class="col-md-3 text-right">
                    <form action="<?php echo site_url('stok/index'); ?>" class="form-inline" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                            <span class="input-group-btn">
                                <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('stok'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                                ?>
                                <button class="btn btn-primary" type="submit">Cari</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <table style="width: 100%;font-size:12px;" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Jumlah stok</th>
                        <th>Harga modal</th>
                        <th>Harga jual</th>
                        <th>Dibuat</th>
                        <th>Jenis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="table-details">
                    </tr><?php
                    foreach ($stok_data as $stok)
                    {
                        ?>
                        <tr>
                            <td width="80px"><?php echo ++$start ?></td>
                            <td><?php echo $stok->nama ?></td>
                            <td><?php echo $stok->kategori ?></td>
                            <td><?php echo $stok->deskripsi ?></td>
                            <td><?php echo $stok->stok ?></td>
                            <td><?php echo number_format($stok->modal) ?></td>
                            <td><?php echo number_format($stok->jual) ?></td>
                            <td><?php echo $stok->dibuat ?></td>
                            <td><?php echo $stok->jenis ?></td>
                            <td style="text-align:center" width="200px">
                                <?php 
                                echo anchor(site_url('stok/read/'.$stok->id),'Detail'); 
                                echo ' | '; 
                                echo anchor(site_url('stok/update/'.$stok->id),'Ubah'); 
                                echo ' | '; 
                                echo anchor(site_url('stok/delete/'.$stok->id),'Hapus','onclick="javasciprt: return confirm(\'Yakin hapus data?\')"'); 
                                ?>
                            </td>
                        </tr>
                    </tbody>
                    <?php
                }
                ?>
            </table>

            <div class="row">
                <div class="col-md-6">
                    <a href="#" class="btn btn-primary">Total Data : <?php echo $total_rows ?></a>
                    <?php echo anchor(site_url('stok/excel'), 'Export ke Excel', 'class="btn btn-primary"'); ?>
                </div>
                <div class="col-md-6 text-right">
                    <?php echo $pagination ?>
                </div>
            </div>
        </div>