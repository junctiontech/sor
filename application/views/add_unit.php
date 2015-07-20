<!--header starts added by palak on 13 jan -->
<div id="main-content">
<div class="page-title">
<div>
<h1><i class="fa fa-plus"></i> <?=(isset($unit_code))?"Edit":"Add"?> <?php if(isset($namehome)==1){echo $namehome[34]->text;}else{echo "Unit";}?> </h1>
</div>
</div>
<div id="breadcrumbs">
<ul class="breadcrumb">

<li class="active"> <i class="fa fa-home"></i><?php echo($this->breadcrumb->output());?> </li>
</ul>
</div>
<!--header end added by palak on 13 jan -->
<!--Content starts added by palak on 13 jan -->

<div class="row">
  <div class="col-md-12">
      <div class="box box-blue">
      <div class="box-title">
      	<h3><i class="fa fa-plus"></i> <?=(isset($unit_code))?"Edit":"Add"?> <?php if(isset($namehome)==1){echo $namehome[34]->text;}else{echo "Unit";}?> </h3>
       </div>
      <div class="box-content">
      <form action="<?=base_url()?>index.php/masters/add_unit" method="post" class="form-horizontal form-row-separated" novalidate="novalidate" id="validation-form">
     <?php if(!isset($unit_code)){?>
       <div class="row">
			<div class="col-md-2 col-md-offset-10">
			
				<input type="button" value="Add Row" class="btn btn-info pull-right" onclick="addRow('dataTable')">
			
			</div>
		 </div>
		 </br>
		 <?php }?>
       <div class="row">
		 <div class="col-md-12">
		 <div class="">
			<table class="table table-striped table-hover fill-head">
			<thead>
			<tr>
			<th style="width:20%"><?php if(isset($namehome)==1){echo $namehome[34]->text;}else{echo "Unit";}?></th>
			<th style="width:45%"><?php if(isset($namehome)==1){echo $namehome[10]->text;}else{echo "Description";}?></th>
			
						</tr>
			</thead>
			<tbody id="dataTable">
				<?php if(isset($unit_code)){?>
			<tr>
				
				  <input type="hidden" name="id" id="id" value="<?=isset($unit_code)?$unit_code:''?>"/>
			<td>
				   <input type="text" name="unit_code" id="unit_code_h" onblur="check_unitname(this,<?=(!empty($unit_code))?$unit_code:'0'?>)" value="<?=isset($unit_code)?$unit_code:''?>" class="form-control" data-rule-required="true">
				
					  <span class="msg_box_unit_name" ></span>
				 
			</td>
			<td>  
				  <textarea name="unit_desc" id="unit_desc" rows="1" class="form-control" ><?=isset($unit_desc)?$unit_desc:''?></textarea>
			 </td>
			
			
		</tr>
		
		<?php } else {?>
			<tr>
				
			<td>
				   <input type="text" name="unit_code[]" id="unit_code" value="" onblur="check_unitname(this,0)" class="form-control" data-rule-required="true">
					
				   <span class="msg_box_unit_name" ></span>
			</td>
			<td>  
				 <textarea name="unit_desc[]" id="unit_desc" rows="1" class="form-control"></textarea>
			</td>
			
			 
		</tr>
		<?php }?>
	</tbody>
</table>
	</div>
 </div>
 </div>
 <?php if(!isset($unit_code)){?>
      <div class="form-group last">
		  <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
			<button type="button" class="btn" onClick="window.history.back();"><?php if(isset($namehome)==1){echo $namehome[13]->text;}else{echo "Cancel";}?></button>
			
			 <input onClick="return check_unit_exsist('msg_box_unit_name')" type="submit" name="submit" value="<?php if(isset($namehome)==1){echo $namehome[14]->text;}else{echo "Save Changes";}?>" class="btn btn-primary"/> 
		  </div>
      </div>
 <?php }else {?>
 <div class="form-group last">
		  <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
			<button type="button" class="btn" onClick="window.history.back();"><?php if(isset($namehome)==1){echo $namehome[13]->text;}else{echo "Cancel";}?></button>
			
			 <input  type="submit" name="submit" value="<?php if(isset($namehome)==1){ echo $namehome[14]->text;  }else{echo"Save Changes";}?>" class="btn btn-primary"/> 
		  </div>
      </div>
 
 
 
 <?php }?>
</form>
      </div>
      </div>
  </div>
</div>
<!--Content ends added by palak on 13 jan -->
<script language="javascript">
function addRow(tableID){
	var table=document.getElementById(tableID);
	var rowCount=table.rows.length;
	var row=table.insertRow(rowCount);
	var colCount=table.rows[0].cells.length;
   for(var i=0;i<colCount;i++){
	var newcell=row.insertCell(i);
	newcell.innerHTML=table.rows[0].cells[i].innerHTML;
	switch(newcell.childNodes[0].type){
		case"text":newcell.childNodes[0].value="" ;
		break;
		case"checkbox":newcell.childNodes[0].checked=false;
		break;
		case"select-one":newcell.childNodes[0].selectedIndex=0;
		break;
		}}}
</script>
