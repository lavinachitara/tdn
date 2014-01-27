<div class="testdrives view">
<h2><?php echo __('Testdrive'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($testdrive['Testdrive']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Customer Name'); ?></dt>
		<dd>
			<?php echo h($testdrive['Testdrive']['customer_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Customer Contact'); ?></dt>
		<dd>
			<?php echo h($testdrive['Testdrive']['customer_contact']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Car'); ?></dt>
		<dd>
			<?php echo $this->Html->link($testdrive['Car']['name'], array('controller' => 'cars', 'action' => 'view', $testdrive['Car']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Testdrivedate'); ?></dt>
		<dd>
			<?php echo h($testdrive['Testdrive']['testdrivedate']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Testdrive'), array('action' => 'edit', $testdrive['Testdrive']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Testdrive'), array('action' => 'delete', $testdrive['Testdrive']['id']), null, __('Are you sure you want to delete # %s?', $testdrive['Testdrive']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Testdrives'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Testdrive'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cars'), array('controller' => 'cars', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Car'), array('controller' => 'cars', 'action' => 'add')); ?> </li>
	</ul>
</div>
