<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
   
	 function __construct() {
		parent::__construct();
		$this->data[]="";
		$this->data['user_data']="";
		$this->data['url'] = base_url();
		$this->load->model('mhome');
		$this->load->library('parser');
		$this->load->model('authority_model');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->data['base_url']=base_url();
	 }
	 function is_logged_in()
	 {
		 $user_data=$user_session_data = $this->session->userdata('user_data');
	 if($user_session_data==''){
	
		 $this->session->set_flashdata('message_type', 'error');
         $this->session->set_flashdata('message',$this->config->item("user").'First Login With Your Account.');
 		redirect('login');
		
	}									
	else{
		
		
	}
		 
		 
	 }
	 
	public function index()
	{ 
	if($this->is_logged_in()){
		redirect('login');
		
	}
	else{
	//	$user_data['user_id'];
		 $filter = array('dep_id !=' => '');
		$this->data['dep_list'] = $this->mhome->get_list($filter,'ssr_t_department');	
		//print_r($this->data['dep_list']);die;
		//Breadcrumb section start
			$this->breadcrumb->clear();
		    $this->breadcrumb->add_crumb('Home', base_url().'index.php/home');
		//Breadcrumb section end
		
	   $this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->load->view('dep_list',$this->data);
		$this->parser->parse('include/footer',$this->data);
		
	}
	
	}
