<?php
$user_session_data = $this->session->userdata('user_data');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>SOR</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet/less" href="<?=base_url();?>less/style.less">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css">
          <!--page specific css styles-->
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/data-tables/DT_bootstrap.css" />

<link rel="stylesheet" href="<?php echo base_url(); ?>css/flaty.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/flaty-responsive.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">

<link rel="shortcut icon" href="<?php echo base_url(); ?>img/icon/favicon.ico">
<script src="https://code.jquery.com/jquery-1.8.3.min.js"></script>
<script src="<?=base_url()?>/js/jquery-1.8.2.min.js"></script>
<base href="<?php echo base_url(); ?>"/>
 <script type="text/javascript" src="<?php echo base_url(); ?>js/common_functions.js"></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>js/script.js"></script>
 <!--page specific css styles-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/chosen-bootstrap/chosen.min.css" />
    
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap-fileupload/bootstrap-fileupload.css" />

</head>
<body>
<?php  if($this->uri->segment(1)!='' && $this->uri->segment(1)!='login'){ ?>
<div id="navbar" class="navbar">
<button type="button" class="navbar-toggle navbar-btn collapsed" data-toggle="collapse" data-target="#sidebar">
<span class="fa fa-bars"></span>
</button>
<a class="navbar-brand" href="javascript:;">
<small>
<strong>
	<i class="fa fa-home"></i>
		<?php if(isset($namehome)==1){ echo $namehome[0]->text;  }else{echo"SOR";}?>
</strong>
</small>
</a>
<ul class="nav flaty-nav pull-left"    >
<li  class="dropdown" name="name" >
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" ><?php if(isset($namehome)==1){ echo $namehome[173]->text;  }else{echo"Select Language";}?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                    
                        <li value="ENG"><a href="<?=base_url()?>index.php/home/select_language_code/ENG"><?php if(isset($namehome)==1){ echo $namehome[174]->text;  }else{echo"ENGLISH";}?></a></li>
                        <li value="HIN"><a href="<?=base_url()?>index.php/home/select_language_code/HIN"><?php if(isset($namehome)==1){ echo $namehome[175]->text;  }else{echo"HINDI";}?></a></li>
                        <li><a href="<?=base_url()?>index.php/home/language"><?php if(isset($namehome)==1){ echo $namehome[176]->text;  }else{echo"ADD MORE LANGUAGE";}?></a></li>
                    </ul>
                </li>
                </ul>
<ul class="nav flaty-nav pull-right">


<li class="user-profile">
<a data-toggle="dropdown" href="javascript:;" class="user-menu dropdown-toggle">
<img class="nav-user-photo" src="<?=base_url()?>img/icon/Admin-icon.png" alt="Admin's Photo" />
<span class="hhh" id="user_info">
<?php
echo $user_session_data['role_id'];
?>	
</span>
<i class="fa fa-caret-down"></i>
</a>
<ul class="dropdown-menu dropdown-navbar" id="user_menu">
<li class="nav-header">
<i class=""></i>
Logined From   <?php 
echo date("h:i:s");
 ?>
</li>
<li>
<a href="<?=base_url();?>index.php/role/acc_setting">
<i class="fa fa-cog"></i>
<?php if(isset($namehome)==1){echo $namehome[171]->text;}else{echo "Account Settings";}?>
</a>
</li>
<!--<li>
<a href="#">
<i class="fa fa-user"></i>
Edit Profile
</a>
</li>-->

<li class="divider"></li>
<li>
<a href="<?php echo base_url(); ?>index.php/role/logout">
<i class="fa fa-off"></i>
<?php if(isset($namehome)==1){echo $namehome[172]->text;}else{echo "Logout";}?>
</a>
</li>
</ul>
</li>
</ul>
</div>
<?php }?>
