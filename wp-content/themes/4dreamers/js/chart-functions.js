function generateGraph(div_id,type){
	var $ = jQuery;
	var div = $('#'+div_id);
	var title = div.data('title');
	var axis_title = div.data('axis-title');
	var fst_title = div.data('fst-title');
	var sec_title = div.data('sec-title');
	var fst_data = $.map(div.data('fst-data').split(','),function(n){return parseFloat(n);});
	var sec_data = $.map(div.data('sec-data').split(','),function(n){return parseFloat(n);});
	var categories = div.data('categories').split(',');
	
	if(type == 'rainfall'){
		div.highcharts({
				chart: {
					zoomType: 'xy',
					backgroundColor:'rgba(255, 255, 255, 0)'
				},
				title: {
					text: title,
				},
				xAxis: [{
					categories: categories
				}],
				yAxis: [{ // Primary yAxis
					labels: {
						format: '{value}',
						style: {
							//color: Highcharts.getOptions().colors[1]
						}
					},
					title: {
						text: axis_title,
						style: {
							//color: Highcharts.getOptions().colors[1]
						}
					}
				}, { // Secondary yAxis
				   labels: {
						enabled: false
					},
					title: {
						text: null
					}
				}],
				tooltip: {
					shared: true
				},
				legend: {
					layout: 'horizontal',
					align: 'center',
					x: 0,
					verticalAlign: 'bottom',
					y: 0,
					floating: false,
					//backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
				},
				series: [{
					name: fst_title,
					type: 'column',
					yAxis: 1,
					color: '#1cc99b',
					data: fst_data,
					tooltip: {
						valueSuffix: ' mm'
					}

				}, {
					name: sec_title,
					type: 'spline',
					color:'#f73e3e',
					data: sec_data,
				}]
		});
	}else{
		 div.highcharts({
		 	chart: {
					backgroundColor:'rgba(255, 255, 255, 0)'
			},
			title: {
				text: title,
				x: -20 //center
			},
			xAxis: {
				categories: categories
			},
			yAxis: {
				title: {
					text: axis_title,
				},
				plotLines: [{
					value: 0,
					width: 1,
					color: '#808080'
				}]
			},
			tooltip: {
				valueSuffix: ''
			},
			legend: {
				layout: 'horizontal',
				align: 'center',
				verticalAlign: 'bottom',
				borderWidth: 0
			},
			series: [{
				name: fst_title,
				color:'#f73e3e',
				data: fst_data
			}, {
				name: sec_title,
				color: '#1cc99b',
				data: sec_data
			}]
		});
	
	}

}