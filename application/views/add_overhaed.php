<!--header starts added by palak on 13 jan -->
<div id="main-content">
<div class="page-title">
<div>
<h1><i class="fa fa-plus"></i> <?=(isset($overhead_name))?"Edit":"Add"?> Overhead</h1>
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
      	<h3><i class="fa fa-plus"></i> <?=(isset($overhead_name))?"Edit":"Add"?> Overhead</h3>
       </div>
      <div class="box-content">
      <form action="<?=base_url()?>index.php/home/add_overhead" method="post" class="form-horizontal form-row-separated" novalidate="novalidate" id="validation-form">
     <?php if(!isset($overhead_name)){?>
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
			<th style="width:35%">Percent</th>
						</tr>
			</thead>
			<tbody id="dataTable">
				<?php if(isset($overhead_name)){?>
			<tr>
				
				  <input type="hidden" name="id" id="id" value="<?=isset($overhead_name)?$overhead_name:''?>"/>
			<td>
				    <input type="text" name="overhead_name" id="overhead_name" value="<?=isset($overhead_name)?$overhead_name:''?>" class="form-control" data-rule-required="true">
					</td>
			<td>  
			  <textarea name="overhead_desc" id="overhead_desc" rows="1" class="form-control" data-rule-required="true"><?=isset($overhead_desc)?$overhead_desc:''?></textarea>
			  </td>
			<td>
					<div class="input-group">
						<input placeholder="Percent" name="overhead_percent" id="overhead_percent"  data-rule-required="true" value="<?=isset($overhead_percent)?$overhead_percent:''?>" class="form-control" type="text">
						<span class="input-group-addon">%</span>
						</div>
					
		   </td>
			
		</tr>
		
		<?php } else {?>
			<tr>
				
			<td>
				   <input type="text" name="overhead_name[]" id="overhead_name" value="" class="form-control" data-rule-required="true">
					 
			</td>
			<td>  
				 <textarea name="overhead_desc[]" id="overhead_desc" rows="1" class="form-control" data-rule-required="true"></textarea>
			  </td>
			<td>
						<div class="input-group">
						<input placeholder="Percent" name="overhead_percent[]" id="overhead_percent" value="" class="form-control" type="text" data-rule-required="true">
						<span class="input-group-addon">%</span>
						</div>
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
