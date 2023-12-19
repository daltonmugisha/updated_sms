<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">Reports about the activity</h3>
       
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<div class="row">
                <div class="col">
                    <h3>Purchasing statitics report</h3>

                    <div id="chart" class="">

                    </div>

                </div>

                <div class="col">
                    <h3>Sales statitics report</h3>

                </div>

            </div>
		</div>
		</div>
	</div>
</div>
<script>
    var options = {
        chart: {
            type: 'donut'
        },
        series:[30, 40, 45, 50, 49, 60, 70, 91, 125],
        chartOptions: {
    labels: ['Apple', 'Mango', 'Orange', 'Watermelon']
  }
    }

    var chart = new ApexCharts(document.querySelector("#chart"), options);

    chart.render();
</script>