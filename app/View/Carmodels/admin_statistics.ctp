<?php
//Cases:
//1. Can see car-model test drive requests per days basis
//2. Can see carmodel test drive requests per months basis
//3. Can see carmodel test drive requests per year basis
//default It will show current year basis

$site_url = Router::url('/', true);
echo $this->Html->script('bootstrap-datepicker');

echo $this->html->script('highcharts');
echo $this->html->script('exporting');
$map_months = Configure::read('map_months');

?>
<script type="text/javascript">
	var selected_model_ids = new Array();
	var selected_model_names = new Array();
	var map_months = <?php echo json_encode($map_months); ?>;
	
	$(document).ready(function(){
		//$('#container').hide();
		$('#container').highcharts({
			chart: {
				type: 'column'
			},
			title: {
				text: 'Test Drive Requests'
			},
			subtitle: {
				//text: 'Source: WorldClimate.com'
			},
			xAxis: {
				/*
				categories: [
					'Jan',
					'Feb',
					'Mar',
					'Apr',
					'May',
					'Jun',
					'Jul',
					'Aug',
					'Sep',
					'Oct',
					'Nov',
					'Dec'
				]
				*/
			},
			yAxis: {
				
				min: 0,
				title: {
					text: 'Test Drive Requests'
				}
				
			},
			/*tooltip: {
				headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
				pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
					'<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
				footerFormat: '</table>',
				shared: true,
				useHTML: true
			},
			*/
			plotOptions: {
				column: {
					pointPadding: 0.2,
					borderWidth: 0
				}
			},
			series: [
				/*
				{

				name: 'Tokyo',
				data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
	
			}, {
				name: 'New York',
				data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]
	
			}, {
				name: 'London',
				data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]
	
			}, {
				name: 'Berlin',
				data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]
	
			}
			*/
			]
		});

		$('#showmap').click(function(){
			//$('#dpd1').val()
			//$('#dpd2').val()
			
			var from_date = new Date($('#dpd1').val());
			var to_date = new Date($('#dpd2').val());
			var base = '';

			if(from_date != '' && to_date != '')
			{
				var timeDiff = Math.round((to_date.getTime()- from_date.getTime())/1000);
				console.log("timediff :"+timeDiff);

				
				if(timeDiff>=86400 && timeDiff<=2678399) {
					// Days 
					var pday = timeDiff/86400;
					console.log('pday :'+pday);
					base = 'day';
				}
				else if(timeDiff>=2678400 && timeDiff<=31535999) {
					// Months
					var pmnth = Math.round(timeDiff / 2678400);
					console.log('pmnth :'+pmnth);
					base = 'month';
				}
				else if(timeDiff>=31536000) {
					// Years
					var pyear = timeDiff / 31536000;
					console.log('pyear :'+pyear);
					base = 'year';
					//$preyear = explode('.',$pyear);

					//$arr_return = array('year'=>$preyear[0]);
				}
			}
			else if(from_date != '' || to_date != '')
			{
				base = 'day';
			}

			if(!(selected_model_ids.length > 0))
			{
				alert('Please select any models');
				return false;
			}

			if(base != '')
			{
				//ajax for searching data in database data will be test drive requests for car-models

				var siteurl = '<?php echo $site_url; ?>testdrives/ajaxtestdriverequests';
				
				var my_from_date = from_date.getFullYear()+'-'+(from_date.getMonth()+1)+'-'+from_date.getDate();

				var my_to_date = to_date.getFullYear()+'-'+(to_date.getMonth()+1)+'-'+to_date.getDate();

				$.ajax({
					url: siteurl,
					type: 'POST',
					data: {from_date: my_from_date, to_date: my_to_date, base: base, carmodel_ids: selected_model_ids},
					success: function(res){
						var parsedRes = $.parseJSON(res);
						
						var seriesdata = parsedRes.seriesdata;
						var carmodels = parsedRes.carmodels;
						var xAixs = parsedRes.xAixs;
						
						var cat_arr = new Array();
						var categories_arr = new Array();

						while(chart.series.length > 0)
							chart.series[0].remove(true);

						switch(base)
						{
							case "day":
								var newxAxis = new Array();
								var newdate = from_date;
								while(newdate < to_date)
								{
									newxAxis.push(newdate.getFullYear()+'-'+(newdate.getMonth()+1)+'-'+newdate.getDate());
									newdate.setDate(newdate.getDate()+1);
								}
								newxAxis.push(newdate.getFullYear()+'-'+(newdate.getMonth()+1)+'-'+newdate.getDate());
								console.log('newxAxis :'+newxAxis);
								
								xAixs = newxAxis;
								chart.xAxis[0].setCategories(xAixs);
								chart.setTitle({text: 'Day Basis Test Drive Requests'});
								break;
							case "month":
								chart.xAxis[0].setCategories(map_months);
								chart.setTitle({text: 'Monthly Basis Test Drive Requests'});
								break;
							case "year":
								chart.xAxis[0].setCategories(xAixs);
								chart.setTitle({text: 'Yearly Basis Test Drive Requests'});
								break;
						}
										
						for(var s in seriesdata)
						{
							//console.log(seriesdata[s]);
							
							var model_arr = seriesdata[s];
							var model_series_arr = new Array();
							
							if(base == 'day' || base == 'year')
							{
								for(var j in xAixs)
								{
									//cat_arr[j] = j;
									if(model_arr[xAixs[j]] === undefined)
										model_series_arr.push(0);
									else
										model_series_arr.push(parseInt(model_arr[xAixs[j]]));
								}
							}
							else if(base == 'month')
							{
								for(var j in map_months)
								{
									console.log(map_months[j]);
									//cat_arr[j] = j;
									if(model_arr[map_months[j]] === undefined)
										model_series_arr.push(0);
									else
										model_series_arr.push(parseInt(model_arr[map_months[j]]));
								}
							}
							console.log(model_series_arr);
							chart.addSeries({
								name: carmodels[s],
								//yAxis: 'rainfall-axis',
								data: model_series_arr
							});
						}
						
						$('#container').show();
						$('#container').highcharts();
					},
					error: function(){
						console.log('I am in failure');
						$('#container').hide();
					}
				});

			}

		});

		$('#savemodels').click(function(){
			selected_model_ids = new Array();
			selected_model_names = new Array();

			$('[name^="mymodels_"]:checked').each(function(){
				selected_model_ids.push($(this).val());
				selected_model_names.push($(this).attr('tagname'));
			});

			if(selected_model_names.length > 0)
			{
				$('#selectedModels').html("<b>Selected Models:</b> "+selected_model_names.join(", "));
			}
			else
			{
				$('#selectedModels').html('');
			}
			console.log(selected_model_ids);
			$('#myModal').trigger('click');
		});

		$('#CarmodelCarbrandId').change(function(){
			//alert($(this).val());
			$('#mybutton').trigger('click');

			var brand_id = $(this).val();

			if(typeof brand_id !== undefined && brand_id != '')
			{
				var siteurl = '<?php echo $site_url; ?>carmodels/ajaxlistmodels';

				$.ajax({
					url: siteurl,
					type: 'POST',
					data: {carbrand_id: brand_id},
					success: function(res){
						if(res != "")
						{
							var res_obj = $.parseJSON(res);
							var myHtml = '';
							for(var i in res_obj){
								myHtml += '<input type="checkbox" name="mymodels_'+i+'" value="'+i+'" tagname="'+res_obj[i]+'" />'+res_obj[i]+'<br/>';		
							}
							myHtml += '';
							
							$("#CarCarmodelId").html(myHtml);
						}
					},
					error: function(){
						alert('Try again!');
					}
				});
			}
			else
			{
				$("#CarCarmodelId").html('No Brand selected.');
			}
		});

		// disabling dates
		var nowTemp = new Date();
		var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

		var checkin = $('#dpd1').datepicker({
		  onRender: function(date) {
			  console.log('I am in checkin render');
			return date.valueOf() < now.valueOf() ? 'disabled' : '';
		  }
		}).on('changeDate', function(ev) {
			
			/*
			if(ev.date.valueOf() > now.valueOf())
			{
				var yesterday = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
				yesterday.setDate(nowTemp.getDate()-1);
				
				$(this).val((yesterday.getMonth()+1)+"/"+yesterday.getDate()+"/"+yesterday.getFullYear()).datepicker('update');

				alert('From date must not be greater than today\'s date.');
			}
			*/
			
			//if(e.date.valueOf() )
			/*
			if(checkout.date !== undefined)
			{
			  if (ev.date.valueOf() > checkout.date.valueOf()) 
			  {
				var newDate = new Date(ev.date)
				newDate.setDate(newDate.getDate() + 1);
				checkout.setValue(newDate);
			  }
			}
			*/
		  
		  checkin.hide();
		  $('#dpd2')[0].focus();
		}).data('datepicker');
		
		
		var checkout = $('#dpd2').datepicker({
		  onRender: function(date) {
			return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
		  },
		}).on('changeDate', function(ev) {
			console.log('I am in checkout changedate');
			
			/*
			if(ev.date.valueOf() > now.valueOf())
			{
				$(this).val(now).datepicker('update');

				alert('To date must not be greater than today\'s date.');
			}
			*/
		
			if(checkin.date !== undefined)
			{
			  if (ev.date.valueOf() <= checkin.date.valueOf()) 
			  {
				alert('To date must be greater than from date');
				var newDate = new Date();
				console.log(newDate);
				//var nnewdate = '';
				newDate.setDate(newDate.getDate() + 1);
				//checkout.setValue(newDate);
				$(this).val(newDate).datepicker('update');
			  }
			}
		  checkout.hide();
		}).data('datepicker');

		// the button handler
		
		var chart = $('#container').highcharts();
		/*
		chart.xAxis[0].setCategories(['January']);

		chart.addSeries({
			name: 'Rainfall',
            //yAxis: 'rainfall-axis',
            data: [4, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
		});
		*/
				
	});
