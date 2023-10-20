<script context="module">
	import {data} from '$lib/dummydata/information.js';
	
	export function infoLinksCheck(input) {
		return data.find((item) => {
			if(input == item.code) {
				return item.id;
			}
		}, input);
	}
</script>