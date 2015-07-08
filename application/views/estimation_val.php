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
  	<?php   foreach($subitem_list as $key=>$subil){ }?>
  	<div class="row-fluid">
  		<div class="span12">
  			<div class="box">
  				<div class="box-title">
  					<h3><i class="icon-reorder"></i> Estimation Values</h3>
  				</div>
  				<div class="box-content">
				 <?php  $row_table=0;

							 foreach($estimate_cal as $j ){ 
							$row_table = $row_table + 1;
							} ?>
  					

	 <form action="index.php/estimation_controller/estimation_create/<?=$subil->subitem_id?>/<?=$subil->subitem_class_id?>/<?=$select?>" method="post" name="myForm" <?php if(!empty($estimate_cal)){ ?> onsubmit="return(validate('editTable'));" <?php } else {?> onsubmit="return(validate('dataTable'));" <?php } ?> >

			
			<input type="hidden"  name="subitem_id" value="<?=$subitem_id?>" />
			<input type="hidden"  name="class_id" value="<?=$class_id?>" />
			<input type="hidden"  name="select" value="<?=$select?>" />
			<input type="hidden"  name="est_id" value="<?=$est_id?>" />
  					
  						<div class="row ">
  							<div class="col-md-4 col-md-offset-8" style="text-align: right;">
  								<?php if(!empty($estimate_cal)){?>
  								<input type="button" value="Add Row" class="btn btn-info " onclick="edit_addRow('editTable',<?=$row_table?>)">
  								
  								
  								<input type="button" value="Delete Row"class="btn btn-info "  onclick="edit_deleteRow('editTable')">
  								<?php } else {?>
  								<input type="button" value="Add Row" class="btn btn-info "  onclick="addRow('dataTable')">
  								<input type="button" value="Delete Row" class="btn btn-info " onclick="deleteRow('dataTable')">
  								<?php }?>
  								
  							</div>
  						</div>
  					</br>
  					
  					<div class="table-big">
  						<p>Subitem Name: <?=(!empty($subil->subitem_name))?$subil->subitem_name:"";?>||Description: <?=(!empty($subil->subitem_desc))?$subil->subitem_desc:"";?>.</p>
  						<table class="table table-bordered fill-head" >
  							<thead>
  								<tr>
  									<th >#</th>
  									<th>No.</th>
  									<th>Length(m)</th>
  									<th>Width(m)</th>
  									<th>Depth(m)</th>
  									<th>Quantity</th>
  									
  									
  								</tr>
  							</thead>
  						 		<?php if(!empty($estimate_cal)){ ?>					
  							<tbody id="editTable">
  							
  								
  								<?php foreach($estimate_cal as $key=> $sub){ ?>	
							<input type="hidden"  readonly name="edit_costing" id="edit_costing" value="1" />
  								<tr>
  									
  									
  									
  									<td><input type="checkbox" id="select_<?=$key+1?>"  
  										title="Check/Uncheck all" class="select_all" />
  										
  									</td>
  									<td><input type="text" required name="no[]" id="no_<?=$key+1?>" placeholder="No." class="form-control" value="<?=(!empty($sub->number))?$sub->number:"";?>">	
  									</td>
  									
  									<td><input type="text" required name="length[]" id="length_<?=$key+1?>" placeholder="Length." class="form-control" value="<?=(!empty($sub->length))?$sub->length:"";?>">	
  									</td>
  									<td><input type="text" required name="width[]" id="width_<?=$key+1?>" placeholder="Width." class="form-control" value="<?=(!empty($sub->width))?$sub->width:"";?>">	
  									</td>
  									<td><input type="text" required name="depth[]" id="depth_<?=$key+1?>" placeholder="Depth." class="form-control" value="<?=(!empty($sub->heigth))?$sub->heigth:"";?>" onchange="calculate_quantity(this.id);total_quantity_onload('editTable')">	
  									</td>
  									<td><input   type="text" required data-rule-required="true" class="input-small form-control required"  id="quantity_<?=$key+1?>" readonly
  										name="quantity[]" 
  										value="" 
  										>
  									</td>
  									
  									
  									
  									
  									
  									
  									
  									
  								</tr>
  							<?php }?>
  							</tbody>
  							<?php } else {?>
  							<tbody id="dataTable"> 
  								
  								<tr>
  						
  										<td><input type="checkbox" id="select_1"  
  										title="Check/Uncheck all" class="select_all" />
  										
  									</td>
  									<td><input type="text" required name="no[]" placeholder="No." id="no_1" class="form-control">	
  									</td>
  									
  									<td><input type="text" required name="length[]" placeholder="Length." id="length_1" class="form-control">	
  									</td>
  									
									<td><input type="text" required name="width[]" placeholder="Width." id="width_1" class="form-control">	
  									</td>
  									
									<td><input type="text" required name="depth[]" placeholder="Depth." id="depth_1" class="form-control"onchange="calculate_quantity(this.id);total_quantity_onload('dataTable')" >	
  									</td>
  									
									<td><input   type="text" required readonly data-rule-required="true" class="input-mini-xs form-control required"  id="quantity_1" 
  										name="quantity[]" 	value="" >
  									</td>
  								
  									
  									
  									
  									</tr>
  							</tbody>
  							<?php }?>
  							</table>
  					</div>					
  					<input type="hidden" readonly name="final_total" id="final_total" value="" />
  					<input type="submit" name="save" class="btn btn-primary pull-right"  value="Save Changes">
  				</form>
  				
  				

  			</div>
		</div>
  	</div>		

  		</div>
  		<script language="javascript">
	//var last_row=1;
	$( "#editTable" ).ready(function() {
		var table=document.getElementById('editTable');
		var rowCount=table.rows.length;
		for(i=1;i<=rowCount;i++){
			var row = i;
			
			
		}
	});
	$(window).load(function() {
		
		var table=document.getElementById('editTable');
		var rowCount=table.rows.length;
		for(i=1;i<=rowCount;i++){
			var row = i;
			//calculate_amount_onload(row);
			
		}
		
		setTimeout( function(){ 
			for(i=1;i<=rowCount;i++){
				var row = i;
				
				calculate_quantity_onload(row);
				}
			total_quantity_onload('editTable');
		}
		
		, 1000 );
	});
	
	
	
	function addRow(tableID)
	{ 
		var table=document.getElementById(tableID);
		var rowCount=table.rows.length;
		var row=table.insertRow(rowCount);
		var last_row=rowCount+1;
		var colCount=table.rows[0].cells.length;
		for(var i=0;i<colCount;i++)
		{
			var newcell= row.insertCell(i);
			newcell.innerHTML=table.rows[0].cells[i].innerHTML;
			
		switch(newcell.childNodes[0].type)
	{
		case"text":
		var get_data = newcell.childNodes[0].id.split('_');	
		var textbox_name =  get_data[0];
		var textbox_id = get_data[1];
		if(textbox_name=='rate'){ 
		}else{
		newcell.childNodes[0].value="";
		}
		newcell.childNodes[0].id=textbox_name+"_"+(last_row);
		break;
		
		case"checkbox":
		newcell.childNodes[0].checked=false;
		newcell.childNodes[0].id='select_'+(last_row);
		break;
}
}
}

