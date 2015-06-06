<!--header starts added by palak on 13 jan -->
<?php // print_r($this->uri->segment(3)); die; ?>
<div id="main-content">
<div class="page-title">
<div>
<h1><i class="fa fa-plus"></i> <?=(isset($chap_id))?"Edit":"Add"?> Chapter</h1>
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
      	<h3><i class="fa fa-plus"></i> <?=(isset($chap_id))?"Edit":"Add"?> Chapter</h3>
		
       </div>
      <div class="box-content">
      <form  action="<?=base_url()?>index.php/home/manage_chapter" method="post" class="form-horizontal form-row-separated" novalidate="novalidate" id="validation-form">
       
       <div class="form-group">
           <label class="control-label">Department</label>
            <div class="controls">
              <select class="form-control" name="dep_id" id="dep_id" tabindex="1" data-rule-required="true">
                  
			    <option  value="">Select Department</option>
			  <?php foreach($dep as $d){?>
                
                 <option value="<?=$d->dep_id?>" <?=($this->uri->segment(3)==$d->dep_id)?'selected':''?>><?=$d->dep_name?></option>
				 <?php } ?>
              </select>
              <span for="select" class="help-block">This field is required.</span>
            </div>
    	</div>
      
      
      <div class="form-group">
      <label for="textfield3" class="control-label">Name</label>
      <div class="controls">
      <input type="text" name="chap_name" id="chap_name" placeholder="Enter Name" value="<?=isset($chap_name)?$chap_name:''?>" class="form-control" data-rule-required="true">
      </div>
      </div>
           
      <div class="form-group">
      <label for="textarea3" class="control-label">Description</label>
      <div class="controls">
      <textarea name="chap_desc" id="chap_desc" rows="5" class="form-control" data-rule-required="true"><?=isset($chap_desc)?$chap_desc:''?></textarea>
      </div>
      </div>
     
     <div class="form-group">
      <label for="textfield3" class="control-label">Heading</label>
      <div class="controls">
      <input type="text" name="chap_heading" id="chap_heading" placeholder="Enter Heading" value="<?=isset($chap_heading)?$chap_heading:''?>" class="form-control" data-rule-required="true">
      </div>
      </div>
        
      
      <div class="form-group">
      <label for="textfield3" class="control-label">Notes</label>
      <div class=" controls">
      <input type="text" name="chap_notes" id="chap_notes" placeholder="Enter Notes" value="<?=isset($chap_notes)?$chap_notes:''?>" class="form-control" data-rule-required="true">
      </div>
      </div>  
      
      <div class="form-group last">
      <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
	   <button type="button" class="btn" onClick="window.history.back();">Cancel</button>
	  <input type="hidden" name="id" id="id" value="<?=isset($chap_id)?$chap_id:''?>"/>
         <input  type="submit" name="submit" value="Save" class="btn btn-primary"/>   
        
      </div>
      </div>
       </form>
      </div>
      </div>
  </div>
</div>
<!--Content ends added by palak on 13 jan -->