function login($info=false)
	{
		
		  // echo"gfjsdfgbsdk";die;       //$this->parser->parse('include/footer',$this->data);
											$data=array(
											'usermailid'=>$this->input->post('usermailid'),
											'password'=>$this->input->post('password')
											);
											//print_r($data);die;
											$row=$this->mhome->login_check('ssr_t_users',$data);
											if($row){
											//print_r($row);die;
											$user_data = array(
											'usermailid' => $row->usermailid,
											'user_id' => $row->user_id,
											'role_id' => $row->role_id
											);
											$this->session->set_userdata('user_data',$user_data);	
											$user_session_data = $this->session->userdata('user_data');
											
											redirect('home');
										   }
										   else{
											   
											 redirect('login');
											 // echo"invalid user or password";
											   }
											//   	$this->parser->parse(//'include/header',$this->data);
	//$this->parser->parse('include/header',$this->data);
	//	$this->parser->parse('login',$this->data);
	//	$this->parser->parse('include/footer',$this->data);
	}
	
	// Start function for check permissions for particular role_id
	function check_authority($function)
	{	
		$user_session_data = $this->session->userdata('user_data');	
		$role=$user_session_data['role_id'];
		$list_permision=$this->data['list_permision']=$this->authority_model->list_permision($role);
		foreach($list_permision as $var)
		{	
		  if($user_session_data['role_id']==$var->role_id && $var->function_id==$function && $var->auth_read==1 && $var->auth_execute==0)
			{  
			$this->session->set_flashdata('category_error', 'success message');        
			$this->session->set_flashdata('message', $this->config->item("add_department").' You are not authorised person for edit');
					return true;
			}
			if($user_session_data['role_id']==$var->role_id && $var->function_id==$function && $var->auth_read==0 && $var->auth_execute==0)
			{		
				$this->session->set_flashdata('category_error_block', 'success message');        
				$this->session->set_flashdata('message', $this->config->item("add_department").' You Are Not Authorised Person Please Contact Administrator');
						redirect('home');
			}
		}
	}
	// Start function for check permissions for particular role_id
	
	function logout($info=false)
	{
		//$this->parser->parse('include/footer',$this->data);
										$this->data['user_data']=$this->session->userdata('user_data');
										$userdata=$this->session->userdata('user_data');
										$unset_userdata=$this->session->unset_userdata($userdata);
										$this->session->sess_destroy();
								//$this->load
										//print_r($unset_userdata);die;
											  redirect('login');
	}
	function sign_up(){
		 
		$a = $this->input->post('usermailid');
     $q =   $this->mhome->insert_sign('ssr_t_users',$a);
	// print_r($q);die;
	 if($q)
       {
        $this->session->set_flashdata('category_error', 'error message');  
		$this->session->set_flashdata('message',$this->config->item("user").' email id already exist'); 
          redirect('login');
		  
       }
       else
       {
        $this->session->set_flashdata('category_success', 'success message');        
                           $this->session->set_flashdata('message', $this->config->item("user").'Signup successfully Please Login With Your Account');
	 redirect('login');
       }
	}
	
	function user()
   {
	   if($this->is_logged_in()){
			redirect('login');
		}else{
       $user=$this->input->post('usermailid');
       $query=$this->mhome->get_record('ssr_t_users',array('usermailid'=>$user));
       if($query)
       {
          $this->session->set_flashdata('error', '<script type="text/javascript">alert("you are already registered with this email id")</script>'); 
          redirect('login');
       }
       else
       {
        
       }
   }
   }
	
	function change_pass($info=false)
	{ 
	if($this->is_logged_in()){
			redirect('login');
		}else{
			$data = array(
			'password' => $this->input->post('password')
			);
			$filter=array(
	        'user_id' => $user_data['user_id']
			);
			$this->mhome->change($filter,$data,'ssr_t_users');
			 $this->session->set_flashdata('message_type', 'success');        
                           $this->session->set_flashdata('message', $this->config->item("user").'Password updated successfully');
			redirect('home');
	}
	}
	function acc_setting($info=false)
	{ 
	if($this->is_logged_in()){
			redirect('login');
		}else{
		$user_data=$user_session_data = $this->session->userdata('user_data');
		
		$this->data['user_data']=$this->session->userdata('user_data');
		$userdata=$this->session->userdata('user_data');
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->load->view('acc_setting',$this->data);
		$this->parser->parse('include/footer',$this->data);
	}
	}
	
		
    function add_department($dep_id=false){
		if($this->is_logged_in()){
			redirect('login');
		}
			elseif($this->check_authority('add_department')==true)
			{
			//echo"elseif";die;
					redirect('home');
			}
		else
		{
		 if($dep_id){
			$filter = array('dep_id'=>$dep_id);
		
		   $dep_info = $this->mhome->get_list($filter,'ssr_t_department');
		   $this->data = array('dep_name'=>$dep_info[0]->dep_name,
		                       'dep_desc'=>$dep_info[0]->dep_desc,
		                        'dep_heading' =>$dep_info[0]->dep_heading,
					               'dep_notes' =>$dep_info[0]->dep_notes);
			$this->data['dep_id']=$dep_id;
								  
		
		}	
		//Breadcrumb section start
			$this->breadcrumb->clear();
		    $this->breadcrumb->add_crumb('Home', base_url());
		    $this->breadcrumb->add_crumb('Department',  base_url().'index.php/home');
		    $this->breadcrumb->add_crumb('Manage Department',  '');
		//Breadcrumb section end
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->parser->parse('add_department',$this->data);
		$this->parser->parse('include/footer',$this->data);
		
	}
	}
  function manage_department(){
			if($this->is_logged_in()){
			redirect('login');
		}else{
					if($this->input->post('submit')){
					if($this->input->post('id')){
						//echo"edit";die;
						$info = array('dep_name' => $this->input->post('dep_name'),
					               'dep_desc' => $this->input->post('dep_desc'),
					               'dep_heading' => $this->input->post('dep_heading'),
					               'dep_notes' => $this->input->post('dep_notes'),
					                 'updated_by' => 1,
										'updated_on' => date("Y-m-d"));
			               $this->mhome->manage_department($info,array('dep_id'=>$this->input->post('id')));
				
			               $this->session->set_flashdata('message_type', 'success');        
                           $this->session->set_flashdata('message', $this->config->item("department").' updated successfully');
						
						
						
					}else{	
			        // echo"add";die;
					$info = array('dep_name' => $this->input->post('dep_name'),
					               'dep_desc' => $this->input->post('dep_desc'),
					                'dep_heading' => $this->input->post('dep_heading'),
					               'dep_notes' => $this->input->post('dep_notes'),
					                 'created_by' => 1,
										'created_on' => date("Y-m-d"));
					  $c_id=$this->mhome->manage_department($info);
																
							}
					
				
					if($this->input->post('id')){
						$this->session->set_flashdata('message_type', 'success');        
                           $this->session->set_flashdata('message', $this->config->item("department").' updated successfully');
						redirect('home');
					}else{
						$this->session->set_flashdata('message_type', 'success');        
                        $this->session->set_flashdata('message', $this->config->item("department").' Added successfully');
								redirect('home');	
					
					}
				}
					
 }
  }
			public function auto_search()
			{
				if($this->is_logged_in()){
			redirect('login');
		}else{
				$search = $this->input->post('search');
				$search_data=$this->data['search_data']=$this->mhome->search_auto($search);
			}
			}
			public function search_result($id=false){
				if($this->is_logged_in()){
			redirect('login');
		}else{
				//Breadcrumb section start
				   $this->breadcrumb->clear();
				   $this->breadcrumb->add_crumb('Home', base_url());
				   $this->breadcrumb->add_crumb('Search Result', '');
		         //Breadcrumb section end
				$this->parser->parse('include/header',$this->data);
				$this->parser->parse('include/leftmenu',$this->data);
				$this->parser->parse('search_result',$this->data);
			}
			}
			// create function for search
			public function search_keyword(){
				if($this->is_logged_in()){
			redirect('login');
		}else{
				//Filter In Sub Items Start 
				
				if($this->input->post('item_id') && $this->input->post('search') && $this->input->post('chap_id'))
				{
					$keyword = $this->input->post('search');
					$sub_item_drop = $this->input->post('item_id');
					$sub_items_drop = $this->data['sub_items_drop']=$this->mhome->sub_items_drop($keyword,$sub_item_drop);
					$dipartments=$this->data['dipartments']=$this->mhome->dipart();
				}
				
				//Filter In Sub Items End
				//Filter In Itmes and Sub Items Start
				
				elseif($this->input->post('chap_id') && $this->input->post('search'))
				{	
					$keyword = $this->input->post('search');
					$item_drop = $this->input->post('chap_id');
					$dropdown_item=$this->data['dropdown_item']=$this->mhome->dropdown_item($keyword,$item_drop);
					$dropdown_subitem=$this->data['dropdown_subitem']=$this->mhome->dropdown_subitem($keyword,$item_drop);
					$dipartments=$this->data['dipartments']=$this->mhome->dipart();
				}
				//Filter In Itmes and Sub Items End
				//filter In Items and Sub Items behalf on department start
				
				elseif($this->input->post('dep_id') && $this->input->post('search'))
				{	
					$keyword = $this->input->post('search');
					$item_drop = $this->input->post('dep_id');
					$dep_dropdown_item=$this->data['dep_dropdown_item']=$this->mhome->dep_dropdown_item($keyword,$item_drop);
					$dep_dropdown_subitem=$this->data['dep_dropdown_subitem']=$this->mhome->dep_dropdown_subitem($keyword,$item_drop);
					$dipartments=$this->data['dipartments']=$this->mhome->dipart();
				}
				
				//filter In Items and Sub Items behalf on department end
				//Search in Items and Sub Items Start
				
				else
				{
				   $keyword = $this->input->post('search');
				   $dipartments=$this->data['dipartments']=$this->mhome->dipart();
				   $chapters=$this->data['chapters']=$this->mhome->search($keyword);
				   $items=$this->data['items']=$this->mhome->search_item($keyword);
				   $sub_items=$this->data['sub_items']=$this->mhome->search_subitem($keyword);
				}
				//Search in Items and Sub Items End
				//Breadcrumb section start
				
				   $this->breadcrumb->clear();
				   $this->breadcrumb->add_crumb('Home',base_url());
				   $this->breadcrumb->add_crumb('Search Result', '');
		         //Breadcrumb section end
				 
				   $this->parser->parse('include/header',$this->data);
				 //$this->load->view('search_result',$this->data);
				   $this->parser->parse('include/leftmenu',$this->data);
				   $this->parser->parse('search_result',$this->data);
				   $this->parser->parse('include/footer',$this->data);
					
			}
			}
			/*Estimation Coding start on 07may2015 bye rohit.................................................................*/
			public function estimation($dep_id=false,$chap_id=false,$item_id=false,$select=false,$est_id=false)
			{	
			if($this->is_logged_in()){
			redirect('login');
		}else{
			//print_r($dep_id);die;
				$this->data['dep_id'] = $dep_id;
				$this->data['chap_id'] = $chap_id;
				$this->data['item_id'] = $item_id;
				$this->data['est_id'] = $est_id;
				//echo $est_id;die;
			//	if($_POST['select']==''){
				//	$this->session->set_flashdata('cat_error', 'error');        
                  //        $this->session->set_flashdata('message', $this->config->item("ref").' Please Select Atleast One Item');
				//redirect("home/get_subitem_list/".$dep_id."/".$chap_id."/".$item_id."");
			//	redirect("home/estimation/".$dep_id."/".$chap_id."/".$item_id."/".$sub."/".$est_id."/");
					//redirect ('sbuitem_list');
					
				
			//	}
				//else{
				if(!(isset($_POST['select'])?$_POST['select']:'')==''){
				$filter=$_POST['select'];
				$filter = implode(',',$filter);
				$this->data['select'] =$filter;
				}else{
					//print_r($select);die;
					$filter= $select;
					$this->data['select'] =$filter;
				}
				$this->data['subitem_list'] = $this->mhome->get_subitem_ids_list_est($filter);
				
				if($est_id){
					
					$filter= $est_id;
					$est_sub=$this->data['est_sub'] = $this->mhome->get_subitem_est_cal($filter);
				}
				
				$this->parser->parse('include/header',$this->data);
				$this->parser->parse('include/leftmenu',$this->data);
				$this->parser->parse('estimation',$this->data);
				$this->parser->parse('include/footer',$this->data);
				}
		//}		
			}
				function add_est_submit($dep_id=false,$chap_id=false,$item_id=false,$select=false,$est_id=false)
				{	
				if($this->is_logged_in()){
			redirect('login');
		}else{
				if($this->input->post('est_id')){
					$data=array('est_description' => $this->input->post('est_description'),
					'est_total' => $this->input->post('final_total'),
							'updated_by'=>'rohit'
							);
					$filter=array('est_id'=>$this->input->post('est_id'));
					if($est_id=$this->mhome->update_estimate($data,$filter)){
						$subitem_id=explode(",",$select);
						
					for($i=0;$i<=count($subitem_id)-1; $i++){
						$filter=array('est_id'=>$this->input->post('est_id'),
						'dep_id'=>$dep_id,
						'chap_id'=>$chap_id,
						'item_id'=>$item_id,
						'subitem_id'=>$subitem_id[$i],
						);
						$amount=$this->input->post('amount');
					$data=array('amount'=>$amount[$i],
					'updated_by'=>'rohit');
					$this->mhome->update_estsitem($data,$filter);
					}
						$filter=$this->input->post('est_id');
				redirect("home/estimation/".$dep_id."/".$chap_id."/".$item_id."/".$select."/".$filter."/");
				}else{
					echo "Error while Adding Estimate";
				}
				} else{
					$data=array('est_description' => $this->input->post('est_description'),
							'est_status'=>'new',
							'est_total' => $this->input->post('final_total'),
							'created_by'=>'rohit',
							'updated_by'=>'rohit'
							);
				if($est_id=$this->mhome->insert_estimate($data)){
					$subitem_id=explode(",",$select);
					for($i=0;$i<=count($subitem_id)-1; $i++){
					$data=array('est_id'=>$est_id,
					'dep_id'=>$dep_id,
					'chap_id'=>$chap_id,
					'item_id'=>$item_id,
					'subitem_id'=>$subitem_id[$i],
					'amount'=>0,
					'quantity'=>0,
					'created_by'=>'rohit',
					'updated_by'=>'rohit');
					$this->mhome->insert_estsitem($data);
					}
					
				redirect("home/estimation/".$dep_id."/".$chap_id."/".$item_id."/".$select."/".$est_id."/");
				
				}else{
					echo "Error while Adding Estimate";
				}
				}
				}
				}
				public function estimation_val($dep_id=false,$chap_id=false,$item_id=false,$subitem_id=false,$class_id=false,$select=false,$est_id=false)
				{
					if($this->is_logged_in()){
			redirect('login');
		}else{
				$this->data['dep_id'] = $dep_id;
				$this->data['chap_id'] = $chap_id;
				$this->data['item_id'] = $item_id;
				$this->data['subitem_id'] = $subitem_id;
				$this->data['class_id'] = $class_id;
				$this->data['select'] = $select;
				$this->data['est_id'] = $est_id;
				
				$filter = array('dep_id'=>$dep_id,
				'chap_id'=>$chap_id,
				'item_id'=>$item_id,
				'subitem_id'=>$subitem_id,
				'est_id'=>$est_id);
				
				$this->data['estimate_cal'] = $this->mhome->get_list($filter,'ssr_t_estimate_cal');
				
				$filter = array('subitem_id'=>$subitem_id);
				$this->data['subitem_list'] = $this->mhome->get_list($filter,'ssr_t_subitem');	
				
				$this->parser->parse('include/header',$this->data);
				$this->parser->parse('include/leftmenu',$this->data);
				$this->parser->parse('estimation_val',$this->data);
				$this->parser->parse('include/footer',$this->data);
				}
				}
	public function estimation_create($dep_id=false,$chap_id=false,$item_id=false,$subitem_id=false,$class_id=false,$select=false,$est_id=false){
					if($this->is_logged_in()){
			redirect('login');
		}else{
				$data = $this->input->post();
				
				$value = "";
				if($this->input->post('edit_costing')==1){
				for($i=0;$i<=count($data['no'])-1; $i++){
				$value .= "('".$data['est_id']."','".$data['dep_id']."','".$data['chap_id']."','".$data['item_id']."','".$data['subitem_id']."',".$data['no'][$i].",'".$data['length'][$i]."','".$data['width'][$i]."','".$data['depth'][$i]."')".",";
				}
				$filter=array('est_id'=>$data['est_id'],
				'dep_id'=>$dep_id,
				'chap_id'=>$chap_id,
				'item_id'=>$item_id,
				'subitem_id'=>$subitem_id,
				);
				//print_r($filter);die;
				if($this->mhome->update_estimate_cal(rtrim($value,","),$data['final_total'],$data['dep_id'],$data['chap_id'],$data['item_id'],$data['subitem_id'],$data['est_id'],$filter)){
					$this->session->set_flashdata('category_success', 'success message');  
		$this->session->set_flashdata('message',$this->config->item("ref").' successfully saved');
					//echo "success";
				redirect("home/estimation/".$data['dep_id']."/".$data['chap_id']."/".$data['item_id']."/".$data['select']."/".$data['est_id']);
				
				}else{
					$this->session->set_flashdata('category_error', 'error message');  
		$this->session->set_flashdata('message',$this->config->item("ref").' subitem does not contain rate');
		redirect("home/estimation/".$data['dep_id']."/".$data['chap_id']."/".$data['item_id']."/".$data['select']."/".$data['est_id']);
					//echo "Error while Editing Estimate";
				}
				} else {
				
				for($i=0;$i<=count($data['no'])-1; $i++){
			
				$value .= "('".$data['est_id']."','".$data['dep_id']."','".$data['chap_id']."','".$data['item_id']."','".$data['subitem_id']."',".$data['no'][$i].",'".$data['length'][$i]."','".$data['width'][$i]."','".$data['depth'][$i]."')".",";
				}
				if($this->mhome->manage_estimate_cal(rtrim($value,","),$data['final_total'],$data['dep_id'],$data['chap_id'],$data['item_id'],$data['subitem_id'],$data['est_id'])){
					
				redirect("home/estimation/".$data['dep_id']."/".$data['chap_id']."/".$data['item_id']."/".$data['select']."/".$data['est_id']);
				
				}else{
					$this->session->set_flashdata('category_error', 'error message');  
		$this->session->set_flashdata('message',$this->config->item("ref").' subitem does not contain rate');
		redirect("home/estimation/".$data['dep_id']."/".$data['chap_id']."/".$data['item_id']."/".$data['select']."/".$data['est_id']);
				}
				}
				}
				}
				function add_estsubitem($dep_id=false,$chap_id=false,$item_id=false,$select=false,$est_id=false)
				{
					if($this->is_logged_in()){
			redirect('login');
		}else{
				$this->data['dep_id'] = $dep_id;
				$this->data['chap_id'] = $chap_id;
				$this->data['item_id'] = $item_id;
				$this->data['select'] = $select;
				$this->data['est_id'] = $est_id;
				$this->data['dep'] = $this->mhome->get_deplist('ssr_t_department');
				$this->parser->parse('include/header',$this->data);
				$this->parser->parse('include/leftmenu',$this->data);
				$this->load->view('add_estsubitem',$this->data);
				$this->parser->parse('include/footer',$this->data);
				} 
				}
				function add_estsubitem_submit($dep_id=false,$chap_id=false,$item_id=false,$select=false,$est_id=false)
				{
if($this->is_logged_in()){
			redirect('login');
		}else{					
					
					$subitem_id=$_POST['subitem_id'];
					$subitem_id = implode(',',$subitem_id);
					$select= $select.",".$subitem_id;
					redirect("home/estimation/".$dep_id."/".$chap_id."/".$item_id."/".$select."/".$est_id."/");	
				} 
				}
				
				function estimation_list($dep_id=false,$chap_id=false,$item_id=false,$select=false)
				{
					if($this->is_logged_in()){
			redirect('login');
		}else{
				$this->check_authority('estimation_list');
				$this->data['dep_id'] = $dep_id;
				$this->data['chap_id'] = $chap_id;
				$this->data['item_id'] = $item_id;
				$this->data['select'] = $select;
				$filter = array('est_id !=' => '');
				$this->data['estimate'] = $this->mhome->get_list($filter,'ssr_t_estimate');
				$this->parser->parse('include/header',$this->data);
				$this->parser->parse('include/leftmenu',$this->data);
				$this->load->view('estimation_list',$this->data);
				$this->parser->parse('include/footer',$this->data);
				}
				}
				function edit_estimation($est_id=false,$v=false)
				{
						if($this->is_logged_in()){
							redirect('login');
						}
				elseif($v=='')
						{
								$this->check_authority('edit_estimation');
								redirect('home/estimation_list');
						}
			else{
					$value = array('');
					$sub="";
					$dep_id="";
					$chap_id="";
					$item_id="";
					$this->data['value']="";
					$filter=array('est_id'=>$est_id);
					$value=$this->data['value']=$this->mhome->get_list($filter,'ssr_t_estimate_sitem');
					
					for($i=0;$i<=count($value); $i++){
					$filter=array('est_id'=>$est_id);
					$value=$this->data['value']=$this->mhome->get_list($filter,'ssr_t_estimate_sitem');
					
					$sub.="".$value[$i]->subitem_id."".",";
					$dep_id=$value[0]->dep_id;
					$chap_id=$value[0]->chap_id;
					$item_id=$value[0]->item_id;
	
					}
					$sub=rtrim($sub,",");
					if($v==1){
					redirect("home/estimation_view/".$dep_id."/".$chap_id."/".$item_id."/".$sub."/".$est_id."/");
					}else{
						redirect("home/estimation/".$dep_id."/".$chap_id."/".$item_id."/".$sub."/".$est_id."/");
					}
					}
				}
				function delete_estimate($est_id=false){
					if($this->is_logged_in()){
							redirect('login');
						}
					elseif($this->check_authority('delete_estimate'))
						{
							redirect('home/estimation_list');
						}
				
					else{
								$this->mhome->delete_estimate($est_id);
								redirect("home/estimation_list");
						}
				}
				function final_estimate($est_id=false){
					if($this->is_logged_in()){
			redirect('login');
		}else{
					$this->mhome->final_estimate($est_id);
					redirect("home/estimation_list");
				}
				}
				function estimate_pdf($est_id=false){
					if($this->is_logged_in()){
			redirect('login');
		}
		elseif($this->check_authority('estimate_pdf'))
				{
						redirect('home/estimation_list');	
				}
		else{
					print_r("Generate PFD");die;
				}
				}
				public function estimation_view($dep_id=false,$chap_id=false,$item_id=false,$select=false,$est_id=false)
			{
if($this->is_logged_in()){
			redirect('login');
		}else{				
				$this->data['dep_id'] = $dep_id;
				$this->data['chap_id'] = $chap_id;
				$this->data['item_id'] = $item_id;
				$this->data['est_id'] = $est_id;
				if(!(isset($_POST['select'])?$_POST['select']:'')==''){
				$filter=$_POST['select'];
				$filter = implode(',',$filter);
				$this->data['select'] =$filter;
				}else{
					$filter= $select;
					$this->data['select'] =$filter;
				}
				$this->data['subitem_list'] = $this->mhome->get_subitem_ids_list_est($filter);
				
				if($est_id){
					
					$filter= $est_id;
					$est_sub=$this->data['est_sub'] = $this->mhome->get_subitem_est_cal($filter);
				}
				
				$this->parser->parse('include/header',$this->data);
				$this->parser->parse('include/leftmenu',$this->data);
				$this->parser->parse('estimate_veiwonly',$this->data);
				$this->parser->parse('include/footer',$this->data);
				} 
			}
				public function estimation_val_view($dep_id=false,$chap_id=false,$item_id=false,$subitem_id=false,$class_id=false,$select=false,$est_id=false)
				{
					if($this->is_logged_in()){
			redirect('login');
		}else{
				$this->data['dep_id'] = $dep_id;
				$this->data['chap_id'] = $chap_id;
				$this->data['item_id'] = $item_id;
				$this->data['subitem_id'] = $subitem_id;
				$this->data['class_id'] = $class_id;
				$this->data['select'] = $select;
				$this->data['est_id'] = $est_id;
				
				$filter = array('dep_id'=>$dep_id,
				'chap_id'=>$chap_id,
				'item_id'=>$item_id,
				'subitem_id'=>$subitem_id,
				'est_id'=>$est_id);
				
				$this->data['estimate_cal'] = $this->mhome->get_list($filter,'ssr_t_estimate_cal');
				
				$filter = array('subitem_id'=>$subitem_id);
				$this->data['subitem_list'] = $this->mhome->get_list($filter,'ssr_t_subitem');	
				
				$this->parser->parse('include/header',$this->data);
				$this->parser->parse('include/leftmenu',$this->data);
				$this->parser->parse('est_val_veiwonly',$this->data);
				$this->parser->parse('include/footer',$this->data);
				}
				}
				function del_sitem_est($dep_id=false,$chap_id=false,$item_id=false,$select=false,$est_id=false){
					if($this->is_logged_in()){
			redirect('login');
		}else{
					
					$sub_select=$_POST['select'];
					for($i=0;$i<=count($sub_select);$i++){
					$filter=array('est_id'=>$est_id,
					'dep_id'=>$dep_id,
					'chap_id'=>$chap_id,
					'item_id'=>$item_id,
					'subitem_id'=>$sub_select[$i]);
					$this->mhome->delete_estimate_sitem($filter);
					}
					$array = explode(',',$select);
					$array = array_diff($array,$sub_select);
					$select = implode(',',$array);
					redirect("home/estimation/".$dep_id."/".$chap_id."/".$item_id."/".$select."/".$est_id."/");		
				}
				}
	/*Estimation Coding END...............................................................................*/
					public function form_validation($id=false){
						if($this->is_logged_in()){
			redirect('login');
		}else{

				$this->parser->parse('include/header',$this->data);
				$this->parser->parse('include/leftmenu',$this->data);
				$this->parser->parse('form_validation',$this->data);
				$this->parser->parse('include/footer',$this->data);


		}
				} 
				public function search($id=false){
if($this->is_logged_in()){
			redirect('login');
		}else{
				$this->parser->parse('include/header',$this->data);
				$this->parser->parse('include/leftmenu',$this->data);
				$this->parser->parse('search',$this->data);
				$this->parser->parse('include/footer',$this->data);
} 
				}
				
					public function abstract_est($id=false){
						if($this->is_logged_in()){
			redirect('login');
		}else{

				$this->parser->parse('include/header',$this->data);
				$this->parser->parse('include/leftmenu',$this->data);
				$this->parser->parse('abstract_est',$this->data);
				$this->parser->parse('include/footer',$this->data);
				}
					}
				
   public function chapter($dep_id)
	{ 
if($this->is_logged_in()){
			redirect('login');
		}else{
			$this->check_authority('chapter');
	$filter = array('dep_id'=>$dep_id);
	    	
		$this->data['chap_list'] = $this->mhome->get_list($filter,'ssr_t_chapter');
		
	    $this->data['dep_detail'] = $this->mhome->get_list($filter,'ssr_t_department');			
		//print_r($this->data['chap_list']);die;
		//Breadcrumb section start
			$this->breadcrumb->clear();
		    $this->breadcrumb->add_crumb('Home', base_url().'index.php/home');
		    $this->breadcrumb->add_crumb($this->data['dep_detail'][0]->dep_name, base_url().'index.php/home');
		    $this->breadcrumb->add_crumb('Chapter', '');
		//Breadcrumb section end
		$this->data['dep_id']=$dep_id;
		//Templets load section
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->load->view('chep_list',$this->data);
		$this->parser->parse('include/footer',$this->data);
	} 
	}
	public function add_chapter($dep_id=false,$chap_id=false)
	 {
		 if($this->is_logged_in()){
			redirect('login');
		}
		elseif($this->check_authority('add_chapter')==true)
			{
			//echo"elseif";die;
					redirect('home/chapter/'.$dep_id);
			}
		else{
	//print_r($dep_id);die;
		
		//$this->data['dep_id']=$dep_id;
	  
			//print_r($this->data['dep_detail'][0]->dep_name);die;
		if($chap_id){
			$filter = array('chap_id'=>$chap_id);
		
		   $chap_info = $this->mhome->get_list($filter,'ssr_t_chapter');
		   $this->data = array( 'chap_name'=>$chap_info[0]->chap_name,
		                          'chap_desc'=>$chap_info[0]->chap_desc,
		                         'chap_heading'=>$chap_info[0]->chap_heading,
		                          'chap_notes'=>$chap_info[0]->chap_notes,
		                          'created_by' => 1,
									'created_on' => date("Y-m-d"));
			$this->data['chap_id']=$chap_id;
								  
		
		}
		 $filter1 = array('dep_id'=>$dep_id);
	    	
	
	    $this->data['deprt_detail'] = $this->mhome->get_list($filter1,'ssr_t_department');			
		
		//Breadcrumb section start
			$this->breadcrumb->clear();
		    $this->breadcrumb->add_crumb('Home', base_url());
		    
		    $this->breadcrumb->add_crumb($this->data['deprt_detail'][0]->dep_name,base_url().'index.php/home');
		    $this->breadcrumb->add_crumb('Chapter','');
		   
		//Breadcrumb section end
		//print_r($this->data);die;
		
		$this->data['dep'] = $this->mhome->get_deplist('ssr_t_department');	
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->parser->parse('add_chapter',$this->data);
		$this->parser->parse('include/footer',$this->data);
	 }
	 }
	 function manage_chapter(){
		 if($this->is_logged_in()){
			redirect('login');
		}else{
			//print_r($_POST);die;
					if($this->input->post('submit')){
					//echo"jjj";die;
						if($this->input->post('id')){
			          $info = array('dep_id' => $this->input->post('dep_id'),
			                          'chap_name' => $this->input->post('chap_name'),
										'chap_desc' => $this->input->post('chap_desc'),
										'chap_heading' => $this->input->post('chap_heading'),
										'chap_notes' => $this->input->post('chap_notes'),
										'created_by' => 1,
										'created_on' => date("Y-m-d"),
										'updated_by' => 1,
										'updated_on' => date("Y-m-d"));
										
										
							$this->mhome->manage_chapter($info,array('chap_id'=>$this->input->post('id')));
								
							$this->session->set_flashdata('message_type', 'success');        
							$this->session->set_flashdata('message', $this->config->item("chapter").' updated successfully');
					
	                 }else{
						 //echo"bb";die;
					       $info = array('dep_id' => $this->input->post('dep_id'),
					                     'chap_name' => $this->input->post('chap_name'),
										'chap_desc' => $this->input->post('chap_desc'),
										'chap_heading' => $this->input->post('chap_heading'),
										'chap_notes' => $this->input->post('chap_notes'),
										'created_by' => 1,
										'created_on' => date("Y-m-d"),
										'updated_by' => 1,
										'updated_on' => date("Y-m-d"));
								//print_r($info);die;		
												
					        $c_id=$this->mhome->manage_chapter($info);
																
						  }   
					
					if($this->input->post('id')){
						$this->session->set_flashdata('message_type', 'success');        
							$this->session->set_flashdata('message', $this->config->item("chapter").' updated successfully');
						redirect('home/chapter/'.$this->input->post('dep_id'));
					}else{
						$this->session->set_flashdata('message_type', 'success');        
                        $this->session->set_flashdata('message', $this->config->item("chapter").' Added successfully');
								redirect('home/chapter/'.$this->input->post('dep_id'));	
					}
				}
	}
	 }
	public function manage_chapter_list($id=false){
		if($this->is_logged_in()){
			redirect('login');
		}else{
	 $this->data['dep'] = $this->mhome->get_deplist('ssr_t_department');		
			
			
		//Breadcrumb section start
			$this->breadcrumb->clear();
		    $this->breadcrumb->add_crumb('Home', base_url());
		    $this->breadcrumb->add_crumb('Departments', base_url());
		    $this->breadcrumb->add_crumb('Chapter','');
		   
		//Breadcrumb section end
			
			$this->parser->parse('include/header',$this->data);
			$this->parser->parse('include/leftmenu',$this->data);
			$this->parser->parse('manage_chapter',$this->data);
			$this->parser->parse('include/footer',$this->data);		
		}
			
	}
