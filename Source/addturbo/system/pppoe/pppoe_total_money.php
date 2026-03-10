											<?php
  include_once('data/update_money.function.php');
	   $money= new money();
		 $money->user_info();
		 $update=$money->pppoe_money();  
		
		 
		 
			
if(!empty($update)){
echo "<script language='javascript'>swal('Save Done!','UPDATE ข้อมูลจำนวน ".$update." รายการสำเร็จแล้ว','success').then(function () {
   }, function (dismiss) {
  if (dismiss === 'overlay') {
    
   }})</script>";
}
?>

<section class="content"> 
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/stock/highstock.js"></script>

<div class="<?php print $convert->panel_modify();?>">
<div class="<?php print $panel_heading;?>"><strong>$ pppoe Total Money</strong>
                        <span class=" hidden-md hidden-sm hidden-xs" >&nbsp;&nbsp;&nbsp;
						<span class="up-time"></span>&nbsp;&nbsp;&nbsp;&nbsp;
						<span class="date"></span>&nbsp;&nbsp;&nbsp;&nbsp;
						<span class="time"></span></span>
						<div class="box-tools pull-right">
		<button class="btn btn-box-tool"   title="pppoe Chart" onclick="toggle_visibility_double('chart-on');"><h3 class="box-title"><i class="fa fa-line-chart"></i></h3></button>&nbsp;&nbsp;
	     <button class="btn btn-box-tool"   title="Table Total Money " onclick="toggle_visibility_double('table-on');"><h3 class="box-title"><i class="fa fa-list"></i></h3></button>&nbsp;&nbsp;
		 
		  </div>
		 </div>
						<div class="panel-body">

						<span style="color:#ffffff;
float: left;
"><a href="index.php?page=pppoe_total_money" class="btn btn-default fa fa-rotate-right"></a>&nbsp;&nbsp;&nbsp;
<a class="btn btn-success btn-xs "  title= "click to view" href='index.php?page=pppoe_money_month'><i class="fa fa-list"></i> รายเดือน </a>
</span><br><br>
<div id="table-on" class="alist" style="display:block;" >
							
							
						<div class="table-responsive">
                        <table class="table table-striped table-hover"  id="dataTables-example">
                                    <thead>
                                        <tr>     
                                        	<th>NO.</th>
											<th  style="display:none;">UTC</th>
											<th>CODE MONEY</th>
											<th class="text-center">วันที่</th>
											<th>จำนานบัตรที่ขาย</th>
                                            <th>รวม/บาท</th>                                            
                                            <th class="text-center">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                            
												<?php
												
								$sql=$db->DB->prepare("SELECT * FROM pppoe_gen WHERE mt_id='".$id."' GROUP BY money_code");
	                                   $sql->execute();
									  	   $no=0;$tickets=0;$total=0;
                                   while($result = $sql->fetch( PDO::FETCH_ASSOC ))	{			
											 
											$no++;
													$thai= substr("".$result['money_code']."",-30,11);
                                                    if(!empty($result['money_code'])){
					$money=$db->selectquery("SELECT * FROM pppoe_pro WHERE pro_name='".$result['profile']."'");	
					$update=$db->selectquery("SELECT * FROM pppoe_money WHERE money_code='".$result['money_code']."'");	
						
						
													echo "<tr>";
														echo "<td>".($no-1)."</td>";								
													
														 echo "<td  style=\"display:none;\">";
                                                    echo $update['utc_time_for_chart'];
													   
														 echo "</td>";
														 echo "<td>";
                                                     
														    echo $thai;
													   
														 echo "</td>";
														 echo "<td class=\"text-center\">".$convert->Convert_time($result['money_code'])."</td>";
													    echo "<td>";
														echo $update['tickets'];
                                                        echo "</td>";
                                                        echo "<td>";
                                                        echo $update['money'];
                                                        echo "</td>";
														echo "<td class=\"text-center\">";
														 echo"<a class=\"btn btn-black btn-xs\"  title= \"click to view\" href='index.php?page=pppoe_date_list&id=".$result['money_code']."&comment=".$thai."&date_money=".$update['money']."'><span class=\"fa fa-list\"></span> ดูรายการ </a></td>";
														  echo "</tr>";
													   
													$tickets = $tickets + ($update['tickets']);
													$total = $total + ($update['money']);
													
												 }
													}
												?>
												</tbody>
												 <tfoot>     
                                        	<th></th>
											<th></th>
											<th class="text-center"><strong>ยอดรวม</strong></th>
											<th><strong><?php echo $tickets;?></strong></th>
                                            <th><?php echo $total;?></th>                                            
                                            <th class="text-center"></th>
                                        </tfoot>
                                </table>
                                </div>
                                </div>
                            
							 
							  <!-- /.table-on -->

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
			<div id="pppoe_money_by_days" style=" height: 500px; margin: 0 auto">
			<!-- <div id="pppoe_money_by_days" style="min-width: 400px; width: 1000px; height: 500px; margin: 0 auto">	 -->			
							</div> 
							
							</div>
							 <!-- /.chart -->
							 </div>
							  <!-- /.chart-on -->


							</div>
							<!-- ./panel-body -->
							</div>
	<!--  -->
