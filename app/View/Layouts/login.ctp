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
</head>
<body>
	<?php //echo $this->Html->script('bsa.js'); ?>
	
    <div class="container">
	  
	  <div class="bs-docs-section" style="*width:50%;*margin:0 auto;">
		<div class="row">
		  <div class="col-lg-12">
			<div class="page-header">
			  <h2 id="forms">Login</h2>
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
					<label for="inputEmail" class="col-lg-2 control-label">Username</label>
					<div class="col-lg-10">
						<?php echo $this->Form->input('username', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Username')); ?>
					</div>
				  </div>
				  <div class="form-group">
					<label for="inputPassword" class="col-lg-2 control-label">Password</label>
					<div class="col-lg-10">
						<?php echo $this->Form->input('password', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Password')); ?>
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-lg-10 col-lg-offset-2">
					  <?php echo $this->Form->button('login', array('class' => 'btn btn-primary')); ?>
					   <?php echo $this->Html->link('Signup Publisher', array('controller' => 'users', 'action' => 'signup'), array('class' => 'btn btn-primary'));
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
