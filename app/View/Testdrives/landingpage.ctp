<?php
echo $this->Html->script('bootstrap-datepicker');
?>
<style>
.form-horizontal .control-label {
    text-align: left;
}
</style>
<script src="http://yui.yahooapis.com/3.14.0/build/yui-base/yui-base-min.js"></script>
<script src="http://yui.yahooapis.com/3.14.0/build/node-base/node-base-min.js"></script>
<script type="text/javascript">

function submitmyform(){
	var customer_contact = $('#customer_contact').val();
	var testdrivedate = $('#dpd1').val();

	$('#errormessage').hide();
	$('#errormessage2').hide();

	if(typeof customer_contact === undefined || customer_contact == '')
	{
		$('#errormessage').show();
	}
	else if(typeof testdrivedate === undefined || testdrivedate == '')
	{
		$('#errormessage2').show();
	}
	else
	{
		var filter = /^\+?[0-9]{0,15}$/;
		if(filter.test(customer_contact))
		{
			console.log(GetSearchUrl());
			$.ajax({
				contentType: "text/plain; charset=utf-8", 
				url: GetSearchUrl() + "&callback=callback", 
				type: "GET", 
				dataType: "jsonp", 
				jsonp:  "jsonp",
				success: function (data) { 
					console.log('I am in success');
					console.log('data'+data);
					
					// response($.map(data.Results, function (item){ 
					// 	return { label: GetName(item) + "(" + GetPhone(item) + ")", value: GetName(item), code: GetPhone(item) }; 
					//}));
					
				}, 
				error: function (data) {
					console.log(data);
					//$("#Phone")[0].innerText = "an error occurred while reading search service"; 
				} 
			}) 
//   			var url = GetSearchUrl() + "?callback={callback}";
//  			 YUI().use("jsonp" ,function (Y) {

//         Y.jsonp(url, handleJSONP);
// });
			return false;
		 	 //return true
		}
	}

	return false;
}


 function handleJSONP(response) {
       console.log($.parseJSON(response));
    }


function GetSearchUrl() { 
	var userName = "Thomasmoen"; 
	var msisdn = "90624567"; 
	var password = "hov2tho3"; 
	var data = "https://api.1881bedrift.no/search/search?userName="
	+ userName 
	+ "&password=" 
	+ password 
	+ "&msisdn=" 
	+ msisdn 
	+ "&level=1"
	+ "&phone="
	+ msisdn 
	+ "&pageSize=25&format=json"; 
	//$("#SearchUrl")[0].innerText = data;
	//console.log('url'+data);
	return data; 
 } 
 function localJsonpCallback(){
	 console.log('I am in localJsonpCallback');
 }

</script>
<div class="bs-docs-section">
	<div class="row">
	  <div class="col-lg-12">
		<div class="page-header">
		  <h2 id="forms">Request for test drive</h2>
		</div>
	  </div>
	</div>

	<div class="row">
	  <div class="col-lg-6">
		<div class="well">
		<?php 
		echo $this->Form->create('Testdrive', array('class' => 'bs-example form-horizontal')); 
		?>
		  <fieldset>
			  <legend><?php //echo __('Car'); ?></legend>
			  <?php

				//if(isset($car) && !empty($car))
				//{
			  ?>
				<!--
				<div class="form-group">
					<label for="inputName" class="col-lg-2 control-label">Name:</label>
					<label for="inputName" class="col-lg-10 control-label"><?php echo $car['Car']['name']; ?></label>
				</div>
				<div class="form-group">
					<label for="inputName" class="col-lg-2 control-label">Description:</label>
					<label for="inputName" class="col-lg-10 control-label"><?php echo $car['Car']['description']; ?></label>
				</div>
				<div class="form-group">
					<label for="inputName" class="col-lg-2 control-label">Brand</label>
					<label for="inputName" class="col-lg-10 control-label"><?php echo $car['Carbrand']['brandname']; ?></label>
				</div>
				<div class="form-group">
					<label for="inputName" class="col-lg-2 control-label">Model</label>
					<label for="inputName" class="col-lg-10 control-label"><?php echo $car['Carmodel']['modelname']; ?></label>
				</div>
				-->
			  <?php
				//}
			  ?>
			  <!--
			  <div class="form-group">
				<label for="inputName" class="col-lg-2 control-label">Name</label>
				<div class="col-lg-10">
				<?php echo $this->Form->input('customer_name', array( 'class' => 'form-control', 'label' => false)); ?>
				</div>
			  </div>
			  -->
			  <div class="form-group">
				<label for="inputName" class="col-lg-2 control-label">Contact Number</label>
				<div class="col-lg-10">
					<?php echo $this->Form->input('customer_contact', array('id' => 'customer_contact', 'class' => 'form-control', 'label' => false)); ?>
					<span style="color:red;"><?php echo isset($ses_message)?$ses_message:''; ?>
					<span id="errormessage" style="color:red; display:none;">Please enter correct contact number</span>
				</div>
			  </div>
			  <div class="form-group">
				<label for="inputName" class="col-lg-2 control-label">Test drive date</label>
				<div class="col-lg-10">
				<!--<input type="text" class="span2 form-control" value="" id="dpd1"></th>-->
					<?php echo $this->Form->input('testdrivedate', array('type' => 'text', 'id' => 'dpd1', 'class' => 'span2 form-control', 'label' => false)); ?>
					<!--
					<span style="color:red;"><?php echo isset($ses_message)?$ses_message:''; ?>
					-->
					<span id="errormessage2" style="color:red; display:none;">Please select testdrive</span>
					
				</div>
			  </div>
			 
			  <div class="form-group" id="numbercity" style="display:none;" >
				<label for="inputName" class="col-lg-2 control-label">City</label>
				<div class="col-lg-10">
				<label for="inputName" class="col-lg-2 control-label">City</label>
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-lg-10 col-lg-offset-2">
				  <?php
					//echo $this->Html->link('Cancel', 'index', array('class' => 'btn btn-default'));
					echo $this->Form->submit('Submit', array('class' => 'btn btn-primary', 'id' => 'submitform'));
				  ?>
				</div>
			  </div>
			</fieldset>
		  <?php echo $this->Form->end(); ?>
		</div>
	  </div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){

	var nowTemp = new Date();
	var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

	var checkin = $('#dpd1').datepicker({
		startDate: now,
	}).on('changeDate', function(ev) {
		  checkin.hide();
		  $('#errormessage2').hide();
	}).data('datepicker');
});
</script>