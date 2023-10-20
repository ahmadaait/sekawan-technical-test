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
		<button type="button" class="btn btn-primary btn-sm" on:click={() => goto('/lis-area/room/add')}
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
				<th scope="col">Kode</th>
				<th scope="col">Ruangan</th>
				<th scope="col">Dokter</th>
				<th scope="col">Keterangan</th>
				<th scope="col">##</th>
			</tr>
		</thead>
		<tbody>
			{#each items as item, i}
				<tr>
					<th scope="row">{++i}</th>
					<td>{item.code}</td>
					<td>{item.name}</td>
					<td>{item.doctorName ? item.doctorName : '-'}</td>
					<td>{item.description ? item.description : '-'}</td>
					<td>
						<button
							on:click={() => goto(`room/detail?id=${item.id}`)}
							class="btn btn-warning btn-sm"><i class="bi bi-eye" /></button
						>
						<button on:click={() => goto(`room/edit?id=${item.id}`)} class="btn btn-primary btn-sm"
							><i class="bi bi-pencil" /></button
						>
						<!-- <button
							on:click={() => {
								$pageSelectedAction = 'showDelete';
								$modalSelectedContext = 'room';
								$modalSelectedId = item.id;
							}}
							class="btn btn-danger btn-sm"><i class="bi bi-trash" /></button
						> -->
					</td>
				</tr>
			{/each}
		</tbody>
	</table>
</div>
