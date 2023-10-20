<script>
	import Add from '$lib/testpackage/add.svelte';
	import Price from '$lib/testpackage/price.svelte';
	import ContentTop from '$lib/common/contentTop.svelte';
	import { xfetch } from '$lib/app/request';
	import { page } from '$app/stores';
	import AddPrice from '$lib/testpackage/addPrice.svelte';

	let title = '';
	let item;

	if ($page.params.slug === 'add') {
		title = 'Tambah Paket';
	} else if ($page.params.slug === 'edit') {
		title = 'Edit Paket';

		const id = $page.url.searchParams.get('id');
		item = xfetch(`testpackage/${id}`);
	} else if ($page.params.slug === 'price') {
		title = 'Harga Paket';
	} else if ($page.params.slug === 'add-price') {
		title = 'Tambah Harga Paket';
	} else {
		title = 'Detail Paket';

		const id = $page.url.searchParams.get('id');
		item = xfetch(`testpackage/${id}`);
	}

	const contentTop = {
		title
	};
</script>

<ContentTop item={contentTop} />
{#if $page.params.slug === 'add'}
	<Add {item} />
{/if}
{#if $page.params.slug === 'edit'}
	{#await item}
		<div>Processing</div>
	{:then result}
		<Add item={result.data} />
	{/await}
{/if}
{#if $page.params.slug === 'detail'}
	{#await item}
		<div>Processing</div>
	{:then result}
		<Add item={result.data} />
	{/await}
{/if}
{#if $page.params.slug === 'price'}
	<Price />
{/if}
{#if $page.params.slug === 'add-price'}
	<AddPrice />
{/if}
