<div class="resellers view">
<h2><?php echo __('Reseller'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($reseller['Reseller']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($reseller['Reseller']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Street'); ?></dt>
		<dd>
			<?php echo h($reseller['Reseller']['street']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Zipcode'); ?></dt>
		<dd>
			<?php echo h($reseller['Reseller']['zipcode']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo h($reseller['Reseller']['city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contactno'); ?></dt>
		<dd>
			<?php echo h($reseller['Reseller']['contactno']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($reseller['User']['name'], array('controller' => 'users', 'action' => 'view', $reseller['User']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Reseller'), array('action' => 'edit', $reseller['Reseller']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Reseller'), array('action' => 'delete', $reseller['Reseller']['id']), null, __('Are you sure you want to delete # %s?', $reseller['Reseller']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Resellers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Reseller'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
