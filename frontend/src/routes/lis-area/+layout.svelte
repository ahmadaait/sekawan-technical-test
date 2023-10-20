<script context="module">
	// import { page } from '$app/stores'; // for some reason can't use this
	export async function load({ page }) {
		return {
			props: {
				path: page.path
			}
		};
	}
</script>

<script>
	import { getContext, setContext } from 'svelte';
	import { writable } from 'svelte/store';

	import { userMenuItems } from '$lib/account/userMenuItems.js';
	import ContentTopNav from '$lib/common/contentTopNav.svelte';
	import Sidebar from '$lib/common/pubSidebar.svelte';

	import { localStorageGet } from '$lib/app/localStorage';
	import { browser } from '$app/environment';

	if (!localStorageGet('auth') && browser) {
		location.href = '/login';
	}

	export let path;
	const layoutCtx = getContext('layoutCtx');
	const { footerMode } = getContext(layoutCtx);

	const subLayoutCtx = {};
	const pageIcon = writable('');
	const pageNav = writable([]);
	const pageSelectedAction = writable('');
	const pageFrameless = writable(true);
	setContext('subLayoutCtx', subLayoutCtx);
	setContext(subLayoutCtx, {
		pageIcon,
		pageNav,
		pageSelectedAction,
		pageFrameless
	});

	let extraPadding = false;
	$: extraPadding = $pageNav.length > 0;

	// default things by path
	$: if (path) {
		$footerMode = 'minimal';
		$pageNav = [];
		$pageSelectedAction = null;
		$pageFrameless = true;
	}
</script>

<Sidebar items={userMenuItems} pathPart={2} />

<div id="subblock">
	<ContentTopNav />
	<div class={extraPadding ? 'extra-padding' : ''}>
		{#if $pageFrameless}
			<slot />
		{:else}
			<div class="xshadow-md-1 p-0 p-md-3 mb-4">
				<slot />
			</div>
		{/if}
	</div>
</div>

<style>
	@media (min-width: 992px) {
		#subblock {
			padding-left: 230px;
		}
	}
	.extra-padding {
		padding-top: 4rem;
	}
	@media (min-width: 768px) {
		.extra-padding {
			padding-top: 0px;
		}
	}
	:global(.tb-list) {
		font-size: small;
	}
</style>
