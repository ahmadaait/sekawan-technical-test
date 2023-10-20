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
			on:click={() => goto('/admin-area/users/add')}><i class="bi bi-plus-lg" /></button
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
				<th scope="col">Email</th>
				<th scope="col">Role</th>
				<th scope="col">##</th>
			</tr>
		</thead>
		<tbody>
			{#each items as item, i}
				<tr>
					<th scope="row" class="text-center">{++i}</th>
					<td>{item.name}</td>
					<td>{item.email}</td>
					<td>
						{item.role
							? item.role == 'pic_head_office'
								? 'Head Office'
								: item.role == 'pic_branch_office'
								? 'Branch Office'
								: 'Admin'
							: '-'}
					</td>
					<td class="text-center">
						<button on:click={() => goto(`users/edit?id=${item.id}`)} class="btn btn-primary btn-sm"
							><i class="bi bi-pencil" /></button
						>
						<button
							on:click={() => {
								$pageSelectedAction = 'showDelete';
								$modalSelectedContext = 'users';
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
