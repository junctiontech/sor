<!--header starts added by palak on 13 jan of create sub item page -->

<div id="main-content">

	<div class="page-title">

		<div>

		<h1><i class="fa fa-plus"></i> <?=(isset($id))?"Edit":"Add"?> Subitem</h1>

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

      <div class="box">

      <div class="box-title">

      	

		<h3><i class="fa fa-plus"></i> <?=(isset($id))?"Edit":"Add"?> Subtems</h3>

       </div>

      <div class="box-content">

     <form action="<?=base_url()?>index.php/home/add_subitem" method="post" class="" novalidate="novalidate" id="validation-form">

     

  <div class="row">

		 <div class="col-md-5">

		   <div class="form-group">

				 	<div class="col-sm-12 col-lg-10 controls">

					  <select class="form-control" name="dep_id" id="dep_id" tabindex="1" data-rule-required="true" onChange="show_chapter(this.value,0)" >

						<option  value="">Select Department</option>

					  <?php foreach($dep as $d){ ?>

						 <option value="<?=$d->dep_id?>" <?=($this->uri->segment(3)==$d->dep_id)?'selected':''?>><?=$d->dep_name?></option>

						 

						 <?php } ?>

					  </select>

					  <span for="select" class="help-block">This field is required.</span>

					</div>

				</div>

			</div>

		   <div class="col-md-4">

			 <div class="form-group">

			 	<div class="col-sm-12 col-lg-10 controls"  id="show_chap" >

				 <select name="chap_id" id="chap_id" class="form-control" data-rule-required="true">

					<option value=''>Chapter</option>

					 <?php foreach($chap as $c){ ?>

                    <option value="<?=$c->chap_id?>" <?=($this->uri->segment(4)==$c->chap_id)?'selected':''?>><?=$c->chap_name?></option>

                 

				   <?php } ?>

				  </select>

				</div>

			 </div>

			  </div>

			 <div class="col-md-3">

			 <div class="form-group">

			   	<div class="col-sm-12 col-lg-10 controls" id="show_item">

				  <select name="item_id" id="item_id" class="form-control" data-rule-required="true">

					<option value=''>Item</option>

					 <?php foreach($item_list as $i){ ?>

                    <option value="<?=$i->item_id?>" <?=($this->uri->segment(5)==$i->item_id)?'selected':''?>><?=$i->item_name?></option>

                 

				   <?php } ?>

				  </select>

				</div>

			</div>

			 </div>

   	</div> 

		 <div class="row">

			<div class="col-md-2 col-md-offset-10">

			

				<!--<input type="button" value="ADD" class="btn btn-info pull-right" onclick="addRow('dataTable')">-->

		<!--	<a href="<?=base_url()?>index.php/home/manage_subitem/<?=$dep_id?>/<?=$chap_id?>/<?=$item_id?>"><button class="btn btn-primary pull-right"  ><i class="fa fa-plus"></i> SUBITEM</button></a>-->

			</div>

		 </div>

		 </br>

    <div class="row">

		 <div class="col-md-12">

	

			<table class="table table-striped table-hover fill-head">

			<thead>

			<tr>

			<th style="width:10%">Code</th>



			<th style="width:10%">Description</th>



			<th style="width:10%">Unit</th>



			<th style="width:10%">Class</th>



			<th style="width:10%">Rate</th>

			<th style="width:10%">Heading</th>

			<th style="width:10%">Notes</th>



			

			</tr>

			</thead>

				<?php if(isset($subitem_id)){?>

			        	<tbody id="dataTable">

				

			<tr>

				 <input type="hidden" name="subitem_id" id="subitem_id" value="<?=isset($subitem_id)?$subitem_id:''?>"/>

			<td>

			

			  <input type="text" name="subitem_name" id="subitem_name" value="<?=isset($subitem_name)?$subitem_name:''?>" class="form-control" data-rule-required="true">

			
			</td>

			<td>

			
				 <textarea class="form-control" rows="1" id="subitem_desc" name="subitem_desc" ><?=isset($subitem_desc)?$subitem_desc:''?></textarea>

				  

			 </td>

			<td>

			           <select class="form-control" name="unit_code" id="unit_code" tabindex="1" data-rule-required="true" >

						<option  value="">Select Unit</option>

					  <?php foreach($unit_list as $ul){ ?>

						 <option value="<?=$ul->unit_code?>" <?=($unit_code==$ul->unit_code)?'selected':''?>><?=$ul->unit_code?></option>

						 <!--<?//=$ul->unit_desc?>-->

						 <?php } ?>

					  </select>

					  <span for="select" class="help-block">This field is required.</span>


			</td>

				<td>

		 <select class="form-control" name="subitem_class_id" id="subitem_class_id" tabindex="1"  >

					   <!--data-rule-required="true" Commented-->

						<option  value="">Select Class</option>

					  <?php foreach($item_cls_list as $cl){ ?>

						 <option value="<?=$cl->id?>" <?=($subitem_class_id==$cl->id)?'selected':''?>><?=$cl->class_name?></option>

						 

						 <?php } ?>

					  </select>

					  <span for="select" class="help-block">This field is required.</span>

			</td>

			<td>

			  <input type="text"  id="rate" name="rate" value="<?=isset($rate)?$rate:''?>" class="form-control"  >

			</td>

			<td>

			
			  <input type="text"  id="subitem_heading" name="subitem_heading" value="<?=isset($subitem_heading)?$subitem_heading:''?>" class="form-control"   >

			</td>

			<td>

			
			  <input type="text"  id="subitem_notes" name="subitem_notes" value="<?=isset($subitem_notes)?$subitem_notes:''?>" class="form-control"   >


			</td>

			</tr>

			</tbody>

			

			

			

			<?php }else {?>

			

			<?php foreach($item_cls_list as $cl){ ?>

			<tbody id="dataTable">

				

			<tr>

			<td>

			
			  <input type="text" name="subitem_name[]" id="subitem_name"  class="form-control" data-rule-required="true">

			  <span for="name" class="help-block"></span>

			</td>

			<td>

			
				 <textarea class="form-control" rows="1" id="subitem_desc" name="subitem_desc[]"  ></textarea>

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

			       <select class="form-control" name="subitem_class_id[]" id="subitem_class_id" tabindex="1"  >

					   <!--data-rule-required="true" Commented-->

						<option  value="">Select Class</option>

					  <?php foreach($item_cls_list as $cl){ ?>

						 <option value="<?=$cl->id?>" ><?=$cl->class_name?></option>

						 

						 <?php } ?>

					  </select>

					  <span for="select" class="help-block">This field is required.</span>

			 
			</td>

			<td>

			  <input type="text"  id="rate" name="rate[]"  class="form-control" readonly  >

			
			</td>

			<td>

		  <input type="text"  id="subitem_heading" name="subitem_heading[]"  class="form-control"   >

			

			</td>

			<td>
	  <input type="text"  id="subitem_notes" name="subitem_notes[]"  class="form-control"   >

			

				</td>

			</tr>

			</tbody>

			<?php }} ?>

		</table>

	


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

