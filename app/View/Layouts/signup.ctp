<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'Cars');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		//echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');

		echo $this->Html->css('bootstrap.css');
		//echo $this->Html->css('bootswatch.min.css');
	?>
	<!--
	<style>
	*, *:before, *:after {
		-moz-box-sizing: inherit;
	}
	*, *:before, *:after {
		-moz-box-sizing: inherit;
	}
	.col-lg-offset-2 {
		margin-left: 0;
	}
	</style>
	-->
	<script type="text/javascript">
	function validateForm(){
		
		$('#passerror').html('');
		$('#emailerror').html('');
		$('#usernameerror').html('');
		$('#siteerror').html('');

		var un = $('#UserUsername').val();
		if(un == '' || un === undefined)
		{
			$('#usernameerror').html('Please enter username');
			return false;
		}

		var pass = $('#UserPassword').val();
		if(pass == '' || pass === undefined)
		{
			$('#passerror').html('Please enter password');
			return false;
		}
		var emailAddress = $('#UserEmail').val();
		
		if(emailAddress !== undefined && emailAddress != '')
		{
			 var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
			if(pattern.test(emailAddress))
			{
				//return true;
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

		var us = $('#UserSite').val();
		if(us == '' || us === undefined)
		{
			$('#siteerror').html('Please enter site name');
			return false;
		}
		
	}
	</script>
</head>
<body>
	<?php //echo $this->Html->script('bsa.js'); ?>
	
    <div class="container">
	  
	  <div class="bs-docs-section" style="*width:50%;*margin:0 auto;">
		<div class="row">
		  <div class="col-lg-12">
			<div class="page-header">
			  <h2 id="forms">Publisher Signup</h2>
			</div>
		  </div>
		</div>
		<div id="flashMessage" class="message" style="color:red;">
			<?php echo $this->Session->flash(); ?>
		</div>
		<div class="row">
		  <div class="col-lg-6">
			<div class="well">
				<?php 
				echo $this->Form->create('User', array('class' => 'bs-example form-horizontal'));
				?>
				<fieldset>
				  <!--<legend>Legend</legend>-->
				  <div class="form-group">
					<label for="inputEmail" class="col-lg-2 control-label">Name</label>
					<div class="col-lg-10">
						<?php echo $this->Form->input('name', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Name')); ?>
					</div>
				  </div>
				  <div class="form-group">
					<label for="inputEmail" class="col-lg-2 control-label">Username</label>
					<div class="col-lg-10">
						<?php echo $this->Form->input('username', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Username')); ?>
						<span id="usernameerror" style="color:red;"></span>
					</div>
				  </div>
				  <div class="form-group">
					<label for="inputPassword" class="col-lg-2 control-label">Password</label>
					<div class="col-lg-10">
						<?php echo $this->Form->input('password', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Password')); ?>
						<span id="passerror" style="color:red;"></span>
					</div>
				  </div>
				  <div class="form-group">
					<label for="inputEmail" class="col-lg-2 control-label">Email</label>
					<div class="col-lg-10">
						<?php echo $this->Form->input('email', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Name')); ?>
						<span id="emailerror" style="color:red;"></span>
					</div>
				  </div>
				  <div class="form-group">
					<label for="inputEmail" class="col-lg-2 control-label">Site Name</label>
					<div class="col-lg-10">
						<?php echo $this->Form->input('site', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Site Name')); ?>
						<span id="siteerror" style="color:red;"></span>
					</div>
				  </div>
				  <div class="form-group">
					<div class="col-lg-10 col-lg-offset-2">
					  <?php echo $this->Form->button('Submit', array('class' => 'btn btn-primary', 'onclick' => 'return validateForm();')); ?>
					   <?php echo $this->Html->link('login', array('controller' => 'users', 'action' => 'login'), array('class' => 'btn btn-primary'));
					   ?>
					</div>
				  </div>
				</fieldset>
			  <?php echo $this->Form->end(); ?>
			</div>
		  </div>
		</div>
	</div>

	<?php 
		//echo $this->Html->script('jquery.min.js');
		echo $this->Html->script('jquery-1.9.1.js');
		echo $this->Html->script('bootstrap.min.js');
		echo $this->Html->script('bootswatch.js');
	?>
   
</html>
