<?php
echo $this->Html->css('data_table');
echo $this->Html->script('jquery.dataTables');
?>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('#modeltable').dataTable( {
			"sPaginationType": "full_numbers"
		} );

		$('#CarmodelCarbrandId').change(function(){
			$('#CarmodelAdminIndexForm').submit();
		});
	} );
</script>
<div class="bs-docs-section">
	<div class="row">
	  <div class="col-lg-12">
		<div class="page-header">
		  <h2 id="tables"><?php echo __('Car Models'); ?>
			<span style="float:right;" >
			<?php 
			echo $this->Html->link('Add Car Model', 'add', array('class' => 'btn btn-primary btn-sm'));
			echo $this->Html->link('Car Model Statistics', 'statistics', array('class' => 'btn btn-primary btn-sm')); 
			?></span>
		  </h2>
		  
		</div>

		<div class="bs-example table-responsive">
		  <table class="table table-striped table-bordered table-hover" id="modeltable">
			<thead>
			  <tr>
				<td colspan="4">
				<?php 
				echo $this->Form->create('Carmodel', array('class' => 'bs-example form-horizontal'));
				echo $this->Form->input('carbrand_id', array('label' => 'Search By Brand: &nbsp;&nbsp;', 'empty' => '-Select Brand-'));
				echo $this->Form->end();
				?>
				</td>
			  </tr>
			  <tr>
				<!--<th><?php echo $this->Paginator->sort('id'); ?></th> -->
				<th><?php echo h('Brandname'); ?></th>
				<th><?php echo h('Modelname'); ?></th>
				<th><?php echo h('Comments'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
			  </tr>
			</thead>
			<tbody>
			<?php foreach ($carmodels as $carmodel): ?>
			<tr>
				<!--<td><?php echo h($carmodel['Carmodel']['id']); ?>&nbsp;</td> -->
				<td><?php echo h($carmodel['Carbrand']['brandname']); ?></td>
				<td><?php echo h($carmodel['Carmodel']['modelname']); ?>&nbsp;</td>
				<td><?php echo h($carmodel['Carmodel']['description']); ?></td>
				<td class="actions">
					<?php //echo $this->Html->link(__('View'), array('action' => 'view', $carmodel['Carmodel']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $carmodel['Carmodel']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $carmodel['Carmodel']['id']), null, __('Are you sure you want to delete # %s?', $carmodel['Carmodel']['id'])); ?>
				</td>
			</tr>
			<?php endforeach; ?>
			 </tbody>
		  </table>
		</div>
	  </div>
	</div>
</div>