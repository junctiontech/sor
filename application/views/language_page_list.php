<?php //print_r($overhead_list);die;?>
<?php $user_session_data =$this->session->userdata('user_data'); ?>
<!--header starts added by palak on 13 jan -->
<div id="main-content">
<div class="page-title">
<div>
<h1><i class="fa fa-plus"></i><?php if(isset($namehome)==1){echo $namehome[88]->text;}else{echo "Language Page";}?> </h1>
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
      	<h3><i class="fa fa-plus"></i><?php if(isset($namehome)==1){echo $namehome[88]->text;}else{echo "Language Page";}?></h3>
       </div>
      
      <div class="box-content">
			  <div class="row">
				
			 </div>  
			 </br>       
<div class="table-big">			 
			<?php if(count($language_page_list) && is_array($language_page_list)){?>
			<table class=" table table-hover fill-head table-advance" id="table1">
						<thead>
						<tr>
						<th>#</th>
						<th><?php if(isset($namehome)==1){echo $namehome[88]->text;}else{echo "Language Page";}?></th>
						<th><?php if(isset($namehome)==1){echo $namehome[36]->text;}else{echo "Action";}?></th>
						</tr>
						</thead>

						<tbody>
						<?php foreach($language_page_list as $key=>$ul){ ?>
					  <tr>
						  <td><?=$key+1?></td>
						  <td><?=$ul->page?></td>
						
						  <td><a class="btn btn-primary btn-sm" href="<?=base_url()?>index.php/home/language_text/<?=$ul->page?>"><i class="fa fa-edit"></i><?php if(isset($namehome)==1){echo $namehome[89]->text;}else{echo "VIEW";}?>  </a> 
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
