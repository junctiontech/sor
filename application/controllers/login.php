<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Controller for login Functionality */
class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->data[]="";
		$this->data['user_data']="";
		$this->data['url'] = base_url();
		$this->load->model('login_model');
		$this->load->library('parser');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->data['base_url']=base_url();
		$this->load->library('session');
	}
	
	public function index()
	{
		$this->breadcrumb->clear();
		    $this->breadcrumb->add_crumb('Home', base_url().'index.php/login');
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('login',$this->data);
		$this->parser->parse('include/footer',$this->data);
	}

				/* Function for login and create session */	
	function login_user($info=false)
	{	
			$data=array(
						'usermailid'=>$this->input->post('usermailid'),
						'password'=>$this->input->post('password')
						);		
			$row=$this->login_model->login_check('ssr_t_users',$data);
			if($row->role_id=='blocked')
			{
				$this->session->set_flashdata('message_type','error');
				$this->session->set_flashdata('message',$this->config->item("user").'your Id have a blocked Please contact administrator');
				redirect('login');
			}
			elseif($row){ 
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
	
		
					/* Function for sign up for new user */
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
	
}
/* End of login controller */