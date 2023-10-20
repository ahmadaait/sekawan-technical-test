<script>
	import { goto } from '$app/navigation';
	import { page } from '$app/stores';
	import { xfetch } from '$lib/app/request';
	import { onMount } from 'svelte';

	let name,
		company_id,
		license_plate,
		status,
		ownership_type,
		load_type,
		fuel_tank,
		service_schedule;

	//group radio
	function onChange(event) {
		status = event.currentTarget.value;
		ownership_type = event.currentTarget.value;
		load_type = event.currentTarget.value;
	}

	const method = $page.params.slug === 'add' ? 'post' : 'put';
	const id = $page.url.searchParams.get('id');
	async function save() {
		let vehicles = await xfetch(`vehicles/${id ? id : ''}`, method, {
			name,
			company_id,
			license_plate,
			status,
			ownership_type,
			load_type,
			fuel_tank,
			service_schedule
		});
		if (vehicles.status == 201 || vehicles.status == 200) {
			goto('/admin-area/vehicles');
		}
	}

	let companyList = [];
	async function getCompanies() {
		let companies = await xfetch('companies');
		companyList = companies.data.data;
	}

	if ($page.params.slug === 'add') {
		onMount(async () => {
			await getCompanies();
		});
	}

	$: console.log($page);

	let loadCompany = false;
	$: {
		if (ownership_type == 'rented_from_another') {
			loadCompany = true;
		} else {
			loadCompany = false;
		}
	}

	export let item;
	if (item) {
		name = item.name;
		company_id = item.company_id;
		license_plate = item.license_plate;
		status = item.status;
		ownership_type = item.ownership_type;
		load_type = item.load_type;
		fuel_tank = item.fuel_tank;
		service_schedule = item.service_schedule;
	}
</script>

<form on:submit|preventDefault={save}>
	<div class="row">
		<div class="col-md-6 mb-3">
			<label for="name" class="visible-ie8 visible-ie9 mb-1">Nama Kendaraan</label>
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
			<label for="license_plate" class="visible-ie8 visible-ie9 mb-1">Nomor Plat</label>
			<div class="input-icon">
				<i class="bi bi-person" />
				<input
					name="license_plate"
					type="text"
					bind:value={license_plate}
					class="form-control placeholder-no-fix"
					autocomplete="off"
					required
				/>
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="status" class="visible-ie8 visible-ie9 mb-1">Status</label>

			<div class="input-icon">
				<input bind:group={status} type="radio" name="status" value="available" /> Tersedia &nbsp;
				&nbsp;
				<input bind:group={status} type="radio" name="status" value="unavailable" /> Tidak Tersedia
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="ownership_type" class="visible-ie8 visible-ie9 mb-1">Kepemilikan</label>

			<div class="input-icon">
				<input
					bind:group={ownership_type}
					type="radio"
					name="ownership_type"
					value="owned_by_company"
				/>
				Milik Perusahaan &nbsp; &nbsp;
				<input
					bind:group={ownership_type}
					type="radio"
					name="ownership_type"
					value="rented_from_another"
				/> Milik Perusahaan Lain
			</div>
		</div>

		{#if loadCompany}
			<div class="col-md-6 mb-3">
				<label for="company_id" class="visible-ie9 visible-ie9 mb-1">Perusahaan</label>

				<div class="input-icon">
					<select
						class="form-select col-md-3"
						name="company_id"
						bind:value={company_id}
						aria-label="select company"
					>
						{#each companyList as co}<option value={co.id}>{co.name}</option>{/each}</select
					>
				</div>
			</div>
		{/if}

		<div class="col-md-6 mb-3">
			<label for="load_type" class="visible-ie8 visible-ie9 mb-1">Angkutan</label>

			<div class="input-icon">
				<input bind:group={load_type} type="radio" name="load_type" value="person" />
				Orang &nbsp; &nbsp;
				<input bind:group={load_type} type="radio" name="load_type" value="item" /> Barang
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="fuel_tank" class="visible-ie8 visible-ie9 mb-1">Kapasitas BBM</label>
			<div class="input-icon">
				<i class="bi bi-person" />
				<input
					name="fuel_tank"
					type="number"
					bind:value={fuel_tank}
					class="form-control placeholder-no-fix"
					autocomplete="off"
					required
				/>
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="service_schedule" class="visible-ie8 visible-ie9 mb-1">Jadwal Service</label>
			<div class="input-icon">
				<i class="bi bi-calendar" />
				<input
					name="service_schedule"
					type="date"
					bind:value={service_schedule}
					class="form-control placeholder-no-fix"
					autocomplete="off"
					required
				/>
			</div>
		</div>

		<hr />
		<div class="col-md-6 mb-3">
			<button type="button" on:click={() => goto('/admin-area/vehicles')} class="btn btn-secondary"
				><i class="bi bi-backspace" /> Kembali</button
			>
			<button type="submit" class="btn btn-primary"><i class="bi bi-save" /> Simpan</button>
		</div>
	</div>
</form>