function deleteRow(tableID,row, row_count)
{
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
						for(i=0;i<rowCount;i++){
							
							var get_data = table.rows[i].cells[0].childNodes[0].id.split('_') ;
							var textbox_name =  get_data[0];
							table.rows[i].cells[0].childNodes[0].id = textbox_name+"_"+z;
							
							var get_data1 = table.rows[i].cells[1].childNodes[0].id.split('_') ;
							var textbox_name1 =  get_data1[0];
							table.rows[i].cells[1].childNodes[0].id = textbox_name1+"_"+z;
							
							var get_data2 = table.rows[i].cells[2].childNodes[0].id.split('_') ;
							var textbox_name2 =  get_data2[0];
							table.rows[i].cells[2].childNodes[0].id = textbox_name2+"_"+z;
							
							var get_data3 = table.rows[i].cells[3].childNodes[0].id.split('_') ;
							var textbox_name3 =  get_data3[0];
							table.rows[i].cells[3].childNodes[0].id = textbox_name3+"_"+z;
							
							var get_data4 = table.rows[i].cells[4].childNodes[0].id.split('_') ;
							var textbox_name4 =  get_data4[0];
							table.rows[i].cells[4].childNodes[0].id = textbox_name4+"_"+z;
							
							var get_data5 = table.rows[i].cells[5].childNodes[0].id.split('_') ;
							var textbox_name5 =  get_data5[0];
							table.rows[i].cells[5].childNodes[0].id = textbox_name5+"_"+z;
							
							
							
							z++;
						}
					}
				total_quantity_onload(tableID);
			}
			catch(e)
			{
				alert(e);

			}
		}


	function edit_addRow(tableID,$row_table)
	{ 
		var table=document.getElementById(tableID);
		var rowCount=table.rows.length;
		var row=table.insertRow(rowCount);
		var last_row=rowCount+1;
		var colCount=table.rows[0].cells.length;
		for(var i=0;i<colCount;i++)
		{
			var newcell= row.insertCell(i);
			newcell.innerHTML=table.rows[0].cells[i].innerHTML;
			
		switch(newcell.childNodes[0].type)
	{
		case"text":
		var get_data = newcell.childNodes[0].id.split('_');	
		var textbox_name =  get_data[0];
		var textbox_id = get_data[1];
		if(textbox_name=='rate'){ 
		}else{
		newcell.childNodes[0].value="";
		}
		newcell.childNodes[0].id=textbox_name+"_"+(last_row);
		break;
		
		case"checkbox":
		newcell.childNodes[0].checked=false;
		newcell.childNodes[0].id='select_'+(last_row);
		break;
}
}
		
	}
	
	
	
	function adding_total(row,tableID)
	{ 		
		var table=document.getElementById(tableID);
		var rowCount=table.rows.length;
		var newRowCount = rowCount;
		//alert(rowCount);
       //alert(newRowCount);

		//var get_data = row.split('_');		
		//var id_type =  get_data[0];
		
		for(var i=1; i<=newRowCount; i++){
			var row_id = newRowCount;
			var row_id = i;
		// alert(row_id);
		// alert(id_type);
		 //var val_id=id_type+'_'+row_id;
//alert(val_id);		 
var e = document.getElementById("type_"+row_id);
var type_val = e.options[e.selectedIndex].value;
		// alert(type_val);
		if(type_val=='convert'){
		//	alert("convert");
		if(row_id==1){
				//alert("row is 1");
				var total=0;
				document.getElementById('total_'+row_id).value=total;
			}else{
		//alert("row is not 1");
		var total = document.getElementById('total_' + (row_id-1)).value;
		//alert(total);
		var quant = document.getElementById('quantity_'+row_id).value;
		var tot1 = total/quant;
	//	alert(tot1);
	document.getElementById("total_"+ row_id).value=tot1; 
}
}
else if(type_val=='text'){
	if(row_id==1){
		var total=0;
		document.getElementById('total_'+row_id).value=total;
	}else{
		var total = document.getElementById('total_' + (row_id-1)).value;
		//  alert("text in");
		  //var quant = document.getElementById('quantity_'+row_id).value;
		//var tot1 = total/quant;
		document.getElementById("total_"+ row_id).value=total; 
	}
}
else if(type_val=='overhead'){
	
	if(row_id==1){
		var total=0;
		document.getElementById('total_'+row_id).value=total;
	}else{ 
		var total = document.getElementById('total_' + (row_id-1)).value;
		//  alert("overhead in");
		var rate = document.getElementById('rate_'+row_id).value;
		var tot1 = total*rate;
		var tot2 = tot1/100;
		document.getElementById("total_"+ row_id).value=tot2; 
	}
}else{  
	if(row_id==1){
		
		var total=document.getElementById('amount_'+row_id).value;
		
		document.getElementById('total_'+row_id).value=total;
		
	}else{
		
		var count=row_id-1;
		
		var total=document.getElementById('amount_'+row_id).value;
		
		var last_total=document.getElementById('total_'+count).value;
		
		if(last_total=='' || last_total==NaN){
			var last_amt=0;
			
		}else{
			var last_amt=last_total;
			
		}

		//alert(last_amt);
		var grand_total=parseFloat(total)+parseFloat(last_amt);
		
		document.getElementById('total_'+row_id).value=grand_total;
		
	}
}
var final_total=document.getElementById('total_'+row_id).value

document.getElementById('final_total').value=final_total;
}
}




