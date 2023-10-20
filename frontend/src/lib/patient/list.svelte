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
			on:click={() => goto('/lis-area/patient/add')}><i class="bi bi-plus-lg" /></button
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
				<th scope="col">No. Rekam Medis</th>
				<th scope="col">Nama</th>
				<th scope="col">Tanggal Lahir</th>
				<th scope="col">##</th>
			</tr>
		</thead>
		<tbody>
			{#each items as item, i}
				<tr>
					<th scope="row">{++i}</th>
					<td>{item.medicalRecnum}</td>
					<td
						>{(item.prefixName == null || item.prefixName == '-' ? '' : item.prefixName + '. ') +
							item.name}</td
					>
					<td>{item.dob ? item.dob.split('T')[0] : '-'}</td>
					<td>
						<button
							on:click={() => goto(`patient/detail?id=${item.id}`)}
							class="btn btn-warning btn-sm"><i class="bi bi-eye" /></button
						>
						<button
							on:click={() => goto(`patient/edit?id=${item.id}`)}
							class="btn btn-primary btn-sm"><i class="bi bi-pencil" /></button
						>
						<!-- <button
							on:click={() => {
								$pageSelectedAction = 'showDelete';
								$modalSelectedContext = 'patient';
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
