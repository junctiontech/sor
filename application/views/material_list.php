<?php //print_r($overhead_list);die;?>
<!--header starts added by palak on 13 jan -->
<div id="main-content">
<div class="page-title">
<div>
<h1><i class="fa fa-plus"></i> Material</h1>
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
      	<h3><i class="fa fa-plus"></i>Material</h3>
       </div>
       
      <div class="box-content">
			  <div class="row">
				<div class="col-md-2 col-md-offset-10">
					<a class="btn btn-primary btn-sm pull-right" href="<?=base_url()?>index.php/masters/manage_material"><i class="fa fa-plus"></i> MATERIAL</a>
				</div> 
			 </div>  
			 </br>      
	<div class="table-big">			 
			<?php if(count($mat_list) && is_array($mat_list)){?>
			<table class="table table-hover fill-head table-advance" id="table1">
									<thead>
									<tr>
									<th>#</th>
									<th style="width:10%">Material Code</th>
									<th style="width:30%">Description</th>
									<th style="width:20%">Unit </th>
									<th style="width:10%">Class </th>
									<th style="width:10%">Rate</th>
									<th style="width:30%"></th>
									</tr>
									</thead>

				<tbody>
				<?php foreach($mat_list as $key=>$li){ ?>
              <tr>
			  <td><?=$key+1?></td>
			  <td ><?=$li->mat_name?></td>
			  <td><?=$li->mat_desc?></td>
			  <?php $filter = array('unit_code'=>$li->unit_code);
			  $unit_name= $this->utilities->get_unit_name('ssr_t_uom',$filter);
			  //print_r($unit_name);die;
			 // print_r($unit_name[0]->unit_name);die;?>
			  <td><?=($unit_name)?$unit_name[0]->unit_code:''?></td>
			  <?php $filter = array('id'=>$li->material_class_id);
			  $class_name= $this->utilities->get_cls_name('ssr_t_class',$filter);
			  //print_r($unit_name);die;
			 // print_r($unit_name[0]->unit_name);die;?>
			  <td><?=($class_name)?$class_name[0]->class_name:''?></td>
			  <td><?=$li->rate?></td>
			  <td><a class="btn btn-primary btn-sm" href="<?=base_url()?>index.php/masters/manage_material/<?=$li->mat_code?>"><i class="fa fa-edit"></i> Edit</a> <a class="btn btn-primary btn-sm" onClick="return confirm('Are you sure to delete this Material? This will delete all the related records on this Material as well.')" href="<?=base_url()?>index.php/masters/delete_material/<?=$li->mat_code?>"><i class="fa fa-edit"></i> DELETE</a></td>
		</tr>

		        <?php }?>
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
<!--Content ends added by palak on 13 jan -->
