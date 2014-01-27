<div class="bs-docs-section">
	<div class="row">
	  <div class="col-lg-12">
		<div class="page-header">
		  <h2 id="tables"><?php echo __('Car Brands'); ?>
			<span style="float:right;" >
			<?php 
			//echo $this->Form->button('Add Dealer', array('class' => 'btn btn-primary btn-sm')); 
			if(AuthComponent::user('isAdmin'))
				echo $this->Html->link('Add Car Brand', 'add', array('class' => 'btn btn-primary btn-sm'));
			?>
			</span>
		  </h2>
		  
		</div>

		<div class="bs-example table-responsive">
		  <table class="table table-striped table-bordered table-hover">
			<thead>
			  <tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('brandname'); ?></th>
				
				<?php
				 if(AuthComponent::user('isAdmin'))
				 {
				?>
				<th><?php echo $this->Paginator->sort('user_id'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
				<?php
				 }
				?>
			  </tr>
			</thead>
			<tbody>
			<?php foreach ($carbrands as $carbrand): ?>
			<tr>
				<td><?php echo h($carbrand['Carbrand']['id']); ?>&nbsp;</td>
				<td><?php echo h($carbrand['Carbrand']['brandname']); ?>&nbsp;</td>
				
				<?php
				 if(AuthComponent::user('isAdmin'))
				 {
				?>
				<td><?php echo h($carbrand['User']['name']); ?>&nbsp;</td>
				<td class="actions">
					<?php //echo $this->Html->link(__('View'), array('action' => 'view', $carbrand['Carbrand']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $carbrand['Carbrand']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $carbrand['Carbrand']['id']), null, __('Are you sure you want to delete # %s?', $carbrand['Carbrand']['id'])); ?>
				</td>
				<?php
				 }
				?>
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