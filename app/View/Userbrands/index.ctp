<div class="userbrands index">
	<h2><?php echo __('Userbrands'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('carbrand_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($userbrands as $userbrand): ?>
	<tr>
		<td><?php echo h($userbrand['Userbrand']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($userbrand['User']['name'], array('controller' => 'users', 'action' => 'view', $userbrand['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($userbrand['Carbrand']['brandname'], array('controller' => 'carbrands', 'action' => 'view', $userbrand['Carbrand']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $userbrand['Userbrand']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $userbrand['Userbrand']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $userbrand['Userbrand']['id']), null, __('Are you sure you want to delete # %s?', $userbrand['Userbrand']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Userbrand'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Carbrands'), array('controller' => 'carbrands', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Carbrand'), array('controller' => 'carbrands', 'action' => 'add')); ?> </li>
	</ul>
</div>
