<?php 
 
class Authority extends CI_Controller {
	
    function __construct() 
	{
        parent::__construct();
		$this->data[]="";
		$this->data['user_data']="";
		$this->data['url'] = base_url();
		$this->load->model('authority_model');
		//$this->load->controllers('home');
		$this->load->library('parser');
		$this->load->helper('url');
		//$this->load->library('form_validation');
		$this->load->library('session');
		$this->data['base_url']=base_url();
    }
		
	function sign_up(){
		
		if($this->is_logged_in()){
			redirect('login');
		}else{
		$a = $this->input->post('usermailid');
     $q =   $this->mhome->insert_sign('ssr_t_users',$a);
	 if($q)
       {
        $this->session->set_flashdata('category_error', 'Error message');  
		$this->session->set_flashdata('message',$this->config->item("user").'email id already exist'); 
          redirect('login');
		  
       }
       else
       {
        $this->session->set_flashdata('category_success', 'success message	');        
                           $this->session->set_flashdata('message', $this->config->item("user").' Data Inserted successfully');
						   
	 redirect('login');
       }
	}
	}
	function is_logged_in()
	{
		$user_data=$user_session_data = $this->session->userdata('user_data');
		if($user_session_data=='')
		{
			$this->session->set_flashdata('message_type', 'error');
			$this->session->set_flashdata('message',$this->config->item("user").'First Login with Your account');
			redirect('login');
		}									

	}
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
				$this->session->set_flashdata('message', $this->config->item("add_department").' You  Are  Not  Authorised  Person  Please  Contact  Administrator');
						redirect('home');
			}
		}
	}
	function user_role($info=false)
	{	
		$name= $this->input->post('name');
		if($this->is_logged_in())
		{
			redirect('login');
		}
		else
		{
			$this->check_authority('user_role');
			if($name!=='')
			{
			$data=array('role_id'=>$name);
			}
		$role_assign=$this->data['role_assign']=$this->authority_model->role_assign($data,$info);
		$role_list=$this->data['role_list']=$this->authority_model->role_list();
		$verify_list=$this->data['verify_list']=$this->authority_model->verify_list();
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->load->view('user_role',$this->data);
		$this->parser->parse('include/footer',$this->data);
		}
	}
	
	// function for delete user from user_role view
	function delete_user($info=false)
	{
		//print_r($info);die;
		if($info){
					  
						$filter = array('user_id'=>$info);
						$this->authority_model->delete_user($filter,'ssr_t_users');
						$this->session->set_flashdata('message_type', 'success');        
                        $this->session->set_flashdata('message', $this->config->item("user").' DELETE successfully');
						redirect('authority/user_role');		
						}
	}	
	//function for delete user from user_role view
	
	function verify($filter=false,$info=false)
	{	
		if($info==1)
		{
			$data=array('status'=>'accept');
		}
		if($info==2)
		{
			$data=array('status'=>'reject');
		}
		$verify=$this->data['verify']=$this->authority_model->verify($data,$filter,'ssr_t_users');
		redirect('authority/user_role');
	}

	
	//for role management(list)
	function role_management($info=false)
	{
		if($this->is_logged_in())
		{
			redirect('login');
		}
		else
		{
			$this->check_authority('role_management');
		$list_permsn=	$this->data['list_permsn']=$this->authority_model->list_permsn();
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->load->view('role_management',$this->data);
		$this->parser->parse('include/footer',$this->data);
		}
	}
//for role permissions
	function role_permission($info=false)
	{	
		//print_r($info);die;
		if($this->is_logged_in())
		{
			redirect('login');
		}
		else
		{
			$permissions=$this->data['permissions']=$this->authority_model->permissions($info);
			//print_r($permissions);die;
			//$list_function_prem=	$this->data['list_function_prem']=$this->authority_model->list_function_prem();
			$this->parser->parse('include/header',$this->data);
			$this->parser->parse('include/leftmenu',$this->data);
			$this->load->view('role_permission',$this->data);
			$this->parser->parse('include/footer',$this->data);
		}
	}
	//for manage users(add-edit)
	function manage_users($info=false)
	{
		if($this->is_logged_in())
		{
			redirect('login');
		}
		else
		{
		$role_list=$this->data['role_list']=$this->authority_model->role_list();	
	    $this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->load->view('manage_users',$this->data);
		$this->parser->parse('include/footer',$this->data);
		}
	}
	
		function user_add()
		{
			if($this->is_logged_in())
				{
					redirect('login');
				}
			else
				{
					$email = $this->input->post('usermailid');
					$qry =   $this->authority_model->user_add('ssr_t_users',$email);
					if($qry)
					   {
							$this->session->set_flashdata('category_error', 'Error message');  
							$this->session->set_flashdata('message',$this->config->item("user").'email id already exist'); 
							   redirect('authority/manage_users');
						  
					   }
					else
					   {
							$this->session->set_flashdata('category_success', 'success message	');        
							$this->session->set_flashdata('message', $this->config->item("user").' Data Inserted successfully');
								redirect('authority/user_role');
					   }
				}
		}
		
		
		//for add role
		function add_role($info=false)
	{
			if($this->is_logged_in())
			{
				redirect('login');
			}
			else
			{
				$list_function=	$this->data['list_function']=$this->authority_model->list_function();
				$this->parser->parse('include/header',$this->data);
				$this->parser->parse('include/leftmenu',$this->data);
				$this->load->view('add_role',$this->data);
				$this->parser->parse('include/footer',$this->data);
			}
	}
  function insert_role()
	{		
		$data = $this->input->post();
		print_r($data);die;
		$value = "";
	  if($this->input->post('edit_costing')==1)
	   {	
			for($i=0;$i<=count($data['function'])-1; $i++)
			{
				$value .= "('".$data['function'][$i]."','".$data['read'][$i]."','".$data['execute'][$i]."')".",";
			}
			//print_r($value);die;
			if($this->authority_model->insert_role(rtrim($value,",")))
			{
				redirect("authority/role_management");
				
			}
			else
			{
				echo "Error while Editing SubItem";
			}
		}
	  
	}
}
/*END OF FILE*/