function edit_deleteRow(tableID,row, row_count)
{    try{
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
						for(i=0;i<rowCount;i++){
							
							var get_data = table.rows[i].cells[0].childNodes[0].id.split('_') ;
							var textbox_name =  get_data[0];
							table.rows[i].cells[0].childNodes[0].id = textbox_name+"_"+z;
							
							var get_data1 = table.rows[i].cells[1].childNodes[0].id.split('_') ;
							var textbox_name1 =  get_data1[0];
							table.rows[i].cells[1].childNodes[0].id = textbox_name1+"_"+z;
							
							var get_data2 = table.rows[i].cells[2].childNodes[0].id.split('_') ;
							var textbox_name2 =  get_data2[0];
							table.rows[i].cells[2].childNodes[0].id = textbox_name2+"_"+z;
							
							var get_data3 = table.rows[i].cells[3].childNodes[0].id.split('_') ;
							var textbox_name3 =  get_data3[0];
							table.rows[i].cells[3].childNodes[0].id = textbox_name3+"_"+z;
							
							var get_data4 = table.rows[i].cells[4].childNodes[0].id.split('_') ;
							var textbox_name4 =  get_data4[0];
							table.rows[i].cells[4].childNodes[0].id = textbox_name4+"_"+z;
							
							var get_data5 = table.rows[i].cells[5].childNodes[0].id.split('_') ;
							var textbox_name5 =  get_data5[0];
							table.rows[i].cells[5].childNodes[0].id = textbox_name5+"_"+z;
							
							
							
							z++;
						}
					}
				total_quantity_onload(tableID);
			}
			catch(e)
			{
				alert(e);

			}
	}



	function validate(tableID)
	{       var table=document.getElementById(tableID);
		var rowCount=table.rows.length;
		var newRowCount = rowCount;
		
		for(i=1;i<=newRowCount;i++){
			var e = document.getElementById("type_"+i);
			var type_val = e.options[e.selectedIndex].value;
		//alert(i);
		//alert(document.getElementById('quantity_'+i).value);
		//alert(type_val);
		if(type_val=='convert'){
			//alert("convert");
			if(document.getElementById('quantity_'+i).value == "" )
			{
				alert( "Please provide your quantity!" );
				document.getElementById('quantity_'+i).focus() ;
				return false;
			}}
			
			if(type_val=='overhead'){
			//alert("overhead");
			if(document.getElementById('code_'+i).value == "" )
			{
				alert( "Please provide your Code!" );
				document.getElementById('code_'+i).focus() ;
				return false;
			}
			if(document.getElementById('rate_'+i).value == "" )
			{
				alert( "Please provide your Rate!" );
				document.getElementById('rate_'+i).focus() ;
				return false;
			}
			
		}
		
		if(type_val=='text'){
			//alert("text");
			if(document.getElementById('serial_'+i).value == "" )
			{
				alert( "Please provide your Serial No!" );
				document.getElementById('serial_'+i).focus() ;
	// $(".msg_box_serial_"+i).html("Please insert serial No.");
	return false;
}
if(document.getElementById('item_desc_'+i).value == "" )
{
	alert( "Please provide your Description!" );
	document.getElementById('item_desc_'+i).focus() ;
	return false;
}}

if(type_val=='material' || type_val=='labour' || type_val=='refrence' || type_val=='carriage' || type_val=='plant' || type_val=='subitem'){
		//	alert("other");
		if(document.getElementById('code_'+i).value == "" )
		{
			alert( "Please provide your Code!" );
			document.getElementById('code_'+i).focus() ;
			return false;
		}
		if(document.getElementById('quantity_'+i).value == "" )
		{
			alert( "Please provide your quantity!" );
			document.getElementById('quantity_'+i).focus() ;
			return false;
		}
	}
	
}
return( true );

}

</script>
