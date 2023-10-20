<script>
	import { getContext } from 'svelte';

	const layoutCtx = getContext('layoutCtx');
	const { footerMode } = getContext(layoutCtx);
	var footerComponent;

	$: {
		$footerMode = $footerMode == null ? 'default' : $footerMode;
		if ($footerMode == 'default') footerComponent = import('./setDefault.svelte');
		else if ($footerMode == 'minimal') footerComponent = import('./setMinimal.svelte');
	}
</script>

<footer id="footer">
	<!--(remove-empty-lines-end)-->
	<div class="container-lg">
		{#if $footerMode}
			{#await footerComponent then result}
				<svelte:component this={result.default} />
			{/await}
		{/if}
	</div>
</footer>

<style>
	#footer {
		background-color: #eee;
		padding-top: 20px;
		padding-bottom: 20px;
	}
</style>
