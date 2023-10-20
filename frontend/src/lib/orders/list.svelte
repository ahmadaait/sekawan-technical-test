<script>
	import { goto } from '$app/navigation';
	import { xfetch } from '$lib/app/request';
	import { createEventDispatcher, getContext } from 'svelte';
	import { API_HOST } from '$lib/env.js';

	function getSearch() {
		const valueSearch = document.getElementById('search').value;
		console.log(valueSearch);
	}

	export let items = [];

	const subLayoutCtx = getContext('subLayoutCtx');
	const { pageIcon, pageNav, pageSelectedAction } = getContext(subLayoutCtx);

	const modalCtx = getContext('modalCtx');
	const { modalSelectedContext, modalSelectedId } = getContext(modalCtx);

	const userCtx = getContext('userCtx');
	const { role } = getContext(userCtx);

	async function getOrderList() {
		let list;
		if ($role == 'admin') {
			list = await xfetch('orders');
		} else {
			list = await xfetch('orders/approval/list');
		}
		items = list.data.data;
	}

	async function approved(id) {
		await xfetch(`orders/${id}/approve`);
		await getOrderList();
	}

	async function rejected(id) {
		await xfetch(`orders/${id}/reject`);
		await getOrderList();
	}

	async function deleteOrder(id) {
		await xfetch(`orders/${id}`, 'delete');
		await getOrderList();
	}

	async function updateStatus(id, params) {
		await xfetch(`orders/${id}`, 'put', params);
		await getOrderList();
	}

	let start_date = '';
	let end_date = '';

	function exportExcel() {
		let params = '';
		if (start_date != '' && end_date != '') {
			params += `?start_date=${start_date}&end_date=${end_date}`;
		} else if (start_date != '') {
			params += `?start_date=${start_date}`;
		} else if (end_date != '') {
			params += `?end_date=${end_date}`;
		}
		window.open(`${API_HOST}orders/export/excel${params}`, '_blank');
	}
</script>

