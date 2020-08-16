<?php $this->load->view('resources/layout/body_header'); ?>
	<!-- CONTENT -->
    <div class="row">
    	<div class="col-sm-3">
    		<h2> <i class="fa fa-area-chart"></i> Applicants Graph</h2>
    		<h5> Legend </h5>
    		<ul>
    			<li>Black: Pending</li>
    			<li>Green: Approved</li>
    			<li>Red: Disapproved</li>
    		</ul>
        </div>
        <div class="col-sm-9">
            <canvas id="barChart" height="200"></canvas>
        </div>
    </div>
    <!-- END CONTENT -->
<?php $this->load->view('resources/layout/body_footer'); ?>
	<script type="text/javascript">
		var barData = {
			labels: 
				<?php 
					echo '[';
					foreach ($organizations_stats as $value) {
						echo '"'. $value['organization_name'] .'", ';
					}
					echo '],';
				?>
			datasets: [{
					label: "Pending",
					fillColor: "rgba(10,10,10,0.5)",
					strokeColor: "rgba(220,220,220,0.8)",
					highlightFill: "rgba(220,220,220,0.75)",
					highlightStroke: "rgba(220,220,220,1)",
					data: 
						<?php 
							echo '[';
							foreach ($organizations_stats as $value) {
								echo $value['applicants_count_pending'] .', ';
							}
							echo '],';
						?>
				},{
					label: "Approved",
					fillColor: "rgba(26,179,148,0.5)",
					strokeColor: "rgba(26,179,148,0.8)",
					highlightFill: "rgba(26,179,148,0.75)",
					highlightStroke: "rgba(26,179,148,1)",
					data: 
						<?php 
							echo '[';
							foreach ($organizations_stats as $value) {
								echo $value['applicants_count_approved'] .', ';
							}
							echo '],';
						?>
				},{
					label: "Disapproved",
					fillColor: "rgba(179,26,26,0.5)",
					strokeColor: "rgba(179,26,26,0.8)",
					highlightFill: "rgba(179,26,26,0.75)",
					highlightStroke: "rgba(179,26,50,1)",
					data: 
						<?php 
							echo '[';
							foreach ($organizations_stats as $value) {
								echo $value['applicants_count_disapproved'] .', ';
							}
							echo '],';
						?>
				}
			]
		};
		var barOptions = {
			scaleBeginAtZero: true,
			scaleShowGridLines: true,
			scaleGridLineColor: "rgba(0,0,0,.1)",
			scaleGridLineWidth: 1,
			barShowStroke: true,
			barStrokeWidth: 2,
			barValueSpacing: 5,
			barDatasetSpacing: 1,
			responsive: true,
		}
		var ctx = barChart.getContext("2d");
		var myNewChart = new Chart(ctx).Bar(barData, barOptions);
	</script>
<?php $this->load->view('resources/layout/body_end'); ?>