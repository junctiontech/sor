<!--header starts added by palak on 13 jan of create sub item page -->
<div id="main-content">
<div class="page-title">
<div>
<h1><i class="fa fa-plus"></i> <?=(isset($id))?"Edit":"Add"?> Refrence</h1>
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
      	
		<h3><i class="fa fa-plus"></i> <?=(isset($id))?"Edit":"Add"?> Refrence</h3>
       </div>
      <div class="box-content">
     <form action="<?=base_url()?>index.php/home/add_refrence" method="post" class="form-horizontal form-row-separated" novalidate="novalidate" id="validation-form">
     
  <div class="row">
		 <input type="hidden" name="dep_id" id="dep_id" value="2147483647"/>
			 <input type="hidden" name="chap_id" id="chap_id" value="2147483647"/>
			  <input type="hidden" name="item_id" id="item_id" value="2147483647"/>
   	</div> 
		 <div class="row">
			<div class="col-md-2 col-md-offset-10">
			
				<input type="button" value="ADD" class="btn btn-info pull-right" onclick="addRow('dataTable')">
			
			</div>
		 </div>
		 </br>
           <div class="row">
		 <div class="col-md-12">
		 <div class="">
			<table class="table table-striped table-hover fill-head">
			<thead>
			<tr>
			<th style="width:10%">Refrence Code</th>

			<th style="width:10%">Description</th>

			<th style="width:10%">Unit</th>

			<th style="width:10%">Class</th>

			<th style="width:10%">Rate</th>
			<th style="width:10%">Heading</th>
			<th style="width:10%">Notes</th>

			
			</tr>
			</thead>
			<?php if(isset($id)){?>

			<tbody id="dataTable">
			<tr>
			 <input type="hidden" name="id" id="id" value="<?=isset($id)?$id:''?>"/>
			<td>
				
			  <input type="text" name="name" id="name" value="<?=isset($name)?$name:''?>" class="form-control" data-rule-required="true">
			  
			</td>
			<td>
			 <textarea class="form-control" rows="1" id="description" name="description" data-rule-required="true"><?=isset($description)?$description:''?></textarea>
			</td>
			<td>
			<div class="form-group" style="border-bottom:none!important;">
			           <select class="form-control" name="unit_code" id="unit_code" tabindex="1" data-rule-required="true" >
						<option  value="">Select Unit</option>
					  <?php foreach($unit_list as $ul){ ?>
						 <option value="<?=$ul->unit_code?>" <?=($unit_code==$ul->unit_code)?'selected':''?>><?=$ul->unit_code?></option>
						 <!--<?//=$ul->unit_desc?>-->
						 <?php } ?>
					  </select>
					  <span for="select" class="help-block">This field is required.</span>
			   </div>
			</td>
				<td>
			
			           <select class="form-control" name="class_id" id="class_id" tabindex="1" data-rule-required="true" >
					   <!--data-rule-required="true" Commented-->
						<option  value="">Select Class</option>
					  <?php foreach($cls_list as $cl){ ?>
						 <option value="<?=$cl->id?>" <?=($class_id==$cl->id)?'selected':''?>><?=$cl->class_name?></option>
						 
						 <?php } ?>
					  </select>
					  <span for="select" class="help-block">This field is required.</span>
			
			</td>
			<td>
			
			  <input type="text"  id="cost_total" name="cost_total" value="<?=isset($cost_total)?$cost_total:''?>" class="form-control" readonly  >
			
			   
			</td>
			<td>
			
			  <input type="text"  id="heading" name="heading" value="<?=isset($heading)?$heading:''?>" class="form-control"   >
			
			</td>
			<td>
		
			  <input type="text"  id="notes" name="notes" value="<?=isset($notes)?$notes:''?>" class="form-control"   >
			
			  
			</td>
			
			</tr>
			</tbody>
			<?php } else {?>
				
		<tbody id="dataTable">
			<tr>
			<td>
				
			  <input type="text" name="name[]" id="name" class="form-control" data-rule-required="true">
			  
			</td>
			<td>
				 <textarea class="form-control" rows="1" id="description" name="description[]" data-rule-required="true"></textarea>
				  
			 </td>
			<td>
		
			           <select class="form-control" name="unit_code[]" id="unit_code" tabindex="1" data-rule-required="true" >
						<option  value="">Select Unit</option>
					  <?php foreach($unit_list as $ul){ ?>
						 <option value="<?=$ul->unit_code?>" ><?=$ul->unit_code?></option>
						 <!--<?//=$ul->unit_desc?>-->
						 <?php } ?>
					  </select>
					  <span for="select" class="help-block">This field is required.</span>
			   
			</td>
				<td>
		
			           <select class="form-control" name="class_id[]" id="class_id" tabindex="1"  >
					   <!--data-rule-required="true" Commented-->
						<option  value="">Select Class</option>
					  <?php foreach($cls_list as $cl){ ?>
						 <option value="<?=$cl->id?>" ><?=$cl->class_name?></option>
						 
						 <?php } ?>
					  </select>
					  <span for="select" class="help-block">This field is required.</span>
			  
			</td>
			<td>
			
			  <input type="text"  id="cost_total" name="cost_total[]" class="form-control" readonly  >
			
			  
			</td>
			<td>
		
			  <input type="text"  id="heading" name="heading[]" class="form-control"   >
			
			  
			</td>
			<td>
		
			  <input type="text"  id="notes" name="notes[]" class="form-control"   >
			
			</td>
			
			</tr>
			</tbody>
				
				
				<?php } ?>
		</table>
	</div>
		 </div>
		 
	 </div>
          
          
      
      <div class="form-group last">
      <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
	     <button type="button" class="btn" onClick="window.history.back();">Cancel</button>
         <input type="hidden" name="id" id="id" value="<?=(!empty($id))?$id:''?>"/>

        <input  type="submit" name="submit" value="Save changes" class="btn btn-primary"/>
      </div>
      </div>
       </form>
      </div>
      </div>
  </div>
</div>
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
<!--Content ends added by palak on 13 jan -->
