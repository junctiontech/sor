var counter=2;

function calculate_amount(row)
{ 	            var get_data = row.split('_');		
				var id_type =  get_data[0];
				var row_id = get_data[1];// current counter 
				var e = document.getElementById("type_"+row_id);
				var type_val = e.options[e.selectedIndex].value;
	if(type_val=='overhead'){
		if(row_id==1){
			return;
		}else{
		var count=row_id-1;// last counter 
		var check_ref = document.getElementById("type_"+count);
	    var type_ref_val = check_ref.options[check_ref.selectedIndex].value;
		if(type_ref_val=='refrence'){
			var previous_counter=row_id-2;//counter To count last to  last sum  
			var last_total=document.getElementById('total_'+previous_counter).value;
			var percent=document.getElementById('rate_'+row_id).value;
			var c=last_total*percent;
			var final_amt = c/100;
			document.getElementById('amount_'+row_id).value=final_amt;
		}else{
			var last_total=document.getElementById('total_'+count).value;
			var percent=document.getElementById('rate_'+row_id).value;
			var c=last_total*percent;
			var final_amt = c/100;
			document.getElementById('amount_'+row_id).value=final_amt;
		 }
	}}else if(type_val=='convert'){
		document.getElementById('serial_'+row_id).value=row_id;
		}else{
	
			var quantity=document.getElementById('quantity_'+row_id).value;
			var rate=document.getElementById('rate_'+row_id).value;
			var c=quantity*rate;
			document.getElementById('amount_'+row_id).value=c;	
	}
}
function check_email(obj,id){
	var edit_mode='';
	if(id){
		edit_mode=id;
		}else{
			edit_mode=0;
			}
	$(".msg_box_"+obj.id).html('');
		var email = obj.value; 
		var email = email; 
		if(email!=''){
			$.ajax({
					type:"POST",
					url: base_url+"index.php/common_functions/check_email/"+edit_mode,
					data: {email: email},
					})
					.done(function( msg ) {
						if(msg!=1) {
							$('#reg-email').val('');
							$(".msg_box_"+obj.id).html("email id already registered with us.<a href='javascript:;' onclick='forgot()'>Forget Password</a>");
							return false;
							}
					});
			return false;		
		}
}
function show_language(language_id){
	$.ajax({
		type: "POST",
		url : base_url+'index.php/common_functions/show_language',
		data: {language_id: language_id },
	})	
		.done(function(msg){
			
			$('#show_language').html(msg);					
			return false;	
		});

return false;
	
	
}
function check_language(obj,id){
	var edit_mode='';
	if(id){
		edit_mode=id;
		}else{
			edit_mode=0;
			}
	
		var language_id = obj.value; 
		var language_id = language_id; 
		if(language_id!=''){
			$.ajax({
					type:"POST",
					url: base_url+"index.php/common_functions/check_language/"+edit_mode,
					data: {language_id: language_id},
					})
					.done(function( msg ) {
					
						if(msg!=1) {
							$('#show-language').html(msg);
							//$(".msg_box_"+obj.id).html("email id already registered with us.<a href='javascript:;' onclick='forgot()'>Forget Password</a>");
							return false;
							}
					});
			return false;		
		}
}

