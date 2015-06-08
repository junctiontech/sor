<div id="main-content">
<div class="page-title">
<div>
<h1><i class="fa fa-dashboard"></i> Dashboard</h1>
</div>
</div>
<div id="breadcrumbs">
<ul class="breadcrumb">
<li class="active"><?php echo($this->breadcrumb->output());?> </li>
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
					<a href="<?=base_url()?>index.php/home/add_chapter/<?=$dep_id?>"><button class="btn btn-primary pull-right"  ><i class="fa fa-plus"></i> CHAPTER</button></a>
					</div>
				</div>
			</br>
	
<div class="row">
	<?php //print_r($chap_list);die;
	if(count($chap_list) && is_array($chap_list)){
					foreach($chap_list as $cl){  ?>
		<div class="col-md-4">			
			<a href="<?=base_url()?>index.php/home/item/<?=$cl->dep_id?>/<?=$cl->chap_id?>">
				<div class="tile-title tile-primary">
					<div class="icon">
					<i class="glyphicon glyphicon-random"></i>
					</div>
					<div class="title">
					<h3><a href="<?=base_url()?>index.php/home/item/<?=$cl->dep_id?>/<?=$cl->chap_id?>"><?=$cl->chap_name?></a></h3>
					<p ><a class="pull-right" style=" margin-right: 9px; color: #fff;"href="<?=base_url()?>index.php/home/add_chapter/<?=$cl->dep_id?>/<?=$cl->chap_id?>"><i class="fa fa-edit"></i> Edit </a>
					<a class="pull-right" style="margin-right: 9px; color: #fff;" 
					href="<?=base_url()?>PDFGeneration/index.php/?dep_id=<?=$cl->dep_id?>&chap_id=<?=$cl->chap_id?>" target="_blank"><i class="fa fa-download"></i> Generate PDF</a></p>
					</div>
				</div>
			</a>
		</div>
						
			
	<?php }?>
		<?php } else {
				   echo "<div class='row-fluid'style='padding: 12px;'><div class='alert alert-danger'><strong>No Record found </strong> </div></div>";
				   } ?>
	
	

</div>
