<div id="main-content" >
    	<div class="page-title">
    	<div>
    	<h1><i class="fa fa-keyboard-o"></i> Subitem Calculation</h1>
    	</div>
    	</div>


    	<div id="breadcrumbs">
    	<ul class="breadcrumb">
    	<li class="active"> <i class="fa fa-home"></i><?php echo($this->breadcrumb->output());?> </li>

    	</ul>
    	</div>
    	 <?php  $row_table=0;

    							 foreach($subitem_costing as $j ){ 
    							$row_table = $row_table + 1;
    							} ?>
    							
    		
    	 <!--DESCRIPTION STARTS -->
    			<div class="row">
    				<div class="col-md-12">
    					<div class="panel panel-default">
    						<div class="panel-heading"><h4><?php echo str_replace("%20"," ",ucwords($subitem_des));?></h4>
    						</div>
    					</div>
    				</div>
    			</div>
    		 <!--DESCRIPTION eNDS -->
    	<div class="row">
    		

    		<div class="col-md-12">
    		
    		
    			
    			<!--<div><form method="post" action="<?php echo base_url() ?>index.php/csv/importcsv" enctype="multipart/form-data" onsubmit="return validate()">
    			 <input type="hidden"  name="dep_id" value="<?=$dep_id?>" />
    			<input type="hidden"  name="chap_id" value="<?=$chap_id?>" />
    			<input type="hidden"  name="item_id" value="<?=$item_id?>" />
    			<input type="hidden"  name="subitem_id" value="<?=$subitem_id?>" />
    			<input type="hidden"  name="class_id" value="<?=$class_id?>" />
    				 <span class="btn btn-default btn-file">
    								Browse
                        <input type="file" id="file" name="userfile" >
    					</span>
                         <input type="hidden" name="list_type" id="list_type" value="subitem" >
                        <input type="submit" name="submit" value="UPLOAD" class="btn btn-primary">
                    </form></div>-->
    		
    		 <form action="index.php/home/create_sub_cal" method="post" name="myForm" <?php if(!empty($subitem_costing)){ ?> onsubmit="return(validate('editTable'));" <?php } else {?> onsubmit="return(validate('dataTable'));" <?php } ?> >
    		    <input type="hidden"  name="dep_id" value="<?=$dep_id?>" />
    			<input type="hidden"  name="chap_id" value="<?=$chap_id?>" />
    			<input type="hidden"  name="item_id" value="<?=$item_id?>" />
    			<input type="hidden"  name="subitem_id" value="<?=$subitem_id?>" />
    			<input type="hidden"  name="class_id" value="<?=$class_id?>" />
    			<div class="row ">
    					<div class="col-md-4 col-md-offset-8" style="text-align: right;">
    					
    						<?php if(!empty($subitem_costing)){?>
    				<input type="button" value="Add Row" class="btn btn-info " onclick="edit_addRow('editTable',
    			  <?=$row_table?>)">
    			  
    			  
    	          <input type="button" value="Delete Row"class="btn btn-info "  onclick="edit_deleteRow('editTable')">
    	          <?php } else {?>
    				  	<input type="button" value="Add Row" class="btn btn-info "  onclick="addRow('dataTable')">
    	          <input type="button" value="Delete Row" class="btn btn-info " onclick="deleteRow('dataTable')">
    	          <?php }?>
    				
    					 </div>
    			  </div>
    			  </br>
    			  
    			  
    			
    			
    			
    	<div class="table-big">
    				
    		    <table class="table table-bordered fill-head subcal" >

    			    
    				<thead>
    					<tr>
    					<th class="subitem">#</th>
    					<th class="subitem">Order</th>
    					<th class="subitem">Type</th>
    					<th class="subitem">Code</th>
    					<th class="subitem">Description </th>
    					<th class="subitem">Unit</th>
    					<th style="display:none;"></th>
    					<th class="subitem">Quantity</th>
    					<th class="subitem">Rate</th>
    					<th class="subitem">Amount</th>
    					<th class="subitem">Total</th>
    					<th>Ovehead</th>
    					</tr>
    					</thead>
    				
    						<?php if(!empty($subitem_costing)){ ?>
    										
    					<tbody id="editTable" >
    				
    							
    							
    							<?php foreach($subitem_costing as $key=> $sub){ ?>	
    							<input type="hidden" readonly name="edit_costing" id="edit_costing" value="1" />
    					
    						<tr>
    								
    								
    								
    								<td><input type="checkbox" id="select_<?=$key+1?>"  
    									title="Check/Uncheck all" class="select_all" />
    									
    								</td>
    								
    								
    								
    								
    	                           <td><input  type="text"  class="input-mini-xs" id="serial_<?=$key+1?>" 
    	                           		name="serial[]"  value="<?=(!empty($sub->serial))?$sub->serial:"";?>">
    									<span class="msg_box_serial_<?=$key+1?>" ></span>
    	                           	</td>
    	                           	<span class="msg_box_serial_<?=$key+1?>" ></span>
    	                           
    											<td><select required  class="input-small" id="type_<?=$key+1?>"  placeholder="Select Category" name="item_type[]" >
    							<option value="">Select Type</option>
    	                        <?php foreach($cost_type as $ct){?>
    							 <option value="<?=$ct->costtype_desc?>" <?=(!empty($sub->item_type) && $sub->item_type==$ct->costtype_desc)?'selected':''?>><?=$ct->costtype_desc?></option>
    	                       <?php }?>
    							</select></td>
    	           					
    	           					<td><input   type="text" class="input-mini-xs" id="code_<?=$key+1?>" 
    									name="code[]" onchange="get_type_value(this.id,'editTable');" 
    									value="<?=(!empty($sub->code))?$sub->code:"";?>">
    								</td>
    	           					
    	           					<?php /*echo $sub->item_desc;*/?>
    								<td><textarea  class="input-medium"  rows="4" id="item_desc_<?=$key+1?>" 
    									name="item_desc[]" onchange="get_text_type(this.id,'editTable');"><?php if($sub->item_type=='text'){ echo (!empty($sub->item_desc))?$sub->item_desc:"";}?>
    									</textarea>
    								</td>
    								
    								
    								 <?php $filter = array('unit_code'=>$sub->unit_code);
    								
    								
    								 
    									  $unit_name= $this->utilities->get_unit_name('ssr_t_uom',$filter);
    									  //print_r($unit_name);
    								?>
    								
    								
    									<td><input readonly type="text" class="input-mini-xs" 
    									id="unit_<?=$key+1?>" name="unit_code[]" 
    									value="<?php //=(!empty($unit_name))?$unit_name[0]->unit_name:"";?>">
    									</td>
    									<?php $filter = array('unit_code'=>$sub->unit_code);
    									$unit_code= $this->utilities->get_unit_name('ssr_t_uom',$filter);
    									?>
    									<td><input type="text"  class="input-mini-xs" id="units_<?=$key+1?>" name="unit_code[]" 
    									value="<?php //=(!empty($unit_code))?$unit_code[0]->unit_code:"";?>">
    								</td>
    								
    								
    								<td><input   type="text" data-rule-required="true" class="input-mini-xs form-control required"  id="quantity_<?=$key+1?>" 
    									name="quantity[]" onchange="calculate_amount(this.id);adding_total(this.id,'editTable')" 
    									value="<?=(!empty($sub->quantity))?$sub->quantity:"";?>" 
    									>
    								</td>
    								
    								
    								<td><input  type="text" readonly class="input-mini-xs"  id="rate_<?=$key+1?>" 
    									name="rate[]" onchange="adding_total(this.id,'editTable')"
    									value="<?php //=(!empty($sub->rate))?$sub->rate:"";?>">
    								</td>
    								
    								
    								<td><input type="text" readonly class="input-mini"id="amount_<?=$key+1?>" 
    									name="amount[]" value="<?php //=(!empty($sub->amount))?$sub->amount:"";?>" 
    									>
    								</td>
    								
    								
    								<td><input type="text" readonly class="input-mini" 
    									placeholder="Total" id="total_<?=$key+1?>" 
    									name="total_amount[]" 
    									value="<?php //=(!empty($sub->total_amount))?$sub->total_amount:0	;?>"
    									>
    									
    								</td>
    								<td><input type="text" onchange="overhead_cal(this.value,this.id,'editTable')" class="input-mini" 
    									placeholder="Ovehead" id="overhead_<?=$key+1?>" 
    									name="Ovehead[]" 
    									value="<?=(!empty($sub->over_head))?$sub->over_head:"";?>"
    									>
    								</td>
    								
    								
    								
    					 </tr>
    								 <?php }?>
    				 </tbody>
    				<?php } else {?>
    					     	<tbody id="dataTable"> 
    					     <tr>
    							<td><input type="checkbox" id="select_1" onclick="check(this.id,'dataTable')" title="Check/Uncheck all" class="select_all" /></td>
    							<td><input required type="text"   class="input-mini-xs" id="serial_1" name="serial[]"  value=""></td>
    						

    								<td><select required class="input-small" id="type_1"  placeholder="Select Category" name="item_type[]" onchange="search_code_ajax(this.value,this.id)">
    							<option value="">Select Type</option>
    	                        <?php foreach($cost_type as $ct){?>
    							 <option value="<?=$ct->costtype_desc?>"><?=$ct->costtype_desc?></option>
    	                       <?php }?>
    							</select></td>
    							<td><span id="code_1" ></span></td>
    							<td><textarea   class="input-medium" rows="1" id="item_desc_1" name="item_desc[]"onchange="get_text_type(this.id,'dataTable');"></textarea></td>
    							
    							<td><input type="text" readonly class="input-mini-xs" id="unit_1" name="unit_code[]" value=""></td>
    							<td><input type="text" readonly class="input-mini-xs" id="units_1" name="unit_code[]" value="">
    							</td>
    							
    							<td><input  type="text" data-rule-required="true" class="input-mini-xs form-control required" id="quantity_1" name="quantity[]" onchange="calculate_amount(this.id);adding_total(this.id,'dataTable')"  value=""  ></td>
    							<td><input type="text" readonly class="input-mini-xs" id="rate_1" name="rate[]"  onchange="adding_total(this.id,'dataTable')" value=""></td>
    							<td><input type="text" readonly class="input-mini-xs" id="amount_1" name="amount[]" value="" onblur="get_total(this.id)"></td>
    							<td><input type="text" readonly class="input-mini" placeholder="Total" id="total_1" name="total_amount[]" value=""></td>
    					  		<td><input type="text"  class="input-mini" onchange="overhead_cal(this.value,this.id,'dataTable')" placeholder="Ovehead" id="overhead_1" 	name="Ovehead[]" value=""></td>
    					  </tr>
    	                   </tbody>
    			<?php }?>
    		  
    </table>
    </div>	
    <div class="row ">
    					<div class="col-md-4 col-md-offset-8" style="text-align: right;">
    					
    						<?php if(!empty($subitem_costing)){?>
    				<input type="button" value="Add Row" class="btn btn-info " onclick="edit_addRow('editTable',
    			  <?=$row_table?>)">
    			  
    			  
    	          <input type="button" value="Delete Row"class="btn btn-info "  onclick="edit_deleteRow('editTable')">
    	          <?php } else {?>
    				  	<input type="button" value="Add Row" class="btn btn-info "  onclick="addRow('dataTable')">
    	          <input type="button" value="Delete Row" class="btn btn-info " onclick="deleteRow('dataTable')">
    	          <?php }?>
    				
    					 </div>
    			  </div>
    				</br>
    				      <div class="col-sm-9 col-sm-offset-3 col-lg-8 col-lg-offset-4">
              <button type="button" class="btn" onClick="window.history.back();">Cancel</button>
           <input type="hidden" readonly name="final_total" id="final_total" value="" />
                     
    			<input type="submit" name="save" class="btn btn-primary " value="Save Changes">
          </div>
    			 
     </form>
    	
    	

    	</div>

    		

    </div>
    	<script language="javascript">
    		
    $( "#editTable" ).ready(function() {
    				var table=document.getElementById('editTable');
    				var rowCount=table.rows.length;
    			for(i=1;i<=rowCount;i++){
    				var row = i;
    			   get_type_value_onload(row,'editTable');
    			}
    });

    $(window).load(function() {
    				var table=document.getElementById('editTable');
    				var rowCount=table.rows.length;
    			for(i=1;i<=rowCount;i++){
    				var row = i;
    			}
      setTimeout( function(){ 
    			for(i=1;i<=rowCount;i++){
    				var row = i;
    			   calculate_amount_onload(row);
    			}
    			adding_total(row,'editTable');
    			//overhead_cal_single_onload(row);
					 overhead_cal_onload(document.getElementById("overhead_"+row).value,document.getElementById("overhead_"+row).id,'editTable',rowCount);
					
      }
      , 2000 );
    });

    function addRow(tableID)
    { 
    			var table=document.getElementById(tableID);
    			var rowCount=table.rows.length;
    			var row=table.insertRow(rowCount);
    			var	last_row = rowCount+1;
    			var colCount=table.rows[0].cells.length;
    			
    	for(var i=0;i<colCount;i++)
    {
    				var newcell= row.insertCell(i);
    				newcell.innerHTML=table.rows[0].cells[i].innerHTML;
    		
    	switch(newcell.childNodes[0].type)
    	{
    		
    		case"text":
    				 newcell.childNodes[0].value="";
    				 var get_data = newcell.childNodes[0].id.split('_');	
    				 var textbox_name =  get_data[0];
    				 var textbox_id = get_data[1];
    		case"text":
    				newcell.childNodes[0].id=textbox_name+"_"+(last_row);
    				break;
    		case"textarea":
    				newcell.childNodes[0].value="";
    		case"textarea":
    				newcell.childNodes[0].id="item_desc"+"_"+(last_row);
    				break;
    		case"checkbox":
    				newcell.childNodes[0].checked=false;
    				newcell.childNodes[0].id='select_'+(last_row);
    				break;
    		case"select-one":
    				get_data = newcell.childNodes[0].id;//.split('_');	
    				var dropdown= get_data.split('_');
    				var drop_name =  dropdown[0];
    				newcell.childNodes[0].selectedIndex=0;
    				newcell.childNodes[0].id=drop_name+"_"+(last_row);
    				break;
    		default:
    			//var h=newcell.childNodes[0].id;
    				var get_data = newcell.childNodes[0].id.split('_');	
    				var span_name =  get_data[0];
    				var span_id = get_data[1];
    				newcell.childNodes[0].id=span_name+"_"+(last_row);
    			break;
    	}
    	}
    	for(i=0;i<rowCount+1;i++){
    			 table.rows[i].cells[1].childNodes[0].value = i+1;
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
    			table.rows[i].cells[1].childNodes[0].value = i+1;
    			
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
    								
    			var get_data6 = table.rows[i].cells[6].childNodes[0].id.split('_') ;
    			var textbox_name6 =  get_data6[0];
    			table.rows[i].cells[6].childNodes[0].id = textbox_name6+"_"+z;
    								
    			var get_data7 = table.rows[i].cells[7].childNodes[0].id.split('_') ;
    			var textbox_name7 =  get_data7[0];
    			table.rows[i].cells[7].childNodes[0].id = textbox_name7+"_"+z;
    								
    			var get_data8 = table.rows[i].cells[8].childNodes[0].id.split('_') ;
    			var textbox_name8 =  get_data8[0];
    			table.rows[i].cells[8].childNodes[0].id = textbox_name8+"_"+z;
    								
    			var get_data9 = table.rows[i].cells[9].childNodes[0].id.split('_') ;
    			var textbox_name9 =  get_data9[0];
    			table.rows[i].cells[9].childNodes[0].id = textbox_name9+"_"+z;
    								
    			var get_data10 = table.rows[i].cells[10].childNodes[0].id.split('_') ;
    			var textbox_name10 =  get_data10[0];
    			table.rows[i].cells[10].childNodes[0].id = textbox_name10+"_"+z;

    			var get_data11 = table.rows[i].cells[11].childNodes[0].id.split('_') ;
				var textbox_name11 =  get_data11[0];
				table.rows[i].cells[11].childNodes[0].id = textbox_name11+"_"+z;
				table.rows[i].cells[11].childNodes[0].value ='' ;
    			
    			z++;
    	}
    	}
    			adding_total(row,tableID);
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
    		var newRowCount = rowCount;
    		var colCount=table.rows[0].cells.length;
    			
    	for(var i=0;i<colCount;i++)
    	{
    		var newcell= row.insertCell(i);
    		newcell.innerHTML=table.rows[0].cells[i].innerHTML;
    	switch(newcell.childNodes[0].type)
    	{
    		case"text":newcell.childNodes[0].value="";
    			
    		var get_data = newcell.childNodes[0].id.split('_');	
    		var textbox_name =  get_data[0];
    		var textbox_id = get_data[1];
    		newcell.childNodes[0].id=textbox_name+"_"+(rowCount+1);
    		break;
    				
    	case"textarea":
    		newcell.childNodes[0].value="";
    		newcell.childNodes[0].id="item_desc"+"_"+(rowCount+1);
    		break;
    				
    	case"checkbox":
    		newcell.childNodes[0].checked=false;
    		newcell.childNodes[0].id='select_'+(rowCount+1);
    		break;
    			
    	case"select-one":
    		get_data = newcell.childNodes[0].id;
    		var dropdown= get_data.split('_');
    		var drop_name =  dropdown[0];
    		newcell.childNodes[0].selectedIndex=0;
    		newcell.childNodes[0].id=drop_name+"_"+(rowCount+1);
    		break;
    	}
    			
    	}
    	for(i=0;i<rowCount+1;i++){
    		table.rows[i].cells[1].childNodes[0].value = i+1;
    	}
    }
    			
    function adding_total(row,tableID)
    { 			
    			var table=document.getElementById(tableID);
    			
    			var rowCount=table.rows.length;
    			var newRowCount = rowCount;
    	for(var i=1; i<=newRowCount; i++){
    			var row_id = i;
    			var e = document.getElementById("type_"+row_id);
    			var type_val = e.options[e.selectedIndex].value;
    	if(type_val=='convert'){
    	if(row_id==1){
    			var total=0;
    			document.getElementById('total_'+row_id).value=total;
    	}else{
    			var total = document.getElementById('total_' + (row_id-1)).value;
    			var quant = document.getElementById('quantity_'+row_id).value;
    			var tot1 = total/quant;
    			document.getElementById("total_"+ row_id).value=tot1; 
    	}
    	}
    	else if(type_val=='text'){
    	if(row_id==1){
    			var total=0;
    			document.getElementById('total_'+row_id).value=total;
    	}else{
    			var total = document.getElementById('total_' + (row_id-1)).value;
    			document.getElementById("total_"+ row_id).value=total; 
    	}
    	}
    	else if(type_val=='overhead'){
    				
    	if(row_id==1){
    			var total=0;
    			document.getElementById('total_'+row_id).value=total;
    	}else{ 
    		var chk=document.getElementById("overhead_"+row_id).value;
    		if(chk){
    			var total = document.getElementById('total_' + (row_id-1)).value;
    			var amt = document.getElementById('amount_'+row_id).value;
    			var tot3 = parseFloat(amt)+parseFloat(total);
    			document.getElementById("total_"+ row_id).value=tot3;
        		}else{
        			var total = document.getElementById('total_' + (row_id-1)).value;
        			 var rate = document.getElementById('rate_'+row_id).value;
        			var tot1 = total*rate;
        			var tot2 = tot1/100;
        			var tot3 = tot2+(+total);
        				document.getElementById("amount_"+ row_id).value=tot2; 
        				document.getElementById("total_"+ row_id).value=tot3; 
        		}
    			}
    			}
    	else{  
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
    			var grand_total=parseFloat(total)+parseFloat(last_amt);
    			document.getElementById('total_'+row_id).value=grand_total;
    	}
    	}
    			var final_total=document.getElementById('total_'+row_id).value
    			document.getElementById('final_total').value=Math.round(final_total);
    	}
    }
    			
    function edit_deleteRow(tableID,row, row_count)
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
    								table.rows[i].cells[1].childNodes[0].value = i+1;
    								
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
    								
    								var get_data6 = table.rows[i].cells[6].childNodes[0].id.split('_') ;
    								var textbox_name6 =  get_data6[0];
    								table.rows[i].cells[6].childNodes[0].id = textbox_name6+"_"+z;
    								
    								var get_data7 = table.rows[i].cells[7].childNodes[0].id.split('_') ;
    								var textbox_name7 =  get_data7[0];
    								table.rows[i].cells[7].childNodes[0].id = textbox_name7+"_"+z;
    								
    								var get_data8 = table.rows[i].cells[8].childNodes[0].id.split('_') ;
    								var textbox_name8 =  get_data8[0];
    								table.rows[i].cells[8].childNodes[0].id = textbox_name8+"_"+z;
    								
    								var get_data9 = table.rows[i].cells[9].childNodes[0].id.split('_') ;
    								var textbox_name9 =  get_data9[0];
    								table.rows[i].cells[9].childNodes[0].id = textbox_name9+"_"+z;
    								
    								var get_data10 = table.rows[i].cells[10].childNodes[0].id.split('_') ;
    								var textbox_name10 =  get_data10[0];
    								table.rows[i].cells[10].childNodes[0].id = textbox_name10+"_"+z;

    								var get_data11 = table.rows[i].cells[11].childNodes[0].id.split('_') ;
    								var textbox_name11 =  get_data11[0];
    								table.rows[i].cells[11].childNodes[0].id = textbox_name11+"_"+z;
    								table.rows[i].cells[11].childNodes[0].value ='' ;
    								
    								z++;
    	}
    	}
    	}
    	catch(e)
    	{
    			alert(e);

    	}
    			adding_total(row,tableID);
    }

    function validate(tableID)
    {           var table=document.getElementById(tableID);
    			var rowCount=table.rows.length;
    			var newRowCount = rowCount;
    			
    	for(i=1;i<=newRowCount;i++){
    			var e = document.getElementById("type_"+i);
    			var type_val = e.options[e.selectedIndex].value;
    			if(type_val=='convert'){
    	if(document.getElementById('quantity_'+i).value == "" )
    	{
    			 alert( "Please provide your quantity!" );
    			 document.getElementById('quantity_'+i).focus() ;
    			 return false;
    	}}
    			
    	if(type_val=='overhead'){
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
    	if(document.getElementById('serial_'+i).value == "" )
    	{
    			 alert( "Please provide your Serial No!" );
    			 document.getElementById('serial_'+i).focus() ;
    			return false;
    	}
    	if(document.getElementById('item_desc_'+i).value == "" )
    	{
    			 alert( "Please provide your Description!" );
    			 document.getElementById('item_desc_'+i).focus() ;
    			 return false;
    	}}
    	   
    	if(type_val=='material' || type_val=='labour' || type_val=='refrence' || type_val=='carriage' || type_val=='plant' || type_val=='subitem'){
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