function check_forget_email(id){
	var edit_mode='';
	var email =  document.getElementById("forget-email").value;
	if(id){
		edit_mode=id;
		}else{
			edit_mode=0;
			}
	$('#forget-email').val('');
		var email = email; 
		if(email!=''){
			$.ajax({
					type:"POST",
					url: base_url+"index.php/common_functions/check_forget/"+edit_mode,
					data: {email: email},
					})
					.done(function( msg ) {
					
						if(msg!=1) {
							$('#forget-email').val('');
							$(".msg_box_forget-email").html("password send in your mail id");
							return false;
							}
							else
							{
							$('#forget-email').val('');
							$(".msg_box_forget-email").html("email id not exist in database check your mail id.");
							return false;	
							}
					});
			return false;		
		}
}
function hello(value){
	alert(value);
}
function code(name)
{
	//alert(name);
	//die;
$.ajax({
		type:"POST",
		url: base_url+'index.php/login/select_language',
		data:{name:name},
})
	.done(function(msg){
		//alert(msg);
		$("#lang").html(msg);
		
		return false;
						});
return false;
	
	
}
function append_menus(){
	
	counter++;
	 var tr = '<tr>' + 
	 			'<td>' + 
	 				'<input type="checkbox" id="select_all" title="Check/Uncheck all" class="select_all" />' +
	 			'</td>' + 
	 			
	 			'<td class="reorder">' +
	 				'<a class="icon-move" href="#move" title="Reorder"></a>' + 
	 			'</td>' + 
	 			
	 			'<td>' + 
	 				'<select id="type" placeholder="Select Category" name="type[]" >' + 
	 					'<option value="">Select Type</option>' + 
	 					'<option value="material">Material</option>' + 
	 					'<option value="lebor">Labour</option>' + 
	 					'<option value="other">Other</option>' + 
	 				'</select>'
	 			'</td>'+
	 //					</td>
	 			'<td>' +
	 				'<textarea   rows="6" id="description" name="description[]"></textarea>' + 
	 			'</td>' + 
	 			'<td>' + 
	 				'<input type="text" placeholder="Subitem Code" id="code" name="code[]" value="">' +
	 			'</td>' + 
	 			'<td>' + 
	 				'<input type="text" placeholder="Subitem Unit" id="unit" name="unit[]" value="">' + 
	 			'</td>' + 
	 			'<td>' + 
	 				'<input type="text" placeholder="Subitem Quantity" ' + 
	 					'id="quantity'+counter+'" name="quantity[]" onblur="calculate_amount()" value="">' + 
	 			'</td>' + 
	 			'<td>' + 
	 				'<input type="text" placeholder="Subitem Rate" ' +
	 					'id="rate'+counter+'"  name="rate[]" onblur="calculate_amount()"  value="">' + 
	 			'</td>' +
	 			'<td>' +
	 				'<input type="text" readonly placeholder="Subitem Amount" id="amount'+counter+'" name="amount[]" value="">' + 
	 			'</td>' + 
	 			'</tr>'; 
	
	$(".menus").append(tr);
}

function search_code_ajax(value,row)
{
			var get_data = row.split('_');		
			var id_type =  get_data[0];
			var row_id = get_data[1];
	 $.ajax({
			type: "POST",
			url: base_url+'index.php/common_functions/search_code_ajax',
			data: {value: value,row_id: row_id},
		})
			.done(function(msg){
				//alert(row_id);
				$("#code_"+row_id).html(msg);
				//$(".search_ajax").html(msg);
				return false;
			});
			return false;
}

function search_ajax(value,row,tableid)
{		$.ajax({
			type: "POST",
			url: base_url+'index.php/common_functions/search_ajax',
			data: {value: value},
		})
			.done(function(msg){
				$(".search_ajax").html(msg);
			return false;
		});
			return false;
}

function get_type_value(row,tableid)
{       
			var get_data = row.split('_');		
			var id_type =  get_data[0];
			var row_id = get_data[1];
			var val_id=id_type+'_'+row_id;	
			var e = document.getElementById("type_"+row_id);
			var type_val = e.options[e.selectedIndex].value;
			var code_val=document.getElementById(val_id).value;
	
	 $.ajax({
			type: "POST",
			url: base_url+"index.php/common_functions/get_type_value/"+type_val+"/"+code_val,
			data: {},
		})
		.done(function(msg) {	
			//alert(msg);
		var topic = eval(msg);
			$.each(topic, function(i,v){
			if(type_val=='refrence'){
			$('#rate_'+row_id).val(v.cost_total);
			$('#unit_'+row_id).val(v.unit_code);
			$('#units_'+row_id).val(v.unit_code);
			$('#item_desc_'+row_id).val(v.description); 
			}else if(type_val=='overhead'){
			$('#rate_'+row_id).val(v.overhead_percent);
			$('#item_desc_'+row_id).val(v.overhead_desc); 
			adding_total(row,tableid);
			 }else if(type_val=='labour'){
			$('#rate_'+row_id).val(v.labour_rate);
			$('#unit_'+row_id).val(v.unit_code);
			$('#units_'+row_id).val(v.unit_code);
			$('#item_desc_'+row_id).val(v.labour_description); 
			}else if(type_val=='carriage'){
		    $('#rate_'+row_id).val(v.carriage_rate);
			$('#unit_'+row_id).val(v.unit_code);
			$('#units_'+row_id).val(v.unit_code);
			$('#item_desc_'+row_id).val(v.carriage_description);   
			}else if(type_val=='plant'){
			$('#rate_'+row_id).val(v.rate);
			$('#unit_'+row_id).val(v.unit_code);
			$('#units_'+row_id).val(v.unit_code);
			$('#item_desc_'+row_id).val(v.pla_desc);   
			}else if(type_val=='subitem'){
			$('#rate_'+row_id).val(v.rate);
			$('#unit_'+row_id).val(v.unit_code);
			$('#units_'+row_id).val(v.unit_code);
			$('#item_desc_'+row_id).val(v.subitem_desc); 
			}else{   
			
			$('#rate_'+row_id).val(v.rate);
			$('#unit_'+row_id).val(v.unit_code);
			$('#units_'+row_id).val(v.unit_code);
			$('#item_desc_'+row_id).val(v.mat_desc);  
		}
		 });
	 });	
}

