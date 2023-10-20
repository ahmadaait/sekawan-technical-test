<script>
	import { goto } from '$app/navigation';
	import { page } from '$app/stores';
	import { xfetch } from '$lib/app/request';

	let name, status;

	//group radio
	function onChange(event) {
		status = event.currentTarget.value;
	}

	const method = $page.params.slug === 'add' ? 'post' : 'put';
	const id = $page.url.searchParams.get('id');
	async function save() {
		let drivers = await xfetch(`drivers/${id ? id : ''}`, method, {
			name,
			status
		});
		if (drivers.status == 201 || drivers.status == 200) {
			goto('/admin-area/drivers');
		}
	}

	$: console.log($page);

	export let item;
	if (item) {
		name = item.name;
		status = item.status;
	}
</script>

<form on:submit|preventDefault={save}>
	<div class="row">
		<div class="col-md-6 mb-3">
			<label for="name" class="visible-ie8 visible-ie9 mb-1">Nama Driver</label>
			<div class="input-icon">
				<i class="bi bi-person" />
				<input
					name="name"
					type="text"
					bind:value={name}
					class="form-control placeholder-no-fix"
					autocomplete="off"
					required
				/>
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="status" class="visible-ie8 visible-ie9 mb-1">Status</label>

			<div class="input-icon">
				<input bind:group={status} checked type="radio" name="status" value="active" /> Aktif &nbsp;
				&nbsp;
				<input bind:group={status} type="radio" name="status" value="inactive" /> Tidak Aktif
			</div>
		</div>

		<hr />
		<div class="col-md-6 mb-3">
			<button type="button" on:click={() => goto('/admin-area/drivers')} class="btn btn-secondary"
				><i class="bi bi-backspace" /> Kembali</button
			>
			<button type="submit" class="btn btn-primary"><i class="bi bi-save" /> Simpan</button>
		</div>
	</div>
</form>
