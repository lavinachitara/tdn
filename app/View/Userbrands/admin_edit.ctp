<div class="userbrands form">
<?php echo $this->Form->create('Userbrand'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Userbrand'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('carbrand_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Userbrand.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Userbrand.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Userbrands'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Carbrands'), array('controller' => 'carbrands', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Carbrand'), array('controller' => 'carbrands', 'action' => 'add')); ?> </li>
	</ul>
</div>
