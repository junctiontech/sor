 <?php// print_r($namehome);die;?> <div id="main-content" >
	<div class="page-title">
	<div>
	<h1><i class="fa fa-keyboard-o"></i><?php if(isset($namehome)==1){echo $namehome[124]->text;}else{echo "Role Management";}?> </h1>
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
	<?php } ?>
  <div class="row-fluid">
                    <div class="span12">
                        <div class="box">
                            <div class="box-title">
                                <h3><i class="icon-table"></i><?php if(isset($namehome)==1){echo $namehome[124]->text;}else{echo "Role Management";}?></h3>
                               
                            </div>
                            <div class="box-content">
							<div class="btn-toolbar pull-right">
                                    <div class="btn-group">
                                        <a class="btn btn-primary show-tooltip" title="" href="<?php echo base_url(); ?>index.php/role/add_role" data-original-title="Add "><?php if(isset($namehome)==1){echo $namehome[109]->text;}else{echo "Add";}?></a>
                                    </div>
                                 </div>
								 <br>
								 	 <br>
                                <table class="table table-striped table-hover fill-head">
                                    <thead>
                                        <tr>
                                            <th><?php if(isset($namehome)==1){echo $namehome[125]->text;}else{echo "Users";}?></th>
										    <th><?php if(isset($namehome)==1){echo $namehome[36]->text;}else{echo "Action";}?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php foreach($list_permsn as $role){ ?>
                                        <tr>
                                            
                                            <td><?=$role->role_id;?></td>
											<td>
                                               <div class="btn-group">
														<a class="btn btn-small btn-primary show-tooltip" title="Permissions" href="<?php echo base_url(); ?>index.php/role/role_permission/<?=$role->role_id;?>"><i class="fa fa-foursquare"></i><?php if(isset($namehome)==1){echo $namehome[130]->text;}else{echo "Permissions";}?> </a>
												</div>
                                               
                                            </td>
                                        </tr>
									<?php } ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
				</div>