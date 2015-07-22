<?php error_reporting(0);?>
	<body id="lang" class="login-page" cz-shortcut-listen="true" 
				data-original="<?php echo base_url(); ?>img/login.jpg" 
				style="display: block; background-image: url(<?php echo base_url(); ?>img/login.jpg);background-repeat: round;">

	<!-- BEGIN Main Content -->
	<div class="login-wrapper">
			<!-- BEGIN Login Form -->
		
			
			
			
					<form id="form-login" method="POST"  action="<?=base_url();?>index.php/login/login_user">
					<h2 style="text-transform: uppercase;text-align: center;color: #fff;"><b><i class="fa fa-home"></i><?php if(isset($text_id)==1){echo $text_id[0]->text;}else{echo "SOR";}?> </b></h2>
					</br>
					<h5 style="text-transform: uppercase;text-align: center;color: #fff;"><b><?php  if(isset($text_id)==1){ echo $text_id[1]->text;  }else{echo"Login to your account";}?> </b></h5>
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
							<?php  if($this->session->flashdata('ct_error')) { ?>
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
					<hr>
					 
					 
					 
					 
					<div class="form-group">
					
					<select class="controls" name="name"   onchange="code(this.value)" >
								
								<option value="ENG" <?=(!empty($text_id[0]->language_id)&& $text_id[0]->language_id=='ENG')?'selected="selected"':''?> >ENGLISH</option>
							<option value="HIN" <?=(!empty($text_id[0]->language_id)&& $text_id[0]->language_id=='HIN')?'selected="selected"':''?>>HINDI</option>
					</select>
					<label style="text-transform: uppercase;text-align: center;color: #fff;"><?php if(isset($text_id)==1){echo $text_id[165]->text;}else{echo "Please Select Language";}?></label>
					
		
					</div>
					<div class="form-group">
					<div class="controls" for="usermailid">
					<input type="text" placeholder="Email" class="form-control"  name="usermailid" data-rule-required="true"  data-rule-email="true" >
					</div>
					</div>
					<div class="form-group">
					<div class="controls" for="password">
					<input type="password" placeholder="Password" class="form-control" name="password"  data-rule-required="true">
					</div>
					</div>
					<div class="form-group">
					<div class="controls">
					<button type="submit" class="btn btn-primary form-control" style="background-color:#2c3e50;"><?php if(isset($text_id)==1){ echo $text_id[2]->text;  }else{echo"Sign In";}?></button>
					</div>
					</div>
					 <hr/>
									<p class="clearfix">
									<a href="javascript:;" class="goto-forgot pull-left text-white"><?php if(isset($text_id)==1){ echo $text_id[3]->text;  }else{echo"Forgot Password";}?></a>
										<a href="javascript:;" class="goto-register pull-right text-white"><?php if(isset($text_id)==1){ echo $text_id[4]->text;  }else{echo"Sign up now";}?></a>
									</p>
					</form>
			<!-- END Login Form -->


				<!-- BEGIN Register Form --> 
				<form id="form-register" action="<?=base_url();?>index.php/login/sign_up" method="post" class="hide">
					<h3 style="text-transform: uppercase;text-align: center;color: #fff;"><?php if(isset($text_id)==1){echo $text_id[166]->text;}else{echo "Sign up";}?></h3>
					  <span style="color: #fff; font-weight:800; text-transform: capitalize;" class="msg_box_reg-email" ></span>
					<hr/>
					<div class="form-group">
						 <div class="controls" for="usermailid">
                        <input type="email" name="usermailid" id="reg-email" onblur="check_email(this,<?=(!empty($id))?$id:'0'?>)" placeholder="Email" class="form-control" data-rule-required="true" data-rule-email="true" />
                    </div>
					</div>
				   
					<div class="form-group">
						<div class="controls" for="password">
							<input type="password" name="password" id="password" placeholder="Password" class="form-control" data-rule-required="true" data-rule-minlength="6" />
						</div>
					</div>
					<div class="form-group">
						<div class="controls" for="con_password">
							<input type="password" placeholder="Repeat Password" name="confirm-password" id="con_password" class="form-control" data-rule-required="true" data-rule-minlength="6" data-rule-equalTo="#password"  />
						</div>
					</div>
				  
			   <div class="form-group">
						<div class="controls">
							<button type="submit" name="submit" class="btn btn-primary input-block-level goto-register "><?php if(isset($text_id)==1){echo $text_id[167]->text;}else{echo "Sign up";}?></button>
						</div>
					</div>
					<hr/>
					<p class="clearfix">
						<a href="javascript:;" class="goto-login pull-left text-white" >â†� <?php if(isset($text_id)==1){echo $text_id[168]->text;}else{echo "Back to login form";}?></a>
					</p>
				</form>
				<!-- END Register Form -->
				<!-- start forget password -->
				 <form id="form-forgot" action="" method="post"  class="hide">
			
   <h3 style="text-transform: uppercase;text-align: center;color: #fff;"><?php if(isset($text_id)==1){echo $text_id[169]->text;}else{echo "Forgot your password";}?></h3>
					<span style="color: #fff; font-weight:800; text-transform: capitalize;" class="msg_box_forget-email" ></span>
						
					<hr/>
					<div class="control-group">
						<div class="controls">
							<input  type="email" name="usermailid" id="forget-email"  placeholder="Email" class="form-control" data-rule-required="true" required data-rule-email="true" />
						</div>
					</div>
					<div class="control-group">
					
						<div class="controls">
						
							<button type="button" onclick="check_forget_email(<?=(!empty($id))?$id:'0'?>)" name="submit" class="btn btn-primary input-block-level" class="login_submit" id="forget-email" ><?php if(isset($text_id)==1){echo $text_id[123]->text;}else{echo "Submit";}?></button>
						</div>
					</div>
					<hr/>
					<p class="clearfix">
						<a href="javascript:;" class="goto-login pull-left text-white">â†� <?php if(isset($text_id)==1){echo $text_id[168]->text;}else{echo "Back to login form";}?> </a>
					</p>
				</form>
				<!-- END Forgot Password Form -->


				<!-- end forget password -->
	</div>
	<!-- END Main Content -->


	<!--basic scripts-->
			<script type="text/javascript">

			 function show() {
			        var e = document.getElementById('show_language');
			        var txt = e.options[e.selectedIndex].text;
			        alert(txt);
			 }
			function forgot(){
			    goToForm('forgot');
        }
		function goToForm(form) 
			   {
					$('.login-wrapper > form:visible').fadeOut(500, function(){
						$('#form-' + form).fadeIn(500);
					 $('#form-register' + form).fadeIn(500);
					$('#form-login' + form).fadeIn(500);
					});
				}
			
				$(function() {
					  $('.goto-login').click(function(){
						goToForm('login');
					});
					$('.goto-forgot').click(function(){
						goToForm('forgot');
					});
					$('.goto-register').click(function(){
						goToForm('register');
					});
					
				});
			</script>


	<div id="window-resizer-tooltip" style="display: none;">
		<a href="#" title="Edit settings"></a>
			<span class="tooltipTitle">Window size: </span>
			<span class="tooltipWidth" id="winWidth">1024</span> x 
			<span class="tooltipHeight" id="winHeight">728</span>
			<br>
				<span class="tooltipTitle">Viewport size: </span>
				<span class="tooltipWidth" id="vpWidth">1024</span> x 
				<span class="tooltipHeight" id="vpHeight">374</span>
	</div>
	</body>
