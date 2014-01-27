<?php
echo $this->Html->css('data_table');
echo $this->Html->script('jquery.dataTables');
?>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('#modeltable').dataTable( {
			"sPaginationType": "full_numbers"
		} );

	} );
</script>
<div class="bs-docs-section">
	<div class="row">
	  <div class="col-lg-12">
		<div class="page-header">
		  <h2 id="tables"><?php echo __('Resellers'); ?>
			<span style="float:right;" >
			<?php 
			echo $this->Html->link('Add Reseller', 'add', array('class' => 'btn btn-primary btn-sm'));
			?></span>
		  </h2>
		  
		</div>

		<div class="bs-example table-responsive">
		  <table class="table table-striped table-bordered table-hover" id="modeltable">
			<thead>
			  <tr>
				<!--<th><?php echo $this->Paginator->sort('id'); ?></th> -->
				<th><?php echo h('Name'); ?></th>
				<th><?php echo h('Street'); ?></th>
				<th><?php echo h('Zipcode'); ?></th>
				<th><?php echo h('City'); ?></th>
				<th><?php echo h('Contact Number'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
			  </tr>
			</thead>
			<tbody>
			<?php foreach ($resellers as $reseller): ?>
			<tr>
				<td><?php echo h($reseller['Reseller']['name']); ?></td>
				<td><?php echo h($reseller['Reseller']['street']); ?></td>
				<td><?php echo h($reseller['Reseller']['zipcode']); ?></td>
				<td><?php echo h($reseller['Reseller']['city']); ?></td>
				<td><?php echo h($reseller['Reseller']['contactno']); ?></td>
				<td class="actions">
					<?php //echo $this->Html->link(__('View'), array('action' => 'view', $reseller['Reseller']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $reseller['Reseller']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $reseller['Reseller']['id']), null, __('Are you sure you want to delete %s?', $reseller['Reseller']['name'])); ?>
				</td>
			</tr>
			<?php endforeach; ?>
			 </tbody>
		  </table>
		</div>
	  </div>
	</div>
</div>