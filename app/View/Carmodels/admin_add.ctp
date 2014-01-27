<div class="bs-docs-section">
	<div class="row">
	  <div class="col-lg-12">
		<div class="page-header">
		  <h2 id="forms">Car Model</h2>
		</div>
	  </div>
	</div>

	<div class="row">
	  <div class="col-lg-6">
		<div class="well">
		<?php echo $this->Form->create('Carmodel', array('class' => 'bs-example form-horizontal')); ?>
		  <fieldset>
			  <legend><?php echo __('Add Car Model'); ?></legend>
			  <div class="form-group">
				<label for="inputName" class="col-lg-2 control-label">Car Brand</label>
				<div class="col-lg-10">
					<?php echo $this->Form->input('carbrand_id', array('class' => 'form-control', 'label' => false)); ?>
				</div>
			  </div>
			  <div class="form-group">
				<label for="inputName" class="col-lg-2 control-label">Name</label>
				<div class="col-lg-10">
					<?php echo $this->Form->input('modelname', array('class' => 'form-control', 'placeholder' => 'Model Name', 'label' => false)); ?>
				</div>
			  </div>
			  <div class="form-group">
				<label for="inputName" class="col-lg-2 control-label">Description</label>
				<div class="col-lg-10">
					<?php echo $this->Form->input('description', array('class' => 'form-control', 'label' => false)); ?>
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-lg-10 col-lg-offset-2">
				  <?php
					//echo $this->Html->link('Cancel', 'index', array('class' => 'btn btn-default'));
					echo $this->Form->submit('Submit', array('class' => 'btn btn-primary'));
				  ?>
				</div>
			  </div>
			</fieldset>
		  <?php echo $this->Form->end(); ?>
		</div>
	  </div>
	</div>
</div>