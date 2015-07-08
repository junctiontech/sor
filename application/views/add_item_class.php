<!--header starts added by palak on 13 jan -->
<div id="main-content">
<div class="page-title">
<div>
<h1><i class="fa fa-plus"></i> <?=(isset($id))?"Edit":"Add"?> Class</h1>
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
      	<h3><i class="fa fa-plus"></i> <?=(isset($id))?"Edit":"Add"?> Class</h3>
       </div>
      <div class="box-content">
      <form action="<?=base_url()?>index.php/masters/add_item_class" method="post" class="form-horizontal form-row-separated" novalidate="novalidate" id="validation-form">
     <?php if(!isset($id)){?>
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
			<th style="width:20%">Class Name</th>
			<th style="width:20%">Description</th>
			<th style="width:20%">Heading</th>
			<th style="width:20%">Notes</th>
						</tr>
			</thead>
			<tbody id="dataTable">
				<?php if(isset($id)){?>
			<tr>
				
				  <input type="hidden" name="id" id="id" value="<?=isset($id)?$id:''?>"/>
			<td>
				    <input type="text" name="class_name" id="class_name" value="<?=isset($class_name)?$class_name:''?>" class="form-control" data-rule-required="true">
					
			</td>
			<td>  
			  <textarea name="class_desc" id="class_desc" rows="1" class="form-control" data-rule-required="true"><?=isset($class_desc)?$class_desc:''?></textarea>
			  
			</td>
			
			<td>
					  <input type="text" name="class_heading" id="class_heading" value="<?=isset($class_heading)?$class_heading:''?>" class="form-control" data-rule-required="true">
				
			</td>
			<td>
				   <input type="text" name="class_notes" id="class_notes" value="<?=isset($class_notes)?$class_notes:''?>" class="form-control" data-rule-required="true">
					 
			</td>
		</tr>
		
		<?php } else {?>
			<tr>
				
			<td>
				 <input type="text" name="class_name[]" id="class_name" value="" class="form-control" data-rule-required="true">
					  </div>
				  </div>
			</td>
			<td>  
			  <textarea name="class_desc[]" id="class_desc" rows="1" class="form-control" data-rule-required="true"></textarea>
			  </td>
			<td>
				    <input type="text" name="class_heading[]" id="class_heading" value="" class="form-control" data-rule-required="true">
					
			</td>
			<td>
				 	  <input type="text" name="class_notes[]" id="class_notes" value="" class="form-control" data-rule-required="true">
					  
			</td>
			 
		</tr>
		<?php }?>
	</tbody>
</table>
	</div>
 </div>
 </div>

      <div class="form-group last">
		  <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
			<button type="button" class="btn" onClick="window.history.back();">Cancel</button>
			
			 <input  type="submit" name="submit" value="Save changes" class="btn btn-primary"/> 
		  </div>
      </div>
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
