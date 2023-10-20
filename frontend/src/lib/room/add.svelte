<script>
	import { goto } from '$app/navigation';
	import { xfetch } from '$lib/app/request';
	import { page } from '$app/stores';

	let code, name, doctorName, description;

	let disabled = $page.params.slug === 'detail' ? 'disabled' : '';

	const method = $page.params.slug === 'add' ? 'post' : 'put';
	const id = $page.url.searchParams.get('id');
	async function save() {
		let doctor = await xfetch(`room/${id ? id : ''}`, method, {
			code,
			name,
			doctorName,
			description
		});
		if (doctor.status == 201) {
			goto('/lis-area/room');
		}
	}

	$: console.log($page);

	export let item;
	if (item) {
		name = item.name;
		doctorName = item.doctorName;
		description = item.description;
		code = item.code;
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
			<label for="name" class="visible-ie8 visible-ie9 mb-1">Nama Ruangan</label>
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
			<label for="doctorName" class="visible-ie8 visible-ie9 mb-1">Dokter PIC</label>
			<div class="input-icon">
				<i class="bi bi-person" />
				<input
					name="doctorName"
					type="text"
					bind:value={doctorName}
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

		<hr />
		<div class="col-md-6 mb-3">
			<button type="button" on:click={() => goto('/lis-area/room')} class="btn btn-secondary"
				><i class="bi bi-backspace" /> Kembali</button
			>
			{#if $page.params.slug !== 'detail'}
				<button type="submit" class="btn btn-primary"><i class="bi bi-save" /> Simpan</button>
			{/if}
		</div>
	</div>
</form>
