<?php //print_r($overhead_list);die;?>
<?php $user_session_data =$this->session->userdata('user_data'); ?>
<!--header starts added by palak on 13 jan -->
<div id="main-content">
<div class="page-title">
<div>
<h1><i class="fa fa-plus"></i><?php if(isset($namehome)==1){echo $namehome[85]->text;}else{echo "Language";}?> 	</h1>
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
      	<h3><i class="fa fa-plus"></i><?php if(isset($namehome)==1){echo $namehome[85]->text;}else{echo "Language";}?></h3>
       </div>
      
      <div class="box-content">
			  <div class="row">
				<div class="col-md-2 col-md-offset-10">
					<a class="btn btn-primary btn-sm pull-right" href="<?=base_url()?>index.php/home/manage_language"><i class="fa fa-plus"></i><?php if(isset($namehome)==1){echo $namehome[85]->text;}else{echo "Language";}?></a>
				</div> 
			 </div>  
			 </br>       
<div class="table-big">			 
			<?php if(count($language_list) && is_array($language_list)){?>
			<table class=" table table-hover fill-head table-advance" id="table1">
						<thead>
						<tr>
						<th>#</th>
						<th><?php if(isset($namehome)==1){echo $namehome[86]->text;}else{echo "Language Code";}?></th>
						<th><?php if(isset($namehome)==1){echo $namehome[87]->text;}else{echo "Language Name";}?></th>
						
						<th></th>
						</tr>
						</thead>

						<tbody>
						<?php foreach($language_list as $key=>$ul){ ?>
					  <tr>
						  <td><?=$key+1?></td>
						  <td><?=$ul->language_id?></td>
						  <td><?=$ul->language_name?></td>
						
						  <td><a class="btn btn-primary btn-sm" href="<?=base_url()?>index.php/home/manage_language/<?=$ul->language_id?>"><i class="fa fa-edit"></i><?php if(isset($namehome)==1){echo $namehome[55]->text;}else{echo "Edit";}?> </a> <a class="btn btn-primary btn-sm" onClick="return confirm('Are you sure to delete this Language? This will delete all the related records on this Uint as well.')" href="<?=base_url()?>index.php/home/delete_language/<?=$ul->language_id?>"><i class="fa fa-edit"></i><?php if(isset($namehome)==1){echo $namehome[56]->text;}else{echo "DELETE";}?> </a>
						  <a class="btn btn-primary btn-sm" href="<?=base_url()?>index.php/home/language_page/<?=$ul->language_id?>"><i class="fa fa-view"></i><?php if(isset($namehome)==1){echo $namehome[88]->text;}else{echo "Language page";}?></a></td>
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
