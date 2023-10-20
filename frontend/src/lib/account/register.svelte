<div class="row justify-content-center pt-md-5 py-3">
	<div class="col col-xl-8 col-lg-10">
		<div class="card mainbox shadow">
			<div class="card-body">
				<h6 class="mb-0"><i class="bi bi-person-plus pe-2" /> Pendaftaran Akun</h6>
				<hr />
				<form class="register-form" method="post" novalidate="novalidate" name="">
					<input type="hidden" name="register" value="Register" />
					<div class="row">
						<div class="col-md-6 mb-3">
							<label for="name" class="visible-ie8 visible-ie9 mb-1">Username</label>
							<div class="input-icon">
								<i class="bi bi-person" />
								<input
									name="name"
									type="text"
									value=""
									class="form-control placeholder-no-fix"
									autocomplete="off"
								/>
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="email" class="visible-ie8 visible-ie9 mb-1">Email</label>
							<div class="input-icon">
								<i class="bi bi-envelope" />
								<input
									name="email"
									type="text"
									value=""
									class="form-control placeholder-no-fix"
									autocomplete="off"
								/>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 mb-3">
							<div class="row gutter-0">
								<div class="col-5">
									<label for="password" class="visible-ie8 visible-ie9 mb-1">Kata Sandi</label>
								</div>
								<div class="col-4 text-right">Keamanan :</div>
								<div class="col-3 pt-1">
									<div class="password-scale h-100 text-center" style="width:0%">
										<div class="bg-danger" style="border-radius:2px; height:100%;" />
									</div>
								</div>
							</div>
							<div class="input-icon">
								<i class="bi bi-lock" />
								<input
									name="password"
									type="password"
									class="form-control placeholder-no-fix password-strength"
									autocomplete="off"
									style=""
								/>
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="passwordConfirm" class="visible-ie8 visible-ie9 mb-1"
								>Konfirmasi Kata Sandi</label
							>
							<div class="input-icon">
								<i class="bi bi-lock" />
								<input
									name="passwordConfirm"
									type="password"
									class="form-control placeholder-no-fix"
									autocomplete="off"
								/>
							</div>
						</div>
					</div>
					<div class="mb-4 mt-2">
						Dengan ini saya menyatakan tunduk dan patuh pada <a
							href="/syarat-dan-ketentuan"
							target="_blank"
							class="nowrap"><strong>syarat dan ketentuan</strong></a
						> yang berlaku.
					</div>
					<div class="mb-4 text-center">
						<button class="btn bg-blue"><i class="bi bi-person-plus me-1" /> Daftar</button>
					</div>
					<a href="/" class="h6"><i class="bi bi-arrow-left" /> Halaman Utama</a>
					<hr />

					<div class="text-center">Copyright (C) Aiicode Production</div>
				</form>
			</div>
		</div>
	</div>
</div>
