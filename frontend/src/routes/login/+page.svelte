<script>
	import { getContext } from 'svelte';
	import Content from '$lib/login/form.svelte';

	const layoutCtx = getContext('layoutCtx');
	const { headerMode, pageTitle } = getContext(layoutCtx);
	$headerMode = 'default';
	$pageTitle = 'Login';
</script>

<div class="d-flex justify-content-center pt-md-3">
	<div class="card-md p-2 p-md-3" style="max-width:650px">
		<Content />
	</div>
</div>

<style>
	.d-flex {
		margin-top: 150px;
	}
</style>
