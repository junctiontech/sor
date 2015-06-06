<!--header starts added by palak on 16 jan of create sub item page -->
<div id="main-content">
<div class="page-title">
<div>
<h1><i class="fa fa-cog"></i> <?=(isset($id))?"Edit":"Manage"?> Subitem</h1>
</div>
</div>
<div id="breadcrumbs">
<ul class="breadcrumb">

<li class="active"> <i class="fa fa-home"></i><?php echo($this->breadcrumb->output());?> </li>
</ul>
</div>
<!--header end added by palak on 16 jan -->
<!--Content starts added by palak on 16 jan -->

<div class="row">
	    <div class="col-md-2 col-md-offset-10">
		
			<a href="<?=base_url()?>index.php/home/manage_subitem"><button class="btn btn-primary pull-right"  ><i class="fa fa-plus"></i> SUBITEM</button></a>
		</div>
	 </div>
	 </br>
<div class="row">
  <div class="col-md-12">
      <div class="box box-blue">
      <div class="box-title">
      	
		<h3><i class="fa fa-cog"></i> <?=(isset($id))?"Edit":"Manage"?>  Subitems</h3>
       </div>
      <div class="box-content">
     <form action="<?=base_url()?>home/add_subitem" method="post" class="form-horizontal form-row-separated" >
      
	<div class="row">
    <div class="col-md-5">
      <div class="form-group">
             <div class="col-sm-12 col-lg-10 controls">
              <select class="form-control" name="dep_id" id="dep_id" tabindex="1" onChange="show_chapter(this.value,0)">
			    <option  value="">Select Department</option>
			  <?php foreach($dep as $d){ ?>
                 <option value="<?=$d->dep_id?>" ><?=$d->dep_name?></option>
                 
				 <?php } ?>
              </select>
            </div>
    	</div>
      </div> 
		 <div class="col-md-4">
         <div class="form-group">
            <div class="col-sm-12 col-lg-10 controls"  id="show_chap" >
             <select name="chap_id" id="chap_id" class="form-control">
				<option value=''>Chapter</option>
			  </select>
            </div>
    	 </div>
		 </div>
		 <div class="col-md-3">
		 <div class="form-group">
             <div class="col-sm-12 col-lg-10 controls" id="show_item">
              <select name="item_id" id="item_id" class="form-control">
				<option value=''>Item</option>
			  </select>
            </div>
    	</div>
		</div>
		
       </form>
     </div>
	 <div class="row-fluid" id="show_subitem">
		 
	 </div>
  </div>
      </div>
  </div>
</div>
