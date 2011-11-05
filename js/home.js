var chart;
$(document).ready(function() {
   chart = new Highcharts.Chart({
      chart: {
         renderTo: 'home_chart',
         defaultSeriesType: 'areaspline',
		 backgroundColor: '#F5F5F5'
      },
      title: "",
      xAxis: {
         categories: [
            'Monday', 
            'Tuesday', 
            'Wednesday', 
            'Thursday', 
            'Friday', 
            'Saturday', 
            'Sunday'
         ],
         plotBands: [{ // visualize the weekend
            from: 2.1,
            to: 4,
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
               this.x +': '+ this.y +' power';
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
      series: [{
         name: 'John',
         data: [300, 400, 300, 500]
      }, {
         name: 'Jane',
         data: [100, 300, 400, 300]
      }]
   });
   
});