<script>
	import { goto } from '$app/navigation';
	import { xfetch } from '$lib/app/request';
	import { page } from '$app/stores';

	let name, phatology, specialization, address, phone, email, gender, dob;

	//group radio
	function onChange(event) {
		phatology = event.currentTarget.value;
		gender = event.currentTarget.value;
	}

	const method = $page.params.slug === 'add' ? 'post' : 'put';
	const id = $page.url.searchParams.get('id');
	async function save() {
		let doctor = await xfetch(`doctor/${id ? id : ''}`, method, {
			name,
			phatology,
			specialization,
			address,
			phone,
			email,
			gender,
			dob
		});
		if (doctor.status == 201) {
			goto('/lis-area/doctor');
		}
	}

	$: console.log($page);

	export let item;
	if (item) {
		name = item.name;
		phatology = item.phatology;
		specialization = item.specialization;
		address = item.address;
		phone = item.phone;
		email = item.email;
		gender = item.gender;
		dob = item.dob?.split('T')[0];
	}
</script>

<form on:submit|preventDefault={save}>
	<div class="row">
		<div class="col-md-6 mb-3">
			<label for="name" class="visible-ie8 visible-ie9 mb-1">Nama Dokter</label>
			<div class="input-icon">
				<i class="bi bi-person" />
				<input
					name="name"
					type="text"
					bind:value={name}
					class="form-control placeholder-no-fix"
					autocomplete="off"
					required
				/>
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="phatology" class="visible-ie8 visible-ie9 mb-1">Patologi</label>

			<div class="input-icon">
				<input bind:group={phatology} type="radio" name="phatology" value="iya" /> Iya &nbsp; &nbsp;
				<input bind:group={phatology} type="radio" name="phatology" value="" /> Tidak
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="name" class="visible-ie8 visible-ie9 mb-1">Spesialis</label>
			<div class="input-icon">
				<i class="bi bi-book" />
				<input
					name="specialization"
					type="text"
					bind:value={specialization}
					class="form-control placeholder-no-fix"
					autocomplete="off"
				/>
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="gender" class="visible-ie8 visible-ie9 mb-1">Jenis Kelamin</label>

			<div class="input-icon">
				<input bind:group={gender} type="radio" name="gender" value="male" /> Laki-laki &nbsp;
				&nbsp;
				<input bind:group={gender} type="radio" name="gender" value="female" /> Perempuan
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
				/>
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="address" class="visible-ie8 visible-ie9 mb-1">Alamat</label>
			<div class="input-icon">
				<i class="bi bi-house" />
				<input
					name="dob"
					type="text"
					bind:value={address}
					class="form-control placeholder-no-fix"
					autocomplete="off"
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
				/>
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="email" class="visible-ie8 visible-ie9 mb-1">Email</label>
			<div class="input-icon">
				<i class="bi bi-list" />
				<input
					name="email"
					type="text"
					bind:value={email}
					class="form-control placeholder-no-fix"
					autocomplete="off"
				/>
			</div>
		</div>
		<hr />
		<div class="col-md-6 mb-3">
			<button type="button" on:click={() => goto('/lis-area/doctor')} class="btn btn-secondary"
				><i class="bi bi-backspace" /> Kembali</button
			>
			<button type="submit" class="btn btn-primary"><i class="bi bi-save" /> Simpan</button>
		</div>
	</div>
</form>