function get_total(row, row_count){
		var get_data = row.split('_');		
		var id_type =  get_data[0];
		for(var i=1; i<=row_count; i++){
		
		 var row_id = i;
		 var val_id=id_type+'_'+row_id;	
		 var e = document.getElementById("type_"+row_id);
		 var type_val = e.options[e.selectedIndex].value;
		 
	  if(type_val=='convert'){
		 var total = document.getElementById('total_' + (row_id-1)).value;
		 var quant = document.getElementById('quantity_'+row_id).value;
		 var tot1 = total/quant;
		document.getElementById("total_"+ row_id).value=tot1; 
		 }else{  
	if(row_id==1){
		var total=document.getElementById('amount_'+row_id).value;
		document.getElementById('total_'+row_id).value=total;
	}else{
		var count=row_id-1;
		var total=document.getElementById('amount_'+row_id).value;
		var last_total=document.getElementById('total_'+count).value;
		if(last_total==''){
			var last_amt=0;
			
		}else{
			var last_amt=last_total;
		}
	    var grand_total=parseFloat(total)+parseFloat(last_amt);
		document.getElementById('total_'+row_id).value=grand_total;
	}
	  }
		}
}

function check(currentcount,tableID){
		var table=document.getElementById(tableID);
		var rowCount=table.rows.length;//Counter for total row exist
		var get_data = currentcount.split('_');		
		var id_type =  get_data[0];
		var row_id = get_data[1];//Counter for current row 
}
/* function _language(language_id,current_value)
{
	$.ajax({
				type: "POST",
				url : base_url+'index.php/common_functions/show_language',
				data: {language_id: language_id , current_value: current_value },
			})	
				.done(function(msg){
					
					$('#show_language').html(msg);					
					
					return false;	
				});
		
		return false;
}
*/
function show_chapter(dep_id,current_value)
{
	$.ajax({
				type: "POST",
				url : base_url+'index.php/common_functions/show_chapter',
				data: {dep_id: dep_id , current_value: current_value },
			})	
				.done(function(msg){
					
					$('#show_chap').html(msg);					
					
					return false;	
				});
		
		return false;
}
function show_item(chap_id,current_value,dep_id)
{
	$.ajax({
				type: "POST",
				url : base_url+'index.php/common_functions/show_item',
				data: {chap_id: chap_id , current_value: current_value,dep_id:dep_id },
			})	
				.done(function(msg){
					
					$('#show_item').html(msg);					
					
					return false;	
				});
		
		return false;
}
function show_sitem(item_id,current_value,dep_id,chap_id)
{
	$.ajax({
				type: "POST",
				url : base_url+"index.php/common_functions/show_sitem/"+dep_id+"/"+chap_id+"/"+item_id,
				data: {dep_id:dep_id,chap_id:chap_id,item_id:item_id},
			})	
				.done(function(msg){
					
					$('#show_subitem').html(msg);					
					
					return false;	
				});
		
		return false;
}

function show_itemchapter(dep_id,current_value)
{
	$.ajax({
				type: "POST",
				url : base_url+'index.php/common_functions/show_itemchapter',
				data: {dep_id: dep_id , current_value: current_value },
			})	
				.done(function(msg){
					
					$('#show_itemchap').html(msg);					
					
					return false;	
				});
		
		return false;
}

