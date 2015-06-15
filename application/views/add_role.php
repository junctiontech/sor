 <div id="main-content" >
	<div class="page-title">
	<div>
	<h1><i class="fa fa-keyboard-o"></i> Add Role</h1>
	</div>
	</div>


	<div id="breadcrumbs">
	<ul class="breadcrumb">
	<li class="active"> <i class="fa fa-home"></i><?php echo($this->breadcrumb->output());?> </li>

	</ul>
	</div>
	    <!-- BEGIN Main Content -->
                <div class="row-fluid">
                    <div class="span12">
                        <div class="box">
                            <div class="box-title">
                                <h3><i class="icon-table"></i> Add Role</h3>
                               
                            </div>
                            <div class="box-content">
						<form action="<?php echo base_url(); ?>index.php/role/insert_role" method="POST">
								   <div class="control-group">
                                       <!-- <label class="control-label">User Name</label>-->
                                        <div class="controls">
                                         	<input type="text" placeholder="Role Name" name="role" class="form-control" />
                                        </div>
                                    </div>
									</br>
									</br>
								    <table class="table table-striped table-bordered ">
										<thead>
											<tr>
												<th>Functions</th>
												<th>Read</th>
												<th>Execute</th>
											</tr>
										</thead>
										<tbody>
											<tr>
											<?php foreach($list_function as $list){
												?>
												<input type="hidden" readonly name="edit_costing" id="edit_costing" value="1" />
												<td>
													<input type="checkbox" id="<?=$list->function_id?>" value="<?php echo $list->function_id; ?>" checked name="function[]" /><?php echo $list->function_id; ?>
												</td>
												
												<td>
												 <div class="controls">
													 <label class="checkbox">
													 <input type="hidden" name="read[]" value="0"><input type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value">
											
													 </label>
												 </div>
												</td>
												<td>
												 <div class="controls">
													 <label class="checkbox">
													 <input type="hidden" name="execute[]" value="0"><input type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value">
														<!--<input type="hidden" id="<?=$list->function_id?>_execute" value="0" name="execute[]" />-->
														<!--<input type="checkbox" id="<?=$list->function_id?>_execute" value="1" name="execute[]" />--> 
													 </label>
												 </div>
												</td>
											</tr>
											<?php } ?>
											
										</tbody>
									</table>
								</br>
								   <div class="form-actions">
                                      <button type="submit" class="btn btn-primary">Submit</button>
                                      <button type="button" class="btn">Cancel</button>
                                   </div>
							</form>
                               
                            </div>
                        </div>
                    </div>
					</div>
		




