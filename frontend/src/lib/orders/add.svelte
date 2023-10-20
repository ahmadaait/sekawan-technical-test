<script>
	import { goto } from '$app/navigation';
	import { page } from '$app/stores';
	import { xfetch } from '$lib/app/request';
	import { onMount } from 'svelte';

	let company_id, driver_id, vehicle_id, mine_id, start_date, return_date, req_pic_1, req_pic_2;

	const method = $page.params.slug === 'add' ? 'post' : 'put';
	const id = $page.url.searchParams.get('id');
	async function save() {
		let orders = await xfetch(`orders/${id ? id : ''}`, method, {
			company_id,
			driver_id,
			vehicle_id,
			mine_id,
			start_date,
			return_date,
			req_pic_1,
			req_pic_2
		});
		if (orders.status == 201 || orders.status == 200) {
			goto('/admin-area/orders');
		}
	}

	let driverList = [];
	async function getDrivers() {
		let drivers = await xfetch('drivers');
		driverList = drivers.data.data;
	}

	let vehicleList = [];
	async function getVehicles() {
		let vehicles = await xfetch('vehicles');
		vehicleList = vehicles.data.data;
	}

	let mineList = [];
	async function getMines() {
		let mines = await xfetch('mines');
		mineList = mines.data.data;
	}

	let branchUserList = [];
	async function getBranchUsers() {
		let users = await xfetch('users/branch/list');
		branchUserList = users.data.data;
	}

	let headUserList = [];
	async function getHeadUsers() {
		let users = await xfetch('users/head/list');
		headUserList = users.data.data;
	}

	if ($page.params.slug === 'add') {
		onMount(async () => {
			await getDrivers();
			await getVehicles();
			await getMines();
			await getBranchUsers();
			await getHeadUsers();
		});
	}

	$: console.log($page);

	// let loadCompany = false;
	// $: {
	// 	if (ownership_type == 'rented_from_another') {
	// 		loadCompany = true;
	// 	} else {
	// 		loadCompany = false;
	// 	}
	// }

	export let item;
	if (item) {
		company_id = item.company_id;
		driver_id = item.driver_id;
		vehicle_id = item.vehicle_id;
		mine_id = item.mine_id;
		start_date = item.start_date;
	}
</script>

<form on:submit|preventDefault={save}>
	<div class="row">
		<!-- <div class="col-md-6 mb-3">
			<label for="category" class="visible-ie9 visible-ie9 mb-1">Perusahaan</label>

			<div class="input-icon">
				<select
					class="form-select col-md-3"
					name="company"
					bind:value={company_id}
					aria-label="select company"
				>
					{#each companyList as co}<option value={co.id}>{co.name}</option>{/each}</select
				>
			</div>
		</div> -->

		<div class="col-md-6 mb-3">
			<label for="driver_id" class="visible-ie9 visible-ie9 mb-1">Driver</label>

			<div class="input-icon">
				<select
					class="form-select col-md-3"
					name="driver_id"
					bind:value={driver_id}
					aria-label="select driver"
					required
				>
					{#each driverList as dr}<option value={dr.id}>{dr.name}</option>{/each}</select
				>
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="vehicle_id" class="visible-ie9 visible-ie9 mb-1">Kendaraan</label>

			<div class="input-icon">
				<select
					class="form-select col-md-3"
					name="vehicle_id"
					bind:value={vehicle_id}
					aria-label="select vehicle"
					required
				>
					{#each vehicleList as ve}<option value={ve.id}>{ve.name}</option>{/each}</select
				>
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="mine_id" class="visible-ie9 visible-ie9 mb-1">Tambang</label>

			<div class="input-icon">
				<select
					class="form-select col-md-3"
					name="mine_id"
					bind:value={mine_id}
					aria-label="select mine"
					required
				>
					{#each mineList as mi}<option value={mi.id}>{mi.name}</option>{/each}</select
				>
			</div>
		</div>

		<div class="col-md-6 mb-3" />

		<div class="col-md-6 mb-3">
			<label for="req_pic_1" class="visible-ie9 visible-ie9 mb-1"
				>Approval PIC 1 (Branch Office)</label
			>

			<div class="input-icon">
				<select
					class="form-select col-md-3"
					name="req_pic_1"
					bind:value={req_pic_1}
					aria-label="select branch"
					required
				>
					{#each branchUserList as u}<option value={u.id}>{u.name}</option>{/each}</select
				>
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="req_pic_2" class="visible-ie9 visible-ie9 mb-1"
				>Approval PIC 2 (Head Office)</label
			>

			<div class="input-icon">
				<select
					class="form-select col-md-3"
					name="req_pic_2"
					bind:value={req_pic_2}
					aria-label="select head"
					required
				>
					{#each headUserList as u}<option value={u.id}>{u.name}</option>{/each}</select
				>
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="start_date" class="visible-ie8 visible-ie9 mb-1">Tanggal Pinjam</label>
			<div class="input-icon">
				<i class="bi bi-calendar" />
				<input
					name="start_date"
					type="date"
					bind:value={start_date}
					class="form-control placeholder-no-fix"
					autocomplete="off"
					required
				/>
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="return_date" class="visible-ie8 visible-ie9 mb-1">Tanggal Kembali</label>
			<div class="input-icon">
				<i class="bi bi-calendar" />
				<input
					name="return_date"
					type="date"
					bind:value={return_date}
					class="form-control placeholder-no-fix"
					autocomplete="off"
					required
				/>
			</div>
		</div>

		<hr />
		<div class="col-md-6 mb-3">
			<button type="button" on:click={() => goto('/admin-area/orders')} class="btn btn-secondary"
				><i class="bi bi-backspace" /> Kembali</button
			>
			<button type="submit" class="btn btn-primary"><i class="bi bi-save" /> Simpan</button>
		</div>
	</div>
</form>
