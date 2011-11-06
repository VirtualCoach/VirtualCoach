var chart;
var power_chart;
$(document).ready(function() {
   var options = {
      chart: {
         renderTo: 'dash_chart',
         defaultSeriesType: 'areaspline',
		 backgroundColor: '#F5F5F5'
      },
      title: {
		text: "Last Workout"
	  },
      xAxis: {
         title: {
            text: 'Time'
         }
      },
      yAxis: {
         title: {
            text: 'Max Power'
         }
      },
      tooltip: {
         formatter: function() {
                   return ''+
               this.y;
         }
      },
	  legend: {
		 enabled: false
	  },
      credits: {
         enabled: false
      },
      plotOptions: {
         areaspline: {
            fillOpacity: 0.5
         }
      },
	  exporting: {
		 enabled: true
	  },
		series : [{
			data: []
		}]
   };
	
	chart = new Highcharts.Chart(options);

	function update_main_chart() {
		//console.log("Update");
		var val1 = $("#col1").val();
		var val2 = "";//$("#col2").val();
		var points = $("#points").val();
		var type = "single"; //val2 == "" ? "single" : "multiple";
		var url = get_url(type, val1, val2, points);

		var dtab = [];

		$.get(url, function(data) {
		    // Iterate over the lines and add categories or series
			data = jQuery.parseJSON(data);

			var series = {
				name: "Hello",
			    data: []
			};

		    $.each(data, function(key, val) {
				if (!isNaN(parseFloat(val))) {
					dtab.push(parseFloat(val));
				}
			});
			
			chart.series[0].setData(dtab, false);
			$(chart.yAxis[0].axisTitle.element).text(val1);
			chart.redraw();
		});

		//console.log(chart.series[0]);

		
	}
	
	$("#col1").change(function() { update_main_chart(); });
	//$("#col2").change(function() { update_main_chart(); });
	$("#points").change(function() { update_main_chart(); });
	
	update_main_chart();
	
	
	
	
	
	
	
	
	
	
	
	var options2 = {
	      chart: {
	         renderTo: 'rider_profile_chart',
	         defaultSeriesType: 'areaspline',
			 backgroundColor: '#F5F5F5'
	      },
	      title: {
			text: ""
		  },
	      xAxis: {
	         title: {
	            text: 'Time'
	         },
	         plotBands: []
	      },
	      yAxis: {
	         title: {
	            text: 'MMP'
	         }
	      },
	      tooltip: {
	         formatter: function() {
	                   return ''+
	               this.y;
	         }
	      },
		  legend: {
			 enabled: false
		  },
	      credits: {
	         enabled: false
	      },
	      plotOptions: {
	         areaspline: {
	            fillOpacity: 0.5
	         }
	      },
		  exporting: {
			 enabled: false
		  },
			series : [{
				data: [0, 0, 0, 0]
			}]
	   };
		
		var mmp = [];
		var mmpurl = get_url("getmmp", "", "", $("#ppoints").val());
		
		$.get(mmpurl, function(data) {
		    // Iterate over the lines and add categories or series
			data = jQuery.parseJSON(data);

		    $.each(data, function(key, val) {
				if (!isNaN(parseFloat(val))) {
					mmp.push(parseFloat(val));
				}
			});
			
			update_power_chart();
		});
		
		var plot_band_ids = [];
		power_chart = new Highcharts.Chart(options2);

		function update_power_chart() {
			//console.log("Update");
			var val1 = $("#pcol1").val();
			var points = $("#ppoints").val();
			var type = "x_mmp";
			var url = get_url(type, val1, 0, points);

			var dtab = [];

			$.get(url, function(data) {
			    // Iterate over the lines and add categories or series
				data = jQuery.parseJSON(data);
				
				var i = 0;
			    $.each(data, function(key, val) {
					if (!isNaN(parseFloat(val))) {
						dtab.push([parseFloat(val), mmp[i]]);
					}
					i++;
				});
				
				var j = 0;
				$.each(plot_band_ids, function(key, val) {
					power_chart.xAxis[0].removePlotBand(val);
				});
				if (val1 == "t") {
			
					power_chart.xAxis[0].addPlotBand({
			            from: 0,
			            to: 6,
			            color: 'rgba(243, 21, 19, .2)',
						id: "band1"
			         });
			
					power_chart.xAxis[0].addPlotBand({
			            from: 6,
			            to: 30,
			            color: 'rgba(243, 125, 6, .2)',
						id: "band2"
			         });
					
					power_chart.xAxis[0].addPlotBand({
			            from: 30,
			            to: 60,
			            color: 'rgba(255, 255, 0, .2)',
						id: "band3"
			         });
			
					power_chart.xAxis[0].addPlotBand({
			            from: 60,
			            to: 500,
			            color: 'rgba(19, 255, 2, .2)',
						id: "band4"
			         });
			
					plot_band_ids = ["band1", "band2", "band3", "band4"];
					
				}

				power_chart.series[0].setData(dtab, false);
				$(power_chart.xAxis[0].axisTitle.element).text(val1);
				power_chart.redraw();
			});


		}

		$("#pcol1").change(function() { update_power_chart(); });
		$("#ppoints").change(function() { update_power_chart(); });
});
