<script>
	import { getContext } from 'svelte';
	import { localStorageGet } from '$lib/app/localStorage';

	import ItemUserMenu from './itemUserMenu.svelte';

	const loginCtx = getContext('loginCtx');
	const { showLogin } = getContext(loginCtx);

	const session = localStorageGet('auth');

	let innerWidth;
</script>

<svelte:window bind:innerWidth />

<ul class="navbar-nav">
	{#if !session}
		<li class="nav-item">
			<div id="loginNav" on:click={() => ($showLogin = true)} class="nav-link">
				<i class="bi bi-box-arrow-in-right d-none d-sm-inline" /> <span class="ms-1">Login</span>
			</div>
		</li>
	{:else}
		<li id="nav-item-usermenu" class="nav-item dropdown">
			<div class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				<i class="bi bi-person" />
			</div>
			<ItemUserMenu />
		</li>
	{/if}
</ul>

<style>
	@media (max-width: 767px) {
		#nav-item-usermenu {
			position: absolute;
			top: -100px;
		}
	}
</style>
