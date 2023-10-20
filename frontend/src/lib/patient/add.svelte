<script>
	import { goto } from '$app/navigation';
	import { xfetch } from '$lib/app/request';
	import { page } from '$app/stores';

	let identityType,
		identityNo,
		prefixName,
		name,
		gender,
		dob,
		address,
		phone,
		status,
		medicalRecnum,
		province,
		regency,
		district,
		village;

	let disabled = $page.params.slug === 'detail' ? 'disabled' : '';

	let prefixNameOptions = [
		'-',
		'Tn',
		'Ny',
		'Nn',
		'An',
		'Byi',
		'Mr',
		'Mrs',
		'Sir',
		'Madam',
		'Child',
		'Baby'
	];

	//group radio
	function onChange(event) {
		identityType = event.currentTarget.value;
		gender = event.currentTarget.value;
	}

	const method = $page.params.slug === 'add' ? 'post' : 'put';
	const id = $page.url.searchParams.get('id');
	async function save() {
		let doctor = await xfetch(`patient/${id ? id : ''}`, method, {
			identityType,
			identityNo,
			prefixName,
			name,
			gender,
			dob,
			address,
			phone,
			status,
			medicalRecnum,
			province,
			regency,
			district,
			village
		});
		if (doctor.status == 201) {
			goto('/lis-area/patient');
		}
	}

	$: console.log($page);

	export let item;
	if (item) {
		identityType = item.identityType;
		identityNo = item.identityNo;
		prefixName = item.prefixName;
		name = item.name;
		gender = item.gender;
		address = item.address;
		phone = item.phone;
		status = item.status;
		medicalRecnum = item.medicalRecnum;
		province = item.province;
		regency = item.regency;
		district = item.district;
		village = item.village;
		dob = item.dob?.split('T')[0];
	}
</script>

<form on:submit|preventDefault={save}>
	<div class="row">
		{#if $page.params.slug === 'detail' || $page.params.slug === 'edit'}
			<div class="col-md-6 mb-3">
				<label for="medicalRecnum" class="visible-ie8 visible-ie9 mb-1">No. Rekam Medis</label>
				<div class="input-icon">
					<i class="bi bi-card-heading" />
					<input
						name="medicalRecnum"
						type="text"
						bind:value={medicalRecnum}
						class="form-control placeholder-no-fix"
						autocomplete="off"
						disabled
					/>
				</div>
			</div>
			<div class="col-md-6 mb-3" />
		{/if}

		<div class="col-md-6 mb-3">
			<label for="identityType" class="visible-ie9 visible-ie9 mb-1">Jenis Identitas</label>

			<div class="input-icon">
				<input bind:group={identityType} type="radio" name="identityType" value="ktp" {disabled} />
				KTP &nbsp; &nbsp;
				<input bind:group={identityType} type="radio" name="identityType" value="" {disabled} /> Tanpa
				Identitas
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="identityNo" class="visible-ie8 visible-ie9 mb-1">No. Identitas</label>
			<div class="input-icon">
				<i class="bi bi-person" />
				<input
					name="identityNo"
					type="text"
					bind:value={identityNo}
					class="form-control placeholder-no-fix"
					autocomplete="off"
					{disabled}
				/>
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<div class="row">
				<label for="name" class="visible-ie8 visible-ie9 mb-1">Nama Pasien</label>
				<div class="input-icon col-md-3">
					<select
						class="form-select col-md-3"
						name="prefixName"
						bind:value={prefixName}
						aria-label="select prefix name"
						{disabled}
					>
						{#each prefixNameOptions as value}<option {value}>{value}</option>{/each}</select
					>
				</div>
				<div class="input-icon col-md-9">
					<input
						name="name"
						type="text"
						bind:value={name}
						class="form-control placeholder-no-fix"
						autocomplete="off"
						required
						{disabled}
					/>
				</div>
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="gender" class="visible-ie8 visible-ie9 mb-1">Jenis Kelamin</label>

			<div class="input-icon">
				<input bind:group={gender} type="radio" name="gender" value="male" {disabled} /> Laki-laki
				&nbsp; &nbsp;
				<input bind:group={gender} type="radio" name="gender" value="female" {disabled} /> Perempuan
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="dob" class="visible-ie8 visible-ie9 mb-1">Tanggal Lahir</label>
			<div class="input-icon">
				<i class="bi bi-calendar" />
				<input
					name="dob"
					type="date"
					bind:value={dob}
					class="form-control placeholder-no-fix"
					autocomplete="off"
					{disabled}
				/>
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="phone" class="visible-ie8 visible-ie9 mb-1">Telepon</label>
			<div class="input-icon">
				<i class="bi bi-phone" />
				<input
					name="phone"
					type="text"
					bind:value={phone}
					class="form-control placeholder-no-fix"
					autocomplete="off"
					{disabled}
				/>
			</div>
		</div>

		<div class="col-md-12 mb-3">
			<label for="address" class="visible-ie8 visible-ie9 mb-1">Alamat</label>
			<div class="input-icon">
				<i class="bi bi-house" />
				<input
					name="dob"
					type="text"
					bind:value={address}
					class="form-control placeholder-no-fix"
					autocomplete="off"
					{disabled}
				/>
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="province" class="visible-ie8 visible-ie9 mb-1">Provinsi</label>
			<div class="input-icon">
				<i class="bi bi-pin-map" />
				<input
					name="province"
					type="text"
					bind:value={province}
					class="form-control placeholder-no-fix"
					autocomplete="off"
					{disabled}
				/>
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="regency" class="visible-ie8 visible-ie9 mb-1">Kabupaten/Kota</label>
			<div class="input-icon">
				<i class="bi bi-pin-map" />
				<input
					name="regency"
					type="text"
					bind:value={regency}
					class="form-control placeholder-no-fix"
					autocomplete="off"
					{disabled}
				/>
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="district" class="visible-ie8 visible-ie9 mb-1">Kecamatan</label>
			<div class="input-icon">
				<i class="bi bi-pin-map" />
				<input
					name="district"
					type="text"
					bind:value={district}
					class="form-control placeholder-no-fix"
					autocomplete="off"
					{disabled}
				/>
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="village" class="visible-ie8 visible-ie9 mb-1">Desa</label>
			<div class="input-icon">
				<i class="bi bi-pin-map" />
				<input
					name="village"
					type="text"
					bind:value={village}
					class="form-control placeholder-no-fix"
					autocomplete="off"
					{disabled}
				/>
			</div>
		</div>

		<hr />
		<div class="col-md-6 mb-3">
			<button type="button" on:click={() => goto('/lis-area/patient')} class="btn btn-secondary"
				><i class="bi bi-backspace" /> Kembali</button
			>
			{#if $page.params.slug !== 'detail'}
				<button type="submit" class="btn btn-primary"><i class="bi bi-save" /> Simpan</button>
			{/if}
		</div>
	</div>
</form>
