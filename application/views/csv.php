<!--header starts added by palak on 11feb -->
<div id="main-content">
<div class="page-title">
<div>
<h1><i class="fa fa-download"></i> <?php if(isset($namehome)==1){echo $namehome[132]->text;}else{echo "Import";}?></h1>
</div>
</div>
<div id="breadcrumbs">
<ul class="breadcrumb">

<li class="active"> <i class="fa fa-home"></i><?php echo($this->breadcrumb->output());?> </li>
</ul>
</div>
<!--header end added by palak on 11feb -->
 <div class="row">
  <div class="col-md-12">
      <div class="box box-blue">
      <div class="box-title">
      	<h3><i class="fa fa-download"></i><?php if(isset($namehome)==1){echo $namehome[132]->text;}else{echo "Import";}?></h3>
       </div>
<?php  if($this->session->flashdata('category_error')) { ?>
								<div class="row-fluid">
									<div class="alert alert-danger">
										<strong><?=$this->session->flashdata('message')?></strong> 
									</div>
									</div>
<?php }?>
	   
      <div class="box-content">
	   <?php if (isset($error)): ?>
                <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('success') == TRUE): ?>
                <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
            <?php endif; ?>
			  <div class="row">
			    
				<div class="col-md-4 col-md-offset-8" style="text-align:right;">
				 <form method="post" action="<?php echo base_url() ?>index.php/csv/importcsv" enctype="multipart/form-data" onsubmit="return validate()">
				 <span class="btn btn-default btn-file">
			<?php if(isset($namehome)==1){echo $namehome[133]->text;}else{echo "Browse";}?>	

                    <input type="file" id="file" name="userfile" >
					</span>
                     <input type="hidden" name="list_type" id="list_type" value="<?=$list_name?>" >
                    <input type="submit" name="submit" value="<?php if(isset($namehome)==1){echo $namehome[134]->text;}else{echo "UPLOAD";}?>" class="btn btn-primary">
                </form>
 
					
				</div> 
			 </div>  
			 </br>  
			 <?php if($csv_data){ ?>                  
	<div class="table-big">
			<table class="table table-hover fill-head table-advance" id="table1">
									<thead>
                <?php 
                if($list_name=='material'){?>
		
                  <tr>
                        <th><?php if(isset($namehome)==1){echo $namehome[57]->text;}else{echo "Material Code";}?></th>
                        <th><?php if(isset($namehome)==1){echo $namehome[138]->text;}else{echo "Material Description";}?></th>
                        <th><?php if(isset($namehome)==1){echo $namehome[139]->text;}else{echo "Material Unit";}?></th>
                        <th><?php if(isset($namehome)==1){echo $namehome[140]->text;}else{echo "Material Rate";}?> </th>
                       
                    </tr>
	  <?php }else if($list_name=='item'){?>
			
		  <tr>
		        <th><?php if(isset($namehome)==1){echo $namehome[19]->text;}else{echo "Department";}?></th>
                        <th><?php if(isset($namehome)==1){echo $namehome[108]->text;}else{echo "Chapter";}?></th>
                        <th><?php if(isset($namehome)==1){echo $namehome[78]->text;}else{echo "Item";}?> </th>
                        <th> <?php if(isset($namehome)==1){echo $namehome[36]->text;}else{echo "Item Description";}?></th>
                       
                    </tr>
		 	
		<?php }else if($list_name=='subitem'){?>
		  <tr>
                        <th><?php if(isset($namehome)==1){echo $namehome[19]->text;}else{echo "Department";}?> </th>
                        <th><?php if(isset($namehome)==1){echo $namehome[108]->text;}else{echo "Chapter";}?></th>
                        <th><?php if(isset($namehome)==1){echo $namehome[78]->text;}else{echo "Item";}?> </th>
                        <th><?php if(isset($namehome)==1){echo $namehome[30]->text;}else{echo "Subitem";}?> </th>
                        <th> <?php if(isset($namehome)==1){echo $namehome[135]->text;}else{echo "Subitem Description";}?></th>
                         <th><?php if(isset($namehome)==1){echo $namehome[136]->text;}else{echo "Subitem Unit";}?> </th>
                          <th> <?php if(isset($namehome)==1){echo $namehome[137]->text;}else{echo "Subitem Rate";}?></th>
                    </tr>
			
		<?php }else if($list_name=='labour'){?>
		 <tr>
                         <th><?php if(isset($namehome)==1){echo $namehome[61]->text;}else{echo "Labour Code";}?></th>
                        <th><?php if(isset($namehome)==1){echo $namehome[141]->text;}else{echo "Labour Description";}?> </th>
                        <th><?php if(isset($namehome)==1){echo $namehome[142]->text;}else{echo "Labour Unit";}?></th>
                        <th><?php if(isset($namehome)==1){echo $namehome[143]->text;}else{echo "Labour Rate";}?> </th>
                       
                    </tr>
			
		<?php }else if($list_name=='carriage'){?>
		    <tr>
                       <th><?php if(isset($namehome)==1){echo $namehome[68]->text;}else{echo "Carriage Code";}?> </th>
                        <th><?php if(isset($namehome)==1){echo $namehome[147]->text;}else{echo "Carriage Description";}?> </th>
                        <th><?php if(isset($namehome)==1){echo $namehome[148]->text;}else{echo "Carriage Unit";}?> </th>
                        <th><?php if(isset($namehome)==1){echo $namehome[149]->text;}else{echo "Carriage Rate";}?> </th>
                       
                    </tr>
			
		<?php }else{?>
			
		     <tr>
                         <th><?php if(isset($namehome)==1){echo $namehome[73]->text;}else{echo "Plant Code";}?> </th>
                        <th><?php if(isset($namehome)==1){echo $namehome[144]->text;}else{echo "Plant Description";}?> </th>
                        <th><?php if(isset($namehome)==1){echo $namehome[145]->text;}else{echo "Plant Unit";}?> </th>
                        <th><?php if(isset($namehome)==1){echo $namehome[146]->text;}else{echo "Plant Rate";}?></th>
                       
                    </tr>
		<?php }?>
                   
                </thead>

				  <tbody>
                    <?php if ($csv_data == FALSE): ?>
                        <tr><td colspan="4">There are currently No Addresses</td></tr>
                    <?php else: ?>
                     
                 
                       
                        
                <?php 
                   if($list_name=='material'){?>
		
                  <?php foreach ($csv_data as $row){?>
                       
                            <tr>
                                <td><?php echo $row['mat_name']; ?></td>
                                <td><?php echo $row['mat_desc']; ?></td>
										 <?php $filter = array('unit_code'=>$row['unit_code']);
											  $unit_name= $this->utilities->get_unit_name('ssr_t_uom',$filter);
											  //print_r($unit_name);die;
											 // print_r($unit_name[0]->unit_name);die;?>
								<td><?=($unit_name)?$unit_name[0]->unit_code:''?></td>
                               <td><?php echo $row['rate']; ?></td>
                               
                            </tr>
                 <?php } ?>
	      <?php }else if($list_name=='item'){?>
			
		  <?php foreach ($csv_data as $row){?>
                      
                            <tr>
							
							     <?php $filter = array('dep_id'=>$row['dep_id']);
											  $dep_name= $this->utilities->get_dep_name('ssr_t_department',$filter);
											  //print_r($unit_name);die;
											 // print_r($unit_name[0]->unit_name);die;?>
								<td><?=($dep_name)?$dep_name[0]->dep_name:''?></td>
                               <?php $filter = array('chap_id'=>$row['chap_id']);
											  $chap_name= $this->utilities->get_chap_name('ssr_t_chapter',$filter);
											  //print_r($unit_name);die;
											 // print_r($unit_name[0]->unit_name);die;?>
								<td><?=($chap_name)?$chap_name[0]->chap_name:''?></td>
							   
                                <td><?php echo $row['item_name']; ?></td>
                                <td><?php echo $row['item_desc']; ?></td>
                               
                            </tr>
                 <?php } ?>
		 	
		<?php }else if($list_name=='subitem'){?>
		        <?php foreach ($csv_data as $row){?>
                       
                            <tr>
                                  <?php $filter = array('dep_id'=>$row['dep_id']);
											  $dep_name= $this->utilities->get_dep_name('ssr_t_department',$filter);
											  //print_r($unit_name);die;
											 // print_r($unit_name[0]->unit_name);die;?>
								<td><?=($dep_name)?$dep_name[0]->dep_name:''?></td>
                               <?php $filter = array('chap_id'=>$row['chap_id']);
											  $chap_name= $this->utilities->get_chap_name('ssr_t_chapter',$filter);
											  //print_r($unit_name);die;
											 // print_r($unit_name[0]->unit_name);die;?>
								<td><?=($chap_name)?$chap_name[0]->chap_name:''?></td>
								
								 <?php $filter = array('item_id'=>$row['item_id']);
											  $item_name= $this->utilities->get_item_name('ssr_t_item',$filter);
											  //print_r($unit_name);die;
											 // print_r($unit_name[0]->unit_name);die;?>
								<td><?=($item_name)?$item_name[0]->item_name:''?></td>
                               
                                <td><?php echo $row['subitem_name']; ?></td>
                                 <td><?php echo $row['subitem_desc']; ?></td>   
								           <?php $filter = array('unit_code'=>$row['unit_code']);
											  $unit_name= $this->utilities->get_unit_name('ssr_t_uom',$filter);
											  //print_r($unit_name);die;
											 // print_r($unit_name[0]->unit_name);die;?>
								<td><?=($unit_name)?$unit_name[0]->unit_code:''?></td>
                                <td><?php echo $row['rate']; ?></td>
                            </tr>
                 <?php } ?>
			
		<?php }else if($list_name=='labour'){?>
		              <?php foreach ($csv_data as $row){?>
                       
                            <tr>
                                <td><?php echo $row['labour_name']; ?></td>
                                <td><?php echo $row['labour_description']; ?></td>
								      <?php $filter = array('unit_code'=>$row['unit_code']);
											  $unit_name= $this->utilities->get_unit_name('ssr_t_uom',$filter);
											  //print_r($unit_name);die;
											 // print_r($unit_name[0]->unit_name);die;?>
								<td><?=($unit_name)?$unit_name[0]->unit_code:''?></td>
                               <td><?php echo $row['labour_rate']; ?></td>
                               
                            </tr>
                 <?php } ?>
			
		<?php }else if($list_name=='carriage'){?>
		         <?php foreach ($csv_data as $row){ ?>
                      
                            <tr>
                                <td><?php echo $row['carriage_code']; ?></td>
                                <td><?php echo $row['carriage_description']; ?></td>
								<?php $filter = array('unit_code'=>$row['unit_code']);
											  $unit_name= $this->utilities->get_unit_name('ssr_t_uom',$filter);
											  //print_r($unit_name);die;
											 // print_r($unit_name[0]->unit_name);die;?>
								<td><?=($unit_name)?$unit_name[0]->unit_code:''?></td>
                                <td><?php echo $row['carriage_rate']; ?></td>
                               
                            </tr>
                 <?php } ?>
			
		<?php }else{?>
			
		      <?php foreach ($csv_data as $row){?>
                       
                            <tr>
                                <td><?php echo $row['pla_code']; ?></td>
                                <td><?php echo $row['pla_desc']; ?></td>
								    <?php $filter = array('unit_code'=>$row['unit_code']);
											  $unit_name= $this->utilities->get_unit_name('ssr_t_uom',$filter);
											  //print_r($unit_name);die;
											 // print_r($unit_name[0]->unit_name);die;?>
								<td><?=($unit_name)?$unit_name[0]->unit_code:''?></td>
                               <td><?php echo $row['rate']; ?></td>
                               
                            </tr>
                 <?php } ?>
		<?php }?>
                        
                   
                        
                    <?php endif; ?>
                </tbody>
					</table>
	</div>
	<?php } ?>
				  
 
      </div>
      </div>
  </div>
</div>
<!--Content ends added by palak on 13 jan -->
 <script>
function validate() {
    var filename=document.getElementById('file').value;
    var extension=filename.substr(filename.lastIndexOf('.')+1).toLowerCase();
    //alert(extension);
    if(extension=='csv') {
        return true;
    } else {
        alert('Not Allowed Extension!');
        return false;
    }
}
</script> 
<!--header starts added by palak on 11feb -->
