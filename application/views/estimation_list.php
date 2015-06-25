<div id="main-content">
<div class="page-title">
<div>
<h1><i class="fa fa-plus"></i> Estimations</h1>
</div>
</div>
<div id="breadcrumbs">
<ul class="breadcrumb">

<li class="active"> <i class="fa fa-home"></i><?php echo($this->breadcrumb->output());?> </li>
</ul>
</div>
<!--header end added by palak on 13 jan -->
<?php  if($this->session->flashdata('category_error')) { ?>
								<div class="row-fluid">
									<div class="alert alert-danger">
										<strong><?=$this->session->flashdata('message')?></strong> 
									</div>
									</div>
<?php }?>
<?php  if($this->session->flashdata('message_type')) { ?>
								<div class="row-fluid">
									<div class="alert alert-success">
									<strong><?=$this->session->flashdata('message')?></strong> 
									</div>
									</div>
							<?php }?>
<!--Content starts added by palak on 13 jan -->
<div class="row">
  <div class="col-md-12">
     <div class="box box-blue">
      <div class="box-title">
      	<h3><i class="fa fa-plus"></i>Estimations</h3>
       </div>
       
      <div class="box-content">
		
			<table class=" table table-striped table-bordered  table-hover fill-head" >
									<thead>
									<tr>
									<th style="width:10%">No.</th>
									<th style="width:10%">Date</th>
									<th style="width:25%">Description</th>
									<th style="width:10%">Status</th>
									<th style="width:55%"></th>
									</tr>
									</thead>

				<tbody>
				<?php  foreach($estimate as $key=>$est){ ?>
					<tr>
						<td>					   
						<?=$est->est_id?>
						</td>   
						<td>		
						<?=$est->created_on?>
						</td>  
						<td>		
						<?=$est->est_description?>
						</td>
						<td>		
						<?=$est->est_status?>
						</td>
						<td>
						<?php if($est->est_status!='final'){ ?>
						<a class="btn btn-primary btn-sm" href="<?=base_url()?>index.php/estimation_controller/edit_estimation/<?=$est->est_id?>"><i class="fa fa-edit"></i> Edit </a>
						<a class="btn btn-primary btn-sm" onClick="return confirm('Are you sure to delete this Estimate? This will delete all the related records on this Estimate as well.')" href="<?=base_url()?>index.php/estimation_controller/delete_estimate/<?=$est->est_id?>"><i class="fa fa-trash-o"></i> Delete</a>
						<a class="btn btn-primary btn-sm" href="<?=base_url()?>index.php/estimation_controller/final_estimate/<?=$est->est_id?>"><i class="fa fa-lock"></i> Finalize</a>
						<?php } ?>
						
						<a class="btn btn-primary btn-sm" href="<?=base_url()?>index.php/estimation_controller/edit_estimation/<?=$est->est_id?>/<?=$V=1;?>"><i class="fa fa-edit"></i> View </a>
						<a class="btn btn-primary btn-sm" href="<?=base_url()?>index.php/estimation_controller/estimate_pdf/<?=$est->est_id?>"><i class="fa fa-edit"></i> Generate PDF </a></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
      </div>
  </div>
</div>