function show_item_list(chap_id,current_value,dep_id)
{
	$.ajax({
				type: "POST",
				url : base_url+"index.php/common_functions/show_item_list/"+chap_id+"/"+dep_id,
				data: {chap_id:chap_id,dep_id:dep_id},
			})	
				.done(function(msg){
					
					$('#show_item_list').html(msg);					
					
					return false;	
				});
		
		return false;
}

function show_chapterlist(dep_id,current_value)
{
	$.ajax({
				type: "POST",
				url : base_url+"index.php/common_functions/show_chapterlist/"+dep_id,
				data: {dep_id:dep_id},
			})	
			.done(function(msg){
					$('#show_chapter_list').html(msg);					
					return false;	
				});
		return false;
}
function check_unit_exsist(id)
{ $("html, body").animate({ scrollTop: 0 }, 600);	
	if($('.'+id).html()!="")
	{ 
		alert('This Unit is alredy exsist!!');
		return false;
	}
	else{
	return true;
	}
}

function check_unitname(obj,id){
	
	var edit_mode='';
	if(id){
		edit_mode=id;
		}else{
			edit_mode=0;
			}
	$(".msg_box_"+obj.id).html('');
		var unit_code = obj.value; 
		var unit_code = unit_code; 
		if(unit_code!=''){
			$.ajax({
					type:"POST",
					url: base_url+"index.php/common_functions/check_unitname/"+edit_mode,
					data: {unit_code: unit_code},
					})
					.done(function( msg ) {
						if(msg!=1) {
							$(".msg_box_"+obj.id).html(msg);
							$('#validation-form').attr('onSubmit','return false');
							return false;
						}else{
							$('#validation-form').attr('onSubmit','return true');
							} 	
					});
			return false;		
		}
}

$(document).ready(function () {
	/* Get the checkboxes values based on the class attached to each check box */
	$("#buttonClass").click(function() {
	    getValueUsingClass();
	});
	
	/* Get the checkboxes values based on the parent div id */
	$("#buttonParent").click(function() {
	    getValueUsingParentTag();
	});
});

function getValueUsingClass(){
	/* declare an checkbox array */
	var chkArray = [];
	
	/* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
	$(".chk:checked").each(function() {
		chkArray.push($(this).val());
	});
	
	/* we join the array separated by the comma */
	var selected;
	selected = chkArray.join(',') + ",";
	
	/* check if there is selected checkboxes, by default the length is 1 as it contains one single comma */
	$.ajax({
				type: "POST",
				url : base_url+"index.php/common_functions/show_estimation",
				data: {selected:selected},
			})	
				.done(function(msg){
					
					$('#show_estimaed').html(msg);					
					
					return false;	
				});
		
		return false;
}
/* Function to check material code already insert START*/
function check_material(obj,id){
			var edit_mode='';
		if(id){
			edit_mode=id;
		}else{
			edit_mode=0;
		}
	    $(".msg_box_"+obj.id).html('');
			 var material = obj.value; 
			 var material = material; 
		if(material!=''){
		$.ajax({
			 type:"POST",
			 url: base_url+"index.php/common_functions/check_material/"+edit_mode,
			 data: {material: material},
		})
		.done(function( msg ) {
		if(msg!=1) {
			$('#mat_name').val('');
			$(".msg_box_"+obj.id).html("Code id already registered with us.");
			return false;
		}
		});
			return false;		
		}
	}
/* Function to check material code already insert END*/

