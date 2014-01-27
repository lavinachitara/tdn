<script type="text/javascript">
function validateForm(){
	var emailAddress = $('#UserEmail').val();
	
	if(emailAddress !== undefined && emailAddress != '')
	{
		 $('#emailerror').html('');
		 var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
		if(pattern.test(emailAddress))
		{
			return true;
		}
		else
		{
			$('#emailerror').html('Invalid email address');
			return false;
		}
		
	}
	else
	{
		
		$('#emailerror').html('');
	}
	
}
</script>
<div class="bs-docs-section">
	<div class="row">
	  <div class="col-lg-12">
		<div class="page-header">
		  <h2 id="forms">Dealer</h2>
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
			  <legend><?php echo __('Edit User'); ?></legend>
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
				<label for="inputUserName" class="col-lg-2 control-label">Email</label>
				<div class="col-lg-10">
					<?php echo $this->Form->input('email', array('class' => 'form-control', 'label' => false)); ?>
					<span id="emailerror" style="color:red;"></span>
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-lg-10 col-lg-offset-2">
				  <?php
					//echo $this->Html->link('Cancel', 'index', array('class' => 'btn btn-default'));
					echo $this->Form->submit('Submit', array('class' => 'btn btn-primary', 'onclick' => 'return validateForm();'));
				  ?>
				</div>
			  </div>
			</fieldset>
		  <?php echo $this->Form->end(); ?>
		</div>
	  </div>
	</div>
</div>