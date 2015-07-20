 <div id="main-content" >
	<div class="page-title">
	<div>
	<h1><i class="fa fa-keyboard-o"></i><?php if(isset($namehome)==1){echo $namehome[115]->text;}else{echo "User Management";}?> </h1>
	</div>
	</div>


	<div id="breadcrumbs">
	<ul class="breadcrumb">
	<li class="active"> <i class="fa fa-home"></i><?php echo($this->breadcrumb->output());?> </li>

	</ul>
	</div>
	<?php  if($this->session->flashdata('category_error')) { ?>
								<div class="form-group">
									<div class="alert alert-danger">
			
									<strong><?=$this->session->flashdata('message')?></strong> 
									</div>
									</div>
							<?php }?>
					
					<?php  if($this->session->flashdata('message_type')) { ?>
								<div class="form-group">
									<div class="alert alert-danger">
			
									<strong><?=$this->session->flashdata('message')?></strong> 
									</div>
									</div>
							<?php }?>
					<?php  if($this->session->flashdata('category_success')) {  ?>
									<div class="form-group">
										<div class="alert alert-success">
										<a href="javascript:;" class="goto-register"><strong><?=$this->session->flashdata('message')?></strong></a>
	
										</div>
										</div>
								<?php }?> 
	   <div class="row-fluid">
                    <div class="span12">
                        <div class="box">
                            <div class="box-title">
                                <h3><i class="icon-reorder"></i><?php if(isset($namehome)==1){echo $namehome[115]->text;}else{echo "User Management";}?> </h3>
                            </div>
							 <div class="box-content">
                                <form method="POST" action="<?=base_url();?>index.php/role/user_add" class="form-horizontal">
								   <div class="control-group">
                                        <label class="control-label"><?php if(isset($namehome)==1){echo $namehome[120]->text;}else{echo "Email";}?></label>
                                        <div class="controls" for="usermailid">
											<input type="text" name="usermailid" placeholder="Email" class="form-control" data-rule-required="true"  data-rule-email="true">
                                        </div>
                                    </div>
									<div class="control-group">
										<label class="control-label"><?php if(isset($namehome)==1){echo $namehome[121]->text;}else{echo "Role";}?></label>
                                      <div class="controls">
                                        <select class="span6 chosen" name="role" data-placeholder="Choose a Category" tabindex="1" data-rule-required="true">
												<option value=""> </option>
												<?php  foreach($role_list as $lists){ ?>
													<option value="<?=$lists->role_id?>" ><?=$lists->role_id; ?></option>
												<?php } ?>
										</select>
                                      </div>
                                   </div>
								    <div class="control-group">
                                        <label class="control-label"><?php if(isset($namehome)==1){echo $namehome[122]->text;}else{echo "Password";}?></label>
                                        <div class="controls" for="password">
                                         <input type="password" placeholder="Password" name="password" class="form-control" data-rule-required="true">
                                             </div>
                                    </div>
								   <div class="form-actions">
                                      <button type="submit" class="btn btn-primary"><?php if(isset($namehome)==1){echo $namehome[123]->text;}else{echo "Submit";}?></button>
                                      <button type="button" class="btn"><?php if(isset($namehome)==1){echo $namehome[13]->text;}else{echo "Cancel";}?></button>
                                   </div>
								</form>
							</div>	
						 </div>
                    </div>
		</div>