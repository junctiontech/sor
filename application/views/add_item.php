<!--header starts added by palak on 13 jan -->
<?php $user_session_data = $this->session->userdata('user_data');?>
<div id="main-content">
<div class="page-title">
<div>
<h1><i class="fa fa-plus"></i> <?=(isset($item_id))?"Edit":"Add"?> <?php if(isset($namehome)==1){ echo $namehome[78]->text;  }else{echo"Item";}?> </h1>
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
      	
		<h3><i class="fa fa-plus"></i> <?=(isset($item_id))?"Edit":"Add"?> <?php if(isset($namehome)==1){ echo $namehome[78]->text;  }else{echo"Items";}?> </h3>
       </div>
      <div class="box-content">
     <form action="<?=base_url()?>index.php/home/add_item" method="post" class="form-horizontal form-row-separated" novalidate="novalidate" id="validation-form">
     <div class="form-group">
           <label class="control-label"><?php if(isset($namehome)==1){ echo $namehome[19]->text;  }else{echo"Department";}?></label>
            <div class="controls">
              <select class="form-control" name="dep_id" id="dep_id" tabindex="1" data-rule-required="true" onChange="show_chapter(this.value,0)">
			    <option  value="">Select Department</option>
			  <?php foreach($dep as $d){ ?>
                 <option value="<?=$d->dep_id?>" <?=($this->uri->segment(3)==$d->dep_id)?'selected':''?>><?=$d->dep_name?></option>
                 
				 <?php } ?>
              </select>
            </div>
    	</div>
        
        <div class="form-group">
           <label class="control-label"><?php if(isset($namehome)==1){ echo $namehome[108]->text;  }else{echo"Chapter";}?></label>
            <div class="controls"  id="show_chap" >
               <select name="chap_id" id="chap_id" class="form-control" data-rule-required="true">
				<option value=''>Chapter</option>
				 <?php foreach($chap as $c){ ?>
                 <option value="<?=$c->chap_id?>" <?=($this->uri->segment(4)==$c->chap_id)?'selected':''?>><?=$c->chap_name?></option>
                 
				 <?php } ?>
			  </select>
            </div>
    	</div>
		
		<!--Class div added-->
									<div class="form-group">
                                      <label class="control-label"><?php if(isset($namehome)==1){ echo $namehome[25]->text;  }else{echo"Class";}?></label>
                                      <div class="controls">
                                          <div class="controls">
                                         <select class="col-md-12" name="item_class_id[]" id="item_class_id" multiple="multiple" data-rule-required="true" data-placeholder="Choose a Category">
                                          
                                            <?php $class_list= $this->utilities->class_list();?>
												<option  value="">Select Class</option>
												  <?php foreach($class_list as $lc){ ?>
												 <option value="<?=$lc->id?>"<?=($item_class_id==$lc->id)?'selected':''?>><?=$lc->class_name?></option>
												 
												 
											<?php } ?>
                                         </select>
                                      </div>
                                      </div>
                                   </div>
     
      <div class="form-group">
      <label for="textfield3" class=" control-label"><?php if(isset($namehome)==1){ echo $namehome[26]->text;  }else{echo"Code";}?></label>
      <div class="controls">
      <input type="text" name="item_name" id="item_name" data-rule-required="true" value="<?=isset($item_name)?$item_name:''?>" placeholder="Enter Name" class="form-control">
      </div>
      </div>
           
      <div class="form-group">
      <label for="textarea3" class="control-label"><?php if(isset($namehome)==1){ echo $namehome[10]->text;  }else{echo"Description";}?></label>
      <div class="controls">
      <textarea name="item_desc" id="item_desc" data-rule-required="true" rows="5" class="form-control"><?=isset($item_desc)?$item_desc:''?></textarea>
      </div>
      </div>
      
     <!--<div class="form-group">
      <label for="textfield3" class="col-sm-3 col-lg-2 control-label">Item Quanity</label>
      <div class="col-sm-9 col-lg-10 controls">
      <input type="text" name="item_qty_base" id="item_qty_base" data-rule-required="true" value="<?=isset($item_qty_base)?$item_qty_base:''?>" placeholder="Enter Quanity" class="form-control">
      </div>
      </div>-->
        
				<!--<div class="form-group">
                                      <label class="col-sm-3 col-lg-2 control-label">Item Unit</label>
                                      <div class="col-sm-9 col-lg-10 controls">
                                          <div class="controls">
                                         <select class="col-md-12" name="unit" id="unit"  data-placeholder="Choose a Unit" >
                                          
                                            <?php $unitlist= $this->utilities->unit_list();?>

												<option  value="">Select Unit</option>

												  <?php foreach($unitlist as $uu){ ?>

												 <option value="<?=$uu->unit_code?>" <?=($unit==$uu->unit_code)?'selected':''?>><?=$uu->unit_desc?></option>

												 

												 <?php } ?>
                                         </select>
                                      </div>
                                      </div>
                                   </div>-->
		
		
		
		
       <!-- <div class="form-group">
      <label for="textfield3" class="col-sm-3 col-lg-2 control-label">Item Cost Total</label>
      <div class="col-sm-9 col-lg-10 controls">
      <input type="text" name="item_cost_total" id="item_cost_total"  value="<?=isset($item_cost_total)?$item_cost_total:''?>" readonly placeholder="Item Cost Total" class="form-control">
      </div>
      </div>
       <div class="form-group">
      <label for="textfield3" class="col-sm-3 col-lg-2 control-label">Item Cost Per Unit</label>
      <div class="col-sm-9 col-lg-10 controls">
      <input type="text" name="item_cost_per_unit" id="item_cost_per_unit"  value="<?=isset($item_cost_per_unit)?$item_cost_per_unit:''?>" readonly placeholder="Item Cost Per Unit" class="form-control">
      </div>
      </div>-->
        <div class="form-group">
      <label for="textfield3" class="control-label"><?php if(isset($namehome)==1){ echo $namehome[27]->text;  }else{echo"Item Heading";}?></label>
      <div class="controls">
      <input type="text" name="item_heading" id="item_heading"  value="<?=isset($item_heading)?$item_heading:''?>" placeholder="Item Heading" class="form-control">
      </div>
      </div>
        <div class="form-group">
      <label for="textfield3" class="control-label"><?php if(isset($namehome)==1){ echo $namehome[28]->text;  }else{echo"item Notes";}?></label>
      <div class="controls">
      <input type="text" name="item_notes" id="item_notes"  value="<?=isset($item_notes)?$item_notes:''?>" placeholder="item Notes" class="form-control">
      </div>
      </div>
      <div class="form-group last">
      <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
        <button type="button" class="btn" onClick="window.history.back();"><?php if(isset($namehome)==1){ echo $namehome[13]->text;  }else{echo"Cancel";}?></button>
       <input type="hidden" name="id" id="id" value="<?=isset($item_id)?$item_id:''?>"/>

        <input  type="submit" name="submit" value="<?php if(isset($namehome)==1){ echo $namehome[14]->text;  }else{echo"Save changes";}?>" class="btn btn-primary"/>   
      </div>
      </div>
       </form>
      </div>
      </div>
  </div>
</div>
<!--Content ends added by palak on 13 jan -->