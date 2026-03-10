


<section class="content"> 
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<!-- new -->
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>

<div class="<?php print $convert->panel_modify();?>">
<div class="<?php print $panel_heading;?>"><strong>$ Hotspot Money Month</strong>
                        <span class=" hidden-md hidden-sm hidden-xs" >&nbsp;&nbsp;&nbsp;
						<span class="up-time"></span>&nbsp;&nbsp;&nbsp;&nbsp;
						<span class="date"></span>&nbsp;&nbsp;&nbsp;&nbsp;
						<span class="time"></span></span>
						<div class="box-tools pull-right">
		<button class="btn btn-box-tool"   title="Hotspot Chart" onclick="toggle_visibility_double('chart-on');"><h3 class="box-title"><i class="fa fa-bar-chart"></i></h3></button>&nbsp;&nbsp;
	     <button class="btn btn-box-tool"   title="Table Total Money " onclick="toggle_visibility_double('table-on');"><h3 class="box-title"><i class="fa fa-list"></i></h3></button>&nbsp;&nbsp;
        
		  </div>
		 </div>

                        <div class="panel-body">
						<span style="color:#ffffff;float: left;">
<a href="index.php?page=total_money" class="btn btn-default fa fa-arrow-left"></a>&nbsp;<a href="index.php?page=money_month" class="btn btn-default fa fa-rotate-right"></a> </span><br><br>

                <div id="table-on" class="alist" style="display:block;" >
                       <div class="table-responsive">
						<table class="table table-striped table-hover"  id="dataTables-example">
                                  <thead>
                                        <tr>   
											  
                                        	<th>NO.</th>
											<th>COMMENT</th>                     	
                                            <th>เดือน/ปี</th>                                            
                                            <th>จำนวนวัน</th>
											<th>ACTION</th>
                                             </tr>
                                    </thead>        
                                    <tbody>   
                                    <?php
									$sql=$db->DB->prepare("SELECT * FROM mt_money WHERE mt_id='".$id."' GROUP BY month_code ");
	                                   $sql->execute();
									  	   $no=0;$total=0;
                                   while($result = $sql->fetch( PDO::FETCH_ASSOC ))	{
													
													$no++;
													$thai_conv= $result['date'];

                                                            echo "<tr>";
															echo "<td>".$no."</td>";								
															echo "<td>".$result['month']."</td>";
															echo "<td>".$convert->Convert_time_min($thai_conv)."</td>";
															echo "<td>";
							$count= $db->num_rows("mt_money","month_code","month_code='".$result['month_code']."'");

															echo $count;
															echo "</td>";
															echo "<td>";
														 echo"<a class=\"btn btn-black btn-xs\"  title= \"click to view\" href='index.php?page=month_list&id=".$result['month_code']."'><span class=\"fa fa-list\"></span> ดูรายการ </a></td>";
															echo "</td>";
															echo "</tr>";
															$total = $total + ($count);
													
													}
												?>
												 </tbody>
												 <tfoot>   
											  
                                        	<th></th>
											<th></th>                     	
                                            <th><strong>ยอดรวม</strong></th>                                            
                                            <th><?php echo $total;?></th>
											<th></th>
                                             </tfoot>
											
                                                                                
                                 </table>
                                  </div>
								  </div>
								  <!-- ./table-on -->
								  
							 <div id="chart-on" class="alist" style="display:none;" >
					 <span class="hidden-md hidden-sm hidden-xs">      
                    <div id="maximize" class="allsize" style="display:block;" >
						<button  id="sizeplus" class="sidebar-toggle"  role="button" data-toggle="offcanvas"   title= "คลิก เพื่อขยาย มอนิเตอร์" onclick="toggle_visibility_size('restore')">+</button>
						<button  id="sizenormal">1:1</button></div>
					</span>
						
						<div id="restore" class="allsize" style="display:none;" >
						<button  id="sizeminus" type="button"  class="sidebar-toggle"  role="button" data-toggle="offcanvas"     title= "คลิก เพื่อลดขนาด มอนิเตอร์" onclick="toggle_visibility_size('maximize')">-</button>
						<button  id="sizenormal2">1:1</button></div>
						
							<div class="chart">
							<div class="row">
            <!-- <div id="hotspot_money" style="width: 1000px; height: 500px;"></div> -->
			<div id="hotspot_money" style="height: 500px;"></div>
			</div>
