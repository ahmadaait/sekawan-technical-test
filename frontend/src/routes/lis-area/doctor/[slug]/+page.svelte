<script>
	import Add from '$lib/doctor/add.svelte';
	import ContentTop from '$lib/common/contentTop.svelte';
	import { xfetch } from '$lib/app/request';
	import { page } from '$app/stores';

	let title = '';
	let item;

	if ($page.params.slug === 'add') {
		title = 'Tambah Dokter';
	} else if ($page.params.slug === 'edit') {
		title = 'Edit Dokter';
		const id = $page.url.searchParams.get('id');

		item = xfetch(`doctor/${id}`);
	} else {
		title = 'Detail Dokter';
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
