<script>
	import { onMount } from 'svelte';
	import Chart from 'chart.js';
	import { xfetch } from '$lib/app/request';

	let labels = [];
	let datas = [];
	async function getAnalytics() {
		const res = await xfetch('orders/analytic/view');
		const resData = res.data;
		resData?.map((d) => {
			console.log(d);
			if (d.return_date != null) {
				labels.push(d.return_date?.split(' ')[0]);
				datas.push(d.count);
			}
		});
	}

	onMount(async () => {
		await getAnalytics();
		console.log(labels, datas);
		renderChart();
	});
	function renderChart() {
		var ctx = document.getElementById('myChart').getContext('2d');
		var chart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels,
				datasets: [
					{
						label: 'Total Pemakaian Kendaraan',
						backgroundColor: 'rgb(255, 99, 132)',
						borderColor: 'rgb(255, 99, 132)',
						data: datas
					}
				]
			},
			options: {}
		});
	}
</script>

<!-- <button on:click={renderChart}>Load</button> -->
<canvas id="myChart" />
