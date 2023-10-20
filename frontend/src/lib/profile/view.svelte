<script>
	import { session } from '$app/stores';

	export let item;

	const auth = $session.auth;
</script>


<div class="row">
	<div class="col-md-6 col-lg-4 position-md-absolute me-md-3">
		<div class="position-relative">
			<div class="img-thumbnail mb-3">
				<img src="/img/user-male.png" class="w-100" alt="Gambar Profile User">
			</div>
			<div class="position-absolute" style="bottom:25px; width:100%">
				<form id="profileImageForm" method="post" enctype="multipart/form-data" action="/myarea/profile/submitProfileImage" class="d-flex justify-content-center">
					<div id="profileImageUpload" class="circlebox-1 pointer" style="line-height:50px; background-color:rgba(255,255,255,0.5)"><i class="h2 bi bi-camera"></i></div>
					<input id="profileImage" type="file" name="profileImage" class="d-none">
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-lg-8">
		<div class="">
			<div class="row no-gutters mb-3 mb-md-2">
				<div class="col-md-3 fw-600">Nama</div>
			<div class="col-md-9 pl-md-3"><span class="d-none d-md-inline me-2">:</span>{item.name}</div>
			</div>
			<div class="row no-gutters mb-3 mb-md-2">
				<div class="col-md-3 fw-600">Nama Jepang</div>
				<div class="col-md-9 pl-md-3"><span class="d-none d-md-inline me-2">:</span>{item.japanName}</div>
			</div>
			<div class="row no-gutters mb-3 mb-md-2">
				<div class="col-md-3 fw-600">Kode Pos</div>
				<div class="col-md-9 pl-md-3"><span class="d-none d-md-inline me-2">:</span>{item.postalCode}</div>
			</div>
			<div class="row no-gutters mb-3 mb-md-2">
				<div class="col-md-3 fw-600">Prefektur</div>
				<div class="col-md-9 pl-md-3"><span class="d-none d-md-inline me-2">:</span>{item.prefecture}</div>
			</div>
			<div class="row no-gutters mb-3 mb-md-2">
				<div class="col-md-3 fw-600">Alamat</div>
				<div class="col-md-9 pl-md-3"><span class="d-none d-md-inline me-2">:</span>
					Localhost 2020<div class="ms-md-3">Line 2</div><div class="ms-md-3">Line 3</div>
				</div>
			</div>
			<div class="row no-gutters mb-3 mb-md-2">
				<div class="col-md-3 fw-600">Tanggal Lahir</div>
				<div class="col-md-9 pl-md-3"><span class="d-none d-md-inline me-2">:</span>{item.berthDate}</div>
			</div>
			<div class="row no-gutters mb-3 mb-md-2">
				<div class="col-md-3 fw-600">Jenis Kelamin</div>
				<div class="col-md-9 pl-md-3"><span class="d-none d-md-inline me-2">:</span>{item.gender}</div>
			</div>
			<div class="row no-gutters mb-3 mb-md-2">
				<div class="col-md-3 fw-600">Pekerjaan</div>
				<div class="col-md-9 pl-md-3"><span class="d-none d-md-inline me-2">:</span>-</div>
			</div>
			<div class="row no-gutters mb-3 mb-md-2">
				<div class="col-md-3 fw-600">Telepon</div>
				<div class="col-md-9 pl-md-3"><span class="d-none d-md-inline me-2">:</span>{item.phone}</div>
			</div>
			<div class="row no-gutters mb-3 mb-md-2">
				<div class="col-md-3 fw-600">Fax</div>
				<div class="col-md-9 pl-md-3"><span class="d-none d-md-inline me-2">:</span>{item.fax}</div>
			</div>
			<div class="row no-gutters mb-3 mb-md-2">
				<div class="col-md-3 fw-600">Whatsapp</div>
				<div class="col-md-9 pl-md-3"><span class="d-none d-md-inline me-2">:</span>{item.whatsapp}</div>
			</div>
			<div class="row no-gutters mb-3 mb-md-2">
				<div class="col-md-3 fw-600">Line</div>
				<div class="col-md-9 pl-md-3"><span class="d-none d-md-inline me-2">:</span>{item.line}</div>
			</div>
		</div>

	</div>
</div>

<style>
	@media (min-width: 786px) {
		.position-md-absolute {
			position: absolute;
			right: 0px;
		}
	}
</style>