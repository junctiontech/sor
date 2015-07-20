<div id="main-content" >
  	<div class="page-title">
  		<div>
  			<h1><i class="fa fa-keyboard-o"></i>Estimation Values</h1>
  		</div>
  	</div>


  	<div id="breadcrumbs">
  		<ul class="breadcrumb">
  			<li class="active"> <i class="fa fa-home"></i><?php echo($this->breadcrumb->output());?> </li>

  		</ul>
  	</div>
 <div class="row">
  <div class="col-md-12">
     <div class="box box-blue">
      <div class="box-title">
      	<h3><i class="fa fa-plus"></i>Estimations</h3>
       </div>
       
      <div class="box-content">
		 <div class="row">
						<div class="col-md-4 col-md-offset-8">

							<!--<a class="btn btn-primary btn-sm" href="<?=base_url()?>index.php/estimation_controller/add_estsubitem/<?=$select?>/<?=$est_id?>"><i class="fa fa-plus"></i> Add Subitems</a>

							<a class="btn btn-primary btn-sm" onclick="deleteRow('dataTable')" href="javascript:;"><i class="fa fa-trash-o"></i> Delete Subitems</a>-->
						</div> 
					 </div>  
					 </br>  

		<div class="row">

		<form action="index.php/estimation_controller/add_est_submit/<?=$select?>" method="post" name="myForm" class="">

			<div class="col-md-12">
			
			<div class="form-group" style="padding-bottom: 30px;">
				  <label class="col-sm-3 col-lg-2 control-label">Estimate Description</label>
						  <div class="col-sm-9 col-lg-10 controls">
						 <input readonly type="text" required name="est_description" class="form-control"
									<?php  if(!empty($est_id)==1){ $filter = array('est_id'=>$est_id);
											$est_description= $this->utilities->get_est('ssr_t_estimate',$filter);
									
											?>
									value="<?=($est_description)?$est_description[0]->est_description:''?>"> <?php }  ?>
						
						  </div>
				   </div>
		
			<div class="table-big" >
			
			
				<table class="table table-striped table-bordered  table-hover fill-head" id="sample_editable_1">

					<thead>

						
							<th style="width:2%" >#</th>
							<th style="width:4%">Subitem Code</th>
							<th style="width:30%"> Description.</th>
							<th style="width:4%">Class.</th>
							<th style="width:10%">Rate.</th>
							<th style="width:10%">Unit</th>
							<th style="width:10%">Qty</th>
							<th style="width:15%">Amount</th>
							<th style="width:15%">Action</th>
				
					</thead>

					<tbody id="est_table">

						<?php   foreach($subitem_list as $key=>$subil){ ?>
						
						<tr>
						
							<td><input readonly type="checkbox" id="select_<?=$key+1?>"  
  										title="Check/Uncheck all" class="select_all" value="<?=$subil->subitem_id?>" />
  										
  									</td>

							 <td> 

								<?=$subil->subitem_name?>

							</td>

							<td> 

								<?=$subil->subitem_desc?>

							</td>
					<?php $filter = array('id'=>$subil->subitem_class_id);
					  $class_name= $this->utilities->get_cls_name('ssr_t_class',$filter); ?>
							<td> 

								<?=($class_name)?$class_name[0]->class_name:''?>

							</td>

							<td> 

								<input type="text" class="input-mini-xs" id="rate_<?=$key+1?>" readonly name="rate" value="<?=$subil->rate?>">

							</td>
							
							  <?php  $filter = array('unit_code'=>$subil->unit_code);
							 
					  $unit_name= $this->utilities->get_unit_name('ssr_t_uom',$filter);
					  
					?>
					  <td><?=($unit_name)?$unit_name[0]->unit_code:''?></td>
					  
					<?php if(!empty($est_sub)==1){	$filter = array('est_id'=>$est_sub[0]->est_id,
					'subitem_id'=>$subil->subitem_id
					);
					 $subitem_est_quantity= $this->utilities->get_est('ssr_t_estimate_sitem',$filter); ?>
					<input type="hidden" name="est_id" id="est_id_<?=$key+1?>"  
					
					value="<?=($subitem_est_quantity)?$subitem_est_quantity[0]->est_id:''?>" /> <?php } ?>
					
						<td><input readonly type="text" class="input-mini-xs" id="quantity_<?=$key+1?>" name="quantity[]"
<?php if(!empty($est_sub)==1){ 
					?>
						value="<?=($subitem_est_quantity)?$subitem_est_quantity[0]->quantity:''?>"> <?php } ?>
							
							</td>
							
							<td><input readonly type="text" class="input-small" id="amount_<?=$key+1?>" name="amount[]" value="">
							
							</td>
							
									
					<td>

							  <a class="btn btn-primary btn-small" href="<?=base_url()?>index.php/estimation_controller/estimation_val_view/<?=$subil->subitem_id?>/<?=$subil->subitem_class_id?>/<?=$select?>/<?=$est_id?>"><i class="icon-edit"></i> View value</a>

													
							</td>
						
						</tr>

						<?php }?>
						<tr >

							<td colspan="12" style="text-align:right;"><strong>Total : <input type="text" readonly name="final_total" id="final_total" value="" /> </strong></td>

							

						</tr>

					</tbody>

				</table>
			</div>
					<button type="button" onClick="window.history.back();" class="btn btn-primary pull-right"><i class="fa fa-times"></i> Cancel</button>
  	
	</div>
		</form>
