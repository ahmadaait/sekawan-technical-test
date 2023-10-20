<script>
	import { goto } from '$app/navigation';
	import { getContext } from 'svelte';

	const showUserMenu = getContext('showUserMenu');
</script>

<div class="px-1 pointer">
	<div
		class="nav-link px-0 d-inline d-md-none logo slidertoggler"
		data-slidertarget="mainmenu"
		on:click={() => ($showUserMenu = true)}
	>
		<!-- <img src="/images/logo.png" alt="AIICODE" style="" /> -->
		AIICODE
	</div>
	<div on:click={() => goto('/lis-area')} class="nav-link px-0 d-none logo d-md-inline">
		<!-- <img src="/images/logo.png" alt="AIICODE" /> -->
		AIICODE
	</div>
</div>

<style>
	.logo {
		height: 40px;
		color: white;
		font-size: 30px;
	}
</style>
