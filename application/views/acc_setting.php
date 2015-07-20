<?php error_reporting(0);?>
<div id="main-content">
	<div class="page-title">
		<div>
		<h1><i class="fa fa-cog"></i><?php if(isset($namehome)==1){echo $namehome[150]->text;}else{echo "Account Settings";}?> </h1>
		</div>
	</div>
	<div id="breadcrumbs">
		<ul class="breadcrumb">
		<li class="active"><?php echo($this->breadcrumb->output());?> </li>
		</ul>
	</div>
   <!-- BEGIN Main Content -->
                <div class="row-fluid">
                    <div class="span12">
					  <div class="box">
					  	<?php if($this->session->flashdata('message_type')) { ?>
								<div class="form-group">
									<div class="alert alert-success">
			
									<strong><?=$this->session->flashdata('message')?></strong> 
									</div>
									</div>
							<?php  }?>	
                            <div class="box-title">
                                <h3><i class="icon-folder-close"></i><?php if(isset($namehome)==1){echo $namehome[150]->text;}else{echo "Account Settings";}?></h3>
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab-1-1" data-toggle="tab"><?php if(isset($namehome)==1){echo $namehome[151]->text;}else{echo "User Profile";}?></a></li>
                                    <li><a href="#tab-1-2" data-toggle="tab"><?php if(isset($namehome)==1){echo $namehome[152]->text;}else{echo "Settings";}?></a></li>
                                </ul>
                            </div>
							
                            <div class="box-content">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-1-1">
                                   <form action="<?=base_url();?>index.php/home/insertdatamy" class="form-horizontal" id="validation-form" method="post" enctype="multipart/form-data">
										   <div class="control-group">
											  <label class="control-label"><?php if(isset($namehome)==1){echo $namehome[153]->text;}else{echo "User Name";}?></label>
											  <div class="controls">
												 <input type="text" class="span6" name="name" data-rule-required="true" value="<?=$abc['name']?>" class="form-control"/>

												 <span class="help-inline"><?php if(isset($namehome)==1){echo $namehome[154]->text;}else{echo "Enter Your User Name";}?></span>

											  </div>

										   </div>
										   
										        <div class="control-group">
                                      <label class="control-label"><?php if(isset($namehome)==1){echo $namehome[155]->text;}else{echo "Image Upload";}?></label>
                                      <div class="controls">
                                         <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                               <img src="img/<?=$abc['image']?>" >
                                            </div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                            <div>

                                               <span class="btn btn-file"><span class="fileupload-new" data-rule-required="true"><?php if(isset($namehome)==1){echo $namehome[156]->text;}else{echo "Select Image";}?></span>
                                               <span class="fileupload-exists"><?php if(isset($namehome)==1){echo $namehome[157]->text;}else{echo "Change";}?></span>

                                               <input type="file" class="default" name="image" id="image"/></span>
                                               <a href="#" class="btn fileupload-exists" data-dismiss="fileupload"><?php if(isset($namehome)==1){echo $namehome[158]->text;}else{echo "Remove";}?></a>
                                            </div>
                                         </div>
                                         <span class="label label-important"><?php if(isset($namehome)==1){echo $namehome[159]->text;}else{echo "NOTE!";}?></span>
                                         <span>
                                       <?php if(isset($namehome)==1){echo $namehome[160]->text;}else{echo "Only Attach Image";}?> 
                                         </span>
                                      </div>
                                   </div>
								      <div class="control-group">
                                        <label class="control-label"><?php if(isset($namehome)==1){echo $namehome[161]->text;}else{echo "Phone";}?></label>
                                        <div class="controls">
                                            <input type="text" data-mask="(999) 999-9999" name="phone_number" value="<?=$abc['phone_number']?>">
                                           
                                        </div>
                                    </div>
									   <div class="control-group">
                                        <label class="control-label"><?php if(isset($namehome)==1){echo $namehome[162]->text;}else{echo "Mobile No";}?></label>
                                        <div class="controls">
                                            <input type="text" data-mask="(999) 999-9999" name="mobile" value="<?=$abc['mobile']?>" data-rule-required="true">                                        </div>
                                    </div>
									   <div class="control-group">
                                      <label class="control-label"><?php if(isset($namehome)==1){echo $namehome[163]->text;}else{echo "Address";}?></label>
                                      <div class="controls">
                                         <textarea class="span6" rows="3" name="address" id="address" ><?=$abc['address']?> </textarea>
                                       
									  </div>
                                   </div>
								      <div class="form-actions">
                                        <input type="submit" class="btn btn-primary" value="<?php if(isset($namehome)==1){ echo $namehome[123]->text;  }else{echo"Submit";}?>" name="submit">
                                        <button type="button" class="btn"><?php if(isset($namehome)==1){echo $namehome[13]->text;}else{echo "Cancel";}?></button>
                                    </div>
										</form>
                                    </div>
                                    <div class="tab-pane" id="tab-1-2">
                                        <form action="<?=base_url();?>index.php/Home/change_pass" class="form-horizontal" id="validation-form" method="post">
                                  <div class="control-group">
                                        <label class="control-label" for="password"><?php if(isset($namehome)==1){echo $namehome[122]->text;}else{echo "Password";}?>:</label>
                                        <div class="controls">
                                            <div class="span12">
                                                <input type="password" name="password" id="password" class="input-xlarge" data-rule-required="true" data-rule-minlength="6" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="confirm-password"><?php if(isset($namehome)==1){echo $namehome[164]->text;}else{echo "Confirm Password";}?>:</label>
                                        <div class="controls">
                                            <div class="span12">
                                                <input type="password" name="confirm-password" id="confirm-password" class="input-xlarge" data-rule-required="true" data-rule-minlength="6" data-rule-equalTo="#password" />
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="form-actions">
                                        <input type="submit" class="btn btn-primary" value="<?php if(isset($namehome)==1){ echo $namehome[123]->text;  }else{echo"Submit";}?>">
                                        <button type="button" class="btn"><?php if(isset($namehome)==1){echo $namehome[13]->text;}else{echo "Cancel";}?></button>
                                    </div>
                                </form>
                                    </div>
                                </div>
                            </div>
                        </div>
						</div>
                </div>
                <!-- END Main Content -->
