<script>
	import { onMount, getContext } from 'svelte';

	import { localStorageGet } from '$lib/app/localStorage';

	import ProfileQuickView from '$lib/profile/quickView.svelte';
	import { userMenuItems } from '$lib/account/userMenuItems.js';

	const showUserMenu = getContext('showUserMenu');

	const session = localStorageGet('auth');

	onMount(() => {
		var itemList = [].slice.call(document.querySelectorAll('.user-menu a'));
		itemList.forEach((item) => {
			item.addEventListener('click', (e) => {
				$showUserMenu = false;
			});
		});
	});

	let innerWidth;
</script>

<svelte:window bind:innerWidth />

<div
	class="user-menu {innerWidth < 768 ? 'slider' : 'dropdown-menu dropdown-menu-end'} {$showUserMenu
		? 'show'
		: ''} xshadow-2 iconize"
	aria-labelledby="navbarDropdownUser"
	style="min-width:250px;"
>
	{#if innerWidth < 768}
		<nav class="navbar navbar-expand py-1 bgcolor-pri theme-shadow1">
			<div class="container-fluid px-1">
				<ul class="navbar-nav me-auto">
					<li class="nav-item pt-1" on:click={() => ($showUserMenu = false)}>
						<div class="nav-link"><i class="bi bi-x-lg" /></div>
					</li>
					<li class="nav-item">
						<!-- <img src="/img/logo-sm.png" alt="logo" /> -->
					</li>
				</ul>
				<ul class="navbar-nav">
					<li class="nav-item px-2">
						<a href="/" class="nav-link h5 m-0 text-white"><i class="bi bi-house" /></a>
					</li>
					<li class="nav-item px-1">
						<a href="/contactsupport" class="nav-link h5 m-0 text-white"
							><i class="bi bi-question-circle" /></a
						>
					</li>
				</ul>
			</div>
		</nav>
	{/if}

	<div class={innerWidth < 768 ? 'dropdown-menu' : ''}>
		<ProfileQuickView />
		<hr />
		{#each userMenuItems as item, i}
			{#each item.items as link}
				<a href={link.url} class="dropdown-item">
					<span class="icon"><i class={link.icon} /></span>{link.title}
				</a>
			{/each}
			<hr />
		{/each}

		{#if session}
			<a href="/logout" class="dropdown-item">
				<span class="icon"><i class="bi bi-box-arrow-right" /></span>Logout
			</a>
		{/if}
	</div>
</div>

<style>
	.slider .dropdown-menu {
		display: unset;
		border: unset;
		width: 100%;
	}
</style>
