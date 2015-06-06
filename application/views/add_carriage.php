<!--header starts added by palak on 02 feb -->
<div id="main-content">
<div class="page-title">
<div>
<h1><i class="fa fa-plus"></i> <?=(isset($carriage_code))?"Edit":"Add"?> Carriage</h1>
</div>
</div>
<div id="breadcrumbs">
<ul class="breadcrumb">

<li class="active"> <i class="fa fa-home"></i><?php echo($this->breadcrumb->output());?> </li>
</ul>
</div>
<!--header end added by palak on 02 feb -->
<!--Content starts added by palak on 02 feb -->
<div class="row">
  <div class="col-md-12">
      <div class="box box-blue">
      <div class="box-title">
      	<h3><i class="fa fa-plus"></i> <?=(isset($carriage_code))?"Edit":"Add"?> Carriage</h3>
       </div>
      <div class="box-content">
      <form action="<?=base_url()?>index.php/home/add_carriage" method="post" class="form-horizontal form-row-separated" novalidate="novalidate" id="validation-form">
           <?php if(!isset($carriage_code)){?>
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
			<th style="width:10%">Carriage</th>
			<th style="width:30%">Description</th>
			<th style="width:15%">Carriage Category</th>
			<th style="width:15%">Carriage Subcategory</th>
			<th style="width:15%">Unit</th>
			<th style="width:10%">Amount</th>
			</tr>
			</thead>
			<tbody id="dataTable">
				<?php if(isset($carriage_id)){?>
					
					
			<tr>
				 <input type="hidden" name="carriage_id" id="carriage_id" value="<?=isset($carriage_id)?$carriage_id:''?>"/>
			<td>
				   <input type="text" name="carriage_code" id="carriage_code" value="<?=isset($carriage_code)?$carriage_code:''?>" class="form-control" data-rule-required="true">
					
			</td>
			<td>  
			  <textarea name="carriage_description" id="carriage_description" rows="1" class="form-control" data-rule-required="true"><?=isset($carriage_description)?$carriage_description:''?></textarea>
		 </td>
			 <td>
			         <select class="form-control" name="carriage_category" id="carriage_category"  data-rule-required="true" >
						   <?php $cat_list= $this->utilities->cat_list();?>
						<option  value="">Select Category</option>
					      <?php foreach($cat_list as $ct){ ?>
						 <option value="<?=$ct->id?>" <?=($carriage_category==$ct->id)?'selected':''?>><?=$ct->name?></option>
						 
						 <?php } ?>
					  </select>
				</td>
			<td>
			        <select class="form-control" name="carriage_sub_category" id="carriage_sub_category"  data-rule-required="true" >
						   <?php $subcat_list= $this->utilities->sub_cat_list();?>
						<option  value="">Select Subcategory</option>
					      <?php foreach($subcat_list as $sct){ ?>
						 <option value="<?=$sct->id?>" <?=($carriage_sub_category==$sct->id)?'selected':''?>><?=$sct->sub_category?></option>
						 
						 <?php } ?>
					  </select>
					</td>
			<td>
			          <select class="form-control" name="unit_code" id="unit_code"  data-rule-required="true" >
						   <?php $unitlist= $this->utilities->unit_list();?>
						<option  value="">Select Unit</option>
					      <?php foreach($unitlist as $uu){ ?>
						 <option value="<?=$uu->unit_code?>" <?=($unit_code==$uu->unit_code)?'selected':''?>><?=$uu->unit_code?></option>
						 
						 <?php } ?>
					  </select>
				</td>
			<td>
			  <input type="text" name="carriage_rate" id="carriage_rate"  value="<?=isset($carriage_rate)?$carriage_rate:''?>" class="form-control" data-rule-required="true" >
			</td>
			</tr>
			<?php } else {?>
			
				<tr>
			<td>
				   <input type="text" name="carriage_code[]" id="carriage_code"  value="" data-rule-required="true" class="form-control">
						</td>
			<td>  
			  <textarea name="carriage_description[]" id="carriage_description" rows="1" data-rule-required="true" class="form-control"></textarea>
		
			 </td>
			<td>
				     <select class="form-control" name="carriage_category[]" id="carriage_category"  data-rule-required="true" >
						<option  value="">Select Category</option>
					  <?php foreach($catlist as $cte){ ?>
						 <option value="<?=$cte->id?>" ><?=$cte->name?></option>
						 
						 <?php } ?>
					  </select>
					  <span for="select" class="help-block">This field is required.</span>
			  	
			</td>
				<td>
				     <select class="form-control" name="carriage_sub_category[]" id="carriage_sub_category"  data-rule-required="true" >
						<option  value="">Select Subcategory</option>
					  <?php foreach($subcate as $scte){ ?>
						 <option value="<?=$scte->id?>" ><?=$scte->sub_category?></option>
						 
						 <?php } ?>
					  </select>
					  <span for="select" class="help-block">This field is required.</span>
			 </td>
				<td>
		           <select class="form-control" name="unit_code[]" id="unit_code"  data-rule-required="true" >
						<option  value="">Select Unit</option>
					  <?php foreach($unit_list as $ul){ ?>
						 <option value="<?=$ul->unit_code?>" ><?=$ul->unit_code?></option>
						 
						 <?php } ?>
					  </select>
					  <span for="select" class="help-block">This field is required.</span>
			  	</td>
			<td>
				  <input type="text" name="carriage_rate[]" id="carriage_rate"  value="" data-rule-required="true" class="form-control">
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
<!--Content ends added by palak on 02 Feb -->
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
