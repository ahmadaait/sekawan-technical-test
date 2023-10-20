<script>
	import { goto } from '$app/navigation';
	import { xfetch } from '$lib/app/request';
	import { page } from '$app/stores';
	import { onMount } from 'svelte';

	let code, name, description;

	let disabled = $page.params.slug === 'detail' ? 'disabled' : '';

	const method = $page.params.slug === 'add' ? 'post' : 'put';
	const id = $page.url.searchParams.get('id');
	async function save() {
		let testPackage = await xfetch(`testpackage/${id ? id : ''}`, method, {
			code,
			name,
			description
		});
		if (testPackage.status == 201) {
			goto('/lis-area/testpackage');
		}
	}

	export let item;
	if (item) {
		name = item.name;
		description = item.description;
		code = item.code;
	}

	let itemList = [];
	async function getTestPackageItemList() {
		const response = await xfetch(`testpackage/${id}/item`);
		itemList = response.data;
	}

	if ($page.params.slug === 'detail') {
		onMount(async () => {
			await getTestPackageItemList();
		});
	}

	async function deleteItem(itemId) {
		const response = await xfetch(`testpackage/${itemId}/item`, 'delete');
		if (response.status == 200) {
			goto(`/lis-area/testpackage/detail?id=${id}`);
		}
	}
</script>

<form on:submit|preventDefault={save}>
	<div class="row">
		{#if $page.params.slug === 'detail' || $page.params.slug === 'edit'}
			<div class="col-md-6 mb-3">
				<label for="code" class="visible-ie8 visible-ie9 mb-1">Kode</label>
				<div class="input-icon">
					<i class="bi bi-puzzle" />
					<input
						name="code"
						type="text"
						bind:value={code}
						class="form-control placeholder-no-fix"
						autocomplete="off"
						disabled
					/>
				</div>
			</div>
		{/if}

		<div class="col-md-6 mb-3">
			<label for="name" class="visible-ie8 visible-ie9 mb-1">Nama Paket</label>
			<div class="input-icon">
				<i class="bi bi-house" />
				<input
					name="name"
					type="text"
					bind:value={name}
					class="form-control placeholder-no-fix"
					autocomplete="off"
					{disabled}
				/>
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="description" class="visible-ie8 visible-ie9 mb-1">Keterangan</label>
			<div class="input-icon">
				<i class="bi bi-list" />
				<input
					name="description"
					type="text"
					bind:value={description}
					class="form-control placeholder-no-fix"
					autocomplete="off"
					{disabled}
				/>
			</div>
		</div>

		{#if $page.params.slug === 'detail'}
			<hr />

			<div class="col-md-12 mb-6">
				<h5>List Paket Item</h5>
				<div class="row">
					<div class="col-md-6">
						<button
							type="button"
							class="btn btn-primary btn-sm"
							on:click={() => (location.href = '/lis-area/item/addreference?id=' + id)}
							><i class="bi bi-plus-lg" /></button
						>
					</div>
				</div>
				<hr />
				<div class="table-responsive">
					<table class="table table-striped table-bordered tb-list">
						<thead class="table-dark">
							<tr>
								<th scope="col">#</th>
								<th scope="col">Kode</th>
								<th scope="col">Nama Item</th>
								<th scope="col">##</th>
							</tr>
						</thead>
						<tbody>
							{#if itemList.length === 0}
								<tr class="text-center">
									<td colspan="7">Tidak ada paket item</td>
								</tr>
							{/if}
							{#each itemList as ref, i}
								<tr>
									<th scope="row">{++i}</th>
									<td>{ref.Item.code}</td>
									<td>{ref.Item.nameID}</td>
									<td>
										<button on:click={() => deleteItem(ref.id)} class="btn btn-danger btn-sm"
											><i class="bi bi-trash" /></button
										>
									</td>
								</tr>
							{/each}
						</tbody>
					</table>
				</div>
			</div>
		{/if}

		<hr />
		<div class="col-md-6 mb-3">
			<button type="button" on:click={() => goto('/lis-area/testpackage')} class="btn btn-secondary"
				><i class="bi bi-backspace" /> Kembali</button
			>
			{#if $page.params.slug !== 'detail'}
				<button type="submit" class="btn btn-primary"><i class="bi bi-save" /> Simpan</button>
			{/if}
		</div>
	</div>
</form>
