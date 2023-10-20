<script>
	import { page } from '$app/stores';
	export let items = [];
	export let pathPart = null;
	export let flex = false;

	let itemCount = items.length;
	let showSidebar = false;
	let selectedPath;

	$: if ($page.path) {
		if (pathPart >= 0) {
			let pathArr = $page.path.split('/');
			selectedPath = pathArr[pathPart];
		} else {
			selectedPath = $page.path;
		}
	}
</script>

<div
	class="pubsidebar {flex ? 'flex' : ''} {showSidebar == true
		? 'show'
		: ''} icononly d-block xshadow-1"
>
	<div
		class="pubsidebar-toggler xshadow-2"
		on:click={() => {
			showSidebar = !showSidebar;
		}}
	>
		<i class="bi bi-chevron-{showSidebar == true ? 'left' : 'right'}" />
	</div>
	<div class="wrapper">
		{#if itemCount > 0}
			<ul class="nav flex-column menu py-3">
				{#each items as item, i}
					{#if item.title != 'Profile'}
						<li><h6>{item.title}</h6></li>
						{#each item.items as link}
							<li>
								<a href={link.url} class:active={selectedPath === link.url.split('/')[pathPart]}
									><i class={link.icon} /> <span>{link.title}</span></a
								>
							</li>
						{/each}
						{#if itemCount != i + 2}
							<li><hr /></li>
						{/if}
					{/if}
				{/each}
			</ul>
		{:else}
			<slot />
		{/if}
	</div>
</div>

<style>
	.pubsidebar {
		position: fixed; /*here*/
		z-index: 100;
		width: 215px;
		background-color: #fff;
		transition: all 0.3s;
		left: -215px;
		top: 70px;
	}
	@media (min-width: 1200px) {
		.pubsidebar.flex {
			width: 230px;
		}
	}
	.pubsidebar.show {
		left: 0px;
	}
	.pubsidebar .pubsidebar-toggler {
		position: fixed;
		z-index: 8800;
		top: 100px;
		left: 0px;
		width: 40px;
		height: 40px;
		display: block;
		background-color: #823674;
		color: #fff;
		line-height: 40px;
		text-align: center;
		transition: all 0.3s;
	}
	.pubsidebar.show .pubsidebar-toggler {
		left: 195px;
	}

	@media (min-width: 992px) {
		.pubsidebar {
			left: unset !important;
		}
		.pubsidebar .pubsidebar-toggler {
			display: none;
		}
	}

	.pubsidebar h6 {
		padding-left: 15px;
	}
	.pubsidebar .menu li a {
		position: relative;
		display: block;
		padding: 8px 10px 8px 40px;
		text-decoration: none;
	}
	.pubsidebar .menu li a.active {
		padding-left: 36px;
		border-left: 4px solid #823674;
	}
	.pubsidebar .menu li a:hover {
		padding-left: 36px;
		/* background-color:#9d1e1b; */
		border-left: 4px solid #823674;
		/* color: #feeef0; */
	}
	.pubsidebar .menu li a i {
		position: absolute;
		left: 16px;
		top: 8px;
		font-size: 1rem;
	}
	.pubsidebar .menu li a.active i {
		left: 12px;
	}
	.pubsidebar .menu li a:hover i {
		left: 12px;
	}
	.pubsidebar hr {
		margin-top: 10px;
		margin-bottom: 10px;
	}
</style>
