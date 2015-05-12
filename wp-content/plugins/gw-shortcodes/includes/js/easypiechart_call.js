jQuery(document).ready(function() {		

	if(easypiechart_data1.epc_color) {

		jQuery('.chart1').easyPieChart({
			easing: 'swing',
			barColor: easypiechart_data1.epc_color.toString(),	
			trackColor: easypiechart_data1.epc_trackcolor.toString(),		
			onStep: function(from, to, percent) {
				jQuery(this.el).find('.percent').text(Math.round(percent));
			}
		});
	
	}
	
	if(easypiechart_data2.epc_color) {
	
		jQuery('.chart2').easyPieChart({
			easing: 'swing',
			barColor: easypiechart_data2.epc_color.toString(),	
			trackColor: easypiechart_data2.epc_trackcolor.toString(),		
			onStep: function(from, to, percent) {
				jQuery(this.el).find('.percent').text(Math.round(percent));
			}
		});		
		
	} 
	
	if(easypiechart_data3.epc_color) {

		jQuery('.chart3').easyPieChart({
			easing: 'swing',
			barColor: easypiechart_data3.epc_color.toString(),	
			trackColor: easypiechart_data3.epc_trackcolor.toString(),		
			onStep: function(from, to, percent) {
				jQuery(this.el).find('.percent').text(Math.round(percent));
			}
		});		
		
	} 
	
	if(easypiechart_data4.epc_color) {

		jQuery('.chart4').easyPieChart({
			easing: 'swing',
			barColor: easypiechart_data4.epc_color.toString(),	
			trackColor: easypiechart_data4.epc_trackcolor.toString(),		
			onStep: function(from, to, percent) {
				jQuery(this.el).find('.percent').text(Math.round(percent));
			}
		});		
		
	}
	
			
});