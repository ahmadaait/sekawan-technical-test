<script>
	import { createEventDispatcher, onDestroy } from 'svelte';
	import { fade } from 'svelte/transition';

	const dispatch = createEventDispatcher();
	const close = () => dispatch('close');
	const ok = () => dispatch('ok');

	let modal;

	const handle_keydown = e => {
		if (e.key === 'Escape') {
			close();
			return;
		}

		if (e.key === 'Tab') {
			// trap focus
			const nodes = modal.querySelectorAll('*');
			const tabbable = Array.from(nodes).filter(n => n.tabIndex >= 0);

			let index = tabbable.indexOf(document.activeElement);
			if (index === -1 && e.shiftKey) index = 0;

			index += tabbable.length + (e.shiftKey ? -1 : 1);
			index %= tabbable.length;

			tabbable[index].focus();
			e.preventDefault();
		}
	};

	const previously_focused = typeof document !== 'undefined' && document.activeElement;

	if (previously_focused) {
		onDestroy(() => {
			previously_focused.focus();
		});
	}

	export let width = null;
	export let size = null;
	export let headerShow = true;
	export let footerShow = true;
	export let title = '';
	export let closeBtnShow = true;
	export let okBtnShow = true;

</script>

<svelte:window on:keydown={handle_keydown}/>

<div class="modal-background" on:click={close} transition:fade="{{duration: 100}}"></div>

<div class="modal" transition:fade="{{duration: 100}}">
	<div class="modal-dialog modal-dialog-centered {size ? ' modal-' + size : ''}" style="{width ? 'width:' + width + 'px !important;' : ''}" >
		<div class="modal-content">
			{#if headerShow}
			<div class="modal-header py-2">
				<h6 class="modal-title">{@html title}</h6>
				<button type="button" on:click={close} class="btn-close" aria-label="Close"></button>
			</div>
			{/if}
			<div class="modal-body">
				<slot />
			</div>
			{#if footerShow}
			<div class="modal-footer">
				{#if closeBtnShow}
				<button type="button" on:click={close} class="btn bg-grey-400"><i class="bi bi-x-lg me-1"></i> Tutup</button>
				{/if}
				{#if okBtnShow}
				<button type="button" on:click={ok} class="btn bg-primary-400"><i class="bi bi-check-lg me-1"></i> OK</button>
				{/if}
			</div>
			{/if}
		</div>
	</div>
</div>

<style>
	.modal-background {
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background: rgba(0,0,0,0.5);
		z-index: 2000;
	}
	.modal {
		z-index: 2200;
		display:block;
	}
</style>