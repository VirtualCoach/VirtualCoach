var chart;
$(document).ready(function() {
   var options = {
      chart: {
         renderTo: 'dash_chart',
         defaultSeriesType: 'areaspline',
		 backgroundColor: '#F5F5F5'
      },
      title: "",
      xAxis: {
         plotBands: [{ // visualize the weekend
            from: 6.1,
            to: 9,
            color: 'rgba(68, 170, 213, .2)'
         }]
      },
      yAxis: {
         title: {
            text: 'Max Power'
         }
      },
      tooltip: {
         formatter: function() {
                   return ''+
               this.y +' power';
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
		series : []
   };
   
	$.get('api/endpoint.php?uid='+glob_uid+'&m=single&col1=power&col2=power&points=20', function(data) {
	    // Iterate over the lines and add categories or series
		data = jQuery.parseJSON(data);
	
		var series = {
			name: "Hello",
		    data: []
		};
				
	    $.each(data, function(key, val) {
			if (!isNaN(parseFloat(val))) {
				series.data.push(parseFloat(val));
			}
		});
		
		options.series.push(series);
		
	    // Create the chart
	    var chart = new Highcharts.Chart(options);
	});
});