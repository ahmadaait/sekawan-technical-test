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
		<button type="button" class="btn btn-primary btn-sm" on:click={() => goto('/lis-area/item/add')}
			><i class="bi bi-plus-lg" /></button
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
		<thead class="table-dark">
			<tr>
				<th scope="col">#</th>
				<th scope="col">ID</th>
				<th scope="col">Kategori ID</th>
				<th scope="col">Sub ID</th>
				<th scope="col">Nama (ID)</th>
				<th scope="col">Nama (EN)</th>
				<th scope="col">Satuan</th>
				<th scope="col">Kode Map</th>
				<th scope="col">##</th>
			</tr>
		</thead>
		<tbody>
			{#each items as item, i}
				<tr>
					<th scope="row">{++i}</th>
					<td>{item.code}</td>
					<td>
						{item.levelType == 1 || item.levelType == 2
							? '#'
							: item.levelCode1
							? item.levelCode1
							: ''}
					</td>
					<td>
						{#if item.levelType == 1}
							#
						{/if}
						{#if item.levelType == 2}
							{item.levelCode1}
						{/if}
						{#if item.levelType == 3}
							{item.levelCode2}
						{/if}
					</td>
					<td>{item.nameID ? item.nameID : '-'}</td>
					<td>{item.nameEN ? item.nameEN : '-'}</td>
					<td>{item.unit ? item.unit : '-'}</td>
					<td>{item.mapCode ? item.mapCode : ''}</td>
					<td>
						<button
							on:click={() => goto(`item/detail?id=${item.id}`)}
							class="btn btn-warning btn-sm"><i class="bi bi-eye" /></button
						>
						<button on:click={() => goto(`item/edit?id=${item.id}`)} class="btn btn-primary btn-sm"
							><i class="bi bi-pencil" /></button
						>
						<button
							on:click={() => {
								$pageSelectedAction = 'showDelete';
								$modalSelectedContext = 'item';
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