<script type="text/javascript">


$(function () {


var chart;
$(document).ready(function() {
var $pppoe = $('#pppoe_money_by_days'),
	//var chart;
	 chart,
    origChartWidth = 1000,
    origChartHeight = 500,
    chartWidth = origChartWidth,
    chartHeight = origChartHeight;	
Highcharts.setOptions({
 lang: {
	 
            loading: 'กำลังโหลด...',
            months: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
            weekdays: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
            shortMonths: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'],
		    //exportButtonTitle: "Exportar",
           // printButtonTitle: "Imprimir",
            rangeSelectorFrom: "จาก",
            rangeSelectorTo: "ถึง",
            rangeSelectorZoom: "เลือก เพื่อขยาย",
           // downloadPNG: 'Download imagem PNG',
          //  downloadJPEG: 'Download imagem JPEG',
          //  downloadPDF: 'Download documento PDF',
           // downloadSVG: 'Download imagem SVG',
			
            // resetZoom: "Reset",
            // resetZoomTitle: "Reset,
            // thousandsSep: ".",
            // decimalPoint: ','
            },
    global: {
        useUTC: false
    },
     
});
$.getJSON("data/data_pppoe_money_by_days.php", function(json) {
        chart = new Highcharts.stockChart({

        chart: {
			renderTo: 'pppoe_money_by_days',
           // height: 400
			
        },
/*		xAxis: {
        type: 'datetime',
        dateTimeLabelFormats: {
           day: '%b/%d/%Y'    //ex- 01 Jan 2016
        }
},*/
   xAxis: {
        type: 'datetime',
        labels: {
            format: '{value:%d/%b/%Y}',
            rotation: 45,
            align: 'left'

        }
    },
		    plotOptions: {
        series: {
            color: '#00cc00'
        }
    },


        title: {
            text: 'pppoe Money Chart'
        },

        subtitle: {
            text: 'แสดง รวมยอด รายรับ /วัน'
        },

        rangeSelector: {
            selected: 1
        },

        series: [{
            name: 'By Days',
            data: json, 
            type: 'area',

         //  threshold: null,
          //  tooltip: {
         //     valueDecimals: 2
       //   },
	   tooltip: {
       headerFormat: '<span style="font-size:14px">{point.key}</span><span style="font-size:10px"> {series.name}</span><br>',
        pointFormat: '<span  style="font-size:18px">{point.y: ,.0f} บาท</span>',
        
    },
fillColor: {
                linearGradient: {
                    x1: 0,
                    y1: 0,
                    x2: 0,
                    y2: 1
                },
                stops: [
                    [0, Highcharts.getOptions().colors[2]],
                    [1, Highcharts.Color(Highcharts.getOptions().colors[2]).setOpacity(0).get('rgba')]
                ]
            }
        }],

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    chart: {
                        height: 300
                    },
                    subtitle: {
                        text: null
                    },
                    navigator: {
                        enabled: false
                    }
                }
            }]
        }
    });


});
//
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

});
});
</script>
<!--  -->

 <script src="../assets/js/date-time.js"></script>
  </section>

