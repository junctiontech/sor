<?php foreach($permissions as $per ){
$a=$per->role_id;
}

?>
?>
<div id="main-content" >
	<div class="page-title">
	<div>
	<h1><i class="fa fa-keyboard-o"></i><?php if(isset($namehome)==1){echo $namehome[131]->text;}else{echo "Role Permissions";}?> </h1>
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
                                <h3><i class="icon-table"></i><?php if(isset($namehome)==1){echo $namehome[131]->text;}else{echo "Role Permissions";}?> </h3>
                               
                            </div>
                            <div class="box-content">
								<form action="<?=base_url();?>index.php/role/update_role_permission/<?=$a;?>" method="POST">
									<table class="table table-striped table-bordered ">
										<thead>
											<tr>
												
												<th><?php if(isset($namehome)==1){echo $namehome[127]->text;}else{echo "Functions";}?></th>
												<th><?php if(isset($namehome)==1){echo $namehome[128]->text;}else{echo "Read";}?></th>
												<th><?php if(isset($namehome)==1){echo $namehome[129]->text;}else{echo "Execute";}?></th>
											</tr>
										</thead>
										<tbody>
										<?php foreach ($functions_list as $function){ ?>
												
												
											<tr>
												<input type="hidden" readonly name="role" value="<?=$a;?>"/>
												<input type="hidden" readonly name="role_permsn" value="1" />
											<td>
													<input type="checkbox" checked id="<?=$function->function_id?>" value="<?php echo $function->function_id; ?>" name="function[]" />
													<?=$function->function_id?>
												</td>
												<td>
												 <div class="controls">
													 <label class="checkbox">
														 <input type="hidden" name="read[]"  <?php foreach($permissions as $perm){ if($function->function_id==$perm->function_id && $perm->auth_read==1){ ?> value="<?=$perm->auth_read;?>" <?php } elseif( $function->function_id==$perm->function_id && $perm->auth_read==0) { ?> value="<?=$perm->auth_read;?>" <?php } }?> /><input type="checkbox"  onclick="this.previousSibling.value=1-this.previousSibling.value" <?php foreach($permissions as $perm){ if($function->function_id==$perm->function_id){ ?><?=(!empty($perm->auth_read) && $perm->auth_read==1)?'checked':'' ?> <?php } }?> /> 
													 </label>
												 </div>
												</td>
												<td>
												 <div class="controls">
													 <label class="checkbox">
													 
														<input type="hidden"  name="execute[]"  <?php foreach($permissions as $perm){ if($function->function_id==$perm->function_id && $perm->auth_execute==1){ ?> value="<?=$perm->auth_execute?>" <?php } elseif ($function->function_id==$perm->function_id && $perm->auth_execute==0) { ?> value="<?=$perm->auth_execute?>" <?php }   } ?> /><input type="checkbox"  onclick="this.previousSibling.value=1-this.previousSibling.value"  <?php foreach($permissions as $perm){ if($function->function_id==$perm->function_id){ ?><?=(!empty($perm->auth_execute) && $perm->auth_execute==1)?'checked':'' ?>  <?php } }?> /> 
													  
													 </label>
												 </div>
												</td>
											</tr>
											
											<?php  } ?>
											 
												
										</tbody>
									</table>
									   </br>
									   <div class="form-actions">
										  <button type="submit" class="btn btn-primary"><?php if(isset($namehome)==1){echo $namehome[123]->text;}else{echo "Submit";}?></button>
										  <button type="button" class="btn"><?php if(isset($namehome)==1){echo $namehome[13]->text;}else{echo "Cancel";}?></button>
									   </div>
								</form>
                            </div>
                        </div>
                    </div>
				</div>