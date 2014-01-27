<div class="userbrands view">
<h2><?php echo __('Userbrand'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userbrand['Userbrand']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userbrand['User']['name'], array('controller' => 'users', 'action' => 'view', $userbrand['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Carbrand'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userbrand['Carbrand']['brandname'], array('controller' => 'carbrands', 'action' => 'view', $userbrand['Carbrand']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Userbrand'), array('action' => 'edit', $userbrand['Userbrand']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Userbrand'), array('action' => 'delete', $userbrand['Userbrand']['id']), null, __('Are you sure you want to delete # %s?', $userbrand['Userbrand']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Userbrands'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Userbrand'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Carbrands'), array('controller' => 'carbrands', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Carbrand'), array('controller' => 'carbrands', 'action' => 'add')); ?> </li>
	</ul>
</div>
