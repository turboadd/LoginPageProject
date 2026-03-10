  $(document).ready(function(){
var timer;

  
       function requestMik() {
		$.ajax({
			url: '../system/data/data_dashboard.php',
              // cache: false,
			success: function(data) {
				var DATAMIK = JSON.parse(data);
				if( DATAMIK.length > 0 ) {
					
					var cpu_load=(DATAMIK[0].data);
					$('.cpu-load').text(cpu_load);


					var uptime=(DATAMIK[1].data);
					$('.res-up-time').text(uptime);


					var hotspot_active=(DATAMIK[2].data);
					$('.user-online').text(hotspot_active);

					var pppoe_active=(DATAMIK[3].data);
					 $('.pppoe-online').text(pppoe_active);

					var ap_online=(DATAMIK[4].data);
					$('.ap-online').text(ap_online);
					 ///3///
					var panal_uptime=(DATAMIK[5].data);
					$('.up-time').text(panal_uptime);

					var time=(DATAMIK[6].data);
					$('.time').text(time);
					var date=(DATAMIK[7].data);
					$('.date').text(date);
					//3//
	}
			},
		});
					
	};	
var auto_refresh = setInterval(function () {
		requestMik();
     }, 6000);
});		