<?php
echo $this->Html->css('data_table');
echo $this->Html->script('jquery.dataTables');
?>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('#testdrivetable').dataTable( {
			"sPaginationType": "full_numbers"
		} );
		
		$('#TestdriveCarbrandId').change(function(){
			$('#TestdriveAdminListrequestsForm').submit();
		});
	} );
</script>
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
		  <table class="table table-striped table-bordered table-hover" id="testdrivetable">
			<thead>
			  <tr>
				<td colspan="5">
					<?php 
					echo $this->Form->create('Testdrive', array('class' => 'bs-example form-horizontal'));
					echo $this->Form->input('carbrand_id', array('label' => 'Search By Brand: &nbsp;&nbsp;', 'empty' => '-Select Brand-'));
					echo $this->Form->end();
					?>
				</td>
			  </tr>
			  <tr>
				<th>Carbrand</th>
				<th>Carmodel</th>
				<th>Customer Requests</th>
				<th>Publisher</th>
				<th>Requested</th>
				<th class="actions"><?php echo __('Actions'); ?></th>
			  </tr>
			</thead>
			<tbody>
			<?php foreach ($testdrives as $testdrive): ?>
			<tr>
				<td><?php echo h($testdrive['Carmodel']['Carbrand']['brandname']); ?>&nbsp;</td>
				<td><?php echo h($testdrive['Carmodel']['modelname']); ?>&nbsp;</td>
				<td>
				<?php 
				//echo $testdrive['Testdrive']['customer_contact']; 
				echo $testdrive[0]['totalrequests'];
				?>
				</td>
				<td><?php echo h($testdrive['User']['name']); ?>&nbsp;</td>
				<td><?php echo h($testdrive['Testdrive']['testdrivedate']); ?>&nbsp;</td>
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