<div class="row">
	<div class="col-md-6">
		{#if $role == 'admin'}
			<button
				type="button"
				class="btn btn-primary btn-sm"
				on:click={() => goto('/admin-area/orders/add')}><i class="bi bi-plus-lg" /></button
			>
		{/if}
	</div>
	<hr style="margin-top: 10px;" />
	<div class="col-md-12">
		<div class="col-md-6">
			<label for="start_date" class="visible-ie8 visible-ie9 mb-1">Tanggal Mulai</label> &nbsp;
			<div class="input-icon">
				<i class="bi bi-calendar" />
				<input
					name="start_date"
					type="date"
					bind:value={start_date}
					class="form-control placeholder-no-fix"
					autocomplete="off"
				/>
			</div>
		</div>
		<div class="col-md-6">
			<label for="end_date" class="visible-ie8 visible-ie9 mb-1">Tanggal Selesai</label> &nbsp;
			<div class="input-icon">
				<i class="bi bi-calendar" />
				<input
					name="end_date"
					type="date"
					bind:value={end_date}
					class="form-control placeholder-no-fix"
					autocomplete="off"
				/>
			</div>
		</div>
		<button
			style="margin-top: 10px"
			type="button"
			class="btn btn-warning btn-sm"
			on:click={() => exportExcel()}><i class="bi bi-list" />Export Excel</button
		>
	</div>
</div>
<hr />

<div class="table-responsive">
	<table class="table table-striped table-bordered tb-list">
		<thead class="table-dark text-center">
			<tr>
				<th scope="col">#</th>
				<th scope="col">Nama Driver</th>
				<th scope="col">Kendaraan</th>
				<th scope="col">Tambang</th>
				<th scope="col">Tanggal Pinjam</th>
				<th scope="col">Disetujui PIC 1</th>
				<th scope="col">Tanggal Disetujui PIC 1</th>
				<th scope="col">Disetujui PIC 2</th>
				<th scope="col">Tanggal Disetujui PIC 2</th>
				<th scope="col">Tanggal Diambil</th>
				<th scope="col">Tanggal Kembali</th>
				<th scope="col">Ditolak Oleh</th>
				<th scope="col">Tanggal Ditolak</th>
				<th scope="col">Diajukan Oleh</th>
				<th scope="col">Dibatalkan Oleh</th>
				<th scope="col">Tanggal Dibatalkan</th>
				<th scope="col">Status</th>
				<th scope="col">##</th>
			</tr>
		</thead>
		<tbody>
			{#each items as item, i}
				<tr>
					<th scope="row" class="text-center">{++i}</th>
					<td>{item.driver.name ? item.driver.name : '-'}</td>
					<td>{item.vehicle.name ? item.vehicle.name : '-'}</td>
					<td>{item.mine.name ? item.mine.name : '-'}</td>
					<!-- <td>
						{item.status ? (item.status == 'available' ? 'Tersedia' : 'Tidak Tersedia') : '-'}
					</td> -->
					<td
						>{item.start_date ? item.start_date : '-'} s/d {item.return_date
							? item.return_date
							: '-'}
					</td>
					<td>
						{item.approval_pic_1
							? item.approval_pic_1.name
								? item.approval_pic_1.name
								: '-'
							: '-'}
					</td>
					<td>
						{item.approval_pic_1_at ? item.approval_pic_1_at : '-'}
					</td>
					<td>
						{item.approval_pic_2
							? item.approval_pic_2.name
								? item.approval_pic_2.name
								: '-'
							: '-'}
					</td>
					<td>
						{item.approval_pic_2_at ? item.approval_pic_2_at : '-'}
					</td>
					<td>
						{item.release_at ? item.release_at : '-'}
					</td>
					<td>
						{item.return_at ? item.return_at : '-'}
					</td>
					<td>
						{item.rejected_by ? (item.rejected_by.name ? item.rejected_by.name : '-') : '-'}
					</td>
					<td>
						{item.rejected_at ? item.rejected_at : '-'}
					</td>
					<td>
						{item.created_by ? (item.created_by.name ? item.created_by.name : '-') : '-'}
					</td>
					<td>
						{item.canceled_by ? (item.canceled_by.name ? item.canceled_by.name : '-') : '-'}
					</td>
					<td>
						{item.canceled_at ? item.canceled_at : '-'}
					</td>
					<td>
						{item.status ? item.status : '-'}
					</td>
					<td class="text-center">
						{#if $role == 'admin'}
							{#if item.status == 'new'}
								<button
									on:click={() => goto(`orders/edit?id=${item.id}`)}
									class="btn btn-primary btn-sm"
									><i class="bi bi-pencil" />
								</button>
								<button on:click={() => deleteOrder(item.id)} class="btn btn-danger btn-sm"
									><i class="bi bi-trash" /></button
								>
							{:else if item.status == 'approved_pic_2'}
								<button
									on:click={() =>
										updateStatus(item.id, {
											status: 'release',
											driver_id: item.driver_id,
											vehicle_id: item.vehicle_id,
											mine_id: item.mine_id
										})}
									class="btn btn-warning btn-sm"
									>Diambil Driver
								</button>
							{:else if item.status == 'release'}
								<button
									on:click={() =>
										updateStatus(item.id, {
											status: 'done',
											driver_id: item.driver_id,
											vehicle_id: item.vehicle_id,
											mine_id: item.mine_id
										})}
									class="btn btn-success btn-sm"
									>Selesai
								</button>
							{/if}
						{:else if (item.status == 'new' && $role == 'pic_branch_office') || (item.status == 'approved_pic_1' && $role == 'pic_head_office')}
							<button on:click={() => approved(item.id)} class="btn btn-success btn-sm">
								<i class="bi bi-check-circle" />
							</button>
							<button on:click={() => rejected(item.id)} class="btn btn-danger btn-sm">
								<i class="bi bi-x-circle" />
							</button>
						{/if}
					</td>
				</tr>
			{/each}
		</tbody>
	</table>
</div>
