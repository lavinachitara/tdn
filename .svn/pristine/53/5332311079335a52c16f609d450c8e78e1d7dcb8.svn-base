<div class="bs-docs-section">
	<div class="row">
	  <div class="col-lg-12">
		<div class="page-header">
		  <h2 id="tables"><?php echo __('Cars'); ?></h2>
		  
		</div>

		<div class="bs-example table-responsive">
		  <table class="table table-striped table-bordered table-hover">
			<thead>
			  <tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('name'); ?></th>
				<th><?php echo $this->Paginator->sort('carbrand_id'); ?></th>
				<th><?php echo $this->Paginator->sort('carmodel_id'); ?></th>
				<th class="actions"><?php echo __('Link'); ?></th>
			  </tr>
			</thead>
			<tbody>
			<?php foreach ($cars as $car): ?>
			<tr>
				<td><?php echo h($car['Car']['id']); ?>&nbsp;</td>
				<td><?php echo h($car['Car']['name']); ?>&nbsp;</td>
				<td><?php echo $car['Carbrand']['brandname']; ?></td>
				<td><?php echo $car['Carmodel']['modelname']; ?></td>
				<td class="actions">
					<?php echo $this->Html->link($this->Html->url(array('controller' => 'cars', 'action' => 'landingpage', $car['Car']['id']), true)); ?>
				</td>
			</tr>
			<?php endforeach; ?>
			 </tbody>
		  </table>
		</div>
	  </div>
	</div>
</div>
<div class=" index">
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