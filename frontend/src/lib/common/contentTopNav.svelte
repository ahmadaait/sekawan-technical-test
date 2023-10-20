<script>
	import { getContext } from 'svelte';

	import { userMenuItems } from '$lib/account/userMenuItems.js';

	const subLayoutCtx = getContext('subLayoutCtx');
	const { pageIcon, pageNav, pageSelectedAction } = getContext(subLayoutCtx);

	let withNav = false;
	$: withNav = $pageNav.length > 0;
</script>

<div class="d-flex pagenav {withNav ? '' : 'zeronav'} pt-md-2">
	<div class="flex-grow-1 {withNav ? 'pt-2' : 'pt-3'} pl-1 pl-md-0 mb-0 h6">
		{@html $pageIcon}
	</div>
	<div class="text-right">
		{#each $pageNav as item}
			{#if item.type == 'button'}
				<button
					class="btn bg-{item.bgcolor}-400 ms-2"
					on:click={() => ($pageSelectedAction = item.onclick)}
				>
					{@html item.icon}<span class="title d-none d-md-inline-block ms-1">{item.title}</span>
				</button>
			{:else if item.type == 'anchor'}
				<a href={item.href} class="btn bg-{item.bgcolor}-400 ms-2">
					{@html item.icon}<span class="title d-none d-md-inline-block ms-1">{item.title}</span>
				</a>
			{/if}
		{/each}
	</div>
</div>

<style>
	.pagenav {
		position: fixed;
		top: 54px;
		left: 0px;
		z-index: 10;
		background-color: #fff;
		width: 100%;
		padding: 0.5rem 1rem;
		box-shadow: 0 0 0.5rem rgba(0, 0, 0, 0.3) !important;
	}
	.pagenav.zeronav {
		position: unset;
		width: 100%;
		margin-bottom: 15px;
		padding: 0px 0px 10px 0px;
		box-shadow: unset !important;
		border-bottom: 1px solid #ccc;
	}
	@media (min-width: 768px) {
		.pagenav {
			position: relative;
			top: unset;
			left: unset;
			padding: 0px 0px 10px 0px;
			box-shadow: unset !important;
		}
		.pagenav.zeronav {
			margin-bottom: unset;
			border-bottom: unset;
		}
	}
</style>
