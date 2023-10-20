<script>
	import { getContext } from 'svelte';
	const layoutCtx = getContext('layoutCtx');
	const { pageTitle } = getContext(layoutCtx); //headerMode, 
</script>

<div class="px-1 me-auto">
	- <span class="text-white">{ $pageTitle }</span>
</div>
