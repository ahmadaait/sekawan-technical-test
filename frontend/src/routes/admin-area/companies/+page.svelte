<script>
	import ContentTop from '$lib/common/contentTop.svelte';
	import List from '$lib/companies/list.svelte';

	import { xfetch } from '$lib/app/request.js';
	import { getContext } from 'svelte';

	const layoutCtx = getContext('layoutCtx');
	const { pageTitle } = getContext(layoutCtx);

	const subLayoutCtx = getContext('subLayoutCtx');
	const { pageIcon, pageFrameless, pageSelectedAction } = getContext(subLayoutCtx);

	$pageTitle = 'Perusahaan';
	$pageFrameless = false;

	const contentTop = {
		title: 'List Perusahaan'
	};

	let item = xfetch('companies');

	// show modal
	const modalCtx = getContext('modalCtx');
	const { modalSetting, modalComponent, modalComponentSetting, modalVisibility } =
		getContext(modalCtx);

	function showDeleteModal() {
		$modalSetting = {
			title: 'Hapus Perusahaan'
		};
		$modalComponent = import('$lib/companies/deleteContent.svelte');
		$modalComponentSetting = {
			delBtnShow: true
		};
		$modalVisibility = true;
	}

	function closeModal() {
		$pageSelectedAction = null;
	}

	$: if ($pageSelectedAction == 'showDelete') showDeleteModal();
	$: if (!$modalVisibility) closeModal();
</script>

<ContentTop item={contentTop} />
{#await item}
	<div>Processing</div>
{:then result}
	<List items={result.data.data} />
{/await}
