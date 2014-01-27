<div class="bs-docs-section">
	<div class="row">
	  <div class="col-lg-12">
		<div class="page-header">
		  <h2 id="forms">My Account settings</h2>
		</div>
	  </div>
	</div>

	<div class="row">
	  <div class="col-lg-6">
		<div class="well">
		<?php echo $this->Form->create('User', array('class' => 'bs-example form-horizontal')); 
		echo $this->Form->input('id');
		?>
		  <fieldset>
			  <legend><?php echo __(''); ?></legend>
			  <div class="form-group">
				<label for="inputName" class="col-lg-2 control-label">Name</label>
				<div class="col-lg-10">
					<?php echo $this->Form->input('name', array('class' => 'form-control', 'label' => false)); ?>
				</div>
			  </div>
			  <div class="form-group">
				<label for="inputUserName" class="col-lg-2 control-label">Username</label>
				<div class="col-lg-10">
					<?php echo $this->Form->input('username', array('class' => 'form-control', 'label' => false)); ?>
				</div>
			  </div>
			  <div class="form-group">
				<label for="inputPassword" class="col-lg-2 control-label">Password</label>
				<div class="col-lg-10">
					<?php //echo $this->Form->input('Password', array('class' => 'form-control', 'placeholder' => 'Password', 'label' => false)); 
					echo $this->Form->input('password', array('class' => 'form-control', 'value' => '', 'label' => false));?>
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