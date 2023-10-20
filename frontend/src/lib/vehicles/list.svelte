<script>
	import { goto } from '$app/navigation';
	import { createEventDispatcher, getContext } from 'svelte';

	function getSearch() {
		const valueSearch = document.getElementById('search').value;
		console.log(valueSearch);
	}

	export let items = [];

	const subLayoutCtx = getContext('subLayoutCtx');
	const { pageIcon, pageNav, pageSelectedAction } = getContext(subLayoutCtx);

	const modalCtx = getContext('modalCtx');
	const { modalSelectedContext, modalSelectedId } = getContext(modalCtx);
</script>

<div class="row">
	<div class="col-md-6">
		<button
			type="button"
			class="btn btn-primary btn-sm"
			on:click={() => goto('/admin-area/vehicles/add')}><i class="bi bi-plus-lg" /></button
		>
	</div>
	<div class="col-md-6">
		<input
			id="search"
			on:change={getSearch}
			type="text"
			class="form-control"
			placeholder="Pencarian"
		/>
	</div>
</div>
<hr />

<div class="table-responsive">
	<table class="table table-striped table-bordered tb-list">
		<thead class="table-dark text-center">
			<tr>
				<th scope="col">#</th>
				<th scope="col">Nama</th>
				<th scope="col">Perusahaan Partner</th>
				<th scope="col">Nomor Plat</th>
				<th scope="col">Status</th>
				<th scope="col">Kepemilikan</th>
				<th scope="col">Angkutan</th>
				<th scope="col">Kapasitas BBM</th>
				<th scope="col">Jadwal Service</th>
				<th scope="col">##</th>
			</tr>
		</thead>
		<tbody>
			{#each items as item, i}
				<tr>
					<th scope="row" class="text-center">{++i}</th>
					<td>{item.name}</td>
					<td>{item.company ? (item.company.name ? item.company.name : '-') : '-'}</td>
					<td>{item.license_plate}</td>
					<td>
						{item.status ? (item.status == 'available' ? 'Tersedia' : 'Tidak Tersedia') : '-'}
					</td>
					<td>
						{item.ownership_type
							? item.ownership_type == 'owned_by_company'
								? 'Milik Perusahaan'
								: 'Milik Perusahaan Lain'
							: '-'}
					</td>
					<td>
						{item.load_type ? (item.load_type == 'person' ? 'Orang' : 'Barang') : '-'}
					</td>
					<td>{item.fuel_tank}</td>
					<td>{item.service_schedule}</td>
					<td class="text-center">
						<button
							on:click={() => goto(`vehicles/edit?id=${item.id}`)}
							class="btn btn-primary btn-sm"
							><i class="bi bi-pencil" />
						</button>
						<button
							on:click={() => {
								$pageSelectedAction = 'showDelete';
								$modalSelectedContext = 'vehicles';
								$modalSelectedId = item.id;
							}}
							class="btn btn-danger btn-sm"><i class="bi bi-trash" /></button
						>
					</td>
				</tr>
			{/each}
		</tbody>
	</table>
</div>
