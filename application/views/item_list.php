<?php $user_session_data = $this->session->userdata('user_data'); ?>
<div id="main-content">
<div class="page-title">
<div>
<h1><i class="fa fa-dashboard"></i><?php if(isset($namehome)==1){ echo $namehome[78]->text;  }else{echo"Items";}?> </h1>

</div>
</div>
<div id="breadcrumbs">
<ul class="breadcrumb">
<li class="active"><?php echo($this->breadcrumb->output());?> </li>
</ul>
</div>
<?php  if($this->session->flashdata('message_type')) { ?>
								<div class="row-fluid">
									<div class="alert alert-success">
									
								
									<strong><?=$this->session->flashdata('message')?></strong> 
									
								
									
									</div>
									</div>
<?php }?>
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
<div class="row">
	<div class="col-md-4 col-md-offset-8" style="text-align: right;">
		
		 <a href="<?=base_url()?>index.php/home/create_item/<?=$dep_id?>/<?=$chap_id?>"><button class="btn btn-primary "><i class="fa fa-plus"></i><?php if(isset($namehome)==1){ echo $namehome[21]->text;  }else{echo"ITEM";}?> </button></a>
	</div>

</div> </br> 
 <?php if(count($item_list) && is_array($item_list)){?>
				

<?php 	foreach($item_list as $key=>$il){ ?>
	<div class="box  ">
	<div class="box-title item_box row">
	<div class="col-md-1"><h3><i class="fa fa-th-list"></i><a href="javascript:;" class="text-white"> <?=$il->item_name?></a></h3></div>
	<div class="col-md-8" > <h3 style=" width: 82%; overflow: hidden;" ><?=$il->item_desc?></h3></div>
	<div class="col-md-3" > 
	<div class="box-tool">
		<a href="<?=base_url()?>index.php/home/create_item/<?=$il->dep_id?>/<?=$il->chap_id?>/<?=$il->item_id?>" ><button class="btn btn-default btn-sm "style="margin-top: -5px;
"><i class="fa fa-edit"></i><?php if(isset($namehome)==1){ echo $namehome[22]->text;  }else{echo"EDIT ITEM";}?> </button></a>
<a href="<?=base_url()?>index.php/home/delete_item/<?=$il->dep_id?>/<?=$il->chap_id?>/<?=$il->item_id?>" onClick="return confirm('Are you sure to delete this Item? This will delete all the related records on this Item as well.')"><button class="btn btn-default btn-sm "style="margin-top: -5px;
"><i class="fa fa-close"></i><?php if(isset($namehome)==1){ echo $namehome[23]->text;  }else{echo"DELETE ITEM";}?> </button></a>

	<a href="<?=base_url()?>index.php/home/get_subitem_list/<?=$il->dep_id?>/<?=$il->chap_id?>/<?=$il->item_id?>" ><button class="btn btn-default btn-sm "style="margin-top: -5px;
"><i class="fa fa-list"></i><?php if(isset($namehome)==1){ echo $namehome[24]->text;  }else{echo"SUBITEM";}?> </button></a>
	<a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
	
	</div>
	</div>
	</div>
	<div class="box-content" style="display:none">
	<div class="row">
	<div class="col-md-12">
	<p><?=$il->item_desc?></p>
	
	</div>

	</div>
	
	</div>		
	</div>
	

      <?php }?>



 <?php } else {?>
				   <div class="row-fluid" style="padding:9px;"><div class="alert alert-warning"><strong>No Record found </strong> </div></div>
				  <?php } ?>
           
