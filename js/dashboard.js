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
   
	$.get('api/get_data.php?uid='+glob_uid, function(data) {
	    // Iterate over the lines and add categories or series
		var series = {
			name: "Hello",
		    data: []
		};
		
		var curr = 0;
		var n = 1;
		
	    $.each(data, function(e, k) {
			if (!isNaN(parseFloat(k))) {
				curr += parseFloat(k);
			}
			if (n % 15  == 0) {
				series.data.push(parseFloat(curr) / 15);
				curr = 0;
			}
			n++;
		});
		
		options.series.push(series);
		
	    // Create the chart
	    var chart = new Highcharts.Chart(options);
	});
});