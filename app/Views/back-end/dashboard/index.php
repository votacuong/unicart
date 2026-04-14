<?php 
$AdminOrderModel = new \App\Models\AdminOrderModel();
echo showMessages(); 
?>
<div class="col-12 grid-margin">
	<div class="card">
	  <div class="card-body">
	    <h4 class="card-title"><?php VLang::__e('CHART_STATISTIC');?></h4>
		<div id="lineChart" style="height: 370px; width: 100%;"></div>
	  </div>
	 </div>
</div>

<script>
jQuery(document).ready(function(){
	CanvasJS.addColorSet("greenShades",
	[
	"#6314e5",
	"#24c8c0",
	"#3dc824",
	"#dff319"               
	]);
	chart1 = new CanvasJS.Chart("lineChart", {
		axisY:{
			gridColor: "#f5f5f5"
		},
		colorSet: "greenShades",
		animationEnabled: true,
		theme: "light2",
		fillOpacity: .3,
		data: [
		{        
			type: "splineArea",
			showInLegend: true,
			indexLabelFontSize: 16,
			fillOpacity: .3,
			name: "<?php VLang::__e('CHART_STATISTIC_ORDER');?>",
			dataPoints: [
				<?php $AdminOrderModel->statisticData();?>
			]
		}
		]
	});
	chart1.render();
});
</script>