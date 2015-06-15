<div id="main-content" >
	<div class="page-title">
		<div>
			<h1><i class="fa fa-keyboard-o"></i> User Management</h1>
		</div>
	</div>


	<div id="breadcrumbs">
		<ul class="breadcrumb">
			<li class="active"> <i class="fa fa-home"></i><?php echo($this->breadcrumb->output());?> </li>
		</ul>
	</div>
	
	<?php  if($this->session->flashdata('message')) { ?>
								<div class="row-fluid">
									<div class="alert alert-success">
										<strong><?=$this->session->flashdata('message')?></strong> 
									</div>
								</div>
	<?php }?>
  <!-- <div class="row-fluid">
                  <div class="span12">
                        <div class="box">
                            <div class="box-title">
                                <h3><i class="icon-table"></i> Users Approval</h3>
                                <div class="box-tool">
                                    <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
                                    <a data-action="close" href="#"><i class="icon-remove"></i></a>
                                </div>
                            </div>
                            <div class="box-content">
								<form method="POST" action="">
									<table class="table table-striped table-hover fill-head">
										<thead>
											<tr>
												<th>#</th>
												<th>Email</th>
												<th>Role</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($user_list as $list) {?>
											<tr>
												<td><?php echo $list->user_id ?></td>
												<td><?php echo $list->usermailid ?></td>
												<td><?php echo $list->user_role ?></td>
												<td>
													<div class="btn-group">
															<a class="btn btn-small show-tooltip" title="Accept" href="<?=base_url();?>index.php/role/verify/<?=$list->user_id?>/<?=$info=1?>"><i class="fa fa-check"></i></a>
													
															<a class="btn btn-small btn-danger show-tooltip" title="Reject" href="<?=base_url();?>index.php/role/verify/<?=$list->user_id;?>/<?=$info=2?>"><i class="fa fa-times"></i></a>
													</div>
												</td>
											</tr>
											<?php } ?>
											
										</tbody>
									</table>
								</form>	
                            </div>
                        </div>
                    </div>
                </div>-->
				  <div class="row-fluid">
                    <div class="span12">
                        <div class="box">
                            <div class="box-title">
                                <h3><i class="icon-table"></i> Assign Role </h3>
                                <div class="box-tool">
                                    <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
                                    <a data-action="close" href="#"><i class="icon-remove"></i></a>
                                </div>
                            </div>
                            <div class="box-content">
							<div class="btn-toolbar pull-right">
                                    <div class="btn-group">
                                        <a class="btn btn-primary show-tooltip" title="" href="<?php echo base_url(); ?>index.php/role/manage_users" data-original-title="Add "><i class="fa fa-plus"></i> Add User</a>
                                    </div>
                            </div>
								 <br>
								 	 <br>
                                <table class="table table-striped table-hover fill-head">
									<thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Email</th>
											<th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php foreach($verify_list as $list){ ?>
										<tr>
											<form method="POST" action="<?=base_url();?>index.php/role/role_assign/<?=$list->user_id?>" >
													<td><?=$list->user_id;?></td>
													<td><?=$list->usermailid;?></td>
													<td>
														<div class="control-group">
														  <div class="controls">
															<select required class="span6 chosen" data-placeholder="Choose a Role" name="role" tabindex="1" required>
																<option value=""> </option>
															<?php  foreach($role_list as $lists){ ?>
																<option value="<?=$lists->role_id?>"<?=(!empty($list->role_id) && $list->role_id==$lists->role_id)?'selected':'' ?> ><?=$lists->role_id; ?></option>
																<?php } ?>
															</select>
														  </div>
													   </div>
													</td>
													<td>
													   <div class="btn-group">
															<button class="btn btn-small show-tooltip" type="submit"  title="edit" ><i class="fa fa-check"></i>   Assign</button>
															<a class="btn btn-small btn-danger show-tooltip" title="Delete" onClick="return confirm('Are you sure to delete this user? This will delete all the related records on this user as well.')" href="<?=base_url()?>index.php/role/delete_user/<?=$list->user_id?>"><i class="fa fa-times"></i> Delete</a>
															<a class="btn btn-small btn-primary show-tooltip"  title="Block/Unblock" href="<?=base_url()?>index.php/role/blocked_user/<?=$list->user_id?>"><i class="fa fa-ban"></i> Block</a>
													   </div>
													</td>
											</form>
										</tr>
									<?php } ?>
									</tbody>
								</table>
                            </div>
                        </div>
                    </div>
                </div>
