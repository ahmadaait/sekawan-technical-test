<script>
	import ContentTop from '$lib/common/contentTop.svelte';

	import { xfetch } from '$lib/app/request.js';
	import { getContext } from 'svelte';
	import Chart from '$lib/analytic/chart.svelte';

	const layoutCtx = getContext('layoutCtx');
	const { pageTitle } = getContext(layoutCtx);

	const subLayoutCtx = getContext('subLayoutCtx');
	const { pageIcon, pageFrameless, pageSelectedAction } = getContext(subLayoutCtx);

	$pageTitle = 'Pengguna';
	$pageFrameless = false;

	const contentTop = {
		title: 'Analisis Pemakaian Kendaraan'
	};
</script>

<ContentTop item={contentTop} />
<Chart />
