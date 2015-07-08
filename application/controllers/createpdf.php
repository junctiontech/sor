
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
   
	 function __construct() {
	parent::__construct();
	$this->data[]="";
	$this->data['url'] = base_url();
	
	$this->load->model('mhome');
	 $this->load->helper('pdf_helper');
	$this->data['base_url']=base_url();
	//fjkdshdf
	 }
	 
	public function index()
	{

   $filter = array('dep_id'=>$dep_id);
				 		$action_array = $this->mhome->export_pdf($filter);
    $this->load->view('pdfreport',$this->data);
    }
}?>
