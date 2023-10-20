<script>
	import { onMount } from 'svelte';

	// import ItemCategory from './itemCategory.svelte';
	// import ItemSearchForm from './itemSearchForm.svelte';
	// import ItemUserNav from './itemUserNav.svelte';

	onMount(() => {
		// all nav menu
		var dropdownSelected = null;
		var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
		var dropdownList = dropdownElementList.map(function (dropdownToggleEl, id) {
			dropdownToggleEl.addEventListener('click', (e) => {
				if (dropdownSelected == id) {
					dropdownList[id].toggle();
					dropdownSelected = null;
				} else {
					dropdownSelected = id;
				}
			});
			return new bootstrap.Dropdown(dropdownToggleEl);
		});
		document.body.addEventListener(
			'click',
			() => {
				if (typeof dropdownList[dropdownSelected] != 'undefined') {
					dropdownList[dropdownSelected].hide();
					// dropdownSelected = null;
				}
			},
			true
		);
	});
</script>

<!-- <ItemCategory />
<ItemSearchForm /> -->
<!-- <ItemUserNav /> -->
