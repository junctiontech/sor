<?php //print_r($overhead_list);die;?>
<!--header starts added by palak on 13 jan -->
<div id="main-content">
<div class="page-title">
<div>
<h1><i class="fa fa-plus"></i> Labor</h1>
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
<?php } ?>
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
      	<h3><i class="fa fa-plus"></i>Labor</h3>
       </div>
       
      <div class="box-content">
			  <div class="row">
				<div class="col-md-2 col-md-offset-10">
					<a class="btn btn-primary btn-sm pull-right" href="<?=base_url()?>index.php/masters/manage_labour"><i class="fa fa-plus"></i> LABOR</a>
				</div> 
			 </div>  
			 </br>                     
			<?php if(count($labour_list) && is_array($labour_list)){?>
			<table class="table-two-td table table-striped table-bordered table-advance table-hover fill-head" id="table1">
									<thead>
									<tr>
									<th>#</th>
									<th>Labor Code</th>
									<th>Description</th>
									<th>Unit </th>
									<th>Rate</th>
									<th></th>
									</tr>
									</thead>

				<tbody>
				<?php foreach($labour_list as $key=>$li){ ?>
              <tr>
			  <td><?=$key+1?></td>
			  <td><?=$li->labour_name?></td>
			  <td><?=$li->labour_description?></td>
			   <?php $filter = array('unit_code'=>$li->unit_code);
			   
			  $unit_name= $this->utilities->get_unit_name('ssr_t_uom',$filter);
			
			?>
			  <td><?=($unit_name)?$unit_name[0]->unit_code:''?></td>
			  
			  <td><?=$li->labour_rate?></td>
			  <td><a class="btn btn-primary btn-sm" href="<?=base_url()?>index.php/masters/manage_labour/<?=$li->labour_name?>"><i class="fa fa-edit"></i> Edit</a> <a class="btn btn-primary btn-sm" onClick="return confirm('Are you sure to delete this Labour? This will delete all the related records on this Labour as well.')" href="<?=base_url()?>index.php/masters/delete_material/0/<?=$li->labour_name?>"><i class="fa fa-edit"></i> DELETE</a></td>
		</tr>

		        <?php }?>
                   </tbody>
					</table>
	
	<?php } else {?>
				   <div class="row-fluid"><div class="alert alert-danger"><strong>No Record found </strong> </div></div>
				  <?php } ?>
				  
 
      </div>
      </div>
  </div>
</div>
<!--Content ends added by palak on 13 jan -->
