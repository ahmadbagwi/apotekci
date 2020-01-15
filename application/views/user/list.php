				<div class="konten">
					<?php
					$this->table->set_heading('Id', 'Username', 'Email', 'Nama Lengkap', 'HP', 'Login terakhir');
					$template = array (
									'table_open' => '<table border="0" cellpadding="2" cellspacing="2" style="width: 100%;font-size:12px;" class="table table-striped">',
									);
						$this->table->set_template($template);
					echo $this->table->generate($daftarAkun);
					?>
				</div>