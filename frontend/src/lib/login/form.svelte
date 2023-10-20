<script>
	import { localStorageSet } from '$lib/app/localStorage';
	import { xfetch } from '$lib/app/request.js';
	import { createEventDispatcher } from 'svelte';

	export let showTitle = true;

	const dispatch = createEventDispatcher();

	let formMessage = false;
	let email, password;
	let loginSuccess = false;

	async function submit() {
		// clear text
		const inputMessage = document.querySelectorAll('.input-message');
		inputMessage.forEach((item) => {
			item.innerHTML = '';
		});

		//
		const resLogin = await xfetch('login', 'post', {
			email,
			password
		});
		if (resLogin.status == 200) {
			localStorageSet('auth', resLogin.data.access_token);
			loginSuccess = true;
			setTimeout(() => {
				location.href = '/admin-area';
				dispatch('close');
			}, 3000);
		} else {
			formMessage = true;
			setTimeout(() => {
				formMessage = false;
				dispatch('close');
			}, 2000);
		}
	}
</script>

<form on:submit|preventDefault={submit}>
	{#if showTitle}
		<h6><i class="bi bi-shield-lock" /> Login</h6>
		<hr />
	{/if}

	<!-- <div id="error-msg" class="text-danger input-message">Email atau password tidak valid</div> -->

	{#if formMessage}
		<div class="alert alert-danger" role="alert">Email atau password tidak valid</div>
	{/if}

	{#if !loginSuccess}
		<div class="mb-3">
			<label for="email" class="control-label visible-ie8 visible-ie9">Email</label>
			<div id="email_box" class="input-icon">
				<i class="bi bi-person" />
				<input
					name="email"
					bind:value={email}
					class="form-control placeholder-no-fix"
					autocomplete="off"
					required
				/>
				<div id="/user/name" class="text-danger input-message" />
			</div>
		</div>
		<div class="mb-3">
			<label for="password" class="control-label visible-ie8 visible-ie9">Kata Sandi</label>
			<div id="password_box" class="input-icon">
				<i class="bi bi-shield" />
				<input
					type="password"
					bind:value={password}
					name="password"
					class="form-control placeholder-no-fix"
					autocomplete="off"
					required
				/>
				<div id="/user/password" class="text-danger input-message" />
			</div>
		</div>
		<div class="text-center">
			<button class="btn bg-blue-400"><i class="bi bi-box-arrow-in-right me-1" /> Masuk</button>
		</div>
	{:else}
		<h6 class="text-center text-blue mb-3"><i class="bi bi-check2-cirlce" />LOGIN BERHASIL</h6>
		<div>Halaman akan direfresh dalam waktu 3 detik.</div>
	{/if}
</form>

<style>
	form {
		min-width: 260px;
	}
	:global(body) {
		background-image: none;
		background-size: cover;

		/* background-color: black; */
	}
</style>
