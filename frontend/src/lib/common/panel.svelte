<script>
	import { goto } from '$app/navigation';

	export let items;
</script>

<div class="row gx-3">
	{#each items as item}
		<div class="col-md-6 col-xxl-4">
			<div class="card xshadow-1 p-2 mb-3 panel">
				<h6>{item.title}</h6>
				<div class="row gx-1">
					{#each item.items as link}
						<div on:click={() => goto(link.url)} class="col-3 pointer item">
							<div class="icon"><i class={link.icon} /></div>
							<div class="title">{link.title}</div>
						</div>
					{/each}
				</div>
			</div>
		</div>
	{/each}
</div>

<style>
	.panel {
		height: 140px;
	}
	.item:hover {
		background-color: #f3dea7;
	}
	.icon {
		text-align: center;
		height: 50px;
	}
	.icon i {
		font-size: 36px;
	}
	.title {
		text-align: center;
		font-size: 0.8rem;
	}
</style>
