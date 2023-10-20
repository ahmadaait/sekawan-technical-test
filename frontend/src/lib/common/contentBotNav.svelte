<script>
	import { createEventDispatcher } from 'svelte';
	
	const dispatch = createEventDispatcher();
	export let useHr = true;
	export let items = [];
</script>

<div class="botnav-rsm text-center text-md-start py-2">
	{#if useHr}
	<hr class="d-none d-md-block mt-0 mb-3" />
	{/if}
	{#each items as item}
		{#if item.type == 'button'}
			<button class="btn bg-{item.bgcolor}-400 me-2" on:click={() => dispatch(item.dispatch)}>
				{@html item.icon}<span class="title ms-1">{item.title}</span>
			</button>
		{:else if item.type == 'anchor'}
			<a href="{item.href}" class="btn bg-{item.bgcolor}-400 me-2">
				{@html item.icon}<span class="title ms-1">{item.title}</span>
			</a>
		{/if}
	{/each}
</div>

<style>
	/* theme botnav on sm media */
	@media (max-width: 767px) {
		.botnav-rsm {
			position:fixed;
			bottom:0px;
			left:0px;
			right:0px;
			padding-top:10px;
			padding-bottom:10px;
			background-color: #fff;
			z-index: 1110;
			box-shadow:0px 2px 6px 1px rgba(0, 0, 0, 0.25) !important;
		}
	}
</style>