/*new coding 05 may start*/
function get_type_value_onload(row,tableid)
{          	
			var id_type = 'code'; 
			var row_id = row; 
			var val_id=id_type+'_'+row_id;
			var e = document.getElementById("type_"+row_id);
			var type_val = e.options[e.selectedIndex].value;
			var code_val=document.getElementById(val_id).value;
	 $.ajax({
			type: "POST",
			url: base_url+"index.php/common_functions/get_type_value/"+type_val+"/"+code_val,
			data: {},
		})
		.done(function(msg) {	
		var topic = eval(msg);
		$.each(topic, function(i,v){
			if(type_val=='refrence'){
			$('#rate_'+row_id).val(v.cost_total);
			$('#unit_'+row_id).val(v.unit_code);
			$('#units_'+row_id).val(v.unit_code);
			$('#item_desc_'+row_id).val(v.description); 
			}else if(type_val=='overhead'){
			$('#rate_'+row_id).val(v.overhead_percent);
			$('#item_desc_'+row_id).val(v.overhead_desc); 
			}else if(type_val=='labour'){
			$('#rate_'+row_id).val(v.labour_rate);
			$('#unit_'+row_id).val(v.unit_code);
			$('#units_'+row_id).val(v.unit_code);
			$('#item_desc_'+row_id).val(v.labour_description);   
			}else if(type_val=='carriage'){
			$('#rate_'+row_id).val(v.carriage_rate);
			$('#unit_'+row_id).val(v.unit_code);
			$('#units_'+row_id).val(v.unit_code);
			$('#item_desc_'+row_id).val(v.carriage_description);   
			}else if(type_val=='plant'){
			$('#rate_'+row_id).val(v.rate);
			$('#unit_'+row_id).val(v.unit_code);
			$('#units_'+row_id).val(v.unit_code);
			$('#item_desc_'+row_id).val(v.pla_desc);   
			}else if(type_val=='subitem'){
			$('#rate_'+row_id).val(v.rate);
			$('#unit_'+row_id).val(v.unit_code);
			$('#units_'+row_id).val(v.unit_code);
			$('#item_desc_'+row_id).val(v.subitem_desc); 
			}else{   
			$('#rate_'+row_id).val(v.rate);
			$('#unit_'+row_id).val(v.unit_code);
			$('#units_'+row_id).val(v.unit_code);
			$('#item_desc_'+row_id).val(v.mat_desc);  
			}
		   });
	 });
}

function calculate_amount_onload(row)
{ 
		var row_id = row; // current counter 
		var e = document.getElementById("type_"+row_id);
		var type_val = e.options[e.selectedIndex].value;
	if(type_val=='overhead'){
	if(row_id==1){
		return;
	}else{
			var count=row_id-1;// last counter 
			var check_ref = document.getElementById("type_"+count);
			var type_ref_val = check_ref.options[check_ref.selectedIndex].value;
	if(type_ref_val=='refrence'){
			var previous_counter=row_id-2;//counter To count last to  last sum  
			var last_total=document.getElementById('total_'+previous_counter).value;
			var percent=document.getElementById('rate_'+row_id).value;
			var c=last_total*percent;
			var final_amt = c/100;
			document.getElementById('amount_'+row_id).value=final_amt;
	}else{
			var last_total=document.getElementById('total_'+count).value;
			var percent=document.getElementById('rate_'+row_id).value;
			var c=last_total*percent;
			var final_amt = c/100;
		    document.getElementById('amount_'+row_id).value=final_amt;
	}
	}}else if(type_val=='convert'){
			document.getElementById('serial_'+row_id).value=row_id;
	}else{
			var quantity=document.getElementById('quantity_'+row_id).value;
			var rate=document.getElementById('rate_'+row_id).value;
			var c=quantity*rate; 
			document.getElementById('amount_'+row_id).value=c;	
	}
}
/*new coding 05 may end............................................................*/

/*estimate coding start............................................................*/
function calculate_quantity(row)
{ 				var get_data = row.split('_');		
				var id_type =  get_data[0];
				var row_id = get_data[1];// current counter 
				var no=document.getElementById('no_'+row_id).value;
				var length=document.getElementById('length_'+row_id).value;
				var width=document.getElementById('width_'+row_id).value;
				var depth=document.getElementById('depth_'+row_id).value;
				var quantityt=no*length*width*depth;
				var amount=document.getElementById('quantity_'+row_id).value=quantityt;
}

function calculate_quantity_onload(row)
{ 				var row_id = row;// current counter 
				var no=document.getElementById('no_'+row_id).value;
				var length=document.getElementById('length_'+row_id).value;
				var width=document.getElementById('width_'+row_id).value;
				var depth=document.getElementById('depth_'+row_id).value;
				var quantityt=no*length*width*depth;
				var amount=document.getElementById('quantity_'+row_id).value=quantityt;
}