public function item($dep_id=false,$chap_id=false)
	{   
	
	if($this->is_logged_in()){
			redirect('login');
		}else{
		$this->check_authority('item');
	$filter = array('dep_id'=>$dep_id,'chap_id'=>$chap_id);
		$this->data['item_list'] = $this->mhome->get_item_list($filter,'ssr_t_item');	
		//print_r($this->data['item_list']);die;
		$filter = array('dep_id'=>$dep_id);
	    $this->data['dep_detail'] = $this->mhome->get_list($filter,'ssr_t_department');
		$filter = array('chap_id'=>$chap_id);
	    $this->data['chap_detail'] = $this->mhome->get_list($filter,'ssr_t_chapter');
		
		//Breadcrumb section start
			$this->breadcrumb->clear();
		    $this->breadcrumb->add_crumb('Home', base_url());
		    $this->breadcrumb->add_crumb($this->data['dep_detail'][0]->dep_name, base_url().'index.php/home');
		    $this->breadcrumb->add_crumb($this->data['chap_detail'][0]->chap_name, base_url().'index.php/home/chapter/'.$this->data['dep_detail'][0]->dep_id);
		    $this->breadcrumb->add_crumb('Items', '');
		//Breadcrumb section end
		$this->data['dep_id']=$dep_id;
	    $this->data['chap_id']=$chap_id;
		//Templets load section
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->load->view('item_list',$this->data);
		$this->parser->parse('include/footer',$this->data);
	}	
	}	
 public function create_item($dep_id=false,$chap_id=false,$item_id=false)
	 {
		 if($this->is_logged_in()){
			redirect('login');
		}
		elseif($this->check_authority('create_item'))
				{
					redirect('home/item/'.$dep_id.'/'.$chap_id);	
				}
		else{
	     $this->data['unit_list'] = $this->mhome->get_unitlist(); 
		  $this->data['class_list'] = $this->mhome->get_class_list();
		if($item_id){
			$filter = array('item_id'=>$item_id);
		
		   $item_info = $this->mhome->get_item_list($filter,'ssr_t_item');
		   $this->data = array('dep_id'=>$item_info[0]->dep_id,
		                        'chap_id'=>$item_info[0]->chap_id,
		                        'item_name'=>$item_info[0]->item_name,
		                        'item_desc'=>$item_info[0]->item_desc,
								'unit_code'=>$item_info[0]->unit_code,
								 'item_class_id' =>$item_info[0]->item_class_id,
		                        'item_qty_base'=>$item_info[0]->item_qty_base,
		                        'item_cost_total'=>$item_info[0]->item_cost_total,
		                        'item_cost_per_unit'=>$item_info[0]->item_cost_per_unit,
		                        'item_cost_total'=>$item_info[0]->item_cost_total,
		                        'item_heading'=>$item_info[0]->item_heading,
		                        'item_notes'=>$item_info[0]->item_notes,
		                         'created_by' => 1,
									'created_on' => date("Y-m-d"));
			$this->data['item_id']=$item_id;
								  
		
		}
			
		$this->data['dep_id']=$dep_id;
	    $this->data['chap_id']=$chap_id;
	    $this->data['item_class_id']=$chap_id;
		//Breadcrumb section start
			$this->breadcrumb->clear();
		    $this->breadcrumb->add_crumb('Home', base_url());
		     $this->breadcrumb->add_crumb('Department', base_url().'index.php/home');
		    $this->breadcrumb->add_crumb('Chapter','');
		    $this->breadcrumb->add_crumb('Items','');
		   
		//Breadcrumb section end
		//print_r($this->data);die;
		$this->data['dep'] = $this->mhome->get_deplist('ssr_t_department');	
		$this->data['chap'] = $this->mhome->get_chapist('ssr_t_chapter');
		$this->data['unit_list'] = $this->mhome->get_unitlist();
		//echo"sds";die;	
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->parser->parse('add_item',$this->data);
		$this->parser->parse('include/footer',$this->data);
	 }
	 }
	function add_item(){
		if($this->is_logged_in()){
			redirect('login');
		}else{
			//print_r($_POST);die; 
					if($this->input->post('submit')){
						//print_r($_POST);die;
						if($this->input->post('id')){
							  $comma_separated = implode(",", $this->input->post('item_class_id'));
							  		//  $item_info = $this->mhome->get_item_list($filter,'ssr_t_item');

			            $info = array('dep_id'=>$this->input->post('dep_id'),
						                   'chap_id'=>$this->input->post('chap_id'),
						                   'item_class_id' => $comma_separated,
																	                    //'item_class_id' =>$this->input->post('item_class_id'),
								                                               //'item_class_id' =>$item_info[0]->item_class_id,

										   'item_name'=>$this->input->post('item_name'),
										    'item_desc'=>$this->input->post('item_desc'),
											'unit_code'=>$this->input->post('unit_code'),
		                                   'item_qty_base'=>$this->input->post('item_qty_base'),
		                                   'item_cost_total'=>$this->input->post('item_cost_total'),
		                                   'item_cost_per_unit'=>$this->input->post('item_cost_per_unit'),
		                                   'item_cost_total'=>$this->input->post('item_cost_total'),
		                                   'item_notes'=>$this->input->post('item_notes'),
		                                   	 'created_by' => 1,
												'created_on' => date("Y-m-d"));
										
							$this->mhome->update_item($info,array('item_id'=>$this->input->post('id')));
								
							$this->session->set_flashdata('message_type', 'success');        
							$this->session->set_flashdata('message', $this->config->item("item").' updated successfully');
					
	                 }else{
						   //print_r($_POST);die;
					       $comma_separated = implode(",", $this->input->post('item_class_id'));
                          // print_r($comma_separated);die;
		                  
					       $info = array('dep_id'=>$this->input->post('dep_id'),
						                   'chap_id'=>$this->input->post('chap_id'),
						                    'item_class_id' => $comma_separated,
										   'item_name'=>$this->input->post('item_name'),
										    'item_desc'=>$this->input->post('item_desc'),
											'unit_code'=>$this->input->post('unit_code'),
		                  
						  'item_qty_base'=>$this->input->post('item_qty_base'),
		                                   'item_cost_total'=>$this->input->post('item_cost_total'),
		                                   'item_cost_per_unit'=>$this->input->post('item_cost_per_unit'),
		                                   'item_cost_total'=>$this->input->post('item_cost_total'),
		                                   'item_notes'=>$this->input->post('item_notes'),
		                                   'created_by' => 1,
										   'created_on' => date("Y-m-d"));
												
								  $item_class_id = $this->input->post('item_class_id');
									//print_r($info);die;
							
											 $c_id=$this->mhome->manage_item($info);
											
																
						  }   
					
					if($this->input->post('id')){
						redirect('home/item/'.$this->input->post('dep_id').'/'.$this->input->post('chap_id'));
					}else{
						$this->session->set_flashdata('message_type', 'success');        
                        $this->session->set_flashdata('message', $this->config->item("item").' Added successfully');
								redirect('home/item/'.$this->input->post('dep_id').'/'.$this->input->post('chap_id'));	
					}
				}
             }
	}
	public function manage_item($id=false){
		if($this->is_logged_in()){
			redirect('login');
		}else{
			
	  $this->data['dep'] = $this->mhome->get_deplist('ssr_t_department');			
			//print_r($this->data);die;
			//Breadcrumb section start
			$this->breadcrumb->clear();
		    $this->breadcrumb->add_crumb('Home', base_url());
		    $this->breadcrumb->add_crumb('Departments', base_url().'index.php/home');
		    $this->breadcrumb->add_crumb('Chapters','');
		    $this->breadcrumb->add_crumb('Items','');
		   
		//Breadcrumb section end
			$this->parser->parse('include/header',$this->data);
			$this->parser->parse('include/leftmenu',$this->data);
			$this->parser->parse('manage_item',$this->data);
			$this->parser->parse('include/footer',$this->data);		
		}	
			
	} 
  public function subitem_list($id=false){
	  if($this->is_logged_in()){
			redirect('login');
		}else{
   $this->data['dep'] = $this->mhome->get_deplist('ssr_t_department');	
		
		
		//print_r($this->data);die;
		//Breadcrumb section start
			$this->breadcrumb->clear();
		    $this->breadcrumb->add_crumb('Home', base_url());
		    $this->breadcrumb->add_crumb('Departments', base_url().'index.php/home');
		    $this->breadcrumb->add_crumb('Chapters','');
		    $this->breadcrumb->add_crumb('Items','');
		    $this->breadcrumb->add_crumb('Subitems','');
		   
		//Breadcrumb section end
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->parser->parse('manage_subitem',$this->data);
		$this->parser->parse('include/footer',$this->data);		
		
		}
 }	
 public function manage_subitem($dep_id=false,$chap_id=false,$item_id=false,$subitem_id=false)
	 {
		 if($this->is_logged_in()){
			redirect('login');
		}
		elseif($this->check_authority('manage_subitem'))
		{
			redirect('home/item/'.$dep_id.'/'.$chap_id.'/'.$item_id);
		}
		else{
	   if($subitem_id){
			$filter = array('subitem_id'=>$subitem_id);
		
		   $subitem_info = $this->mhome->get_list($filter,'ssr_t_subitem');
		   $this->data = array('dep_id'=>$subitem_info[0]->dep_id,
		                         'chap_id'=>$subitem_info[0]->chap_id,
		                          'item_id'=>$subitem_info[0]->item_id,
		                          'subitem_name'=>$subitem_info[0]->subitem_name,
		                          'subitem_desc'=>$subitem_info[0]->subitem_desc,
		                         'unit_code'=>$subitem_info[0]->unit_code,
		                         'rate'=>$subitem_info[0]->rate,
		                         'subitem_class_id'=>$subitem_info[0]->subitem_class_id,
		                        'subitem_heading'=>$subitem_info[0]->subitem_heading,
		                        'subitem_notes'=>$subitem_info[0]->subitem_notes,
		                          'created_by' => 1,
									'created_on' => date("Y-m-d"));
			$this->data['subitem_id']=$subitem_id;
								  
		
		}
		//Breadcrumb section start
			$this->breadcrumb->clear();
		    $this->breadcrumb->add_crumb('Home', base_url());
		    $this->breadcrumb->add_crumb('Departments',base_url().'index.php/home');
		    $this->breadcrumb->add_crumb('Chapters','');
		    $this->breadcrumb->add_crumb('Items','');
		    $this->breadcrumb->add_crumb('Subitems','');
		   
		//Breadcrumb section end
		 $this->data['unit_list'] = $this->mhome->get_unitlist();
		  $this->data['dep'] = $this->mhome->get_deplist('ssr_t_department');
	    $this->data['chap_id']=$chap_id;
	    $this->data['dep_id']=$dep_id;
	    $this->data['item_id']=$item_id;
	      $filter = array('dep_id'=>$dep_id,'chap_id'=>$chap_id,'item_id'=>$item_id);
	   $this->data['item_list'] = $this->mhome->get_item_list($filter,'ssr_t_item');	
	
		$class_ids=$this->data['item_list'][0]->item_class_id;
		 
	    $this->data['chap'] = $this->mhome->get_chapist('ssr_t_chapter');
	    $this->data['item_cls_list']=$this->mhome->get_item_cls_list($class_ids);
		//print_r($this->data);die;
		
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->parser->parse('create_subitem',$this->data);
		$this->parser->parse('include/footer',$this->data);
		
	 }
	 }	 
	 function add_subitem(){
		 if($this->is_logged_in()){
			redirect('login');
		}else{
			//print_r($_POST);die;
			if($this->input->post('submit')){
					
						$data = $this->input->post();
		        
		//print_r($data);die;
		$value = "";
		if($this->input->post('subitem_id')){
			//echo"e";die;
			
					    $info = array( 'subitem_name'=>$this->input->post('subitem_name'),
										'subitem_desc' => $this->input->post('subitem_desc'),
										'unit_code' => $this->input->post('unit_code'),
										'rate' => $this->input->post('rate'),
										'subitem_class_id' => $this->input->post('subitem_class_id'),
										'subitem_heading' => $this->input->post('subitem_heading'),
										'subitem_notes' => $this->input->post('subitem_notes'));
										
										
							$this->mhome->update_subitem($info,array('subitem_id'=>$this->input->post('subitem_id')));
								
							$this->session->set_flashdata('message_type', 'success');        
							$this->session->set_flashdata('message', 'Subitem updated successfully');
							redirect("home/get_subitem_list/".$data['dep_id']."/".$data['chap_id']."/".$data['item_id']);
		  
		}else{
		
		for($i=0;$i<=count($data['subitem_name'])-1; $i++){
			
				$value .= "('".$data['dep_id']."','".$data['chap_id']."','".$data['item_id']."','".$data['subitem_name'][$i]."','".$data['subitem_desc'][$i]."','".$data['unit_code'][$i]."','".$data['subitem_class_id'][$i]."','".$data['rate'][$i]."','".$data['subitem_heading'][$i]."','".$data['subitem_notes'][$i]."')".","; 
			}
			
			
				if($this->mhome->manage_sitem(rtrim($value,","))){
					#echo "Menus Added Sucessfully";
					$this->session->set_flashdata('message_type', 'success');        
                        $this->session->set_flashdata('message', 'Subitem Added successfully');
					//redirect("home/manage_subitem");
					redirect("home/get_subitem_list/".$data['dep_id']."/".$data['chap_id']."/".$data['item_id']);
					
				}else{
					echo "Error while Adding SubItem";
				}
		}
    }
}
	 }	
  public function material()
	{   
	if($this->is_logged_in()){
			redirect('login');
		}else{
	$this->check_authority('material');
	$this->data['mat_list'] = $this->mhome->get_material_list();	
		 $this->data['unit_list'] = $this->mhome->get_unitlist();
		//print_r($this->data['mat_list']);die;
		//Breadcrumb section start
	    $this->breadcrumb->clear();
	    $this->breadcrumb->add_crumb('Home', base_url());
	    $this->breadcrumb->add_crumb('Deshboard', base_url().'index.php/home');
	    $this->breadcrumb->add_crumb('Material', '');
	
	//Breadcrumb section end
		//Templets load section
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->load->view('material_list',$this->data);
		$this->parser->parse('include/footer',$this->data);
	}
	}
	 public function manage_material($mat_code=false)
	 {  
	 if($this->is_logged_in()){
			redirect('login');
		}
		elseif($this->check_authority('manage_material')==true)
			{
					redirect('home/material');
			}
		else{
		 	
		// print_r($this->data['class_list']);die;
		if($mat_code){
			$filter = array('mat_code'=>$mat_code);
		
		   $material_info = $this->mhome->get_list($filter,'ssr_t_material');
		   $this->data['material_info'] = $this->mhome->get_list($filter,'ssr_t_material');
		   //print_r($this->data['material_info']);die;
		   $this->data = array('mat_name'=>$material_info[0]->mat_name,
		                         'mat_desc'=>$material_info[0]->mat_desc,
		                         'material_class_id'=>$material_info[0]->material_class_id,
								 'unit_code'=>$material_info[0]->unit_code,
								 'rate'=>$material_info[0]->rate,
		                          'created_by' => 1,
									'created_on' => date("Y-m-d"));
			$this->data['mat_code']=$mat_code;
								  
		
		}else{
			 $this->data['material_info']='';
			
		}
		///Breadcrumb section start
	    $this->breadcrumb->clear();
	    $this->breadcrumb->add_crumb('Home', base_url());
	    $this->breadcrumb->add_crumb('Deshboard', base_url().'index.php/home');
	    $this->breadcrumb->add_crumb('Material', base_url().'index.php/home/labour');
	    $this->breadcrumb->add_crumb('Manage Material', base_url().'index.php/home/material');
	//Breadcrumb section end
		//print_r($this->data);die;
		$this->data['unit_list'] = $this->mhome->get_unitlist(); 
		 $this->data['class_list'] = $this->mhome->get_class_list();
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->parser->parse('add_material',$this->data);
		$this->parser->parse('include/footer',$this->data);
	 }
	 }
	 function add_material(){
		 if($this->is_logged_in()){
			redirect('login');
		}else{
   if($this->input->post('submit')){
					
						$data = $this->input->post();
		        
		
		$value = "";
		if($this->input->post('id')){
			//echo"e";die;
			
					    $info = array( 'mat_name'=>$this->input->post('mat_name'),
										'mat_desc' => $this->input->post('mat_desc'),
										'material_class_id' => $this->input->post('material_class_id'),
										'unit_code' => $this->input->post('unit_code'),
										'rate' => $this->input->post('rate'),
										'created_by' => 1,
										'created_on' => date("Y-m-d"),
										'updated_by' => 1,
										'updated_on' => date("Y-m-d"));
										
										
							$this->mhome->update_material($info,array('mat_code'=>$this->input->post('id')));
								
							$this->session->set_flashdata('message_type', 'success');        
							$this->session->set_flashdata('message', $this->config->item("material").' updated successfully');
							redirect("home/material");
		  
		}else{
				//echo"a";die;
			
					for($i=0;$i<=count($data['mat_name'])-1; $i++){
						
							$value .= "('".$data['mat_name'][$i]."','".$data['mat_desc'][$i]."','".$data['material_class_id'][$i]."','".$data['unit_code'][$i]."','".$data['rate'][$i]."')".","; 
						}
						//print_r($value);die;
						
							if($this->mhome->manage_material(rtrim($value,","))){
							  $this->session->set_flashdata('message_type', 'success');        
							$this->session->set_flashdata('message', $this->config->item("material").' Added successfully');
								redirect("home/material");
								
							}else{
								echo "Error while Adding Material";
							}
		   }	
     }
 }
	 }
 public function labour()
	{   
if($this->is_logged_in()){
			redirect('login');
		}else{
			$this->check_authority('labour');
	$this->data['labour_list'] = $this->mhome->get_labour_list();	
	
		 $this->data['unitlist'] = $this->mhome->get_unitlist();
		
		//print_r($this->data['labour_list']);die;
		//Breadcrumb section start
	    $this->breadcrumb->clear();
	    $this->breadcrumb->add_crumb('Home', base_url());
	    $this->breadcrumb->add_crumb('Deshboard', base_url().'index.php/home');
	    $this->breadcrumb->add_crumb('Labour', '');
	
	//Breadcrumb section end
	
		
		//Templets load section
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->load->view('labour_list',$this->data);
		$this->parser->parse('include/footer',$this->data);
	} 
	}
	 public function manage_labour($labour_code=false)
	 {
		 if($this->is_logged_in()){
			redirect('login');
		}
		elseif($this->check_authority('manage_labour')==true)
			{
					redirect('home/labour');
			}
		else{
	    $this->data['unit_list'] = $this->mhome->get_unitlist(); 
		if($labour_code){
			$filter = array('labour_code'=>$labour_code);
		
		   $labour_info = $this->mhome->get_list($filter,'ssr_t_labor');
		   $this->data = array('labour_name'=>$labour_info[0]->labour_name,
		                         'labour_description'=>$labour_info[0]->labour_description,
								 'unit_code'=>$labour_info[0]->unit_code,
								 'labour_rate'=>$labour_info[0]->labour_rate,
		                          'created_by' => 1,
									'created_on' => date("Y-m-d"));
			$this->data['labour_code']=$labour_code;
								  
		
		}
		//Breadcrumb section start
	    $this->breadcrumb->clear();
	    $this->breadcrumb->add_crumb('Home', base_url());
	    $this->breadcrumb->add_crumb('Deshboard', base_url().'index.php/home');
	    $this->breadcrumb->add_crumb('Labour', base_url().'index.php/home/labour');
	    $this->breadcrumb->add_crumb('Manage Labour', base_url().'index.php/home/labour');
	//Breadcrumb section end
		//print_r($this->data);die;
		
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->parser->parse('add_labour',$this->data);
		$this->parser->parse('include/footer',$this->data);
	 } 
	 }
 function add_labour(){
	 if($this->is_logged_in()){
			redirect('login');
		}else{
				//print_r($_POST);die;
					if($this->input->post('submit')){
					
						$data = $this->input->post();
		        
		
				$value = "";
					if($this->input->post('id')){
			//echo"e";die;
			
					    $info = array( 'labour_name'=>$this->input->post('labour_name'),
										'labour_description' => $this->input->post('labour_description'),
										'unit_code' => $this->input->post('unit_code'),
										'labour_rate' => $this->input->post('labour_rate'),
										'created_by' => 1,
										'created_on' => date("Y-m-d"),
										'updated_by' => 1,
										'updated_on' => date("Y-m-d"));
										
										
							$this->mhome->update_labour($info,array('labour_code'=>$this->input->post('id')));
								
							$this->session->set_flashdata('message_type', 'success');        
							$this->session->set_flashdata('message', $this->config->item("labour").' updated successfully');
							redirect("home/labour");
		  
		}else{
				//echo"a";die;
			
					for($i=0;$i<=count($data['labour_name'])-1; $i++){
						
							$value .= "('".$data['labour_name'][$i]."','".$data['labour_description'][$i]."','".$data['unit_code'][$i]."','".$data['labour_rate'][$i]."')".","; 
						}
						//print_r($value);die;
						
							if($this->mhome->manage_labour(rtrim($value,","))){
								$this->session->set_flashdata('message_type', 'success');        
							$this->session->set_flashdata('message', $this->config->item("labour").' Added successfully');
							
								redirect("home/labour");
								
							}else{
								echo "Error while Adding Labour";
							}
		   }	
         }
 }
 }
 
  public function overhead()
	{   
		if($this->is_logged_in()){
			redirect('login');
		}else{
			$this->check_authority('overhead');
		 $this->data['overhead_list'] = $this->mhome->get_overhead_list();	
		
		//print_r($this->data['overhead_list']);die;
			//Breadcrumb section start
	     $this->breadcrumb->clear();
	    $this->breadcrumb->add_crumb('Home', base_url());
	    $this->breadcrumb->add_crumb('Deshboard', base_url().'index.php/home');
	    $this->breadcrumb->add_crumb('Overhead', base_url());
	
	//Breadcrumb section end
		
		//Templets load section
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->load->view('overhead_list',$this->data);
		$this->parser->parse('include/footer',$this->data);
	}
	}
