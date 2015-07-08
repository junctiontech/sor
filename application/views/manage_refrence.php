<div id="main-content">
<div class="page-title">
<div>
<h1><i class="fa fa-plus"></i> Reference</h1>
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
      	<h3><i class="fa fa-plus"></i>Reference</h3>
       </div>
       
      <div class="box-content">
			  <div class="row">
				<div class="col-md-2 col-md-offset-10">
					<a class="btn btn-primary btn-sm pull-right" href="<?=base_url()?>index.php/masters/manage_refrence"><i class="fa fa-plus"></i> REFERENCE</a>
				</div> 
			 </div>  
			 </br>  
			 <div class="table-big">
<?php if(count($refrence_list) && is_array($refrence_list)){?>
<table class="  table table-hover fill-head table-advance" id="table1">
									<thead>
									<tr>
									<th>#</th>
									<th style="width:10%">Reference Code </th>
									<th style="width:20%">Description</th>
									<th style="width:10%">Unit </th>
									<th style="width:20%">Rate</th>
									<th style="width:45%"></th>
									</tr>
									</thead>

				<tbody>
				<?php foreach($refrence_list as $key=>$subil){ ?>
              <tr>
			  <!--<td><?=$key+1?></td>-->
			  <td><div class="checkbox check-default" style="margin-right:auto;margin-left:auto;">
				   <input type="checkbox" value="1" id="checkbox1">
                        <label for="checkbox1"></label>
                      </div>
               </td>       
			  <td><?=$subil->name?></td>
			  <td><?=$subil->description?></td>
			   <?php $filter = array('unit_code'=>$subil->unit_code);
			  $unit_name= $this->utilities->get_unit_name('ssr_t_uom',$filter);
			?>
			  <td><?=($unit_name)?$unit_name[0]->unit_code:''?></td>
			  <td><?=$subil->cost_total?></td>
              <?php if($subil->cost_total==0) {?>
			   <td><a class="btn btn-inverse btn-sm" href="<?=base_url()?>index.php/masters/create_ref_cal/<?=$dep_id?>/<?=$chap_id?>/<?=$item_id?>/<?=$subil->id?>/<?=$subil->class_id?>"><i class="fa fa-money"></i> Calculation</a>&nbsp;<a class="btn btn-inverse btn-sm" href="<?=base_url()?>index.php/masters/manage_refrence/<?=$subil->id?>"><i class="fa fa-edit"></i> REFRENCE</a> <a class="btn btn-primary btn-sm" onClick="return confirm('Are you sure to delete this Item? This will delete all the related records on this Item as well.')" onClick="return confirm('Are you sure to delete this Refrence? This will delete all the related records on this Refrence as well.')" href="<?=base_url()?>index.php/masters/delete_material/0/0/0/0/0/0/0/<?=$subil->id?>"><i class="fa fa-edit"></i> DELETE</a></td>
				<?php } else {?>

				<td><a class="btn btn-primary btn-sm" href="<?=base_url()?>index.php/masters/create_ref_cal/<?=$dep_id?>/<?=$chap_id?>/<?=$item_id?>/<?=$subil->id?>/<?=$subil->class_id?>"><i class="fa fa-money"></i> Calculation </a>&nbsp;<a class="btn btn-inverse btn-sm" href="<?=base_url()?>index.php/masters/manage_refrence/<?=$subil->id?>"><i class="fa fa-edit"></i> REFRENCE</a> <a class="btn btn-primary btn-sm" href="<?=base_url()?>index.php/masters/delete_material/0/0/0/0/0/0/0/<?=$subil->id?>" onClick="return confirm('Are you sure to delete this Refrence? This will delete all the related records on this Refrence as well.')"><i class="fa fa-edit"></i> DELETE</a></td>
					<?php } }?>
				</tr>
		
                 </tbody>
					</table>
	</div>
	<?php } else {?>
				   <div class="row-fluid"><div class="alert alert-danger"><strong>No Record found </strong> </div></div>
				  <?php } ?>
				  
 
      </div>
      </div>
  </div>
</div>