</div>
	</div> 
 </div> 
 </div>
  </div>
 <script>
 
 $(window).load(function() {
		var table=document.getElementById('est_table');
		var rowCount=table.rows.length;
		for(i=1;i<=rowCount-1;i++){
			var row = i;
			//calculate_estamount_onload(row);
		}
		setTimeout( function(){ 
			for(i=1;i<=rowCount-1;i++){
				var row = i;
				calculate_estamount_onload(row);
				}
			total_estamount_onload('est_table');
		}
		, 1000 );
	});
 
 
 function deleteRow(tableID,row, row_count)
{   var tableID="sample_editable_1";
	try{
		var table=document.getElementById(tableID);
		
		var rowCount=table.rows.length;
		
		var no_of_rows_selected=0;	
		for(var i=0;i<rowCount;i++)
		{
			var row=table.rows[i];
			var chkbox=row.cells[0].childNodes[0];
			if(null!=chkbox&&true==chkbox.checked){
				no_of_rows_selected++;	
				
			}
		}
		if(no_of_rows_selected==rowCount){
			alert("Cannot delete all the rows.");
			
		}else{
			for(var i=0;i<rowCount;i++)
			{
				var row=table.rows[i];
				var chkbox=row.cells[0].childNodes[0];
				if(null!=chkbox&&true==chkbox.checked)
				{
					table.deleteRow(i);
					rowCount--; 
					i--;
				}
			}
				var z = 1;
						for(i=1;i<rowCount;i++){
							
							var get_data = table.rows[i].cells[0].childNodes[0].id.split('_') ;
							
							var textbox_name =  get_data[0];
							table.rows[i].cells[0].childNodes[0].id = textbox_name+"_"+z;
							
							
							z++;
						}
					}
				total_estamount_onload('est_table');
			}
			catch(e)
			{
				alert(e);

			}
		}
 </script>
