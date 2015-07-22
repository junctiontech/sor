<div id="main-content">
<div class="page-title">
<div>
<h1><i class="fa fa-dashboard"></i> <?php if(isset($namehome)==1){echo $namehome[15]->text;}else{echo "Dashboard";}?></h1>

</div>
</div>
<div id="breadcrumbs">
<ul class="breadcrumb">
<li class="active"><?php echo($this->breadcrumb->output());?> </li>
</ul>
</div>
<div id="show_estimaed">
<div class="row">
	    <div class="col-md-4 col-md-offset-8 ">
		  
			   <input type="button" value="<?php if(isset($namehome)==1){echo $namehome[29]->text;}else{echo "ESTIMATION";}?>" onClick="document.getElementById('form-id').submit();" class="btn btn-primary "> 
			<a href="<?=base_url()?>index.php/home/manage_subitem/<?=$dep_id?>/<?=$chap_id?>/<?=$item_id?>"><button class="btn btn-primary "  ><i class="fa fa-plus"></i> <?php if(isset($namehome)==1){echo $namehome[24]->text;}else{echo "SUBITEM";}?> </button></a>
		</div>
	 </div>
	 </br>
	  <?php  if($this->session->flashdata('ct_success')) { ?>
								<div class="row-fluid">
									<div class="alert alert-success">
										<strong><?=$this->session->flashdata('message')?></strong> 
									</div>
									</div>
<?php }?>
 <?php  if($this->session->flashdata('cate_success')) { ?>
								<div class="row-fluid">
									<div class="alert alert-success">
										<strong><?=$this->session->flashdata('message')?></strong> 
									</div>
									</div>
<?php }?>
  <?php  if($this->session->flashdata('cat_success')) { ?>
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

 <?php  if($this->session->flashdata('sat_error')) {  ?>
									<div class="form-group">
										<div class="alert alert-danger">
										<a href="javascript:;" class="goto-register"><strong><?=$this->session->flashdata('message')?></strong></a>
	
										</div>
										</div>

								<?php }?>  
	 <form action="<?=base_url()?>index.php/estimation_controller/estimation/<?=$dep_id?>/<?=$chap_id?>/<?=$item_id?>" method="post" id="form-id">


<?php if(count($subitem_list) && is_array($subitem_list)){?>
<div class="table-big">
<table class=" table table-hover fill-head table-advance" id="table1">
									<thead>
									<tr>
									<th style="width:2%">#</th>
									<th style="width:10%"><?php if(isset($namehome)==1){echo $namehome[33]->text;}else{echo "Subitem Code";}?> </th>
									<th style="width:20%"> <?php if(isset($namehome)==1){echo $namehome[10]->text;}else{echo "Description";}?></th>
									<th style="width:10%"><?php if(isset($namehome)==1){echo $namehome[34]->text;}else{echo "Unit";}?> </th>
									<th style="width:10%"><?php if(isset($namehome)==1){echo $namehome[25]->text;}else{echo "Class";}?> </th>
									<th style="width:10%"><?php if(isset($namehome)==1){echo $namehome[35]->text;}else{echo "Rate";}?></th>
									
									<th style="width:40%"><?php if(isset($namehome)==1){echo $namehome[36]->text;}else{echo "Action";}?></th>
									</tr>
									</thead>

				<tbody>
				<?php foreach($subitem_list as $key=>$subil){?>
				
                <tr>
			 
			  <td>
			  
			  
			  <div class="checkbox check-default" style="margin-right:auto;margin-left:auto;" id="checkboxlist">
				   <input type="checkbox" name="select[]" id="select_<?=$key+1?>" class="chk" value="<?=$subil->subitem_id?>"/>
                      </div>
                      
               </td>       
			  <td><?=$subil->subitem_name?></td>
			  <td><?=$subil->subitem_desc?></td>
			 
			  <?php $filter = array('unit_code'=>$subil->unit_code);
			  $unit_name= $this->utilities->get_unit_name('ssr_t_uom',$filter);
			?>
			  <td><?=($unit_name)?$unit_name[0]->unit_code:''?></td>
			  <?php $filter = array('id'=>$subil->subitem_class_id);
			  $class_name= $this->utilities->get_cls_name('ssr_t_class',$filter);
			  //print_r($unit_name);die;
			 // print_r($unit_name[0]->unit_name);die;?>
			  <td><?=($class_name)?$class_name[0]->class_name:''?></td>
			  <td><?=$subil->rate?></td>
              <?php if($subil->rate==0) {?>
			   <td><a class="btn btn-inverse btn-sm" href="<?=base_url()?>index.php/home/create_sub_item/<?=$dep_id?>/<?=$chap_id?>/<?=$item_id?>/<?=$subil->subitem_id?>/<?=$subil->subitem_class_id?>"><i class="fa fa-money"></i><?php if(isset($namehome)==1){echo $namehome[31]->text;}else{echo "Calculation";}?></a>&nbsp;&nbsp;<a class="btn btn-inverse btn-sm" href="<?=base_url()?>index.php/home/manage_subitem/<?=$dep_id?>/<?=$chap_id?>/<?=$item_id?>/<?=$subil->subitem_id?>"><i class="fa fa-edit"></i> <?php if(isset($namehome)==1){echo $namehome[24]->text;}else{echo "SUBITEM";}?></a>&nbsp;&nbsp;<a class="btn btn-inverse btn-sm" onClick="return confirm('Are you sure to delete this SUBITEM? This will delete all the related records on this SUBITEM as well.')" href="<?=base_url()?>index.php/home/delete_subitem/<?=$dep_id?>/<?=$chap_id?>/<?=$item_id?>/<?=$subil->subitem_id?>/<?=$subil->subitem_class_id?>"><i class="fa fa-edit"></i> <?php if(isset($namehome)==1){echo $namehome[32]->text;}else{echo "DELETE SUBITEM";}?></a></td></tr>
				<?php } else {?>

				<td><a class="btn btn-primary btn-sm" href="<?=base_url()?>index.php/home/create_sub_item/<?=$dep_id?>/<?=$chap_id?>/<?=$item_id?>/<?=$subil->subitem_id?>/<?=$subil->subitem_class_id?>"><i class="fa fa-money"></i><?php if(isset($namehome)==1){echo $namehome[31]->text;}else{echo "Calculation";}?></a>&nbsp;&nbsp;<a class="btn btn-inverse btn-sm" href="<?=base_url()?>index.php/home/manage_subitem/<?=$dep_id?>/<?=$chap_id?>/<?=$item_id?>/<?=$subil->subitem_id?>"><i class="fa fa-edit"></i><?php if(isset($namehome)==1){echo $namehome[24]->text;}else{echo "SUBITEM";}?> <a>&nbsp;&nbsp;<a class="btn btn-primary btn-sm" onClick="return confirm('Are you sure to delete this SUBITEM? This will delete all the related records on this SUBITEM as well.')" href="<?=base_url()?>index.php/home/delete_subitem/<?=$dep_id?>/<?=$chap_id?>/<?=$item_id?>/<?=$subil->subitem_id?>/<?=$subil->subitem_class_id?>"><i class="fa fa-edit"></i> <?php if(isset($namehome)==1){echo $namehome[32]->text;}else{echo "DELETE SUBITEM";}?></a></td></tr>
					<?php } } ?>

		
                   </tbody>
					</table>
</div>	
</form>
	<?php } else {?>
				   <div class="row-fluid" style="padding:9px;"><div class="alert alert-warning"><strong>No Record found </strong> </div></div>
				  <?php } ?>
	</div>	
<script>
	//function hello()
	//{
	//	alert('Please select atleast one item');
		
	//	<?php //redirect("home/get_subitem_list/".$dep_id."/".$chap_id."/".$item_id.""); ?>
	//}
	
</script>
<? //redirect('subitem_list','refresh');?>
