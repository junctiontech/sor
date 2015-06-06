 <div id="main-content" >
	<div class="page-title">
	<div>
	<h1><i class="fa fa-keyboard-o"></i> Role Permissions</h1>
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
                                <h3><i class="icon-table"></i> Role Permissions</h3>
                               
                            </div>
                            <div class="box-content">
								<form action="" method="POST">
									<table class="table table-striped table-bordered "id="table1">
										<thead>
											<tr>
												
												<th>Functions</th>
												<th>Read</th>
												<th>Execute</th>
											</tr>
										</thead>
										<tbody>
												<?php foreach($permissions as $perm){ ?>
											<tr>
												
												<td><?=$perm->function_id?></td>
												<td>
												 <div class="controls">
													 <label class="checkbox">
														<input type="checkbox" value="1" <?=(!empty($perm->auth_read) && $perm->auth_read==1)?'checked':'' ?> name="read" /> 
													 </label>
												 </div>
												</td>
												<td>
												 <div class="controls">
													 <label class="checkbox">
														<input type="checkbox" value="1" <?=(!empty($perm->execute) && $perm->execute==1)?'checked':'' ?> name="execute"/> 
													 </label>
												 </div>
												</td>
											</tr>
											<?php } ?>
											 
												</td>
											</tr>
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