</script>
<div class="bs-docs-section">
	<div class="row">
	  <div class="col-lg-12">
		<div class="page-header">
		  <h2 id="tables"><?php echo __('Car Models Statistics'); ?></h2>
		</div>

		<div class="bs-example table-responsive">
		  <span style="" >
			<?php 
				echo $this->Form->create('Carmodel', array('class' => 'bs-example form-horizontal'));
				echo $this->Form->input('carbrand_id', array('label' => 'Search By Brand: &nbsp;&nbsp;', 'empty' =>  '-Select Brand-'));
				echo $this->Form->end();
				?>
				
				<span id="selectedModels"></span>
				<div>
					<!--<input data-provide="datepicker">-->
					<div class="well">
					  <table class="table">
						<thead>
						  <tr>
							<th>
								<label for="inputEmail" class="col-lg-2 control-label">From Date:</label>
								<input type="text" class="span2 col-lg-8" value="" id="dpd1">
							</th>
							<th>
								<label for="inputEmail" class="col-lg-2 control-label">To Date:</label><input type="text" class="span2 col-lg-8" value="" id="dpd2">
							</th>
							<th>
								<button  class="btn btn-primary" id="showmap" >Show Map
							</th>
						  </tr>
						</thead>
					  </table>
					</div>

					<div id="container"> </div>
				</div>
				<!-- Button trigger modal -->

				<button class="btn btn-primary" data-toggle="modal" data-target="#myModal" id="mybutton" style="display:none;">
				  Launch demo modal
				</button>
				
				<!-- Modal -->
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Car Models</h4>
					  </div>
					  <div class="modal-body" id="CarCarmodelId">
						No Brand selected.
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" id="savemodels">Save changes</button>
					  </div>
					</div><!-- /.modal-content -->
				  </div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
			<?php 
			//echo $this->Form->button('Add Dealer', array('class' => 'btn btn-primary btn-sm')); 
			//echo $this->Html->link('Add Car Model', 'add', array('class' => 'btn btn-primary btn-sm'));
			?></span>
			
		</div>
	  </div>
	</div>
</div>