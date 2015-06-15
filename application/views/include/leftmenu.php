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
<span>Search</span>
</a>
</li>
<li class="active">
<a href="<?=base_url()?>index.php/home">
<i class="fa fa-dashboard"></i>
<span>Dashboard</span>
</a>
</li>

<li>
<a href="javascript:;" class="dropdown-toggle">
<i class="fa fa-cog"></i>
<span>Manage</span>
<b class="arrow fa fa-angle-right"></b>
</a>
<ul class="submenu">
<!--<li><a href="<?=base_url()?>index.php/home"> Departments</a></li>-->
<!--<li><a href="<?=base_url()?>index.php/home/manage_chapter_list"> Chapters</a></li>-->
<!--<li><a href="<?=base_url()?>index.php/home/manage_item"> Items</a></li>-->
<!--<li><a href="<?=base_url()?>index.php/home/subitem_list"> Sub Items</a></li>-->
<li><a href="<?=base_url()?>index.php/home/material"> Material</a></li>
<li><a href="<?=base_url()?>index.php/home/labour"> Labor</a></li>
<li><a href="<?=base_url()?>index.php/home/overhead"> Overhead</a></li>
<li><a href="<?=base_url()?>index.php/home/unit"> Units</a></li>
<li><a href="<?=base_url()?>index.php/home/carriage"> Carriage</a></li>
<li><a href="<?=base_url()?>index.php/home/plant">Plants</a></li>
<li><a href="<?=base_url()?>index.php/home/item_class">Class</a></li>
<li><a href="<?=base_url()?>index.php/home/refrence">Reference</a></li>

</ul>
</li>
<li> <a href="javascript:;" class="dropdown-toggle">
<i class="fa fa-download"></i>
<span>Import</span>
<b class="arrow fa fa-angle-right"></b>
</a>
	<ul class="submenu">
		
		
		<li><a href="<?=base_url()?>index.php/csv/index/subitem"> Sub Items</a></li>
		
		
		<li><a href="<?=base_url()?>index.php/csv/index/material"> Material</a></li>
		<li><a href="<?=base_url()?>index.php/csv/index/labour">Labor</a></li>
		<li><a href="<?=base_url()?>index.php/csv/index/plant">Plant</a></li>
		<li><a href="<?=base_url()?>index.php/csv/index/carriage">Carriage</a></li>
		
	</ul>

</li>
<li><a href="<?=base_url()?>index.php/home/estimation_list"> <i class="fa fa-align-justify"></i><span>Estimations</span></a></li>
<li><a href="<?=base_url()?>index.php/role/user_role"> <i class="fa fa-user"></i><span>User Management</span></a></li>
<li><a href="<?=base_url()?>index.php/role/role_management"> <i class="fa fa-users"></i><span>Role Management</span></a></li><!--
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