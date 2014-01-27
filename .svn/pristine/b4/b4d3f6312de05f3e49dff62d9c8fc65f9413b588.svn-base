<?php
$site_url = Router::url('/', true);
?>
<script type="text/javascript">
function showCarmodel(myobj){
	
	var brand_id = $(myobj).val();
	if(typeof brand_id !== undefined && brand_id != '')
	{
		var siteurl = '<?php echo $site_url; ?>carmodels/listmodels';

		$.ajax({
			url: siteurl,
			type: 'POST',
			data: {carbrand_id: brand_id},
			success: function(res){
				if(res != "")
				{
					var res_obj = $.parseJSON(res);
					var myHtml = '';
					for(var i in res_obj){
						myHtml += '<option value="'+i+'">'+res_obj[i]+'</option>';		
					}
					myHtml += '';
					
					$("#CarCarmodelId").html(myHtml);
				}
			},
			error: function(){
				alert('Try again!');
			}
		});
	}
	else
	{
		$("#CarCarmodelId").html('');
	}
}
</script>

<div class="bs-docs-section">
	<div class="row">
	  <div class="col-lg-12">
		<div class="page-header">
		  <h2 id="forms">Car</h2>
		</div>
	  </div>
	</div>

	<div class="row">
	  <div class="col-lg-6">
		<div class="well">
		<?php echo $this->Form->create('Car', array('class' => 'bs-example form-horizontal')); ?>
		  <fieldset>
			  <legend><?php echo __('Add Car'); ?></legend>
			  <div class="form-group">
				<label for="inputName" class="col-lg-2 control-label">Name</label>
				<div class="col-lg-10">
					<?php echo $this->Form->input('name', array('class' => 'form-control', 'placeholder' => 'Name', 'label' => false)); ?>
				</div>
			  </div>
			  <div class="form-group">
				<label for="inputName" class="col-lg-2 control-label">Description</label>
				<div class="col-lg-10">
					<?php echo $this->Form->input('description', array('class' => 'form-control', 'label' => false)); ?>
				</div>
			  </div>
			  <div class="form-group">
				<label for="inputName" class="col-lg-2 control-label">Car Brads</label>
				<div class="col-lg-10">
					<?php echo $this->Form->input('carbrand_id', array('class' => 'form-control', 'label' => false, 'onchange' => 'showCarmodel(this);')); ?>
				</div>
			  </div>
			  <div class="form-group">
				<label for="inputName" class="col-lg-2 control-label">Car Models</label>
				<div class="col-lg-10">
					<?php echo $this->Form->input('carmodel_id', array('class' => 'form-control', 'label' => false)); ?>
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-lg-10 col-lg-offset-2">
				  <?php
					//echo $this->Html->link('Cancel', 'index', array('class' => 'btn btn-default'));
					echo $this->Form->submit('Submit', array('class' => 'btn btn-primary'));
				  ?>
				</div>
			  </div>
			</fieldset>
		  <?php echo $this->Form->end(); ?>
		</div>
	  </div>
	</div>
</div>