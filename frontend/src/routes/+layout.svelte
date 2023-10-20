<script context="module">
	export async function load({ page }) {
		return {
			props: {
				path: page.path
			}
		};
	}
</script>

<script>
	import { setContext } from 'svelte';
	import { writable } from 'svelte/store';
	// import { page } from '$app/stores'; // this methode failed as it loaded after the page process

	import Style from '$lib/app/style.svelte';
	import Header from '$lib/header/main.svelte';
	import Footer from '$lib/footer/main.svelte';
	import Modal, {
		modalSetting,
		modalComponent,
		modalComponentSetting,
		modalVisibility,
		modalSelectedContext,
		modalSelectedId
	} from '$lib/common/modal.svelte';

	export let path;

	// layout context
	const layoutCtx = {};
	const headerMode = writable(null);
	const footerMode = writable(null);
	const pageTitle = writable('');
	setContext('layoutCtx', layoutCtx);
	setContext(layoutCtx, {
		headerMode,
		footerMode,
		pageTitle
	});

	// modal context
	const modalCtx = {};
	setContext('modalCtx', modalCtx);
	setContext(modalCtx, {
		modalSetting,
		modalComponent,
		modalComponentSetting,
		modalVisibility,
		modalSelectedContext,
		modalSelectedId
	});
	function modalClosing() {
		$modalVisibility = false;
		$modalSetting = {};
	}

	// set header to default, reactive to path change
	// $: if($page.path) { // fails
	$: if (path) {
		$headerMode = 'default';
		$footerMode = 'default';
	}
</script>

<svelte:head>
	<title>{$pageTitle}</title>
</svelte:head>

<!-- Header -->
<Header />

<!-- Body -->
<div id="mainblock" class="container-lg position-relative">
	<slot />
</div>

<!-- Footer -->
<Footer />

<!-- Modal -->
{#if $modalVisibility}
	<Modal {...$modalSetting} on:close={modalClosing}>
		{#await $modalComponent then result}
			<svelte:component
				this={result.default}
				{...$modalComponentSetting}
				on:close={() => ($modalVisibility = false)}
			/>
		{/await}
	</Modal>
{/if}

<style>
	#mainblock {
		padding-top: 54px;
		min-height: 95vh;
	}
</style>