<div id="main-content" >
  	<div class="page-title">
  		<div>
  			<h1><i class="fa fa-keyboard-o"></i>Estimation Values</h1>
  		</div>
  	</div>


  	<div id="breadcrumbs">
  		<ul class="breadcrumb">
  			<li class="active"> <i class="fa fa-home"></i><?php echo($this->breadcrumb->output());?> </li>

  		</ul>
  	</div>
 <div class="row">
  <div class="col-md-12">
     <div class="box box-blue">
      <div class="box-title">
      	<h3><i class="fa fa-plus"></i>Estimations</h3>
       </div>
       
      <div class="box-content">
		 <div class="row">
						<div class="col-md-4 col-md-offset-8">

							<!--<a class="btn btn-primary btn-sm" href="<?=base_url()?>index.php/estimation_controller/add_estsubitem/<?=$select?>/<?=$est_id?>"><i class="fa fa-plus"></i> Add Subitems</a>

							<a class="btn btn-primary btn-sm" onclick="deleteRow('dataTable')" href="javascript:;"><i class="fa fa-trash-o"></i> Delete Subitems</a>-->
						</div> 
					 </div>  
					 </br>  

		<div class="row">

		<form action="index.php/estimation_controller/add_est_submit/<?=$select?>" method="post" name="myForm" class="">

			<div class="col-md-12">
			
			<div class="form-group" style="padding-bottom: 30px;">
				  <label class="col-sm-3 col-lg-2 control-label">Estimate Description</label>
						  <div class="col-sm-9 col-lg-10 controls">
						 <input readonly type="text" required name="est_description" class="form-control"
									<?php  if(!empty($est_id)==1){ $filter = array('est_id'=>$est_id);
											$est_description= $this->utilities->get_est('ssr_t_estimate',$filter);
									
											?>
									value="<?=($est_description)?$est_description[0]->est_description:''?>"> <?php }  ?>
						
						  </div>
				   </div>
		
			<div class="table-big" >
			
			
				<table class="table table-striped table-bordered  table-hover fill-head" id="sample_editable_1">

					<thead>

						
							<th style="width:2%" >#</th>
							<th style="width:4%">Subitem Code</th>
							<th style="width:30%"> Description.</th>
							<th style="width:4%">Class.</th>
							<th style="width:10%">Rate.</th>
							<th style="width:10%">Unit</th>
							<th style="width:10%">Qty</th>
							<th style="width:15%">Amount</th>
							<th style="width:15%">Action</th>
				
					</thead>

					<tbody id="est_table">

						<?php   foreach($subitem_list as $key=>$subil){ ?>
						
						<tr>
						
							<td><input readonly type="checkbox" id="select_<?=$key+1?>"  
  										title="Check/Uncheck all" class="select_all" value="<?=$subil->subitem_id?>" />
  										
  									</td>

							 <td> 

								<?=$subil->subitem_name?>

							</td>

							<td> 

								<?=$subil->subitem_desc?>

							</td>
					<?php $filter = array('id'=>$subil->subitem_class_id);
					  $class_name= $this->utilities->get_cls_name('ssr_t_class',$filter); ?>
							<td> 

								<?=($class_name)?$class_name[0]->class_name:''?>

							</td>

							<td> 

								<input type="text" class="input-mini-xs" id="rate_<?=$key+1?>" readonly name="rate" value="<?=$subil->rate?>">

							</td>
							
							  <?php  $filter = array('unit_code'=>$subil->unit_code);
							 
					  $unit_name= $this->utilities->get_unit_name('ssr_t_uom',$filter);
					  
					?>
					  <td><?=($unit_name)?$unit_name[0]->unit_code:''?></td>
					  
					<?php if(!empty($est_sub)==1){	$filter = array('est_id'=>$est_sub[0]->est_id,
					'subitem_id'=>$subil->subitem_id
					);
					 $subitem_est_quantity= $this->utilities->get_est('ssr_t_estimate_sitem',$filter); ?>
					<input type="hidden" name="est_id" id="est_id_<?=$key+1?>"  
					
					value="<?=($subitem_est_quantity)?$subitem_est_quantity[0]->est_id:''?>" /> <?php } ?>
					
						<td><input readonly type="text" class="input-mini-xs" id="quantity_<?=$key+1?>" name="quantity[]"
<?php if(!empty($est_sub)==1){ 
					?>
						value="<?=($subitem_est_quantity)?$subitem_est_quantity[0]->quantity:''?>"> <?php } ?>
							
							</td>
							
							<td><input readonly type="text" class="input-small" id="amount_<?=$key+1?>" name="amount[]" value="">
							
							</td>
							
									
					<td>

							  <a class="btn btn-primary btn-small" href="<?=base_url()?>index.php/estimation_controller/estimation_val_view/<?=$subil->subitem_id?>/<?=$subil->subitem_class_id?>/<?=$select?>/<?=$est_id?>"><i class="icon-edit"></i> View value</a>

													
							</td>
						
						</tr>

						<?php }?>
						<tr >

							<td colspan="12" style="text-align:right;"><strong>Total : <input type="text" readonly name="final_total" id="final_total" value="" /> </strong></td>

							

						</tr>

					</tbody>

				</table>
			</div>
					<button type="button" onClick="window.history.back();" class="btn btn-primary pull-right"><i class="fa fa-times"></i> Cancel</button>
  	
	</div>
		</form>
</div>
	</div> 
 </div> 
 </div>
  </div>
 <script>
 
 $(window).load(function() {
		var table=document.getElementById('est_table');
		var rowCount=table.rows.length;
		for(i=1;i<=rowCount-1;i++){
			var row = i;
			//calculate_estamount_onload(row);
		}
		setTimeout( function(){ 
			for(i=1;i<=rowCount-1;i++){
				var row = i;
				calculate_estamount_onload(row);
				}
			total_estamount_onload('est_table');
		}
		, 1000 );
	});
 
 
 function deleteRow(tableID,row, row_count)
{   var tableID="sample_editable_1";
	try{
		var table=document.getElementById(tableID);
		
		var rowCount=table.rows.length;
		
		var no_of_rows_selected=0;	
		for(var i=0;i<rowCount;i++)
		{
			var row=table.rows[i];
			var chkbox=row.cells[0].childNodes[0];
			if(null!=chkbox&&true==chkbox.checked){
				no_of_rows_selected++;	
				
			}
		}
		if(no_of_rows_selected==rowCount){
			alert("Cannot delete all the rows.");
			
		}else{
			for(var i=0;i<rowCount;i++)
			{
				var row=table.rows[i];
				var chkbox=row.cells[0].childNodes[0];
				if(null!=chkbox&&true==chkbox.checked)
				{
					table.deleteRow(i);
					rowCount--; 
					i--;
				}
			}
				var z = 1;
						for(i=1;i<rowCount;i++){
							
							var get_data = table.rows[i].cells[0].childNodes[0].id.split('_') ;
							
							var textbox_name =  get_data[0];
							table.rows[i].cells[0].childNodes[0].id = textbox_name+"_"+z;
							
							
							z++;
						}
					}
				total_estamount_onload('est_table');
			}
			catch(e)
			{
				alert(e);

			}
		}
 </script>
