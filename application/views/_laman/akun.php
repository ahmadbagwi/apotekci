				<div class="col-md-9 content"><!--mulai konten-->
				<p class="home"><a href="<?php echo base_url('Dashboard');?>">Home</a> > <strong> Data Akun</strong></p>
                <h4>Data Akun</h4>
					<?php
					$this->table->set_heading('Id', 'Username', 'Email', 'Nama Lengkap', 'HP', 'Login terakhir');
					$template = array (
									'table_open' => '<table border="0" cellpadding="2" cellspacing="2" style="width: 100%;font-size:12px;" class="table table-striped">',
									);
						$this->table->set_template($template);
					echo $this->table->generate($data_akun);
					?>
				</div>
</body>
</html>