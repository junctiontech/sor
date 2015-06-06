<div id="main-content">
<div class="page-title">
<div>
<h1><i class="fa fa-dashboard"></i> Dashboard</h1>
</div>
</div>
<div id="breadcrumbs">
<ul class="breadcrumb">


<li class="active"> <i class="fa fa-home"></i><?php echo($this->breadcrumb->output());?> </li>
</ul>

</div>
<?php  if($this->session->flashdata('category_error')) { ?>
								<div class="row-fluid">
									<div class="alert alert-danger">
									
								
									<strong><?=$this->session->flashdata('message')?></strong> 
									
								
									
									</div>
									</div>
<?php }?>
<?php  if($this->session->flashdata('category_error_block')) { ?>
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
		
				<!--ADD CODE -->
				<div class="row">
				   <div class="col-md-2 col-md-offset-10">
					<a href="<?=base_url()?>index.php/home/add_department"><button class="btn btn-primary pull-right"  ><i class="fa fa-plus"></i> DEPARTMENT</button></a>
					</div>
				</div>
			</br>
	
		
	<div class="row">
		<?php if(count($dep_list) && is_array($dep_list)){
						foreach($dep_list as $dl){ ?>
			<div class="col-md-4">				
				<a href="<?=base_url()?>index.php/home/chapter/<?=$dl->dep_id?>">
					<div class="tile-title tile-primary">
						<div class="icon">
						 <i class="glyphicon glyphicon-link"></i>
						</div>
							<div class="title">
							<h3><a href="<?=base_url()?>index.php/home/chapter/<?=$dl->dep_id?>"><?=$dl->dep_name?></a></h3>
							<p><a class="pull-right" style="margin-right: 9px; color: #fff;"href="<?=base_url()?>index.php/home/add_department/<?=$dl->dep_id?>"><i class="fa fa-edit"></i> Edit </a>
							
							</div>
					</div>
                </a>	
                </div>		
			

     <?php }?>
		<?php } else {
				   echo "<div class='row-fluid'style='padding: 12px;'><div class='alert alert-danger'><strong>No Record found </strong> </div></div>";
				   } ?>
	
				

</div>
