<script context="module">
	import { writable } from 'svelte/store';
	export const showLogin = writable(false);
</script>

<script>
	import { getContext } from 'svelte';
	
	const modalCtx = getContext('modalCtx');
	const { modalSetting, modalComponent, modalComponentSetting, modalVisibility } = getContext(modalCtx);

	function showLoginModal() {
		$modalSetting = {
			size : 'sm',
			title: 'Login',
			footerShow : false,
		};
		$modalComponent = import('$lib/login/form.svelte');
		$modalComponentSetting = { showTitle: false };
		$modalVisibility = true;
	}

	function closeLoginModal() {
		$showLogin = false;
	}

	$: if($showLogin) showLoginModal();
	$: if(!$modalVisibility) closeLoginModal();
</script>