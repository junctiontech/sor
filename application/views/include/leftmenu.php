<?php $user_session_data = $this->session->userdata('user_data');
			//$name=$user_session_data['language_id'];
			//print_r($name);die;
		//	$namehome = $this->data['namehome'] = $this->login_model->lang($name,'ssr_t_text');
			?>
			<div id="sidebar" class="navbar-collapse collapse">
<ul class="nav nav-list">
<!--<li>
<form  method="POST" action="<?php echo base_url(); ?>index.php/home/search_keyword"  class="search-form">
<span class="search-pan">
<button type="submit" name="submit">
<i class="fa fa-search"></i>
</button>
<input type="text" name="search" placeholder="Search ..." autocomplete="off" />
</span>
</form>
</li>-->
<li>
<a href="<?=base_url()?>index.php/home/search_keyword">
<i class="fa fa-search"></i>
<span><?php if(isset($namehome)==1){ echo $namehome[37]->text;   }else{echo"Search";}?></span>
</a>
</li>
<li class="active">
<a href="<?=base_url()?>index.php/home">
<i class="fa fa-dashboard"></i>
<span><?php if(isset($namehome)==1){ echo $namehome[38]->text; }else{echo"Dashboard";}?></span>
</a>
</li>

<li>
<a href="javascript:;" class="dropdown-toggle">
<i class="fa fa-cog"></i>
<span><?php if(isset($namehome)==1){ echo $namehome[39]->text;  }else{echo"Manage";}?></span>
<b class="arrow fa fa-angle-right"></b>
</a>
<ul class="submenu">
<!--<li><a href="<?=base_url()?>index.php/home"> Departments</a></li>-->
<!--<li><a href="<?=base_url()?>index.php/home/manage_chapter_list"> Chapters</a></li>-->
<!--<li><a href="<?=base_url()?>index.php/home/manage_item"> Items</a></li>-->
<!--<li><a href="<?=base_url()?>index.php/home/subitem_list"> Sub Items</a></li>-->
<li><a href="<?=base_url()?>index.php/masters/material"><?php if(isset($namehome)==1){ echo $namehome[44]->text;  }else{echo"Material";}?> </a></li>
<li><a href="<?=base_url()?>index.php/masters/labour"><?php if(isset($namehome)==1){ echo $namehome[45]->text;  }else{echo"Labor";}?> </a></li>
<li><a href="<?=base_url()?>index.php/masters/overhead"><?php if(isset($namehome)==1){ echo $namehome[46]->text;  }else{echo" Overhead";}?> </a></li>
<li><a href="<?=base_url()?>index.php/masters/unit"><?php if(isset($namehome)==1){ echo $namehome[47]->text;  }else{echo"Units";}?> </a></li>
<li><a href="<?=base_url()?>index.php/masters/carriage"><?php if(isset($namehome)==1){ echo $namehome[48]->text;  }else{echo"Carriage";}?> </a></li>
<li><a href="<?=base_url()?>index.php/masters/plant"><?php if(isset($namehome)==1){ echo $namehome[49]->text;  }else{echo"Plants";}?></a></li>
<li><a href="<?=base_url()?>index.php/masters/item_class"><?php if(isset($namehome)==1){ echo $namehome[50]->text;  }else{echo"Class";}?></a></li>
<li><a href="<?=base_url()?>index.php/masters/refrence"><?php if(isset($namehome)==1){ echo $namehome[51]->text;  }else{echo"Reference";}?></a></li>

</ul>
</li>
<li> <a href="javascript:;" class="dropdown-toggle">
<i class="fa fa-download"></i>
<span><?php if(isset($namehome)==1){ echo $namehome[40]->text;  }else{echo"Import";}?></span>
<b class="arrow fa fa-angle-right"></b>
</a>
	<ul class="submenu">
		
		
		<li><a href="<?=base_url()?>index.php/csv/index/subitem"><?php if(isset($namehome)==1){ echo $namehome[52]->text;  }else{echo"Sub Items";}?> </a></li>
		
		
		<li><a href="<?=base_url()?>index.php/csv/index/material"><?php if(isset($namehome)==1){ echo $namehome[44]->text;  }else{echo"Material";}?> </a></li>
		<li><a href="<?=base_url()?>index.php/csv/index/labour"><?php if(isset($namehome)==1){ echo $namehome[45]->text;  }else{echo"Labor";}?></a></li>
		<li><a href="<?=base_url()?>index.php/csv/index/plant"><?php if(isset($namehome)==1){ echo $namehome[49]->text;  }else{echo"Plant";}?></a></li>
		<li><a href="<?=base_url()?>index.php/csv/index/carriage"><?php if(isset($namehome)==1){ echo $namehome[48]->text;  }else{echo"Carriage";}?></a></li>
		
	</ul>

</li>
<li><a href="<?=base_url()?>index.php/estimation_controller/estimation_list"> <i class="fa fa-align-justify"></i><span><?php if(isset($namehome)==1){ echo $namehome[41]->text;  }else{echo"Estimations";}?></span></a></li>
<li><a href="<?=base_url()?>index.php/role/user_role"> <i class="fa fa-user"></i><span><?php if(isset($namehome)==1){ echo $namehome[42]->text;  }else{echo"User Management";}?></span></a></li>
<li><a href="<?=base_url()?>index.php/role/role_management"> <i class="fa fa-users"></i><span><?php if(isset($namehome)==1){ echo $namehome[43]->text;  }else{echo"Role Management";}?></span></a></li><!--
<li class="">
<a href="http://192.168.1.110:8080//PDFGeneration">
<i class="fa fa-file"></i>
<span>Generate Doc</span>
</a>
</li>-->

</ul>
<div id="sidebar-collapse" class="visible-lg">
<i class="fa fa-angle-double-left"></i>
</div>
</div>