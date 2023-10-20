<script>
	import { goto } from '$app/navigation';
	import { page } from '$app/stores';
	import { xfetch } from '$lib/app/request';

	let name, address, phone, email;

	const method = $page.params.slug === 'add' ? 'post' : 'put';
	const id = $page.url.searchParams.get('id');
	async function save() {
		let companies = await xfetch(`companies/${id ? id : ''}`, method, {
			name,
			address,
			phone,
			email
		});
		if (companies.status == 201 || companies.status == 200) {
			goto('/admin-area/companies');
		}
	}

	$: console.log($page);

	export let item;
	if (item) {
		name = item.name;
		address = item.address;
		phone = item.phone;
		email = item.email;
	}
</script>

<form on:submit|preventDefault={save}>
	<div class="row">
		<div class="col-md-6 mb-3">
			<label for="name" class="visible-ie8 visible-ie9 mb-1">Nama Perusahaan</label>
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
			<label for="address" class="visible-ie8 visible-ie9 mb-1">Alamat</label>
			<div class="input-icon">
				<i class="bi bi-person" />
				<input
					name="address"
					type="text"
					bind:value={address}
					class="form-control placeholder-no-fix"
					autocomplete="off"
					required
				/>
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="phone" class="visible-ie8 visible-ie9 mb-1">No. Telepon</label>
			<div class="input-icon">
				<i class="bi bi-person" />
				<input
					name="phone"
					type="text"
					bind:value={phone}
					class="form-control placeholder-no-fix"
					autocomplete="off"
				/>
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="email" class="visible-ie8 visible-ie9 mb-1">Email</label>
			<div class="input-icon">
				<i class="bi bi-person" />
				<input
					name="email"
					type="email"
					bind:value={email}
					class="form-control placeholder-no-fix"
					autocomplete="off"
				/>
			</div>
		</div>

		<hr />
		<div class="col-md-6 mb-3">
			<button type="button" on:click={() => goto('/admin-area/companies')} class="btn btn-secondary"
				><i class="bi bi-backspace" /> Kembali</button
			>
			<button type="submit" class="btn btn-primary"><i class="bi bi-save" /> Simpan</button>
		</div>
	</div>
</form>
