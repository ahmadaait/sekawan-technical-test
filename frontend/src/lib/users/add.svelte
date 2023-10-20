<script>
	import { goto } from '$app/navigation';
	import { page } from '$app/stores';
	import { xfetch } from '$lib/app/request';

	let name, email, password, password_confirmation, role;

	//group radio
	function onChange(event) {
		role = event.currentTarget.value;
	}

	const method = $page.params.slug === 'add' ? 'post' : 'put';
	const id = $page.url.searchParams.get('id');
	async function save() {
		let users = await xfetch(`users/${id ? id : ''}`, method, {
			name,
			email,
			password,
			password_confirmation,
			role
		});
		if (users.status == 201 || users.status == 200) {
			goto('/admin-area/users');
		}
	}

	$: console.log($page);

	export let item;
	if (item) {
		name = item.name;
		email = item.email;
		password = item.password;
		password_confirmation = item.password_confirmation;
		role = item.role;
	}
</script>

<form on:submit|preventDefault={save}>
	<div class="row">
		<div class="col-md-6 mb-3">
			<label for="name" class="visible-ie8 visible-ie9 mb-1">Nama Pengguna</label>
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
			<label for="email" class="visible-ie8 visible-ie9 mb-1">Email</label>
			<div class="input-icon">
				<i class="bi bi-person" />
				<input
					name="email"
					type="email"
					bind:value={email}
					class="form-control placeholder-no-fix"
					autocomplete="off"
					required
				/>
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="password" class="visible-ie8 visible-ie9 mb-1">Password</label>
			<div class="input-icon">
				<i class="bi bi-person" />
				<input
					name="password"
					type="password"
					bind:value={password}
					class="form-control placeholder-no-fix"
					autocomplete="off"
					required
				/>
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="password_confirmation" class="visible-ie8 visible-ie9 mb-1"
				>Konfirmasi Password</label
			>
			<div class="input-icon">
				<i class="bi bi-person" />
				<input
					name="password_confirmation"
					type="password"
					bind:value={password_confirmation}
					class="form-control placeholder-no-fix"
					autocomplete="off"
					required
				/>
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="role" class="visible-ie8 visible-ie9 mb-1">Role</label>

			<div class="input-icon">
				<input bind:group={role} checked type="radio" name="role" value="admin" /> Admin &nbsp;
				&nbsp;
				<input bind:group={role} type="radio" name="role" value="pic_head_office" /> Head Office
				&nbsp; &nbsp;
				<input bind:group={role} type="radio" name="role" value="pic_branch_office" /> Branch Office
			</div>
		</div>

		<hr />
		<div class="col-md-6 mb-3">
			<button type="button" on:click={() => goto('/admin-area/users')} class="btn btn-secondary"
				><i class="bi bi-backspace" /> Kembali</button
			>
			<button type="submit" class="btn btn-primary"><i class="bi bi-save" /> Simpan</button>
		</div>
	</div>
</form>
