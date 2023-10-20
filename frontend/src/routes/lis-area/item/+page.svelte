<script>
	import List from '$lib/item/list.svelte';
	import ContentTop from '$lib/common/contentTop.svelte';

	import { getContext } from 'svelte';
	import { xfetch } from '$lib/app/request.js';

	const layoutCtx = getContext('layoutCtx');
	const { pageTitle } = getContext(layoutCtx);

	const subLayoutCtx = getContext('subLayoutCtx');
	const { pageIcon, pageFrameless, pageSelectedAction } = getContext(subLayoutCtx);

	$pageTitle = 'Item';
	$pageFrameless = false;

	const contentTop = {
		title: 'List Item'
	};

	let item = xfetch('item?sorted=[{"id":"id","value":"asc"}]');

	// show modal
	const modalCtx = getContext('modalCtx');
	const { modalSetting, modalComponent, modalComponentSetting, modalVisibility } =
		getContext(modalCtx);

	function showDeleteModal() {
		$modalSetting = {
			title: 'Hapus Item'
		};
		$modalComponent = import('$lib/item/deleteContent.svelte');
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
	<List items={result.data} />
{/await}
