<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->data[]="";
		$this->data['url'] = base_url();
		
		$this->load->model('mhome');
		$this->load->library('parser');
		$this->data['base_url']=base_url();
		
	 }
	public function index()
	{
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('login',$this->data);
		$this->parser->parse('include/footer',$this->data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
