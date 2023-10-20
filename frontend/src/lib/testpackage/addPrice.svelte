<script>
	import { goto } from '$app/navigation';
	import { xfetch } from '$lib/app/request';
	import { page } from '$app/stores';
	import { onMount } from 'svelte';

	let price, type;
	let item = {};

	onMount(async () => {
		await getTestPackageById();
		await getPriceType();
	});

	const id = $page.url.searchParams.get('id');

	async function getTestPackageById() {
		const response = await xfetch(`testpackage/${id}`);
		if (response.status == 200) {
			item = response.data;
		}
	}

	async function save() {
		let p = await xfetch('testpackageprice', 'post', {
			TestPackageId: id,
			price,
			type
		});
		if (p.status == 201) {
			goto(`/lis-area/testpackage/price?id=${id}`);
		}
	}

	let priceTypeOptions = [];
	async function getPriceType() {
		const priceType = await xfetch('price-type');
		priceTypeOptions = priceType.data.type;
	}
</script>

<form on:submit|preventDefault={save}>
	<div class="row">
		<div class="col-md-6 mb-3">
			<label for="code" class="visible-ie8 visible-ie9 mb-1">Kode</label>
			<div class="input-icon">
				<i class="bi bi-puzzle" />
				<input
					name="code"
					type="text"
					bind:value={item.code}
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
					bind:value={item.name}
					class="form-control placeholder-no-fix"
					autocomplete="off"
					disabled
				/>
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="priceType" class="visible-ie9 visible-ie9 mb-1">Tipe</label>

			<div class="input-icon">
				<select
					class="form-select col-md-3"
					name="priceType"
					bind:value={type}
					aria-label="select priceType"
				>
					{#each priceTypeOptions as po}<option value={po}>{po}</option>{/each}</select
				>
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="price" class="visible-ie8 visible-ie9 mb-1">Harga</label>
			<div class="input-icon">
				<i class="bi bi-house" />
				<input
					name="price"
					type="number"
					bind:value={price}
					class="form-control placeholder-no-fix"
					autocomplete="off"
				/>
			</div>
		</div>
		<hr />
		<div class="col-md-6 mb-3">
			<button
				type="button"
				on:click={() => goto(`/lis-area/testpackage/price?id=${id}`)}
				class="btn btn-secondary"><i class="bi bi-backspace" /> Kembali</button
			>
			{#if $page.params.slug !== 'detail'}
				<button type="submit" class="btn btn-primary"><i class="bi bi-save" /> Simpan</button>
			{/if}
		</div>
	</div>
</form>