<div id="sliders">
    <!-- <center> --><table>
        <tr>
        	<td>Alpha Angle</td>
        	<td><input id="alpha" type="range" min="0" max="45" value="15"/> <span id="alpha-value" class="value"></span></td>
        </tr>
        <tr>
        	<td>Beta Angle</td>
        	<td><input id="beta" type="range" min="-45" max="45" value="15"/> <span id="beta-value" class="value"></span></td>
        </tr>
        <tr>
        	<td>Depth</td>
        	<td><input id="depth" type="range" min="20" max="100" value="50"/> <span id="depth-value" class="value"></span></td>
        </tr>
    <!-- </center> --></table>
    </div>

							
							</div>
							 <!-- /.chart -->
							 </div>
							  <!-- /.chart-on -->


								    </div>
									   </div>

	<script type="text/javascript">


$(document).ready(function() {
	var $hotspot = $('#hotspot_money'),
	//var chart;
	 chart,
    origChartWidth = 1000,
    origChartHeight = 500,
    chartWidth = origChartWidth,
    chartHeight = origChartHeight;
	var options = { 
    chart: {
        renderTo: 'hotspot_money',
        type: 'column',
        options3d: {
            enabled: true,
            alpha: 0,
            beta: 0,
            depth: 50,
            viewDistance: 25
        }
    },
    title: {
    },
    subtitle: {
    },
    plotOptions: {
     series: {
            //borderWidth: 0,
            dataLabels: {
                enabled: true
            }
        }
    },
   xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Mikrotik Thailand'
        }
    },
	tooltip: {
      headerFormat: '<span style="font-size:14px">{point.key} {series.name}</span><br>',
	 // headerFormat: '<span style="font-size:14px">{point.x} {series.name}</span><br>',
        pointFormat: '<span style="font-size:18px">{point.y: ,.0f} บาท</span>',
        //footerFormat: '</table>',
      //  shared: true,
      //  useHTML: true
    },
series: [],
	drilldown: {
		        activeAxisLabelStyle: {
            textDecoration: 'none',
           // fontStyle: 'italic'
        },
        activeDataLabelStyle: {
            textDecoration: 'none',
          //  fontStyle: 'italic'
        },
       drillUpButton: {
            relativeTo: 'spacingBox',
            position: {
                y: 0,
                x: -50
            },
            theme: {
                fill: 'white',
                'stroke-width': 1,
                stroke: 'silver',
                r: 0,
                states: {
                    hover: {
                        fill: '#a4edba'
                    },
                    select: {
                        stroke: '#039',
                        fill: '#a4edba'
                    }
                }
            }

        },
        series: []
	}
};//option
             $.getJSON("data/data_hotspot_money.php", function(json) {
				  if(json[0]!=null){
                options.series = json[0].series;
                 options.drilldown.series = json[1].drilldown;}
				 options.title = json[2].title;
				 options.subtitle = json[3].subtitle;
                 chart = new Highcharts.Chart(options);
            });

//});
//});

 

//
function showValues() {
    $('#alpha-value').html(chart.options.chart.options3d.alpha);
    $('#beta-value').html(chart.options.chart.options3d.beta);
    $('#depth-value').html(chart.options.chart.options3d.depth);
}

// Activate the sliders
$('#sliders input').on('input change', function () {
    chart.options.chart.options3d[this.id] = parseFloat(this.value);
    showValues();
    chart.redraw(false);
});

//showValues();
// create some buttons to test the resize logic

$('#sizeplus').click(function () {
   chartWidth = 1200;
   // chartHeight *= 1.1;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizeminus').click(function () {
    //chartWidth += (-30);
	chartWidth = 1000;
  //  chartHeight *= 0.9;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizenormal').click(function () {
    chartWidth = origChartWidth;
    chartHeight = origChartHeight;
    chart.setSize(origChartWidth, origChartHeight);
});
$('#sizenormal2').click(function () {
    chartWidth = origChartWidth;
    chartHeight = origChartHeight;
    chart.setSize(origChartWidth, origChartHeight);
});
//
 
//});
$(function () {
		Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
    return {
        radialGradient: {
            cx: 0.5,
            cy: 0.3,
            r: 0.7
        },
        stops: [
            [0, color],
            [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
        ]
    };
});
});

});
</script>
								
	<script src="../assets/js/date-time.js"></script>								  
  </section>
								 
    
                            