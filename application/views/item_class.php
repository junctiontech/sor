<?php //print_r($overhead_list);die;?>
<!--header starts added by palak on 13 jan -->
<div id="main-content">
<div class="page-title">
<div>
<h1><i class="fa fa-plus"></i><?php if(isset($namehome)==1){echo $namehome[25]->text;}else{echo "Class";}?> </h1>
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
      	<h3><i class="fa fa-plus"></i><?php if(isset($namehome)==1){echo $namehome[25]->text;}else{echo "Class";}?></h3>
       </div>
      
      <div class="box-content">
			  <div class="row">
				<div class="col-md-2 col-md-offset-10">
					<a class="btn btn-primary btn-sm pull-right" href="<?=base_url()?>index.php/masters/manage_item_class"><i class="fa fa-plus"></i><?php if(isset($namehome)==1){echo $namehome[25]->text;}else{echo "Class";}?> </a>
				</div> 
			 </div>  
			 </br>      
<div class="table-big">			 
			<?php if(count($class_list) && is_array($class_list)){?>
			<table class=" table table-hover fill-head table-advance" id="table1">
						<thead>
						<tr>
						<th>#</th>
						<th><?php if(isset($namehome)==1){echo $namehome[25]->text;}else{echo "Class";}?></th>
						<th><?php if(isset($namehome)==1){echo $namehome[10]->text;}else{echo "Description";}?></th>
						<th><?php if(isset($namehome)==1){echo $namehome[11]->text;}else{echo "Heading";}?></th>
						<th><?php if(isset($namehome)==1){echo $namehome[12]->text;}else{echo "Notes";}?></th>
						
						<th></th>
						</tr>
						</thead>

						<tbody>
						<?php foreach($class_list as $key=>$cl){ ?>
					  <tr>
						  <td><?=$key+1?></td>
						  <td><?=$cl->class_name?></td>
						  <td><?=$cl->class_desc?></td>
						  <td><?=$cl->class_heading?></td>
						  <td><?=$cl->class_notes?></td>
						
						  <td><a class="btn btn-primary btn-sm" href="<?=base_url()?>index.php/masters/manage_item_class/<?=$cl->id?>"><i class="fa fa-edit"></i><?php if(isset($namehome)==1){echo $namehome[55]->text;}else{echo "Edit";}?> </a> <a class="btn btn-primary btn-sm" onClick="return confirm('Are you sure to delete this Class? This will delete all the related records on this Class as well.')" href="<?=base_url()?>index.php/masters/delete_material/0/0/0/0/0/0/<?=$cl->id?>"><i class="fa fa-edit"></i><?php if(isset($namehome)==1){echo $namehome[56]->text;}else{echo "DELETE";}?> </a>
						  </td>
					 </tr>

						<?php }?>
					   </tbody>
		   </table>
	</div>
	<?php } else {?>
				   <div class="row-fluid"><div class="alert alert-danger"><strong>No Record found </strong> </div></div>  <?php } ?>
				  
 
      </div>
      </div>
  </div>
</div>
<!--Content ends added by palak on 13 jan -->
