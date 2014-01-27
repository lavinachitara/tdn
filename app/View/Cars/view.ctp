<div class="bs-docs-section">
	<div class="row">
	  <div class="col-lg-12">
		<div class="page-header">
		  <h2 id="type">Car</h2>
		</div>
	  </div>
	</div>

	<!-- Headings -->

	<div class="row">
	  <div class="col-lg-4">
		<div class="well well-lg">
		<table style="background-color: inherit;">
			<tr>
				<td>Name:</td>
				<td><?php echo h($car['Car']['name']); ?></td>
			</tr>
			<tr>
				<td>Description:</td>
				<td><?php echo h($car['Car']['description']); ?></td>
			</tr>
			<tr>
				<td>Car brand:</td>
				<td><?php echo h($car['Carbrand']['brandname']); ?></td>
			</tr>
			<tr>
				<td>Car model:</td>
				<td><?php echo h($car['Carmodel']['modelname']); ?></td>
			</tr>
			
		</table>
		</div>
	  </div>
	</div>
</div>

<!--
<div class="related">
	<h3><?php echo __('Related Testdrives'); ?></h3>
	<?php if (!empty($car['Testdrive'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Customer Name'); ?></th>
		<th><?php echo __('Customer Contact'); ?></th>
		<th><?php echo __('Car Id'); ?></th>
		<th><?php echo __('Testdrivedate'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($car['Testdrive'] as $testdrive): ?>
		<tr>
			<td><?php echo $testdrive['id']; ?></td>
			<td><?php echo $testdrive['customer_name']; ?></td>
			<td><?php echo $testdrive['customer_contact']; ?></td>
			<td><?php echo $testdrive['car_id']; ?></td>
			<td><?php echo $testdrive['testdrivedate']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'testdrives', 'action' => 'view', $testdrive['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'testdrives', 'action' => 'edit', $testdrive['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'testdrives', 'action' => 'delete', $testdrive['id']), null, __('Are you sure you want to delete # %s?', $testdrive['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Testdrive'), array('controller' => 'testdrives', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
-->