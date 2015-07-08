<?php //print_r($overhead_list);die;?>
<!--header starts added by palak on 02 feb -->
<div id="main-content">
<div class="page-title">
<div>
<h1><i class="fa fa-plus"></i> Carriage</h1>
</div>
</div>
<div id="breadcrumbs">
<ul class="breadcrumb">

<li class="active"> <i class="fa fa-home"></i><?php echo($this->breadcrumb->output());?> </li>
</ul>
</div>
<!--header end added by palak on 02 feb -->
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
<!--Content starts added by palak on 02 feb -->
<div class="row">
  <div class="col-md-12">
      <div class="box box-blue">
      <div class="box-title">
      	<h3><i class="fa fa-plus"></i>Carriage</h3>
       </div>
      
      <div class="box-content">
			  <div class="row">
				<div class="col-md-2 col-md-offset-10">
					<a class="btn btn-primary btn-sm pull-right" href="<?=base_url()?>index.php/masters/manage_carriage"><i class="fa fa-plus"></i> Carriage</a>
				</div> 
			 </div>  
			 </br>   
<div class="table-big">			 
			<?php if(count($carriage_list) && is_array($carriage_list)){?>
			<table class=" table table-hover fill-head table-advance" id="table1">
									<thead>
									<tr>
									<th>#</th>
									<th style="width:10%">Carriage Code</th>
									<th style="width:20%">Description</th>
									<th style="width:15%">Carriage Category</th>
									<th style="width:10%">Carriage Subcategory</th>
									<th style="width:10%">Unit </th>
									<th style="width:10%">Rate</th>
									<th style="width:35%"></th>
									</tr>
									</thead>

				<tbody>
				<?php foreach($carriage_list as $key=>$li){ ?>
              <tr>
			  <td><?=$key+1?></td>
			  <td><?=$li->carriage_code?></td>
			  <td><?=$li->carriage_description?></td>
			   <?php $filter = array('id'=>$li->carriage_category);
			  $cat_name= $this->utilities->get_cat_name('ssr_t_carriage_cate',$filter);
			?>
			  <td><?=($cat_name)?$cat_name[0]->name:''?></td>
			   <?php $filter = array('id'=>$li->carriage_sub_category);
			  $subcat_name= $this->utilities->get_subcat_name('ssr_t_carriage_sub_cate',$filter);
			?>
			   <td><?=($subcat_name)?$subcat_name[0]->sub_category:''?></td>
			   <?php $filter = array('unit_code'=>$li->unit_code);
			  $unit_name= $this->utilities->get_unit_name('ssr_t_uom',$filter);
			?>
			  <td><?=($unit_name)?$unit_name[0]->unit_code:''?></td>
			
			  <td><?=$li->carriage_rate?></td>

			  <td><a class="btn btn-primary btn-sm" href="<?=base_url()?>index.php/masters/manage_carriage/<?=$li->carriage_code?>"><i class="fa fa-edit"></i> Edit</a> <a class="btn btn-primary btn-sm" onClick="return confirm('Are you sure to delete this Carriage? This will delete all the related records on this Carriage as well.')" href="<?=base_url()?>index.php/masters/delete_material/0/0/0/0/<?=$li->carriage_code?>"><i class="fa fa-edit"></i> DELETE</a>
			  <!--<a class="btn btn-primary btn-sm" href="<?=base_url()?>index.php/masters/manage_carriage_cal/<?=$li->carriage_code?>"><i class="fa fa-edit"></i> Calculation</a></td>-->

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
<!--Content ends added by palak on 02 feb -->
