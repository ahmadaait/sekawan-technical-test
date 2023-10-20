<script>
	import List from '$lib/room/list.svelte';
	import ContentTop from '$lib/common/contentTop.svelte';

	import { getContext } from 'svelte';
	import { xfetch } from '$lib/app/request.js';

	const layoutCtx = getContext('layoutCtx');
	const { pageTitle } = getContext(layoutCtx);

	const subLayoutCtx = getContext('subLayoutCtx');
	const { pageIcon, pageFrameless, pageSelectedAction } = getContext(subLayoutCtx);

	$pageTitle = 'Ruangan';
	$pageFrameless = false;

	const contentTop = {
		title: 'List Ruangan'
	};

	let item = xfetch('room');

	// show modal
	const modalCtx = getContext('modalCtx');
	const { modalSetting, modalComponent, modalComponentSetting, modalVisibility } =
		getContext(modalCtx);

	function showDeleteModal() {
		$modalSetting = {
			title: 'Hapus Ruangan'
		};
		$modalComponent = import('$lib/room/deleteContent.svelte');
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
