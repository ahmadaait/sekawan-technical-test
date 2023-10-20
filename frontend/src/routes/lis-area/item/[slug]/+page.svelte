<script>
	import Add from '$lib/item/add.svelte';
	import ContentTop from '$lib/common/contentTop.svelte';
	import { xfetch } from '$lib/app/request';
	import { page } from '$app/stores';
	import AddReference from '$lib/item/addReference.svelte';

	let title = '';
	let item;

	if ($page.params.slug === 'add') {
		title = 'Tambah Item';
	}
	if ($page.params.slug === 'edit') {
		title = 'Edit Item';

		const id = $page.url.searchParams.get('id');
		item = xfetch(`item/${id}`);
	}
	if ($page.params.slug === 'detail') {
		title = 'Detail Item';

		const id = $page.url.searchParams.get('id');
		item = xfetch(`item/${id}`);
	}
	if ($page.params.slug === 'addreference') {
		title = 'Tambah Referensi Item';
	}

	const contentTop = {
		title
	};

	$: console.log('content slug :', $page.params.slug);
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
{#if $page.params.slug === 'addreference'}
	<AddReference />
{/if}
{#if $page.params.slug === 'detail'}
	{#await item}
		<div>Processing</div>
	{:then result}
		<Add item={result.data} />
	{/await}
{/if}