function total_quantity_onload(tableID)
{ 				
				var table=document.getElementById(tableID);
				var rowCount=table.rows.length;
				var grand_total=0;
				for(i=1;i<=rowCount;i++){
				var row_id = i;
				var quantity=document.getElementById('quantity_'+row_id).value;
				var grand_total=grand_total+(+quantity);
			}
				document.getElementById('final_total').value=grand_total;
}

function calculate_estamount_onload(row)
{ 				
				var row_id = row;// current counter 
				var rate=document.getElementById('rate_'+row_id).value;
				var quantity=document.getElementById('quantity_'+row_id).value;
				var quantityt=rate*quantity;
				var amount=document.getElementById('amount_'+row_id).value=quantityt;
				
}
function total_estamount_onload(tableID)
{ 				var table=document.getElementById(tableID);
				var rowCount=table.rows.length;
				var grand_total=0;
				for(i=1;i<=rowCount-1;i++){
				var row_id = i;
				var amount=document.getElementById('amount_'+row_id).value;
				var grand_total=grand_total+(+amount);
			}
				document.getElementById('final_total').value=grand_total;
}
/*estimate coding end.................................................................................*/
/*overhead calculation start...........................................................................*/
function overhead_cal(value,id,tableid)
{				
				var get_data = id.split('_');		
				var id_type =  get_data[0];
				var row_id = get_data[1];
				
				var temp = new Array();
				temp = value.split(",");
				var lnth= temp.length;
				 
				var sum=0;
	for(i=0;i<=lnth-1;i++)
	{
				var val=temp[i];
				var sum =parseFloat(sum)+parseFloat(document.getElementById('amount_'+ val).value);
	}
				
				var rate = document.getElementById('rate_'+ row_id).value;
				var tot1 = sum*rate;
				var tot2 = tot1/100;
				document.getElementById("amount_"+ row_id).value=tot2; 
				adding_total(id,tableid);
				
}

function overhead_cal_onload(value,id,tableid,rowCount)
{			
	for(i=1;i<=rowCount;i++){
		var row = i;
		var chk=document.getElementById("overhead_"+row).value;
		if(chk){	
				var e = document.getElementById("type_"+row);
				var type_val = e.options[e.selectedIndex].value;
				
				 if(type_val=='overhead'){
					
					var id1= document.getElementById("overhead_"+row).value
					var temp = new Array();
					temp = id1.split(",");
					var lnth= temp.length;
				 
					var sum=0;
	for(j=0;j<=lnth-1;j++)
	{      
				var val=temp[j];
				var sum =parseFloat(sum)+parseFloat(document.getElementById('amount_'+ val).value);
	}
				var rate = document.getElementById('rate_'+ row).value;
				var tot1 = sum*rate;
				var tot2 = tot1/100;
				document.getElementById("amount_"+ row).value=tot2; 
				
				 }}}	
	adding_total(id,tableid);

}
function overhead_cal_single(row_id,tableid)
{				
	if(row_id==1){
		var total=0;
		document.getElementById('total_'+row_id).value=total;
	}else{ 
		var total = document.getElementById('total_' + (row_id-1)).value;
		 var rate = document.getElementById('rate_'+row_id).value;
		var tot1 = total*rate;
		var tot2 = tot1/100;
		var tot3 = tot2+(+total);
			document.getElementById("amount_"+ row_id).value=tot2; 
			document.getElementById("total_"+ row_id).value=tot3; 
		}
	var table=document.getElementById(tableid);
	var rowCount=table.rows.length;
	adding_total(rowCount,tableid);
}
function overhead_cal_single_onload(row_id)
{				
	if(row_id==1){
		var total=0;
		document.getElementById('total_'+row_id).value=total;
	}else{ 
		var total = document.getElementById('total_' + (row_id-1)).value;
		 var rate = document.getElementById('rate_'+row_id).value;
		var tot1 = total*rate;
		var tot2 = tot1/100;
		var tot3 = tot2+(+total);
			document.getElementById("amount_"+ row_id).value=tot2; 
			document.getElementById("total_"+ row_id).value=tot3; 
		}
	adding_total(row_id,'editTable');
}
/*overhead calculation end...........................................................................*/