public function manage_overhead($overhead_code=false)
	 {
		 if($this->is_logged_in()){
			redirect('login');
		}
		elseif($this->check_authority('manage_overhead')==true)
			{
					redirect('home/overhead');
			}
		else{
	   
		if($overhead_code){
			$filter = array('overhead_code'=>$overhead_code);
		
		   $overhead_info = $this->mhome->get_list($filter,'ssr_t_overhead');
		   $this->data = array('overhead_name'=>$overhead_info[0]->overhead_name,
		                         'overhead_desc'=>$overhead_info[0]->overhead_desc,
								 'overhead_percent'=>$overhead_info[0]->overhead_percent,
								  'created_by' => 1,
									'created_on' => date("Y-m-d"));
			$this->data['overhead_code']=$overhead_code;
								  
		
		}
		//Breadcrumb section start
	    $this->breadcrumb->clear();
	    $this->breadcrumb->add_crumb('Home', base_url());
	    $this->breadcrumb->add_crumb('Deshboard', base_url().'index.php/home');
	    $this->breadcrumb->add_crumb('Overhead', base_url().'index.php/home/unit');
	    $this->breadcrumb->add_crumb('Manage Overhead', base_url().'index.php/home/unit');
	//Breadcrumb section end
		//print_r($this->data);die;
		
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->parser->parse('add_overhaed',$this->data);
		$this->parser->parse('include/footer',$this->data);
	 }
	 }
  function add_overhead(){
		if($this->is_logged_in()){
			redirect('login');
		}else{
					//print_r($_POST);die;
		if($this->input->post('submit')){
				
						$data = $this->input->post();
		        
		
		          $value = "";	
							if($this->input->post('id')){
			          $info = array( 'overhead_name'=>$this->input->post('overhead_name'),
										'overhead_desc' => $this->input->post('overhead_desc'),
										'overhead_percent' => $this->input->post('overhead_percent'),
										
										'created_by' => 1,
										'created_on' => date("Y-m-d"),
										'updated_by' => 1,
										'updated_on' => date("Y-m-d"));
										
										
							$this->mhome->update_overhead($info,array('overhead_code'=>$this->input->post('id')));
								
							$this->session->set_flashdata('message_type', 'success');        
							$this->session->set_flashdata('message', $this->config->item("overhead").' updated successfully');
							redirect("home/overhead");
							
		        } else {
							for($i=0;$i<=count($data['overhead_name'])-1; $i++){
						
							$value .= "('".$data['overhead_name'][$i]."','".$data['overhead_desc'][$i]."','".$data['overhead_percent'][$i]."')".","; 
							  }       
						
						
							if($this->mhome->manage_overhead(rtrim($value,","))){
						    $this->session->set_flashdata('message_type', 'success');        
							$this->session->set_flashdata('message', $this->config->item("overhead").' Added successfully');
								redirect("home/overhead");
								
							}else{
								echo "Error while Adding Overhead";
							}
		         }
		  } 	
  }	
  }
  public function unit()
	{   
		if($this->is_logged_in()){
			redirect('login');
		}
		
		else{
			$this->check_authority('unit');
		 $this->data['unit_list'] = $this->mhome->get_unit_list();	
		
		//print_r($this->data['overhead_list']);die;
		//Breadcrumb section start
	    $this->breadcrumb->clear();
	    $this->breadcrumb->add_crumb('Home', base_url());
	    $this->breadcrumb->add_crumb('Deshboard', base_url().'index.php/home');
	    $this->breadcrumb->add_crumb('Unit', '');
	    
	
	//Breadcrumb section end
		
		//Templets load section
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->load->view('unit_list',$this->data);
		$this->parser->parse('include/footer',$this->data);
	}
	}
