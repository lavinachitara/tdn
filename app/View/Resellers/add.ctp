<div class="resellers form">
<?php echo $this->Form->create('Reseller'); ?>
	<fieldset>
		<legend><?php echo __('Add Reseller'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('street');
		echo $this->Form->input('zipcode');
		echo $this->Form->input('city');
		echo $this->Form->input('contactno');
		echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Resellers'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
