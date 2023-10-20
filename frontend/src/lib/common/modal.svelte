<script context="module">
	import { writable } from 'svelte/store';

	export const modalSetting = writable({});
	export const modalComponent = writable();
	export const modalComponentSetting = writable({});
	export const modalVisibility = writable(false);
	export const modalSelectedId = writable(null);
	export const modalSelectedContext = writable(null);
</script>

<script>
	import { xfetch } from '$lib/app/request.js';
	import { createEventDispatcher, onDestroy } from 'svelte';
	import { fade } from 'svelte/transition';

	const dispatch = createEventDispatcher();
	const close = () => dispatch('close');
	const ok = () => dispatch('ok');

	let modal;

	const handle_keydown = (e) => {
		if (e.key === 'Escape') {
			close();
			return;
		}

		if (e.key === 'Tab') {
			// trap focus
			const nodes = modal.querySelectorAll('*');
			const tabbable = Array.from(nodes).filter((n) => n.tabIndex >= 0);

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

	let delBtnShow = $modalComponentSetting.delBtnShow;

	export let width = null;
	export let size = null;
	export let headerShow = true;
	export let footerShow = true;
	export let title = '';
	export let closeBtnShow = true;
	export let okBtnShow = delBtnShow ? false : true;

	function del() {
		console.log('delete', $modalSelectedContext, $modalSelectedId);
		xfetch(`${$modalSelectedContext}/${$modalSelectedId}`, 'delete');

		//after execute delete
		$modalVisibility = false;
		$modalSelectedContext = null;
		$modalSelectedId = null;

		location.reload();
	}
</script>

<svelte:window on:keydown={handle_keydown} />

<div class="modal-background" on:click={close} transition:fade={{ duration: 100 }} />

<div class="modal" transition:fade={{ duration: 100 }} bind:this={modal}>
	<div
		class="modal-dialog modal-dialog-centered {size && !width ? ' modal-' + size : ''}"
		style={width ? 'min-width:' + width + 'px !important;' : ''}
	>
		<div class="modal-content">
			{#if headerShow}
				<div class="modal-header py-2">
					<h6 class="modal-title">{@html title}</h6>
					<button type="button" on:click={close} class="btn-close" aria-label="Close" />
				</div>
			{/if}
			<div class="modal-body">
				<slot />
			</div>
			{#if footerShow}
				<div class="modal-footer">
					{#if closeBtnShow}
						<button type="button" on:click={close} class="btn bg-grey-400"
							><i class="bi bi-x-lg me-1" /> Tutup</button
						>
					{/if}
					{#if okBtnShow}
						<button type="button" on:click={ok} class="btn bg-primary-400"
							><i class="bi bi-check-lg me-1" /> OK</button
						>
					{/if}
					{#if delBtnShow}
						<button type="button" on:click={del} class="btn bg-danger-400"
							><i class="bi bi-trash me-1" /> Hapus</button
						>
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
		background: rgba(0, 0, 0, 0.5);
		z-index: 2000;
	}
	.modal {
		z-index: 2200;
		display: block;
	}
</style>
