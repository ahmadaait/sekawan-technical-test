<script>
	import { localStorageDelete } from '$lib/app/localStorage';
	import { browser } from '$app/environment';

	if (browser) {
		localStorageDelete('auth');
		location.href = '/login';
	}
</script>
