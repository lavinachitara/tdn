<div class="resellers index">
	<h2><?php echo __('Resellers'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('street'); ?></th>
			<th><?php echo $this->Paginator->sort('zipcode'); ?></th>
			<th><?php echo $this->Paginator->sort('city'); ?></th>
			<th><?php echo $this->Paginator->sort('contactno'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($resellers as $reseller): ?>
	<tr>
		<td><?php echo h($reseller['Reseller']['id']); ?>&nbsp;</td>
		<td><?php echo h($reseller['Reseller']['name']); ?>&nbsp;</td>
		<td><?php echo h($reseller['Reseller']['street']); ?>&nbsp;</td>
		<td><?php echo h($reseller['Reseller']['zipcode']); ?>&nbsp;</td>
		<td><?php echo h($reseller['Reseller']['city']); ?>&nbsp;</td>
		<td><?php echo h($reseller['Reseller']['contactno']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($reseller['User']['name'], array('controller' => 'users', 'action' => 'view', $reseller['User']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $reseller['Reseller']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $reseller['Reseller']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $reseller['Reseller']['id']), null, __('Are you sure you want to delete # %s?', $reseller['Reseller']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Reseller'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
