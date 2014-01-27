<div class="userbrands form">
<?php echo $this->Form->create('Userbrand'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Userbrand'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('carbrand_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Userbrands'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Carbrands'), array('controller' => 'carbrands', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Carbrand'), array('controller' => 'carbrands', 'action' => 'add')); ?> </li>
	</ul>
</div>
