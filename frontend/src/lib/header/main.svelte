<script>
	import { getContext, setContext } from 'svelte';
	import { writable } from 'svelte/store';

	import ItemLogo from './itemLogo.svelte';
	import LoginManager, { showLogin } from '$lib/login/manager.svelte';

	// layout context
	const layoutCtx = getContext('layoutCtx');
	const { headerMode } = getContext(layoutCtx);
	let headerComponent;

	// user menu context
	const showUserMenu = writable(false);
	setContext('showUserMenu', showUserMenu);

	// login context
	const loginCtx = {};
	setContext('loginCtx', loginCtx);
	setContext(loginCtx, {
		showLogin
	});

	$: {
		$headerMode = $headerMode == null ? 'default' : $headerMode;
		if ($headerMode == 'default') headerComponent = import('./setDefault.svelte');
		else if ($headerMode == 'minimal') headerComponent = import('./setMinimal.svelte');
	}
</script>

<header class="mainnavbar bgcolor-pri fixed-top py-1 xshadow-2">
	<nav class="container-lg d-flex align-items-center h-100 navbar-expand px-1 px-md-2">
		<ItemLogo />
		{#await headerComponent then result}
			<svelte:component this={result.default} />
		{/await}
	</nav>
</header>

<!-- Login manager -->
<LoginManager />
