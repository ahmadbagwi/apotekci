				<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
				?>
				<div class="container">
					<div class="row">
						<?php if (validation_errors()) : ?>
							<div class="col-md-12">
								<div class="alert alert-danger" role="alert">
									<?= validation_errors() ?>
								</div>
							</div>
						<?php endif; ?>
						<?php if (isset($error)) : ?>
							<div class="col-md-12">
								<div class="alert alert-danger" role="alert">
									<?= $error ?>
								</div>
							</div>
						<?php endif; ?>
						<div class="col-md-12">
							<div class="page-header">
								<legend>Buat Akun</legend>
							</div>
							<?= form_open_multipart('User/register') ?>
								<div class="form-group">
									<label for="username">Username</label>
									<input type="text" class="form-control" id="username" name="username" placeholder="Huruf dan angka tanpa spasi">
								</div>
								<div class="form-group">
									<label for="email">Email</label>
									<input type="email" class="form-control" id="email" name="email" placeholder="Email aktif">
								</div>
								<div class="form-group">
									<label for="password">Password</label>
									<input type="password" class="form-control" id="password" name="password" placeholder="Minimal 6 karakter">
								</div>
								<div class="form-group">
									<label for="password_confirm">Konfirmasi password</label>
									<input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Ketik ulang password">
								</div>
								<div class="form-group">
									<label for="full_name">Nama Lengkap</label>
									<input type="text" class="form-control" id="full_name" name="full_name" placeholder="Nama Lengkap">
								</div>
								<div class="form-group">
									<label for="phone">Phone</label>
									<input type="text" class="form-control" id="phone" name="phone" placeholder="62857xxx">
								</div>
								<div class="form-group">
									<label for="address">Alamat</label>
									<textarea class="form-control" id="address" name="address" placeholder="Alamat lengkap"></textarea>
								</div>
								<!--<div class="form-group">
									<label for="address">Foto</label><br>
									<input type="file" name="foto" value="foto">
								</div>-->
								<div class="form-group">
									<input type="submit" class="btn btn-primary" value="Buat Akun">
								</div>
							</form>
						</div>
					</div><!-- .row -->
				</div><!-- .container -->