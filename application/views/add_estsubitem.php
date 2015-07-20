<!--header starts added by palak on 13 jan of create sub item page -->
<div id="main-content">

	<div class="page-title">

<div>

<h1><i class="fa fa-plus"></i> <?=(isset($id))?"Edit":"Add"?> <?php if(isset($namehome)==1){echo $namehome[107]->text;}else{echo "Estimation Subitems";}?> </h1>

</div>

</div>

<div id="breadcrumbs">

<ul class="breadcrumb">



<li class="active"> <i class="fa fa-home"></i><?php echo($this->breadcrumb->output());?> </li>

</ul>

</div>

<!--header end added by palak on 13 jan --> 
  <div class="row-fluid">
                    <div class="span12">
                        <div class="box">
                            <div class="box-title">
                                <h3><i class="icon-reorder"></i> <?php if(isset($namehome)==1){echo $namehome[107]->text;}else{echo "Add Estimation Subitems";}?> </h3>
                            </div>
                            <div class="box-content">
                                <form action="index.php/estimation_controller/add_estsubitem_submit/<?=$select?>/<?=$est_id?>" method="post"class="form-horizontal form-row-separated">
                                      <div class="control-group">
                                      <label class="control-label"><?php if(isset($namehome)==1){echo $namehome[10]->text;}else{echo "Department";}?></label>
                                      <div class="controls">
                                         <select onchange="if (this.selectedIndex) show_chapter(this.value,0);" class="span6 chosen" data-placeholder="Choose a Category" tabindex="1">
                                            <option value="" > </option>
											 <?php foreach($dep as $d){ ?>
                                            <option value="<?=$d->dep_id?>"><?=$d->dep_name?></option>
                                             <?php } ?>
                                         </select>
                                      </div>
                                   </div>
								      <div class="control-group" >
                                      <label class="control-label"><?php if(isset($namehome)==1){echo $namehome[108]->text;}else{echo "Chapter";}?></label>
                                      <div class="controls" id="show_chap">
									 
                                         <select  class="span6 chosen" onchange="if (this.selectedIndex) show_item(this.value,0);" data-placeholder="Choose a Category" tabindex="1">
										
                                            <option  value=""> </option>
                                            <?php foreach($chap as $c){ ?>
                 <option value="<?=$c->chap_id?>" <?=($this->uri->segment(4)==$c->chap_id)?'selected':''?>><?=$c->chap_name?></option>
                 
				 <?php } ?>
                                            
                                         </select>
                                      </div>
                                   </div>
								      <div class="control-group">
                                      <label class="control-label"><?php if(isset($namehome)==1){echo $namehome[78]->text;}else{echo "Item";}?></label>
                                      <div class="controls" id="show_item">
                                         <select class="span6 chosen" onchange="if (this.selectedIndex) show_sitem(this.value,0);" data-placeholder="Choose a Category" tabindex="1">
                                            <option value=""> </option>
                 
                                            
                                         </select>
                                      </div>
                                   </div>
								      <div class="control-group">
                                      <label class="control-label"><?php if(isset($namehome)==1){echo $namehome[30]->text;}else{echo "SubItem";}?></label>
                                      <div class="controls" id="show_subitem">
                                         <select class="span6 chosen" data-placeholder="Choose a Category" tabindex="1">
                                            <option value=""> </option>
                                            
                                            
                                         </select>
                                      </div>
                                   </div>
                                    <div class="form-actions">
                                       <button type="submit"  class="btn btn-primary"><i class="fa fa-check"></i><?php if(isset($namehome)==1){echo $namehome[109]->text;}else{echo "Add";}?> </button>
                                       <button type="button" onClick="window.history.back();" class="btn btn-default"><i class="fa fa-times"></i><?php if(isset($namehome)==1){echo $namehome[13]->text;}else{echo "Cancel";}?> </button>
                                    </div>
                                 </form>
                            </div>
                        </div>
                    </div>
                </div>
			