public function manage_unit($unit_code=false)
	 {
	   if($this->is_logged_in()){
			redirect('login');
		}
		elseif($this->check_authority('manage_unit')==true)
			{
					redirect('home/unit');
			}
		else{
		if($unit_code){
			$unit_code=urldecode($unit_code);
			$filter = array('unit_code'=>$unit_code);
			
		   $unit_info = $this->mhome->get_list($filter,'ssr_t_uom');
		   $this->data = array(
                                 'unit_code'=>$unit_info[0]->unit_code,
		                         'unit_desc'=>$unit_info[0]->unit_desc,
						           'created_by' => 1,
									'created_on' => date("Y-m-d"));
			$this->data['unit_code']=urldecode($unit_code);
								  
		
		}
		//Breadcrumb section start
	    $this->breadcrumb->clear();
	    $this->breadcrumb->add_crumb('Home', base_url());
	    $this->breadcrumb->add_crumb('Deshboard', base_url().'index.php/home');
	    $this->breadcrumb->add_crumb('Unit', base_url().'index.php/home/unit');
	    $this->breadcrumb->add_crumb('Manage Unit','');
	    
	
	//Breadcrumb section end
		//print_r($this->data);die;
		
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->parser->parse('add_unit',$this->data);
		$this->parser->parse('include/footer',$this->data);
	 }	
	 }
	  function add_unit(){
		if($this->is_logged_in()){
			redirect('login');
		}else{
					//print_r($_POST);die;
		if($this->input->post('submit')){
				
						$data = $this->input->post();
		        
		
		          $value = "";	
							if($this->input->post('id')){
			          $info = array( 'unit_code'=>$this->input->post('unit_code'),
										'unit_desc' => $this->input->post('unit_desc'),
										'created_by' => 1,
										'created_on' => date("Y-m-d"),
										'updated_by' => 1,
										'updated_on' => date("Y-m-d"));
										
										
							$this->mhome->update_unit($info,array('unit_code'=>$this->input->post('id')));
								
							$this->session->set_flashdata('message_type', 'success');        
							$this->session->set_flashdata('message', 'Unit updated successfully');
							redirect("home/unit");
							
		        } else {
							for($i=0;$i<=count($data['unit_code'])-1; $i++){
						
							$value .= "('".$data['unit_code'][$i]."','".$data['unit_desc'][$i]."')".","; 
							  }       
						
						
							if($this->mhome->manage_unit(rtrim($value,","))){
								$this->session->set_flashdata('message_type', 'success');        
							$this->session->set_flashdata('message', 'Unit Added successfully');
								redirect("home/unit");
								
							}else{
								echo "Error while Adding Unit";
							}
		         }
		  } 	
  }	
	  }
  public function create_sub_item($dep_id=false,$chap_id=false,$item_id=false,$subitem_id=false,$class_id=false)
	{  
	if($this->is_logged_in()){
			redirect('login');
		}
		elseif($this->check_authority('create_sub_item'))
		{
			redirect('home/item/'.$dep_id.'/'.$chap_id.'/'.$item_id);
		}
		else{
		       $this->data['dep_id'] = $dep_id;
		       $this->data['chap_id'] = $chap_id;
		       $this->data['item_id'] = $item_id;
		       $this->data['subitem_id'] = $subitem_id;
		       $this->data['class_id'] = $class_id;
		    //  print_r("fh");die;
		$filter = array('subitem_id'=>$subitem_id);
		//print_r($filter);die;;
		$this->data['subitem_costing'] = $this->mhome->get_list($filter,'ssr_t_calculation');
		//print_r($subitem_costing);
		//print_r( $this->data['subitem_costing']);die;
		$filter = array('dep_id'=>$dep_id);
	    $this->data['dep_detail'] = $this->mhome->get_list($filter,'ssr_t_department');
		$filter = array('chap_id'=>$chap_id);
	    $this->data['chap_detail'] = $this->mhome->get_list($filter,'ssr_t_chapter');
		$filter = array('item_id'=>$item_id);
	    $this->data['item_detail'] = $this->mhome->get_item_list($filter,'ssr_t_item');
	    $filter = array('subitem_id'=>$subitem_id);
	    $this->data['subitem_detail'] = $this->mhome->get_list($filter,'ssr_t_subitem');
		
		//Breadcrumb section start
			$this->breadcrumb->clear();
		    $this->breadcrumb->add_crumb('Home', base_url());
		    $this->breadcrumb->add_crumb($this->data['dep_detail'][0]->dep_name, base_url());
		    $this->breadcrumb->add_crumb($this->data['chap_detail'][0]->chap_name, base_url().'index.php/home/chapter/'.$dep_id);
		    $this->breadcrumb->add_crumb($this->data['item_detail'][0]->item_name, base_url().'index.php/home/item/'.$dep_id.'/'.$chap_id);
		    $this->breadcrumb->add_crumb($this->data['subitem_detail'][0]->subitem_name, base_url().'index.php/home/item/'.$dep_id.'/'.$chap_id);
		//Breadcrumb section end
		//print_r($this->data['chap_list']);die;
                   $this->data['subitem_des'] = $this->data['subitem_detail'][0]->subitem_desc;
                   $this->data['class_id'] = $this->data['subitem_detail'][0]->subitem_class_id;
		 $this->data['cost_type'] = $this->mhome->get_costtype('ssr_t_cost_type');
		 $this->data['code_type'] = $this->mhome->get_code('ssr_t_calculation');
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->load->view('subitem_cal',$this->data);
		$this->parser->parse('include/footer',$this->data);
	}
	}
	public function create_sub_cal()
	{  
	if($this->is_logged_in()){
			redirect('login');
		}else{
		
		$data = $this->input->post();
		//print_r($data);die;
		
		$value = "";
		if($this->input->post('edit_costing')==1){
			
			for($i=0;$i<=count($data['code'])-1; $i++){
				
				
				
				$value .= "('".$data['dep_id']."','".$data['chap_id']."','".$data['item_id']."','".$data['subitem_id']."','".$data['class_id']."',".$data['serial'][$i].",'".$data['item_type'][$i]."','".$data['item_desc'][$i]."','".$data['code'][$i]."','".$data['unit_code'][$i]."','".$data['amount'][$i]."','".$data['total_amount'][$i]."','".$data['quantity'][$i]."','".$data['rate'][$i]."')".",";
			}
			
			if($this->mhome->update_subitem_cal(rtrim($value,","),$data['final_total'],$data['dep_id'],$data['chap_id'],$data['item_id'],$data['subitem_id'])){
				redirect("home/get_subitem_list/".$data['dep_id']."/".$data['chap_id']."/".$data['item_id']);
				
			}else{
				echo "Error while Editing SubItem";
			}
		} else {
			//echo "add"; die;
		for($i=0;$i<=count($data['code'])-1; $i++){
			
				$value .= "('".$data['dep_id']."','".$data['chap_id']."','".$data['item_id']."','".$data['subitem_id']."','".$data['class_id']."',".$data['serial'][$i].",'".$data['item_type'][$i]."','".$data['item_desc'][$i]."','".$data['code'][$i]."','".$data['unit_code'][$i]."','".$data['amount'][$i]."','".$data['total_amount'][$i]."','".$data['quantity'][$i]."','".$data['rate'][$i]."')".",";
			}
			//print_r($data['final_total']);die;
			
			if($this->mhome->manage_subitem_cal(rtrim($value,","),$data['final_total'],$data['subitem_id'],$data['item_id'])){
					
				redirect("home/get_subitem_list/".$data['dep_id']."/".$data['chap_id']."/".$data['item_id']);
				
			}else{
				echo "Error while Adding SubItem";
			}
		}
       		
	}
	}
 function readExcel()
	{
		if($this->is_logged_in()){
			redirect('login');
		}else{
			$this->load->library('csvreader');
			$result =   $this->csvreader->parse_file('Test.csv');//path to csv file

			$data['csvData'] =  $result;
			$this->load->view('view_csv', $data);  
	}
	}	
