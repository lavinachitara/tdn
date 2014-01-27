<div class="carmodels view">
<h2><?php echo __('Carmodel'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($carmodel['Carmodel']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modelname'); ?></dt>
		<dd>
			<?php echo h($carmodel['Carmodel']['modelname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Carbrand'); ?></dt>
		<dd>
			<?php echo $this->Html->link($carmodel['Carbrand']['brandname'], array('controller' => 'carbrands', 'action' => 'view', $carmodel['Carbrand']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($carmodel['Carmodel']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Carmodel'), array('action' => 'edit', $carmodel['Carmodel']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Carmodel'), array('action' => 'delete', $carmodel['Carmodel']['id']), null, __('Are you sure you want to delete # %s?', $carmodel['Carmodel']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Carmodels'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Carmodel'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Carbrands'), array('controller' => 'carbrands', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Carbrand'), array('controller' => 'carbrands', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cars'), array('controller' => 'cars', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Car'), array('controller' => 'cars', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Cars'); ?></h3>
	<?php if (!empty($carmodel['Car'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Carmodel Id'); ?></th>
		<th><?php echo __('Carbrand Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($carmodel['Car'] as $car): ?>
		<tr>
			<td><?php echo $car['id']; ?></td>
			<td><?php echo $car['name']; ?></td>
			<td><?php echo $car['description']; ?></td>
			<td><?php echo $car['carmodel_id']; ?></td>
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
