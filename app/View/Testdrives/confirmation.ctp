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
		echo $this->Form->create('Testdrive', array('class' => 'bs-example form-horizontal', 'action' => 'thankyou')); 
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
			  <?php if(isset($city)){ ?>
			  <div class="form-group">
				<label for="inputName" class="col-lg-2 control-label">Your City</label>
				<div class="col-lg-10">

					<label class="col-lg-2 control-label" id="city-label"><?php echo $city ?></label>
				</div>
			  </div>
			  <?php
				}
			  ?>
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