<!--header starts added by palak on 13 jan -->
<div id="main-content">
<div class="page-title">
<div>
<h1><i class="fa fa-plus"></i> <?=(isset($labour_name))?"Edit":"Add"?> Labour</h1>
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
      	<h3><i class="fa fa-plus"></i> <?=(isset($labour_name))?"Edit":"Add"?> Labour</h3>
       </div>
      <div class="box-content">
      <form action="<?=base_url()?>index.php/masters/add_labour" method="post" class="form-horizontal form-row-separated" novalidate="novalidate" id="validation-form">
           <?php if(!isset($labour_name)){?>
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
			<th style="width:20%">Code</th>
			<th style="width:45%">Description</th>
			<th style="width:15%">Unit</th>
			<th style="width:20%">Amount</th>
			</tr>
			</thead>
			<tbody id="dataTable">
				<?php if(isset($labour_name)){?>
					
					
			<tr>
				 <input type="hidden" name="id" id="id" value="<?=isset($labour_name)?$labour_name:''?>"/>
			<td>
				  <input type="text" name="labour_name" onblur="check_labour(this)" id="labour_name" value="<?=isset($labour_name)?$labour_name:''?>" class="form-control" data-rule-required="true">
					<span class="msg_box_lablour_name" ></span>
					 </td>
			<td>  
			  <textarea name="labour_description" id="labour_description" rows="1" class="form-control" data-rule-required="true"><?=isset($labour_description)?$labour_description:''?></textarea>
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
			  <input type="text" name="labour_rate" id="labour_rate"  value="<?=isset($labour_rate)?$labour_rate:''?>" class="form-control" data-rule-required="true" >
				 
			</td>
			</tr>
			<?php } else {?>
			
				<tr>
			<td>
				  <input type="text" name="labour_name[]" id="labour_name"  value="" data-rule-required="true" class="form-control">
					 
			</td>
			<td>  
			  <textarea name="labour_description[]" id="labour_description" rows="1" data-rule-required="true" class="form-control"></textarea>
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
				  <input type="text" name="labour_rate[]" id="labour_rate"  value="" data-rule-required="true" class="form-control">
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
<script language="javascript">function addRow(tableID){	var table=document.getElementById(tableID);	var rowCount=table.rows.length;	var row=table.insertRow(rowCount);	var colCount=table.rows[0].cells.length;   for(var i=0;i<colCount;i++){	var newcell=row.insertCell(i);	newcell.innerHTML=table.rows[0].cells[i].innerHTML;	switch(newcell.childNodes[0].type){		case"text":newcell.childNodes[0].value="" ;		break;		case"checkbox":newcell.childNodes[0].checked=false;		break;		case"select-one":newcell.childNodes[0].selectedIndex=0;		break;		}}}</script>
