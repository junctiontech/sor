<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->data[]="";
		$this->data['user_data']="";
		$this->data['url'] = base_url();
		$this->load->model('login_model');
		$this->load->model('authority_model');
		$this->load->library('parser');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->data['base_url']=base_url();
		$this->load->library('session');
		$this->load->library('authority');	
	
	 }
	public function index()
	{
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('login',$this->data);
		$this->parser->parse('include/footer',$this->data);
	}
	function login_user($info=false)
	{	
			$data=array(
						'usermailid'=>$this->input->post('usermailid'),
						'password'=>$this->input->post('password')
						);		
			$row=$this->login_model->login_check('ssr_t_users',$data);
			if($row){ 
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
				  redirect('home');
				}
	}
	function logout($info=false)
	{
		$this->data['user_data']=$this->session->userdata('user_data');
		$userdata=$this->session->userdata('user_data');
		$unset_userdata=$this->session->unset_userdata($userdata);
		$this->session->sess_destroy();
		redirect('login');
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
		else
		{

		}
	}
	function sign_up()
	{
		$a = $this->input->post('usermailid');
		$q = $this->login_model->insert_sign('ssr_t_users',$a);
	    if($q)
			{
				$this->session->set_flashdata('category_error', 'Error message');  
				$this->session->set_flashdata('message',$this->config->item("user").'Email id already exist'); 
				$this->session->$a;
				  redirect('login');
			}
		else
		   {
				$this->session->set_flashdata('category_success', 'success message	');        
				$this->session->set_flashdata('message', $this->config->item("user").' Data Inserted successfully');
				redirect('login');
		   }
		
	}
	function acc_setting($info=false)
	{ 
	if($this->is_logged_in()){
		
		redirect('login');
		
	}
	else{
		$user_data=$user_session_data = $this->session->userdata('user_data');
		$this->data['user_data']=$this->session->userdata('user_data');
		$userdata=$this->session->userdata('user_data');
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->load->view('acc_setting',$this->data);

		
		$this->parser->parse('include/footer',$this->data);
	}
	}
	function change_pass($info=false)
	{
	   if($this->is_logged_in())
	    {
			redirect('login');
		}									
		else
		{
			$user_data=$user_session_data = $this->session->userdata('user_data');
			$data = array(
				'password' => $this->input->post('password')
				);
				$filter=array(
				'user_id' => $user_data['user_id']
				);
				$this->login_model->change($filter,$data,'ssr_t_users');
				$this->session->set_flashdata('message_type', 'success');        
				$this->session->set_flashdata('message', $this->config->item("user").'Password updated successfully');
				redirect('home');
		}		
	}
	//********** function start for user role and role management****
	
	function user_role()
	{	
		if($this->is_logged_in())
		{
			redirect('login');
		}
		else
		{
				Authority::checkAuthority('user_role');
		$role_list=$this->data['role_list']=$this->authority_model->role_list();
		$verify_list=$this->data['verify_list']=$this->authority_model->verify_list();
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->load->view('user_role',$this->data);
		$this->parser->parse('include/footer',$this->data);
		}
	}
	
	//function for assign role 
	function role_assign($info=false)
	{
		$name= $this->input->post('role');
		if($name!=='')
		{
			$data=array('role_id'=>$name);
		}
		$role_assign=$this->data['role_assign']=$this->authority_model->role_assign($data,$info);
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('message', $this->config->item("user").' Role Assign Successfully');
		redirect('login/user_role');
	}
	
	// function for delete user from user_role view
	function delete_user($user=false)
	{
		//print_r($user);die;
		if($user){
					  
						$filter = array('user_id'=>$user);
						$this->authority_model->delete_user($filter,'ssr_t_users');
						$this->session->set_flashdata('message_type', 'success');        
                        $this->session->set_flashdata('message', $this->config->item("user").' Delete Successfully');
						redirect('login/user_role');		
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
		redirect('login/user_role');
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
				Authority::checkAuthority('role_management');
		$list_permsn =$this->data['list_permsn']=$this->authority_model->list_permsn();
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->load->view('role_management',$this->data);
		$this->parser->parse('include/footer',$this->data);
		}
	}
//
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
			$this->parser->parse('include/header',$this->data);
			$this->parser->parse('include/leftmenu',$this->data);
			$this->load->view('role_permission',$this->data);
			$this->parser->parse('include/footer',$this->data);
		}
	}
	
	
	//function for role permissions
	 
	
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
					$role= $this->input->post('role');
					$qry =   $this->authority_model->user_add('ssr_t_users',$email,$role);
					if($qry)
					   {
							$this->session->set_flashdata('category_error', 'Error message');  
							$this->session->set_flashdata('message',$this->config->item("user").'email id already exist'); 
							   redirect('login/manage_users');
						  
					   }
					else
					   {
							$this->session->set_flashdata('category_success', 'success message	');        
							$this->session->set_flashdata('message', $this->config->item("user").' Data Inserted successfully');
								redirect('login/user_role');
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
		//print_r($data);die;
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
				$this->session->set_flashdata('category_success', 'success message	');
				$this->session->set_flashdata('message', $this->config->item("user").' Role Inserted successfully');
				redirect("login/role_management");
				
			}
			else
			{
				echo "Error while Editing SubItem";
			}
		}
	  
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
