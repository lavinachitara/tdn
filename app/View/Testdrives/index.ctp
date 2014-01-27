<div class="bs-docs-section">
	<div class="row">
	  <div class="col-lg-12">
		<div class="page-header">
		  <h2 id="tables"><?php echo __('Requests for test drive'); ?>
			<span style="float:right;" >
			<?php 
			//echo $this->Form->button('Add Dealer', array('class' => 'btn btn-primary btn-sm')); 
			//echo $this->Html->link('Add Car', 'add', array('class' => 'btn btn-primary btn-sm'));
			?></span>
		  </h2>
		  
		</div>

		<div class="bs-example table-responsive">
		  <table class="table table-striped table-bordered table-hover">
			<thead>
			  <tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('car_id'); ?></th>
				<th><?php echo $this->Paginator->sort('customer_contact'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
			  </tr>
			</thead>
			<tbody>
			<?php foreach ($testdrives as $testdrive): ?>
			<tr>
				<td><?php echo h($testdrive['Testdrive']['id']); ?>&nbsp;</td>
				<td><?php echo h($testdrive['Car']['name']); ?>&nbsp;</td>
				<td><?php echo $testdrive['Testdrive']['customer_contact']; ?></td>
				<td class="actions">
					<?php //echo $this->Html->link(__('View'), array('action' => 'view', $testdrive['Testdrive']['id'])); ?>
					<?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $testdrive['Testdrive']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $testdrive['Testdrive']['id']), null, __('Are you sure you want to delete # %s?', $testdrive['Testdrive']['id'])); ?>
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