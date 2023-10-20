<script>
	import { goto } from '$app/navigation';
	import { page } from '$app/stores';
	import { xfetch } from '$lib/app/request';
	import { onMount } from 'svelte';

	let items = [];
	let detail = {};
	const id = $page.url.searchParams.get('id');

	async function deletePrice(priceId) {
		const response = await xfetch(`testpackageprice/${priceId}`, 'delete');
		if (response.status == 200) {
			location.reload();
		}
	}

	onMount(async () => {
		await getTestPackagePrice();
		await getTestPackageById();
	});

	async function getTestPackageById() {
		const response = await xfetch(`testpackage/${id}`);
		if (response.status == 200) {
			detail = response.data;
		}
	}

	async function getTestPackagePrice() {
		const response = await xfetch(`testpackageprice/${id}`);
		if (response.status == 200) {
			items = response.data;
		}
	}
</script>

<div class="row">
	<div class="col-md-6">
		<button
			type="button"
			class="btn btn-primary btn-sm"
			on:click={() => goto(`/lis-area/testpackage/add-price?id=${detail.id}`)}
			><i class="bi bi-plus-lg" /></button
		>
	</div>
</div>
<hr />

<div class="row">
	<div class="col-md-6 mb-3">
		<label for="code" class="visible-ie8 visible-ie9 mb-1">Kode</label>
		<div class="input-icon">
			<i class="bi bi-puzzle" />
			<input
				name="code"
				type="text"
				bind:value={detail.code}
				class="form-control placeholder-no-fix"
				autocomplete="off"
				disabled
			/>
		</div>
	</div>
	<div class="col-md-6 mb-3">
		<label for="name" class="visible-ie8 visible-ie9 mb-1">Nama Paket</label>
		<div class="input-icon">
			<i class="bi bi-house" />
			<input
				name="name"
				type="text"
				bind:value={detail.name}
				class="form-control placeholder-no-fix"
				autocomplete="off"
				disabled
			/>
		</div>
	</div>
</div>

<div class="table-responsive">
	<table class="table table-striped table-bordered tb-list">
		<thead class="table-dark">
			<tr>
				<th scope="col">#</th>
				<th scope="col">Tipe</th>
				<th scope="col">Harga</th>
				<th scope="col">##</th>
			</tr>
		</thead>
		<tbody>
			{#each items as item, i}
				<tr>
					<th scope="row">{++i}</th>
					<td>{item.type}</td>
					<td>Rp. {item.price != null ? item.price : '-'}</td>
					<td>
						<button on:click={() => deletePrice(item.id)} class="btn btn-danger btn-sm"
							><i class="bi bi-trash" /></button
						>
					</td>
				</tr>
			{/each}
		</tbody>
	</table>
</div>

<hr />
<div class="col-md-6 mb-3">
	<button type="button" on:click={() => goto('/lis-area/testpackage')} class="btn btn-secondary"
		><i class="bi bi-backspace" /> Kembali</button
	>
</div>
