  $(document).ready(function(){
var timer;

  
       function requestMik() {
		$.ajax({
			url: '../system/data/data_date_time.php',
              // cache: false,
			success: function(data) {
				var DATAMIK = JSON.parse(data);
				if( DATAMIK.length > 0 ) {
					

					
					var panal_uptime=(DATAMIK[0].data);
					$('.mik-up-time').text(panal_uptime);

					var time=(DATAMIK[1].data);
					$('.mik-time').text(time);
					var date=(DATAMIK[2].data);
					$('.mik-date').text(date);
					
	}
			},
		});
					
	};	
var auto_refresh = setInterval(function () {
		requestMik();
     }, 5000);
});		