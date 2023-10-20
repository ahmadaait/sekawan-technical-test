<script>
	import {
		branchOfficeMenuItems,
		headOfficeMenuItems,
		userMenuItems
	} from '$lib/account/userMenuItems.js';
	import Panel from '$lib/common/panel.svelte';

	import { localStorageGet } from '$lib/app/localStorage';
	import { browser } from '$app/environment';
	import jwtDecode from 'jwt-decode';
	import { getContext, onMount } from 'svelte';

	// const userCtx = getContext('userCtx');
	// let { role, uid } = getContext(userCtx);

	let menu = userMenuItems;

	async function decodeJwt(token) {
		const decoded = jwtDecode(token);

		if (decoded.role == 'pic_head_office') {
			menu = headOfficeMenuItems;
		} else if (decoded.role == 'pic_branch_office') {
			menu = branchOfficeMenuItems;
		}
	}

	if (localStorageGet('auth') && browser) {
		onMount(() => {
			decodeJwt(localStorageGet('auth'));
		});
	}
</script>

<Panel items={menu} />