/*added by palak on 2 feb*/
/*started*/
public function carriage()
	{   
if($this->is_logged_in()){
			redirect('login');
		}else{
		$this->check_authority('carriage');
	$this->data['carriage_list'] = $this->mhome->get_carriage_list();	
		 $this->data['unitlist'] = $this->mhome->get_unitlist();
		
		//print_r($this->data['carriage_list']);die;
		   //Breadcrumb section start
	    $this->breadcrumb->clear();
	    $this->breadcrumb->add_crumb('Home', base_url());
	    $this->breadcrumb->add_crumb('Deshboard', base_url().'index.php/home');
	    $this->breadcrumb->add_crumb('Carriage', '');
	   
	
	//Breadcrumb section end
		//Templets load section
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->load->view('carriage_list',$this->data);
		$this->parser->parse('include/footer',$this->data);
		}} 
	 public function manage_carriage($carriage_id=false)
	 {
		 if($this->is_logged_in()){
			redirect('login');
		}
		
		elseif($this->check_authority('manage_carriage')==true)
			{
			//echo"elseif";die;
					redirect('home/carriage');
			}
		else{
	    
		if($carriage_id){
			$filter = array('carriage_id'=>$carriage_id);
		
		   $carriage_info = $this->mhome->get_list($filter,'ssr_t_carriage');
		   $this->data = array('carriage_code'=>$carriage_info[0]->carriage_code,
		                         'carriage_description'=>$carriage_info[0]->carriage_description,
		                         'carriage_category'=>$carriage_info[0]->carriage_category,
		                         'carriage_sub_category'=>$carriage_info[0]->carriage_sub_category,
								 'unit_code'=>$carriage_info[0]->unit_code,
								 'carriage_rate'=>$carriage_info[0]->carriage_rate,
		                          'created_by' => 1,
									'created_on' => date("Y-m-d"));
			$this->data['carriage_id']=$carriage_id;
								  
		}
	//Breadcrumb section start
	    $this->breadcrumb->clear();
	    $this->breadcrumb->add_crumb('Home', base_url());
	    $this->breadcrumb->add_crumb('Deshboard', base_url().'index.php/home');
	    $this->breadcrumb->add_crumb('Carriage', base_url().'index.php/home/carriage');
	    $this->breadcrumb->add_crumb('Manage Carriage','');
	
	//Breadcrumb section end
		//print_r($this->data);die;
		$this->data['unit_list'] = $this->mhome->get_unitlist(); 
		$this->data['catlist'] = $this->mhome->get_catlist(); 
		$this->data['subcate'] = $this->mhome->get_subcate();
		
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->parser->parse('add_carriage',$this->data);
		$this->parser->parse('include/footer',$this->data);
	 }
	 }	 
 function add_carriage(){
	 if($this->is_logged_in()){
			redirect('login');
		}else{
				//print_r($_POST);die;
					if($this->input->post('submit')){
					
						$data = $this->input->post();
		        
		
				$value = "";
					if($this->input->post('carriage_id')){
			//echo"e";die;
			
					    $info = array( 'carriage_code'=>$this->input->post('carriage_code'),
										'carriage_description' => $this->input->post('carriage_description'),
										'carriage_category' => $this->input->post('carriage_category'),
										'carriage_sub_category' => $this->input->post('carriage_sub_category'),
										'unit_code' => $this->input->post('unit_code'),
										'carriage_rate' => $this->input->post('carriage_rate'),
										'created_by' => 1,
										'created_on' => date("Y-m-d"),
										'updated_by' => 1,
										'updated_on' => date("Y-m-d"));
										
										
							$this->mhome->update_carriage($info,array('carriage_id'=>$this->input->post('carriage_id')));
								
							$this->session->set_flashdata('message_type', 'success');        
							$this->session->set_flashdata('message', $this->config->item("carriage").' updated successfully');
							redirect("home/carriage");
		  
		}else{
				//echo"a";die;
			
					for($i=0;$i<=count($data['carriage_code'])-1; $i++){
						
							$value .= "('".$data['carriage_code'][$i]."','".$data['carriage_description'][$i]."','".$data['carriage_category'][$i]."','".$data['carriage_sub_category'][$i]."','".$data['unit_code'][$i]."','".$data['carriage_rate'][$i]."')".","; 
						}
						//print_r($value);die;
						
							if($this->mhome->manage_carriage(rtrim($value,","))){
							$this->session->set_flashdata('message_type', 'success');        
							$this->session->set_flashdata('message', 'carriage Added successfully');
								redirect("home/carriage");
								
							}else{
								echo "Error while Adding carriage";
							}
		   }	
         }
 }
 }
	public function plant()
	{    
	if($this->is_logged_in()){
			redirect('login');
		}else{
	$this->check_authority('plant');
	$this->data['plan_list'] = $this->mhome->get_plan_list();	
		 $this->data['unitlist'] = $this->mhome->get_unitlist();
		
		//print_r($this->data['labour_list']);die;
		//Breadcrumb section start
	    $this->breadcrumb->clear();
	    $this->breadcrumb->add_crumb('Home', base_url());
	    $this->breadcrumb->add_crumb('Deshboard', base_url().'index.php/home');
	    $this->breadcrumb->add_crumb('Plant', '');
	
	//Breadcrumb section end
	
		
		//Templets load section
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->load->view('plant_list',$this->data);
		$this->parser->parse('include/footer',$this->data);
	}
	}	
	 public function manage_plant($plan_code=false)
	 {
		 if($this->is_logged_in()){
			redirect('login');
		}
		elseif($this->check_authority('manage_plant')==true)
			{
			//echo"elseif";die;
					redirect('home/plant');
			}
		else{
	    $this->data['unit_list'] = $this->mhome->get_unitlist(); 
		if($plan_code){
			$filter = array('pla_code'=>$plan_code);
		
		   $paln_info = $this->mhome->get_list($filter,'ssr_t_plant');
		 //  print_r($plan_code);die;
		   $this->data = array('pla_code'=>$paln_info[0]->pla_code,
		                         'pla_desc'=>$paln_info[0]->pla_desc,
								 'unit_code'=>$paln_info[0]->unit_code,
								 'rate'=>$paln_info[0]->rate,
		                          'created_by' => 1,
									'created_on' => date("Y-m-d"));
			$this->data['plan_code']=$plan_code;
								  
		
		}
		//Breadcrumb section start
	    $this->breadcrumb->clear();
	    $this->breadcrumb->add_crumb('Home', base_url());
	    $this->breadcrumb->add_crumb('Deshboard', base_url().'index.php/home');
	    $this->breadcrumb->add_crumb('Plant', base_url().'index.php/home/plant');
	    $this->breadcrumb->add_crumb('Manage Plant', '');
	
	//Breadcrumb section end
		//print_r($this->data);die;
		
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->parser->parse('add_plant',$this->data);
		$this->parser->parse('include/footer',$this->data);
	 } 
	 }
 function add_plant(){
	 if($this->is_logged_in()){
			redirect('login');
		}else{
				//print_r($_POST);die;
					if($this->input->post('submit')){
					
						$data = $this->input->post();
		        
		
				$value = "";
					if($this->input->post('id')){
			//echo"e";die;
			
					    $info = array( 'pla_code'=>$this->input->post('pla_code'),
										'pla_desc' => $this->input->post('pla_desc'),
										'unit_code' => $this->input->post('unit_code'),
										'rate' => $this->input->post('rate'),
										'created_by' => 1,
										'created_on' => date("Y-m-d"),
										'updated_by' => 1,
										'updated_on' => date("Y-m-d"));
										
										
							$this->mhome->update_plant($info,array('pla_code'=>$this->input->post('id')));
								
							$this->session->set_flashdata('message_type', 'success');        
							$this->session->set_flashdata('message', $this->config->item("Plan").' updated successfully');
							redirect("home/plant");
		  
		}else{
				//echo"a";die;
			
					for($i=0;$i<=count($data['pla_code'])-1; $i++){
						
							$value .= "('".$data['pla_code'][$i]."','".$data['pla_desc'][$i]."','".$data['unit_code'][$i]."','".$data['rate'][$i]."')".","; 
						}
						//print_r($value);die;
						
							if($this->mhome->manage_plant(rtrim($value,","))){
							$this->session->set_flashdata('message_type', 'success');        
							$this->session->set_flashdata('message', $this->config->item("Plan").' Added successfully');
								redirect("home/plant");
								
							}else{
								echo "Error while Adding Labour";
                                                                 redirect("home/plant");

							}
		   }	
         }
 } 
 }
