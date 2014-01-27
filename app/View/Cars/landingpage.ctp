<style>
.form-horizontal .control-label {
    text-align: left;
}
</style>
<script type="text/javascript">
$(document).ready(function(){

	
});
function submitmyform(){
	var customer_contact = $('#customer_contact').val();
	if(typeof customer_contact !== undefined && customer_contact != '')
	{
		 var filter = /^\+?[0-9]{0,15}$/;
		 if(filter.test(customer_contact))
		 	 return true
		else{
			$('#errormessage').show();
		 }
	}
	return false;
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
			  <div class="form-group">
				<label for="inputName" class="col-lg-2 control-label">Contact Number</label>
				<div class="col-lg-10">
					<?php echo $this->Form->input('customer_contact', array('id' => 'customer_contact', 'class' => 'form-control', 'label' => false)); ?>
					<span style="color:red;"><?php echo isset($ses_message)?$ses_message:''; ?>
					<span id="errormessage" style="color:red; display:none;">Please enter correct contact number</span>
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-lg-10 col-lg-offset-2">
				  <?php
					//echo $this->Html->link('Cancel', 'index', array('class' => 'btn btn-default'));
					echo $this->Form->submit('Submit', array('class' => 'btn btn-primary', 'id' => 'submitform', 'onclick' => 'return submitmyform()'));
				  ?>
				</div>
			  </div>
			</fieldset>
		  <?php echo $this->Form->end(); ?>
		</div>
	  </div>
	</div>
</div>