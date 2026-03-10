
						
<section class="content">
                   
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>


<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>


<div id="mik_show" style="height: 400px; min-width: 310px"></div>
 
	<!--hide  -->
	<input type="hidden" value="<?php echo $_GET['interface'];?>" name="interface"  id="interface">
	<!--hide  -->

<!--  -->

<!--######################################################################  -->
<script type="text/javascript">
	var chart;
	function requestDatta(interface) {
		$.ajax({
			url: 'data/data_interface_traffic.php?interface='+interface,
			//datatype: "json",
			success: function(data) {
				var mikDATA = JSON.parse(data);
				if( mikDATA.length > 0 ) {
					var TX=JSON.parse(mikDATA[0].data);
					var RX=JSON.parse(mikDATA[1].data);
					var x = (new Date()).getTime(); 
					shift=chart.series[0].data.length > 19;
					chart.series[0].addPoint([x, TX], true, shift);
					chart.series[1].addPoint([x, RX], true, shift);
					
				}
			},
			      
		});
	}	

	$(document).ready(function() {
			Highcharts.setOptions({
				global: {
					useUTC: false
				}
			});
	

           chart = new Highcharts.Chart({
			   chart: {
				renderTo: 'mik_show',
				animation: Highcharts.svg,
				type: 'spline',
		borderColor: '#EBBA95',
        borderRadius: 20,
        borderWidth: 2,
				events: {
					load: function () {
						setInterval(function () {
							requestDatta(document.getElementById("interface").value);
						}, 5000);
					},				
			}
		 },
		 title: {
			text: 'Monitor-Traffic : <?php echo $_GET['interface'];?>'
		 },
			 tooltip: {
       headerFormat: '<span style="font-size:10px">{point.key}</span><br>',
        pointFormat: '<span  style="font-size:18px">{point.y: ,.2f}</span> <span style="font-size:14px"> {series.name}</span>',
        
    },
		 xAxis: {
			type: 'datetime',
				tickPixelInterval: 150,
				maxZoom: 20 * 1000
		 },
		 yAxis: {
			minPadding: 0.2,
				maxPadding: 0.2,
				title: {
					text: 'Mikrotik Thailand',
					margin: 15
				}
		 },
            series: [{
                name: 'Mbps-TX',
                data: []
            }, {
                name: 'Mbps-RX',
                data: []
            }]
	  });
  });



</script>

       
</section>  

