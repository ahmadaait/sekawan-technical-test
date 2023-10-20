<script>
	import { page } from '$app/stores';
	import { xfetch } from '$lib/app/request';
	import ContentTop from '$lib/common/contentTop.svelte';
	import Add from '$lib/companies/add.svelte';

	let title = '';
	let item;

	if ($page.params.slug === 'add') {
		title = 'Tambah Perusahaan';
	} else if ($page.params.slug === 'edit') {
		title = 'Edit Perusahaan';
		const id = $page.url.searchParams.get('id');

		item = xfetch(`companies/${id}`);
	} else {
		title = 'Detail Perusahaan';
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
