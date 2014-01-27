<div class="cartypes view">
<h2><?php echo __('Cartype'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($cartype['Cartype']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Typename'); ?></dt>
		<dd>
			<?php echo h($cartype['Cartype']['typename']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($cartype['Cartype']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Cartype'), array('action' => 'edit', $cartype['Cartype']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Cartype'), array('action' => 'delete', $cartype['Cartype']['id']), null, __('Are you sure you want to delete # %s?', $cartype['Cartype']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Cartypes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cartype'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cars'), array('controller' => 'cars', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Car'), array('controller' => 'cars', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Cars'); ?></h3>
	<?php if (!empty($cartype['Car'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Cartype Id'); ?></th>
		<th><?php echo __('Carbrand Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($cartype['Car'] as $car): ?>
		<tr>
			<td><?php echo $car['id']; ?></td>
			<td><?php echo $car['name']; ?></td>
			<td><?php echo $car['cartype_id']; ?></td>
			<td><?php echo $car['carbrand_id']; ?></td>
			<td><?php echo $car['created']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'cars', 'action' => 'view', $car['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'cars', 'action' => 'edit', $car['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'cars', 'action' => 'delete', $car['id']), null, __('Are you sure you want to delete # %s?', $car['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Car'), array('controller' => 'cars', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
