<div class="testdrives form">
<?php echo $this->Form->create('Testdrive'); ?>
	<fieldset>
		<legend><?php echo __('Edit Testdrive'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('customer_name');
		echo $this->Form->input('customer_contact');
		echo $this->Form->input('car_id');
		echo $this->Form->input('testdrivedate');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Testdrive.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Testdrive.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Testdrives'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Cars'), array('controller' => 'cars', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Car'), array('controller' => 'cars', 'action' => 'add')); ?> </li>
	</ul>
</div>