function get_subitem_list($dep_id=false,$chap_id=false,$item_id=false){
	       if($this->is_logged_in()){
			redirect('login');
		}
		
		else{
			$this->check_authority('get_subitem_list');
		       $this->data['dep_id'] = $dep_id;
		       $this->data['chap_id'] = $chap_id;
		       $this->data['item_id'] = $item_id;
			$filter = array('dep_id'=> $dep_id,
			                'chap_id'=>$chap_id,
							'item_id'=>$item_id);
			$this->data['subitem_list'] = $this->mhome->get_list($filter,'ssr_t_subitem');
			
			
		$filter = array('dep_id'=>$dep_id);
	    $this->data['dep_detail'] = $this->mhome->get_list($filter,'ssr_t_department');
		$filter = array('chap_id'=>$chap_id);
	    $this->data['chap_detail'] = $this->mhome->get_list($filter,'ssr_t_chapter');
		$filter = array('item_id'=>$item_id);
	    $this->data['item_detail'] = $this->mhome->get_item_list($filter,'ssr_t_item');
		//Breadcrumb section start	
		
			$this->breadcrumb->clear();
		    $this->breadcrumb->add_crumb('Home', base_url());
		    $this->breadcrumb->add_crumb($this->data['dep_detail'][0]->dep_name,base_url().'index.php/home');
		    $this->breadcrumb->add_crumb($this->data['chap_detail'][0]->chap_name, base_url().'index.php/home/chapter/'.$dep_id);
		    $this->breadcrumb->add_crumb($this->data['item_detail'][0]->item_name, base_url().'index.php/home/item/'.$dep_id.'/'.$chap_id);
		    if($this->data['subitem_list']){
			  $this->breadcrumb->add_crumb($this->data['subitem_list'][0]->subitem_name, base_url().'index.php/home/item/'.$dep_id.'/'.$chap_id);
			
		}else{
	    $this->breadcrumb->add_crumb('Subitem', '');
	    
  	}
			//print_r($this->data['subitem_list']);die;
		
		 $this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		 $this->parser->parse('subitem_list', $this->data);
		$this->parser->parse('include/footer',$this->data);
		
	}
}
 	  public function item_class()
	{  
if($this->is_logged_in()){
			redirect('login');
		}else{	
		$this->check_authority('item_class');
		 $this->data['class_list'] = $this->mhome->get_class_list();	
		
		//print_r($this->data['overhead_list']);die;
		//Breadcrumb section start
	    $this->breadcrumb->clear();
	    $this->breadcrumb->add_crumb('Home', base_url());
	    $this->breadcrumb->add_crumb('Deshboard', base_url().'index.php/home');
	    $this->breadcrumb->add_crumb('Class', '');
	    
	
	//Breadcrumb section end
		
		//Templets load section
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->load->view('item_class',$this->data);
		$this->parser->parse('include/footer',$this->data);
	}
	}
