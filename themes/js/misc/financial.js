var blue	= '#1E67A9';
var green	= '#499342';
var red		= '#AC212F';
var orange	= '#FF901A';

var chart;





$(document).ready(function(){	
	
	/*= START MONTHLY SETTLEMENT SUMMARY*/
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'monthly_settlement_summary',
			marginTop: 50
		},
		xAxis: {
			categories: eval(monthly_settlement_summary_data['x_axis'])
		},
		yAxis: [{
				//min: 0,
				title: {
					text: 'Amount ($)',
					style: {
						fontFamily: 'Arial',
						fontWeight: 'bold',
						color: blue
					}
				},
				stackLabels: {
					enabled: false,
					style: {
						fontWeight: 'bold',
						color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
					}
				},
				labels: {							
					/*style: {
						fontWeight: 'bold',
						color: blue	
					}*/
				},
			},{
				title: {
					text: 'Total',
					style: {
						fontFamily: 'Arial',
						fontWeight: 'bold',
						color: orange
					},
					rotation: -90
				},
				stackLabels: {
					enabled: false,
					style: {
						fontWeight: 'bold',
						color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
					}
				},
				labels: {		
					//formatter: function() {
						//return this.value +'°C';
					//},					
					//style: {
						//fontWeight: 'bold',
						//color: blue	
					//}
				},
				linkedTo: 0,
				opposite: true
			}
		],
		title:'',
		labels: {
			/*items: [{
				html: 'Total fruit consumption',
				style: {
					left: '40px',
					top: '8px',
					color: 'black'
				}
			}]*/
		},
		legend: {
			align: 'center',
			x: 0,
			verticalAlign: 'top',
			y: 0,
			floating: true,
			backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
			borderColor: '#CCC',
			borderWidth: 1,
			/*width:350,*/
			shadow: false
		},
		tooltip: {
			formatter: function() {
				return '<b>'+ this.x.replace('<br />',' ') +'</b><br/>'+
					this.series.name +': '+ this.y +'<br/>';
					//'Total: '+ this.point.stackTotal;
			}
		},
		plotOptions: {
			column: {
				stacking: 'normal',
				dataLabels: {
					enabled: false,
					color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
				}
			}
		},
		series: [{
			type: 'column',
			name: 'Open',
			data: eval(monthly_settlement_summary_data['open']),
			pointWidth: 25
		}, {
			type: 'column',
			name: 'Closed',
			data: eval(monthly_settlement_summary_data['closed']),
			pointWidth: 25
		
		}, {
			type: 'spline',
			name: 'Total',
			data: eval(monthly_settlement_summary_data['total']),
			yAxis: 1,
		}],
		colors: [
			blue, 
			red, 
			orange, 
			green, 
			'#3D96AE', 
			'#DB843D', 
			'#92A8CD', 
			'#A47D7C', 
			'#B5CA92'
		]
	});
	/*= END MONTHLY SETTLEMENT SUMMARY*/
	
	/*= START WEEKLY SETTLEMENT SUMMARY*/
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'weekly_settlement_summary',
			marginTop: 50
		},
		xAxis: {
			categories: eval(weekly_settlement_summary_data['x_axis'])
		},
		yAxis: [{
				//min: 0,
				title: {
					text: 'Amount ($)',
					style: {
						fontFamily: 'Arial',
						fontWeight: 'bold',
						color: blue
					}
				},
				stackLabels: {
					enabled: false,
					style: {
						fontWeight: 'bold',
						color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
					}
				},
				labels: {							
					/*style: {
						fontWeight: 'bold',
						color: blue	
					}*/
				},
			},{
				title: {
					text: 'Total',
					style: {
						fontFamily: 'Arial',
						fontWeight: 'bold',
						color: orange
					},
					rotation: -90
				},
				stackLabels: {
					enabled: false,
					style: {
						fontWeight: 'bold',
						color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
					}
				},
				labels: {		
					//formatter: function() {
						//return this.value +'°C';
					//},					
					//style: {
						//fontWeight: 'bold',
						//color: blue	
					//}
				},
				linkedTo: 0,
				opposite: true
			}
		],
		title:'',
		labels: {
			/*items: [{
				html: 'Total fruit consumption',
				style: {
					left: '40px',
					top: '8px',
					color: 'black'
				}
			}]*/
		},
		legend: {
			align: 'center',
			x: 0,
			verticalAlign: 'top',
			y: 0,
			floating: true,
			backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
			borderColor: '#CCC',
			borderWidth: 1,
			/*width:350,*/
			shadow: false
		},
		tooltip: {
			formatter: function() {
				return '<b>'+ this.x.replace('<br />',' ') +'</b><br/>'+
					this.series.name +': '+ this.y +'<br/>';
					//'Total: '+ this.point.stackTotal;
			}
		},
		plotOptions: {
			column: {
				stacking: 'normal',
				dataLabels: {
					enabled: false,
					color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
				}
			}
		},
		series: [{
			type: 'column',
			name: 'Open',
			data: eval(weekly_settlement_summary_data['open']),
			pointWidth: 25
		}, {
			type: 'column',
			name: 'Closed',
			data: eval(weekly_settlement_summary_data['closed']),
			pointWidth: 25
		
		}, {
			type: 'spline',
			name: 'Total',
			data: eval(weekly_settlement_summary_data['total']),
			yAxis: 1,
		}],
		colors: [
			blue, 
			red, 
			orange, 
			green, 
			'#3D96AE', 
			'#DB843D', 
			'#92A8CD', 
			'#A47D7C', 
			'#B5CA92'
		]
	});
	/*= END WEEKLY SETTLEMENT SUMMARY*/
	
	/*= START DAILY SETTLEMENT SUMMARY*/
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'daily_settlement_summary',
			marginTop: 50
		},
		xAxis: {
			categories: eval(daily_settlement_summary_data['x_axis'])
		},
		yAxis: [{
				//min: 0,
				title: {
					text: 'Amount ($)',
					style: {
						fontFamily: 'Arial',
						fontWeight: 'bold',
						color: blue
					}
				},
				stackLabels: {
					enabled: false,
					style: {
						fontWeight: 'bold',
						color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
					}
				},
				labels: {							
					/*style: {
						fontWeight: 'bold',
						color: blue	
					}*/
				},
			},{
				title: {
					text: 'Total',
					style: {
						fontFamily: 'Arial',
						fontWeight: 'bold',
						color: orange
					},
					rotation: -90
				},
				stackLabels: {
					enabled: false,
					style: {
						fontWeight: 'bold',
						color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
					}
				},
				labels: {		
					//formatter: function() {
						//return this.value +'°C';
					//},					
					//style: {
						//fontWeight: 'bold',
						//color: blue	
					//}
				},
				linkedTo: 0,
				opposite: true
			}
		],
		tooltip: {
			formatter: function() {
				return '<b>'+ this.x.replace('<br />',' ') +'</b><br/>'+
					this.series.name +': '+ this.y +'<br/>';
					//'Total: '+ this.point.stackTotal;
			}
		},
		title:'',
		labels: {
			/*items: [{
				html: 'Total fruit consumption',
				style: {
					left: '40px',
					top: '8px',
					color: 'black'
				}
			}]*/
		},
		legend: {
			align: 'center',
			x: 0,
			verticalAlign: 'top',
			y: 0,
			floating: true,
			backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
			borderColor: '#CCC',
			borderWidth: 1,
			/*width:350,*/
			shadow: false
		},
		plotOptions: {
			column: {
				stacking: 'normal',
				dataLabels: {
					enabled: false,
					color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
				}
			}
		},
		series: [{
			type: 'column',
			name: 'Open',
			data: eval(daily_settlement_summary_data['open']),
			pointWidth: 25
		}, {
			type: 'column',
			name: 'Closed',
			data: eval(daily_settlement_summary_data['closed']),
			pointWidth: 25
		
		}, {
			type: 'spline',
			name: 'Total',
			data: eval(daily_settlement_summary_data['total']),
			yAxis: 1,
		}],
		colors: [
			blue, 
			red, 
			orange, 
			green, 
			'#3D96AE', 
			'#DB843D', 
			'#92A8CD', 
			'#A47D7C', 
			'#B5CA92'
		]
	});
	/*= END DAILY SETTLEMENT SUMMARY*/
	
	
	
	/*= MONTHLY CC INVOICES*/
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'monthly_cc_invoices',
			marginTop: 70
		},
		xAxis: {
			categories: eval(monthly_cc_invoices_data['x_axis'])
		},
		yAxis: [{
				//min: 0,
				title: {
					text: 'Invoice Amount ($)',
					style: {
						fontFamily: 'Arial',
						fontWeight: 'bold',
						color: blue
					}
				},
				stackLabels: {
					enabled: false,
					style: {
						fontWeight: 'bold',
						color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
					}
				},
				labels: { /*style: { fontWeight: 'bold', color: blue}*/ },
			},{
				min: 0,
				title: {
					text: '# of Payments',
					style: {
						fontFamily: 'Arial',
						fontWeight: 'bold',
						color: orange
					},
					rotation: -90
				},
				stackLabels: {
					enabled: false,
					style: {
						fontWeight: 'bold',
						color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
					}
				},
				labels: {		
					//formatter: function() {
						//return this.value +'°C';
					//},					
					//style: {
						//fontWeight: 'bold',
						//color: blue	
					//}
				},
				//linkedTo: 0,
				opposite: true
			}
		],
		title:'',
		labels: {/*items: [{ html: 'Total fruit consumption', style: {left: '40px',top: '8px',color: 'black'}}]*/},
		legend: {
			align: 'center',
			x: 0,
			verticalAlign: 'top',
			y: 0,
			floating: true,
			backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
			borderColor: '#CCC',
			borderWidth: 1,
			//width:330,
			shadow: false,
		},
		tooltip: {
			formatter: function() {
				return '<b>'+ this.x.replace('<br />',' ') +'</b><br/>'+
					this.series.name +': '+ this.y +'<br/>';
					//'Total: '+ this.point.stackTotal;
			}
		},
		plotOptions: {
			column: {
				stacking: 'normal',
				dataLabels: {
					enabled: false,
					color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
				}
			}
		},
		series: [{
			type: 'column',
			name: 'Remaining',
			data: eval(monthly_cc_invoices_data['remaining']),
			pointWidth: 25
		
		}, {
			type: 'column',
			name: 'Overdue',
			data: eval(monthly_cc_invoices_data['overdue']),
			pointWidth: 25
		}, {
			type: 'column',
			name: 'Paid',
			data: eval(monthly_cc_invoices_data['paid']),
			pointWidth: 25
		}, {
			type: 'spline',
			name: '# of Payments',
			data: eval(monthly_cc_invoices_data['payments']),
			yAxis: 1,
		}],
		colors: [
			blue, 
			red, 
			green, 
			orange, 
			'#3D96AE', 
			'#DB843D', 
			'#92A8CD', 
			'#A47D7C', 
			'#B5CA92'
		]
	});
	/*= END MONTHLY CC INVOICES*/
	
	
	/*= MONTHLY ACH INVOICES */
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'monthly_ach_invoices',
			marginTop: 70
		},
		xAxis: {
			categories: eval(monthly_ach_invoices_data['x_axis'])
		},
		yAxis: [{
				//min: 0,
				title: {
					text: 'Invoice Amount ($)',
					style: {
						fontFamily: 'Arial',
						fontWeight: 'bold',
						color: blue
					}
				},
				stackLabels: {
					enabled: false,
					style: {
						fontWeight: 'bold',
						color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
					}
				},
				labels: { /*style: { fontWeight: 'bold', color: blue}*/ },
			},{
				min: 0,
				title: {
					text: '# of Payments',
					style: {
						fontFamily: 'Arial',
						fontWeight: 'bold',
						color: orange
					},
					rotation: -90
				},
				stackLabels: {
					enabled: false,
					style: {
						fontWeight: 'bold',
						color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
					}
				},
				labels: {		
					//formatter: function() {
						//return this.value +'°C';
					//},					
					//style: {
						//fontWeight: 'bold',
						//color: blue	
					//}
				},
				//linkedTo: 0,
				opposite: true
			}
		],
		title:'',
		labels: {/*items: [{ html: 'Total fruit consumption', style: {left: '40px',top: '8px',color: 'black'}}]*/},
		legend: {
			align: 'center',
			x: 0,
			verticalAlign: 'top',
			y: 0,
			floating: true,
			backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
			borderColor: '#CCC',
			borderWidth: 1,
			//width:330,
			shadow: false,
		},
		tooltip: {
			formatter: function() {
				return '<b>'+ this.x.replace('<br />',' ') +'</b><br/>'+
					this.series.name +': '+ this.y +'<br/>';
					//'Total: '+ this.point.stackTotal;
			}
		},
		plotOptions: {
			column: {
				stacking: 'normal',
				dataLabels: {
					enabled: false,
					color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
				}
			}
		},
		series: [{
			type: 'column',
			name: 'Remaining',
			data: eval(monthly_ach_invoices_data['remaining']),
			pointWidth: 25
		
		}, {
			type: 'column',
			name: 'Overdue',
			data: eval(monthly_ach_invoices_data['overdue']),
			pointWidth: 25
		}, {
			type: 'column',
			name: 'Paid',
			data: eval(monthly_ach_invoices_data['paid']),
			pointWidth: 25
		}, {
			type: 'spline',
			name: '# of Payments',
			data: eval(monthly_ach_invoices_data['payments']),
			yAxis: 1,
		}],
		colors: [
			blue, 
			red, 
			green, 
			orange, 
			'#3D96AE', 
			'#DB843D', 
			'#92A8CD', 
			'#A47D7C', 
			'#B5CA92'
		]
	});
	/*= END MONTHLY ACH INVOICES*/
	
	
	/*= MONTHLY NEW CUSTOMERS */
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'monthly_new_customers',
			marginTop: 70
		},
		xAxis: {
			categories: eval(monthly_ach_invoices_data['x_axis'])
		},
		yAxis: [{
				min: 0,
				title: {
					text: 'Invoice Amount ($)',
					style: {
						fontFamily: 'Arial',
						fontWeight: 'bold',
						color: blue
					}
				},
				stackLabels: {
					enabled: false,
					style: {
						fontWeight: 'bold',
						color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
					}
				},
				labels: { /*style: { fontWeight: 'bold', color: blue}*/ },
			},{
				min: 0,
				title: {
					text: '# of Payments',
					style: {
						fontFamily: 'Arial',
						fontWeight: 'bold',
						color: orange
					},
					rotation: -90
				},
				stackLabels: {
					enabled: false,
					style: {
						fontWeight: 'bold',
						color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
					}
				},
				labels: {		
					//formatter: function() {
						//return this.value +'°C';
					//},					
					//style: {
						//fontWeight: 'bold',
						//color: blue	
					//}
				},
				//linkedTo: 0,
				opposite: true
			}
		],
		title:'',
		labels: {/*items: [{ html: 'Total fruit consumption', style: {left: '40px',top: '8px',color: 'black'}}]*/},
		legend: {
			align: 'center',
			x: 0,
			verticalAlign: 'top',
			y: 0,
			floating: true,
			backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
			borderColor: '#CCC',
			borderWidth: 1,
			//width:330,
			shadow: false,
		},
		tooltip: {
			formatter: function() {
				return '<b>'+ this.x.replace('<br />',' ') +'</b><br/>'+
					this.series.name +': '+ this.y +'<br/>';
					//'Total: '+ this.point.stackTotal;
			}
		},
		plotOptions: {
			column: {
				stacking: 'normal',
				dataLabels: {
					enabled: false,
					color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
				}
			}
		},
		series: [{
			type: 'column',
			name: 'CC',
			data: eval(m_new_customer_data['cc']),
			pointWidth: 25
		}, {
			type: 'column',
			name: 'ACH',
			data: eval(m_new_customer_data['ach']),
			pointWidth: 25
		}, {
			type: 'spline',
			name: '# of Payments',
			data: eval(m_new_customer_data['payments']),
			yAxis: 1,
		}],
		colors: [
			red, 
			blue, 
			orange, 
			green, 
			'#3D96AE', 
			'#DB843D', 
			'#92A8CD', 
			'#A47D7C', 
			'#B5CA92'
		]
	});
	/*= END MONTHLY NEW CUSTOMERS */
	
	/*= WEEKLY CC INVOICES*/
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'weekly_cc_invoices',
			marginTop: 70
		},
		xAxis: {
			categories: eval(weekly_cc_invoices_data['x_axis'])
		},
		yAxis: [{
				//min: 0,
				title: {
					text: 'Invoice Amount ($)',
					style: {
						fontFamily: 'Arial',
						fontWeight: 'bold',
						color: blue
					}
				},
				stackLabels: {
					enabled: false,
					style: {
						fontWeight: 'bold',
						color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
					}
				},
				labels: { /*style: { fontWeight: 'bold', color: blue}*/ },
			},{
				title: {
					text: '# of Payments',
					style: {
						fontFamily: 'Arial',
						fontWeight: 'bold',
						color: orange
					},
					rotation: -90
				},
				stackLabels: {
					enabled: false,
					style: {
						fontWeight: 'bold',
						color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
					}
				},
				labels: {		
					//formatter: function() {
						//return this.value +'°C';
					//},					
					//style: {
						//fontWeight: 'bold',
						//color: blue	
					//}
				},
				//linkedTo: 0,
				opposite: true
			}
		],
		title:'',
		labels: {/*items: [{ html: 'Total fruit consumption', style: {left: '40px',top: '8px',color: 'black'}}]*/},
		legend: {
			align: 'center',
			x: 0,
			verticalAlign: 'top',
			y: 0,
			floating: true,
			backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
			borderColor: '#CCC',
			borderWidth: 1,
			//width:330,
			shadow: false,
		},
		tooltip: {
			formatter: function() {
				return '<b>'+ this.x.replace('<br />',' ') +'</b><br/>'+
					this.series.name +': '+ this.y +'<br/>';
					//'Total: '+ this.point.stackTotal;
			}
		},
		plotOptions: {
			column: {
				stacking: 'normal',
				dataLabels: {
					enabled: false,
					color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
				}
			}
		},
		series: [{
			type: 'column',
			name: 'Remaining',
			data: eval(weekly_cc_invoices_data['remaining']),
			pointWidth: 25
		
		}, {
			type: 'column',
			name: 'Overdue',
			data: eval(weekly_cc_invoices_data['overdue']),
			pointWidth: 25
		}, {
			type: 'column',
			name: 'Paid',
			data: eval(weekly_cc_invoices_data['paid']),
			pointWidth: 25
		}, {
			type: 'spline',
			name: '# of Payments',
			data: eval(weekly_cc_invoices_data['payments']),
			yAxis: 1,
		}],
		colors: [
			blue, 
			red, 
			green, 
			orange, 
			'#3D96AE', 
			'#DB843D', 
			'#92A8CD', 
			'#A47D7C', 
			'#B5CA92'
		]
	});
	/*= END WEEKLY CC INVOICES*/
	
	
	/*= WEEKLY ACH INVOICES */
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'weekly_ach_invoices',
			marginTop: 70
		},
		xAxis: {
			categories: eval(weekly_ach_invoices_data['x_axis'])
		},
		yAxis: [{
				//min: 0,
				title: {
					text: 'Invoice Amount ($)',
					style: {
						fontFamily: 'Arial',
						fontWeight: 'bold',
						color: blue
					}
				},
				stackLabels: {
					enabled: false,
					style: {
						fontWeight: 'bold',
						color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
					}
				},
				labels: { /*style: { fontWeight: 'bold', color: blue}*/ },
			},{
				min: 0,
				title: {
					text: '# of Payments',
					style: {
						fontFamily: 'Arial',
						fontWeight: 'bold',
						color: orange
					},
					rotation: -90
				},
				stackLabels: {
					enabled: false,
					style: {
						fontWeight: 'bold',
						color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
					}
				},
				labels: {		
					//formatter: function() {
						//return this.value +'°C';
					//},					
					//style: {
						//fontWeight: 'bold',
						//color: blue	
					//}
				},
				//linkedTo: 0,
				opposite: true
			}
		],
		title:'',
		labels: {/*items: [{ html: 'Total fruit consumption', style: {left: '40px',top: '8px',color: 'black'}}]*/},
		legend: {
			align: 'center',
			x: 0,
			verticalAlign: 'top',
			y: 0,
			floating: true,
			backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
			borderColor: '#CCC',
			borderWidth: 1,
			//width:330,
			shadow: false,
		},
		tooltip: {
			formatter: function() {
				return '<b>'+ this.x.replace('<br />',' ') +'</b><br/>'+
					this.series.name +': '+ this.y +'<br/>';
					//'Total: '+ this.point.stackTotal;
			}
		},
		plotOptions: {
			column: {
				stacking: 'normal',
				dataLabels: {
					enabled: false,
					color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
				}
			}
		},
		series: [{
			type: 'column',
			name: 'Remaining',
			data: eval(weekly_ach_invoices_data['remaining']),
			pointWidth: 25
		
		}, {
			type: 'column',
			name: 'Overdue',
			data: eval(weekly_ach_invoices_data['overdue']),
			pointWidth: 25
		}, {
			type: 'column',
			name: 'Paid',
			data: eval(weekly_ach_invoices_data['paid']),
			pointWidth: 25
		}, {
			type: 'spline',
			name: '# of Payments',
			data: eval(weekly_ach_invoices_data['payments']),
			yAxis: 1,
		}],
		colors: [
			blue, 
			red, 
			green, 
			orange, 
			'#3D96AE', 
			'#DB843D', 
			'#92A8CD', 
			'#A47D7C', 
			'#B5CA92'
		]
	});
	/*= END WEEKLY ACH INVOICES */
	
	
	/*= WEEKLY NEW CUSTOMERS */
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'weekly_new_customers',
			marginTop: 70
		},
		xAxis: {
			categories: eval(w_new_customer_data['x_axis'])
		},
		yAxis: [{
				min: 0,
				title: {
					text: 'Invoice Amount ($)',
					style: {
						fontFamily: 'Arial',
						fontWeight: 'bold',
						color: blue
					}
				},
				stackLabels: {
					enabled: false,
					style: {
						fontWeight: 'bold',
						color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
					}
				},
				labels: { /*style: { fontWeight: 'bold', color: blue}*/ },
			},{
				min: 0,
				title: {
					text: '# of Payments',
					style: {
						fontFamily: 'Arial',
						fontWeight: 'bold',
						color: orange
					},
					rotation: -90
				},
				stackLabels: {
					enabled: false,
					style: {
						fontWeight: 'bold',
						color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
					}
				},
				labels: {		
					//formatter: function() {
						//return this.value +'°C';
					//},					
					//style: {
						//fontWeight: 'bold',
						//color: blue	
					//}
				},
				//linkedTo: 0,
				opposite: true
			}
		],
		title:'',
		labels: {/*items: [{ html: 'Total fruit consumption', style: {left: '40px',top: '8px',color: 'black'}}]*/},
		legend: {
			align: 'center',
			x: 0,
			verticalAlign: 'top',
			y: 0,
			floating: true,
			backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
			borderColor: '#CCC',
			borderWidth: 1,
			//width:330,
			shadow: false,
		},
		tooltip: {
			formatter: function() {
				return '<b>'+ this.x.replace('<br />',' ') +'</b><br/>'+
					this.series.name +': '+ this.y +'<br/>';
					//'Total: '+ this.point.stackTotal;
			}
		},
		plotOptions: {
			column: {
				stacking: 'normal',
				dataLabels: {
					enabled: false,
					color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
				}
			}
		},
		series: [{
			type: 'column',
			name: 'CC',
			data: eval(w_new_customer_data['cc']),
			pointWidth: 25
		}, {
			type: 'column',
			name: 'ACH',
			data: eval(w_new_customer_data['ach']),
			pointWidth: 25
		}, {
			type: 'spline',
			name: '# of Payments',
			data: eval(w_new_customer_data['payments']),
			yAxis: 1,
		}],
		colors: [
			red, 
			blue, 
			orange, 
			green, 
			'#3D96AE', 
			'#DB843D', 
			'#92A8CD', 
			'#A47D7C', 
			'#B5CA92'
		]
	});
	/*= END WEEKLY NEW CUSTOMERS */
	
	/*= DAILY CC INVOICES*/
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'daily_cc_invoices',
			marginTop: 70
		},
		xAxis: {
			categories: eval(daily_cc_invoices_data['x_axis'])
		},
		yAxis: [{
				//min: 0,
				title: {
					text: 'Invoice Amount ($)',
					style: {
						fontFamily: 'Arial',
						fontWeight: 'bold',
						color: blue
					}
				},
				stackLabels: {
					enabled: false,
					style: {
						fontWeight: 'bold',
						color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
					}
				},
				labels: { /*style: { fontWeight: 'bold', color: blue}*/ },
			},{
				min:0,
				title: {
					text: '# of Payments',
					style: {
						fontFamily: 'Arial',
						fontWeight: 'bold',
						color: orange
					},
					rotation: -90
				},
				stackLabels: {
					enabled: false,
					style: {
						fontWeight: 'bold',
						color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
					}
				},
				labels: {		
					//formatter: function() {
						//return this.value +'°C';
					//},					
					//style: {
						//fontWeight: 'bold',
						//color: blue	
					//}
				},
				//linkedTo: 0,
				opposite: true
			}
		],
		title:'',
		labels: {/*items: [{ html: 'Total fruit consumption', style: {left: '40px',top: '8px',color: 'black'}}]*/},
		legend: {
			align: 'center',
			x: 0,
			verticalAlign: 'top',
			y: 0,
			floating: true,
			backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
			borderColor: '#CCC',
			borderWidth: 1,
			//width:330,
			shadow: false,
		},
		tooltip: {
			formatter: function() {
				return '<b>'+ this.x.replace('<br />',' ') +'</b><br/>'+
					this.series.name +': '+ this.y +'<br/>';
					//'Total: '+ this.point.stackTotal;
			}
		},
		plotOptions: {
			column: {
				stacking: 'normal',
				dataLabels: {
					enabled: false,
					color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
				}
			}
		},
		series: [{
			type: 'column',
			name: 'Remaining',
			data: eval(daily_cc_invoices_data['remaining']),
			pointWidth: 25
		
		}, {
			type: 'column',
			name: 'Overdue',
			data: eval(daily_cc_invoices_data['overdue']),
			pointWidth: 25
		}, {
			type: 'column',
			name: 'Paid',
			data: eval(daily_cc_invoices_data['paid']),
			pointWidth: 25
		}, {
			type: 'spline',
			name: '# of Payments',
			data: eval(daily_cc_invoices_data['payments']),
			yAxis: 1,
		}],
		colors: [
			blue, 
			red, 
			green, 
			orange, 
			'#3D96AE', 
			'#DB843D', 
			'#92A8CD', 
			'#A47D7C', 
			'#B5CA92'
		]
	});
	/*= END DAILY CC INVOICES*/
	
	
	/*= DAILY ACH INVOICES */
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'daily_ach_invoices',
			marginTop: 70
		},
		xAxis: {
			categories: eval(daily_ach_invoices_data['x_axis'])
		},
		yAxis: [{
				//min: 0,
				title: {
					text: 'Invoice Amount ($)',
					style: {
						fontFamily: 'Arial',
						fontWeight: 'bold',
						color: blue
					}
				},
				stackLabels: {
					enabled: false,
					style: {
						fontWeight: 'bold',
						color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
					}
				},
				labels: { /*style: { fontWeight: 'bold', color: blue}*/ },
			},{
				min: 0,
				title: {
					text: '# of Payments',
					style: {
						fontFamily: 'Arial',
						fontWeight: 'bold',
						color: orange
					},
					rotation: -90
				},
				stackLabels: {
					enabled: false,
					style: {
						fontWeight: 'bold',
						color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
					}
				},
				labels: {		
					//formatter: function() {
						//return this.value +'°C';
					//},					
					//style: {
						//fontWeight: 'bold',
						//color: blue	
					//}
				},
				//linkedTo: 0,
				opposite: true
			}
		],
		title:'',
		labels: {/*items: [{ html: 'Total fruit consumption', style: {left: '40px',top: '8px',color: 'black'}}]*/},
		legend: {
			align: 'center',
			x: 0,
			verticalAlign: 'top',
			y: 0,
			floating: true,
			backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
			borderColor: '#CCC',
			borderWidth: 1,
			//width:330,
			shadow: false,
		},
		tooltip: {
			formatter: function() {
				return '<b>'+ this.x.replace('<br />',' ') +'</b><br/>'+
					this.series.name +': '+ this.y +'<br/>';
					//'Total: '+ this.point.stackTotal;
			}
		},
		plotOptions: {
			column: {
				stacking: 'normal',
				dataLabels: {
					enabled: false,
					color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
				}
			}
		},
		series: [{
			type: 'column',
			name: 'Remaining',
			data: eval(daily_ach_invoices_data['remaining']),
			pointWidth: 25
		
		}, {
			type: 'column',
			name: 'Overdue',
			data: eval(daily_ach_invoices_data['overdue']),
			pointWidth: 25
		}, {
			type: 'column',
			name: 'Paid',
			data: eval(daily_ach_invoices_data['paid']),
			pointWidth: 25
		}, {
			type: 'spline',
			name: '# of Payments',
			data: eval(daily_ach_invoices_data['payments']),
			yAxis: 1,
		}],
		colors: [
			blue, 
			red, 
			green, 
			orange, 
			'#3D96AE', 
			'#DB843D', 
			'#92A8CD', 
			'#A47D7C', 
			'#B5CA92'
		]
	});
	/*= END DAILY ACH INVOICES */
	
	
	/*= DAILY NEW CUSTOMERS */
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'daily_new_customers',
			marginTop: 70
		},
		xAxis: {
			categories: eval(d_new_customer_data['x_axis'])
		},
		yAxis: [{
				min: 0,
				title: {
					text: 'Invoice Amount ($)',
					style: {
						fontFamily: 'Arial',
						fontWeight: 'bold',
						color: blue
					}
				},
				stackLabels: {
					enabled: false,
					style: {
						fontWeight: 'bold',
						color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
					}
				},
				labels: { /*style: { fontWeight: 'bold', color: blue}*/ },
			},{
				min: 0,
				title: {
					text: '# of Payments',
					style: {
						fontFamily: 'Arial',
						fontWeight: 'bold',
						color: orange
					},
					rotation: -90
				},
				stackLabels: {
					enabled: false,
					style: {
						fontWeight: 'bold',
						color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
					}
				},
				labels: {		
					//formatter: function() {
						//return this.value +'°C';
					//},					
					//style: {
						//fontWeight: 'bold',
						//color: blue	
					//}
				},
				//linkedTo: 0,
				opposite: true
			}
		],
		title:'',
		labels: {/*items: [{ html: 'Total fruit consumption', style: {left: '40px',top: '8px',color: 'black'}}]*/},
		legend: {
			align: 'center',
			x: 0,
			verticalAlign: 'top',
			y: 0,
			floating: true,
			backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
			borderColor: '#CCC',
			borderWidth: 1,
			//width:330,
			shadow: false,
		},
		tooltip: {
			formatter: function() {
				return '<b>'+ this.x.replace('<br />',' ') +'</b><br/>'+
					this.series.name +': '+ this.y +'<br/>';
					//'Total: '+ this.point.stackTotal;
			}
		},
		plotOptions: {
			column: {
				stacking: 'normal',
				dataLabels: {
					enabled: false,
					color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
				}
			}
		},
		series: [{
			type: 'column',
			name: 'CC',
			data: eval(d_new_customer_data['cc']),
			pointWidth: 25
		}, {
			type: 'column',
			name: 'ACH',
			data: eval(d_new_customer_data['ach']),
			pointWidth: 25
		}, {
			type: 'spline',
			name: '# of Payments',
			data: eval(d_new_customer_data['payments']),
			yAxis: 1,
		}],
		colors: [
			red, 
			blue, 
			orange, 
			green, 
			'#3D96AE', 
			'#DB843D', 
			'#92A8CD', 
			'#A47D7C', 
			'#B5CA92'
		]
	});
	/*= END DAILY NEW CUSTOMERS */
	

/* =============================================================================================================== */

	/*= SETTLEMENT SUMMARY SWITCH */
	$("select[name='summary_switch']").change(function(){
        var v=$(this).find('option:selected').val();
		var el;
		if(v=='1') el=$("#monthly_settlement_summary, #line_chart_4, .monthly");
		if(v=='2') el=$("#weekly_settlement_summary, #line_chart_5, .weekly");
		if(v=='3') el=$("#daily_settlement_summary, #line_chart_6, .daily");
		
        $("#monthly_settlement_summary, #weekly_settlement_summary, #daily_settlement_summary, #line_chart_4, #line_chart_5, #line_chart_6, .monthly, .weekly, .daily")
			.not(el).hide();
        el.fadeIn();
        
    })
	/*= END SETTLEMENT SUMMARY SWITCH */
				
	$("tspan:contains('Highcharts.com')").remove();
})