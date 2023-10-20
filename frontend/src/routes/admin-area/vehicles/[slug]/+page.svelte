<script>
	import { page } from '$app/stores';
	import { xfetch } from '$lib/app/request';
	import ContentTop from '$lib/common/contentTop.svelte';
	import Add from '$lib/vehicles/add.svelte';

	let title = '';
	let item;

	if ($page.params.slug === 'add') {
		title = 'Tambah Kendaraan';
	} else if ($page.params.slug === 'edit') {
		title = 'Edit Kendaraan';
		const id = $page.url.searchParams.get('id');

		item = xfetch(`vehicles/${id}`);
	} else {
		title = 'Detail Kendaraan';
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
