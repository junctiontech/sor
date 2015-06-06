<!--header starts added by palak on 13 jan for add department -->
<div id="main-content">
<div class="page-title">
<div>
<h1><i class="fa fa-plus"></i><?=(isset($dep_id))?"Edit":"Add"?> Department</h1>
</div>
</div>
<div id="breadcrumbs">
<ul class="breadcrumb">

<li class="active"> <i class="fa fa-home"></i><?php echo($this->breadcrumb->output());?></li>
</ul>
</div>
<!--header end added by palak on 13 jan -->
<!--Content starts added by palak on 13 jan -->
<div class="row">
  <div class="col-md-12">
      <div class="box box-blue">
      <div class="box-title">
      <h3><i class="fa fa-plus"></i> <?=(isset($dep_id))?"Edit":"Add"?> Department</h3>

       </div>
      <div class="box-content">
      <form action="<?=base_url()?>index.php/home/manage_department" method="post" class="form-horizontal form-row-separated" novalidate="novalidate" id="validation-form">

        <div class="form-group">
		  <label for="textarea3" class="control-label">Name</label>
			  <div class="controls">
			
			   <input type="text" name="dep_name" id="dep_name" value="<?=isset($dep_name)?$dep_name:''?>" class="col-md-12" data-rule-required="true"/>
			  </div>
      </div>
          
      <div class="form-group">
      <label for="textarea3" class="control-label">Description</label>
      <div class="controls">
      <textarea name="dep_desc" id="dep_desc" rows="2" class="form-control" data-rule-required="true"><?=isset($dep_desc)?$dep_desc:''?></textarea>
      </div>
      </div>
        
        <div class="form-group">
      <label for="textarea3" class=" control-label">Heading</label>
      <div class="controls">
    
       <input type="text" name="dep_heading" id="dep_heading" value="<?=isset($dep_heading)?$dep_heading:''?>" class="col-md-12"/>
      </div>
      </div>
      
       <div class="form-group">
      <label for="textarea3" class="control-label">Notes</label>
      <div class="controls">
    
       <input type="text" name="dep_notes" id="dep_notes" value="<?=isset($dep_notes)?$dep_notes:''?>" class="col-md-12"/>
      </div>
      </div> 
        
      <div class="form-group last">
      <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
         <button type="button" class="btn" onClick="window.history.back();">Cancel</button>
       
        <input type="hidden" name="id" id="id" value="<?=(!empty($dep_id))?$dep_id:''?>"/>
        <input  type="submit" name="submit" value="Save changes" class="btn btn-primary"/>   
      </div>
      </div>
       </form>
      </div>
      </div>
  </div>
</div>
<!--Content ends added by palak on 13 jan -->
