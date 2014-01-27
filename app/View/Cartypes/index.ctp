<div class="bs-docs-section">
	<div class="row">
	  <div class="col-lg-12">
		<div class="page-header">
		  <h2 id="tables"><?php echo __('Car Types'); ?>
			<span style="float:right;" >
			<?php 
			//echo $this->Form->button('Add Dealer', array('class' => 'btn btn-primary btn-sm')); 
			echo $this->Html->link('Add Car Type', 'add', array('class' => 'btn btn-primary btn-sm'));
			?></span>
		  </h1>
		  
		</div>

		<div class="bs-example table-responsive">
		  <table class="table table-striped table-bordered table-hover">
			<thead>
			  <tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('typename'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
			  </tr>
			</thead>
			<tbody>
			<?php foreach ($cartypes as $cartype): ?>
			<tr>
				<td><?php echo h($cartype['Cartype']['id']); ?>&nbsp;</td>
				<td><?php echo h($cartype['Cartype']['typename']); ?>&nbsp;</td>
				<td class="actions">
					<?php //echo $this->Html->link(__('View'), array('action' => 'view', $cartype['Cartype']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $cartype['Cartype']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $cartype['Cartype']['id']), null, __('Are you sure you want to delete # %s?', $cartype['Cartype']['id'])); ?>
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