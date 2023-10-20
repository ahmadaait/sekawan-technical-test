<script>
	export let item = null;
</script>

{#if item != null}
	<div class="row">
		<div class="col-md-12">
			<h4>{item.title}</h4>
		</div>
	</div>
{/if}
