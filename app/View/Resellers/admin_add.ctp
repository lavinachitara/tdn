<script type="text/javascript">
$(document).ready(function(){

	$('#submitReseller').click(function(){
		
		var validate = true;
		$('[id$="Error"]').each(function(){
			
			var fieldid = $(this).attr('for');
			if($('#'+fieldid).val() == '')
			{
				$(this).show();
				validate = false;
			}
			else
				$(this).hide();
		});
		if(validate)
			$('#ResellerAdminAddForm').submit();

	});
});
</script>
<div class="bs-docs-section">
	<div class="row">
	  <div class="col-lg-12">
		<div class="page-header">
		  <h2 id="forms">Reseller</h2>
		</div>
	  </div>
	</div>

	<div class="row">
	  <div class="col-lg-6">
		<div class="well">
		<?php echo $this->Form->create('Reseller', array('class' => 'bs-example form-horizontal')); ?>
		  <fieldset>
			  <legend><?php echo __('Add Reseller'); ?></legend>
			  <div class="form-group">
				<label for="inputName" class="col-lg-2 control-label">Name</label>
				<div class="col-lg-10">
					<?php echo $this->Form->input('name', array('class' => 'form-control', 'placeholder' => 'Reseller Name', 'label' => false)); ?>
					<span for="ResellerName" id="nameError" style="color:red; display:none;">Please enter name.</span>
				</div>
			  </div>
			  <div class="form-group">
				<label for="inputName" class="col-lg-2 control-label">Street</label>
				<div class="col-lg-10">
					<?php echo $this->Form->input('street', array('class' => 'form-control', 'label' => false)); ?>
					<span for="ResellerStreet" id="streetError" style="color:red; display:none;">Please enter street.</span>
				</div>
			  </div>
			  <div class="form-group">
				<label for="inputName" class="col-lg-2 control-label">Zipcode</label>
				<div class="col-lg-10">
					<?php echo $this->Form->input('zipcode', array('class' => 'form-control', 'placeholder' => 'Zipcode','label' => false)); ?>
					<span for="ResellerZipcode" id="zipcodeError" style="color:red; display:none;">Please enter zipcode.</span>
				</div>
			  </div>
			  <div class="form-group">
				<label for="inputName" class="col-lg-2 control-label">City</label>
				<div class="col-lg-10">
					<?php echo $this->Form->input('city', array('class' => 'form-control', 'placeholder' => 'City', 'label' => false)); ?>
					<span for="ResellerCity" id="cityError" style="color:red; display:none;">Please enter city.</span>
				</div>
			  </div>
			  <div class="form-group">
				<label for="inputName" class="col-lg-2 control-label">Contact Number</label>
				<div class="col-lg-10">
					<?php echo $this->Form->input('contactno', array('class' => 'form-control', 'placeholder' => 'Contact Number', 'label' => false)); ?>
					<span for="ResellerContactno" id="contactnoError" style="color:red; display:none;">Please enter contact number.</span>
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-lg-10 col-lg-offset-2">
				  <?php
					//echo $this->Html->link('Cancel', 'index', array('class' => 'btn btn-default'));
					echo $this->Form->submit('Submit', array('id' => 'submitReseller', 'class' => 'btn btn-primary'));
				  ?>
				</div>
			  </div>
			</fieldset>
		  <?php echo $this->Form->end(); ?>
		</div>
	  </div>
	</div>
</div>