public function manage_item_class($id=false)
	 {  
	   if($this->is_logged_in()){
			redirect('login');
		}
		elseif($this->check_authority('manage_item_class')==true)
			{
					redirect('home/item_class');
			}
		else{
		if($id){
			$filter = array('id'=>$id);
		
		   $class_info = $this->mhome->get_list($filter,'ssr_t_class');
		 // print_r($class_info[0]->class_name);die;
		   $this->data = array('class_name'=>$class_info[0]->class_name,
		                         'class_desc'=>$class_info[0]->class_desc,
		                         'class_heading'=>$class_info[0]->class_heading,
		                         'class_notes'=>$class_info[0]->class_notes,
						           'created_by' => 1,
									'created_on' => date("Y-m-d"));
			$this->data['id']=$id;
								  
		
		}
		//Breadcrumb section start
	    $this->breadcrumb->clear();
	    $this->breadcrumb->add_crumb('Home', base_url());
	    $this->breadcrumb->add_crumb('Deshboard', base_url().'index.php/home');
	    $this->breadcrumb->add_crumb('Class', base_url().'index.php/home/item_class');
	    $this->breadcrumb->add_crumb('Manage Class','');
	    
	
	//Breadcrumb section end
		//print_r($this->data);die;
		
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->parser->parse('add_item_class',$this->data);
		$this->parser->parse('include/footer',$this->data);
	 }	
	 }
	  function add_item_class(){
		if($this->is_logged_in()){
			redirect('login');
		}else{
					//print_r($_POST);die;
		if($this->input->post('submit')){
				
						$data = $this->input->post();
		        
		
		          $value = "";	
							if($this->input->post('id')){
			          $info = array( 'class_name'=>$this->input->post('class_name'),
										'class_desc' => $this->input->post('class_desc'),
										'class_heading' => $this->input->post('class_heading'),
										'class_notes' => $this->input->post('class_notes'),
										'created_by' => 1,
										'created_on' => date("Y-m-d"),
										'updated_by' => 1,
										'updated_on' => date("Y-m-d"));
										
										
							$this->mhome->update_item_class($info,array('id'=>$this->input->post('id')));
								
							$this->session->set_flashdata('message_type', 'success');        
							$this->session->set_flashdata('message', 'Class updated successfully');
							redirect("home/item_class");
							
		        } else {
							for($i=0;$i<=count($data['class_name'])-1; $i++){
						
							$value .= "('".$data['class_name'][$i]."','".$data['class_desc'][$i]."','".$data['class_heading'][$i]."','".$data['class_notes'][$i]."')".","; 
							  }       
						
						
							if($this->mhome->manage_class(rtrim($value,","))){
								$this->session->set_flashdata('message_type', 'success');        
							$this->session->set_flashdata('message', 'Class Added successfully');
								redirect("home/item_class");
								
							}else{
								echo "Error while Adding Class";
							}
		         }
		  } 	
  }	
	  }
 public function refrence($id=false){
	 if($this->is_logged_in()){
			redirect('login');
		}else{
  $this->check_authority('refrence');
		//print_r($this->data);die;
		//Breadcrumb section start
		
		$filter = array('id'=>$id);
		
		       $this->data['dep_id'] = 2147483647;
		       $this->data['chap_id'] = 2147483647;
		       $this->data['item_id'] = 2147483647;
			//$filter = array('dep_id'=> $dep_id,
			                //'chap_id'=>$chap_id,
							//'item_id'=>$item_id);
			//$this->data['subitem_list'] = $this->mhome->get_list($filter,'ssr_t_subitem');
			$this->breadcrumb->clear();
		    $this->breadcrumb->add_crumb('Home', base_url().'index.php/home');
		 
		    $this->breadcrumb->add_crumb('Refrence','');
		$this->data['refrence_list'] = $this->mhome->get_refrence();
		//Breadcrumb section end
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->parser->parse('manage_refrence',$this->data);
		$this->parser->parse('include/footer',$this->data);		
		
		
 }	
 }
 public function manage_refrence($id=false)
	 {
		 if($this->is_logged_in()){
			redirect('login');
		}
		elseif($this->check_authority('manage_refrence')==true)
			{
					redirect('home/refrence');
			}
		else{
	  
		//print_r($this->data['cls_list']);die;
			if($id){
			$filter = array('id'=>$id);
		
		   $refrence_info = $this->mhome->get_list($filter,'ssr_t_reference');
		   $this->data = array('dep_id'=>$refrence_info[0]->dep_id,
		                         'chap_id'=>$refrence_info[0]->chap_id,
		                          'item_id'=>$refrence_info[0]->item_id,
		                          'name'=>$refrence_info[0]->name,
		                          'description'=>$refrence_info[0]->description,
		                        'unit_code'=>$refrence_info[0]->unit_code,
		                        'cost_total'=>$refrence_info[0]->cost_total,
		                       
		                        'class_id'=>$refrence_info[0]->class_id,
		                        'heading'=>$refrence_info[0]->heading,
		                        'notes'=>$refrence_info[0]->notes);
			$this->data['id']=$id;
								  
		
		}
		//Breadcrumb section start
			$this->breadcrumb->clear();
		    $this->breadcrumb->add_crumb('Home', base_url());
		   
		    $this->breadcrumb->add_crumb('Refrence','');
		   
		//Breadcrumb section end
		//print_r($this->data);die;
		  
	    $this->data['unit_list'] = $this->mhome->get_unitlist();
	   
		$this->data['cls_list']=$this->mhome->get_cls_list();
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->parser->parse('create_refrence',$this->data);
		$this->parser->parse('include/footer',$this->data);
	 }
	 }
	  function add_refrence(){
		  if($this->is_logged_in()){
			redirect('login');
		}else{
			//print_r($_POST);die;
	if($this->input->post('submit')){
					
						$data = $this->input->post();
		        
		//print_r($data);die;
		$value = "";
		if($this->input->post('id')){
			//echo"e";die;
			
					    $info = array( 'name'=>$this->input->post('name'),
										'description' => $this->input->post('description'),
										'unit_code' => $this->input->post('unit_code'),
										'cost_total' => $this->input->post('cost_total'),
										'class_id' => $this->input->post('class_id'),
										'heading' => $this->input->post('heading'),
										'notes' => $this->input->post('notes'));
									
										
							$this->mhome->update_refrence($info,array('id'=>$this->input->post('id')));
								
							$this->session->set_flashdata('message_type', 'success');        
							$this->session->set_flashdata('message', 'Refrence updated successfully');
							redirect("home/refrence");
		  
		}else{
		
		
		for($i=0;$i<=count($data['name'])-1; $i++){
			
				$value .= "('".$data['dep_id']."','".$data['chap_id']."','".$data['item_id']."','".$data['name'][$i]."','".$data['description'][$i]."','".$data['unit_code'][$i]."','".$data['class_id'][$i]."','".$data['cost_total'][$i]."','".$data['heading'][$i]."','".$data['notes'][$i]."')".","; 
			}
			
			//print_r($value);die;
				if($this->mhome->manage_ref(rtrim($value,","))){
					#echo "Menus Added Sucessfully";
					$this->session->set_flashdata('message_type', 'success');        
                        $this->session->set_flashdata('message', 'Refrence Added successfully');
					redirect("home/refrence");
					
				}else{
					echo "Error while Adding Refrence";
				}
		}
	}
 }
	  }
    public function create_ref_cal($dep_id=false,$chap_id=false,$item_id=false,$ref_id=false,$class_id=false)
	{ 
if($this->is_logged_in()){
			redirect('login');
		}
		elseif($this->check_authority('create_ref_cal')==true)
			{
			//echo"elseif";die;
					redirect('home/refrence');
			}
		else{	
		       $this->data['dep_id'] = $dep_id;
		       $this->data['chap_id'] = $chap_id;
		       $this->data['item_id'] = $item_id;
		       $this->data['id'] = $ref_id;
		       $this->data['class_id'] = $class_id;
		      
		$filter = array('ref_id'=>$ref_id);
	    $this->data['ref_costing'] = $this->mhome->get_list($filter,'ssr_t_rel_calculation');
		//print_r( $this->data['subitem_costing']);die;
	
	    $filter = array('id'=>$ref_id);
	    $this->data['ref_detail'] = $this->mhome->get_list($filter,'ssr_t_reference');
		//Breadcrumb section start
			$this->breadcrumb->clear();
		    $this->breadcrumb->add_crumb('Home', base_url());
		    
		    $this->breadcrumb->add_crumb($this->data['ref_detail'][0]->name, base_url().'index.php/home/refrence');
		//Breadcrumb section end
		//print_r($this->data['chap_list']);die;
                   $this->data['ref_des'] = $this->data['ref_detail'][0]->description;
                   $this->data['class_id'] = $this->data['ref_detail'][0]->class_id;
		 $this->data['cost_type'] = $this->mhome->get_costtype('ssr_t_cost_type');
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->load->view('ref_cal',$this->data);
		$this->parser->parse('include/footer',$this->data);
	}
	}
	public function submit_ref_cal()
	{  
	if($this->is_logged_in()){
			redirect('login');
		}else{
		
		$data = $this->input->post();
	
		
		$value = "";
		if($this->input->post('edit_costing')==1){
		
			for($i=0;$i<=count($data['code'])-1; $i++){
				
				
				
				$value .= "('".$data['dep_id']."','".$data['chap_id']."','".$data['item_id']."','".$data['ref_id']."',".$data['serial'][$i].",'".$data['item_type'][$i]."','".$data['item_desc'][$i]."','".$data['code'][$i]."','".$data['unit_code'][$i]."','".$data['amount'][$i]."','".$data['total_amount'][$i]."','".$data['quantity'][$i]."','".$data['rate'][$i]."')".",";
			}
			if($this->mhome->update_rel_cal(rtrim($value,","),$data['final_total'],$data['dep_id'],$data['chap_id'],$data['item_id'],$data['ref_id'])){
				
				redirect("home/refrence/");
				
			}else{
				//echo"ii";die;
				echo "Error while Editing Refrence calculation";
			}
		} else {
		
		for($i=0;$i<=count($data['code'])-1; $i++){
				
				
				
				$value .= "('".$data['dep_id']."','".$data['chap_id']."','".$data['item_id']."','".$data['ref_id']."',".$data['serial'][$i].",'".$data['item_type'][$i]."','".$data['item_desc'][$i]."','".$data['code'][$i]."','".$data['unit_code'][$i]."','".$data['amount'][$i]."','".$data['total_amount'][$i]."','".$data['quantity'][$i]."','".$data['rate'][$i]."')".",";
			}
			
			
			if($this->mhome->manage_rel_cal(rtrim($value,","),$data['final_total'],$data['ref_id'])){
					
				redirect("home/refrence/");
				
			}else{
				echo "Error while Adding Refrence calculation";
			}
		} 
}
	}
public function gen_doc()
	{ 
	if($this->is_logged_in()){
			redirect('login');
		}else{
       $this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->load->view('gen_doc',$this->data);
		$this->parser->parse('include/footer',$this->data);
  
	}
	}
public function delete_item($dep_id=false,$chap_id=false,$item_id=false){
	
	
	if($this->is_logged_in()){
			redirect('login');
		}
		elseif($this->check_authority('delete_item'))
		{
			redirect('home/item/'.$dep_id.'/'.$chap_id);
		}
		else{
		$this->mhome->delete_item($item_id);
	
	                   $this->session->set_flashdata('message_type', 'success');        
                        $this->session->set_flashdata('message', $this->config->item("item").' DELETE successfully');
								redirect('home/item/'.$dep_id.'/'.$chap_id);		
}
}

public function delete_subitem($dep_id=false,$chap_id=false,$item_id=false,$subitem_id=false,$class_id=false){
	
	if($this->is_logged_in()){
			redirect('login');
		}
		elseif($this->check_authority('delete_subitem'))
		{
			redirect('home/item/'.$dep_id.'/'.$chap_id.'/'.$item_id);
		}
		else{
	
						$this->mhome->delete_subitem($subitem_id);
	
	                   $this->session->set_flashdata('message_type', 'success');        
                        $this->session->set_flashdata('message', $this->config->item("item").' DELETE successfully');
						redirect('home/get_subitem_list/'.$dep_id.'/'.$chap_id.'/'.$item_id);		
}
}
public function delete_material($mat_code=false,$labour_code=false,$overhead_code=false,$unit_code=false,$carriage_id=false,$pla_code=false,$id=false,$id1=false){
	if($this->is_logged_in()){
			redirect('login');
		}else{		
	               if($mat_code){
		               	if($this->check_authority('delete_material')==true)
		               	{
		               		redirect('home/material');
		               	}
						$filter = array('mat_code'=>$mat_code);
						$this->mhome->delete_material($filter,'ssr_t_material');
						$this->session->set_flashdata('message_type', 'success');        
                        $this->session->set_flashdata('message', $this->config->item("item").' DELETE successfully');
						redirect('home/material');		
						}
						elseif($labour_code){
							 if($this->check_authority('delete_material')==true)
								{
								redirect('home/labour');
								}
							$filter = array('labour_code'=>$labour_code);
						$this->mhome->delete_material($filter,'ssr_t_labor');
						$this->session->set_flashdata('message_type', 'success');        
                        $this->session->set_flashdata('message', $this->config->item("item").' DELETE successfully');
						redirect('home/labour');	
						}
						elseif($overhead_code){
								if($this->check_authority('delete_material')==true)
									{
									redirect('home/overhead');
									}
							$filter = array('overhead_code'=>$overhead_code);
						$this->mhome->delete_material($filter,'ssr_t_overhead');
						$this->session->set_flashdata('message_type', 'success');        
                        $this->session->set_flashdata('message', $this->config->item("item").' DELETE successfully');
						redirect('home/overhead');	
						}
						elseif($unit_code){
							if($this->check_authority('delete_material')==true)
										{
										redirect('home/unit');
										}
							$filter = array('unit_code'=>$unit_code);
						$this->mhome->delete_material($filter,'ssr_t_uom');
						$this->session->set_flashdata('message_type', 'success');        
                        $this->session->set_flashdata('message', $this->config->item("item").' DELETE successfully');
						redirect('home/unit');	
						}
						elseif($carriage_id){
							if($this->check_authority('delete_material')==true)
							{
								redirect('home/carriage');
							}
							$filter = array('carriage_id'=>$carriage_id);
						$this->mhome->delete_material($filter,'ssr_t_carriage');
						$this->session->set_flashdata('message_type', 'success');        
                        $this->session->set_flashdata('message', $this->config->item("item").' DELETE successfully');
						redirect('home/carriage');	
						}
						elseif($pla_code){
						if($this->check_authority('delete_material')==true)
							{
								redirect('home/plant');
							}
							$filter = array('pla_code'=>$pla_code);
						$this->mhome->delete_material($filter,'ssr_t_plant');
						$this->session->set_flashdata('message_type', 'success');        
                        $this->session->set_flashdata('message', $this->config->item("item").' DELETE successfully');
						redirect('home/plant');	
						}
						elseif($id){
								if($this->check_authority('delete_material')==true)
									{
										redirect('home/item_class');
									}
							$filter = array('id'=>$id);
						$this->mhome->delete_material($filter,'ssr_t_class');
						$this->session->set_flashdata('message_type', 'success');        
                        $this->session->set_flashdata('message', $this->config->item("item").' DELETE successfully');
						redirect('home/item_class');	
						}
						elseif($id1){
							if($this->check_authority('delete_material')==true)
							{
								redirect('home/refrence');
							}
							$filter = array('id'=>$id1);
						$this->mhome->delete_material($filter,'ssr_t_reference');
						$this->session->set_flashdata('message_type', 'success');        
                        $this->session->set_flashdata('message', $this->config->item("item").' DELETE successfully');
						redirect('home/refrence');	
						}
}
}
public function create_carriage_cal($carriage_id=false){
	if($this->is_logged_in()){
			redirect('login');
		}else{
	
	$filter = array('carriage_id'=>$carriage_id);
$this->data['carriage_costing'] = $this->mhome->get_list($filter,'ssr_t_carriage_cal');
  $this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->load->view('carriage_cal',$this->data);
		$this->parser->parse('include/footer',$this->data);	
	
	
		}
}	
public function index1(){
	if($this->is_logged_in()){
			redirect('login');
		}else{
		$search=  $this->input->post('search');
		$query = $this->mhome->search_auto($search);
		echo json_encode ($query);
	}
}
  // public function search_ajax()
//{
	//echo"hihhhhhh";die;
	//$dep_id = $this->input->post('value');
	//print_r($dep_id);die;
	// $chap_list = $thais->data['chap_list'] = $this->utilities->search_ajax($dep_id);
	//print_r($chap_list);die;
	//$this->load->view('subitem_cal',$this->data);
	//$this->load->view('subitem_cal');
	//$this->parser->parse('subitem_cal',$thais->data);
//}
}
/* Ended */

