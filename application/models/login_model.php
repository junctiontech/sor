<?php
class Login_model extends CI_Model 
{
	 /**
	 # Programmer : Ankit
	 # Login_model Model
	 
	 **/
	 
	//variable initialize
    var $title   = '';
    var $content = '';
    var $date    = '';
	
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		
		//Load database connection
		$this->load->database();
    }
 function login_check($table=false,$data=false)
   {
		  $query = $this->db->get_where($table,$data);
		  if($query->num_rows()>0)
		  {
			   return $query->row();   
		  }
		  else
		  {
				return false;
		  }
   }
 function insert_sign()
   {
			$a= $this->input->post('usermailid');
			$this->db->where('usermailid',$a);
			$query = $this->db->get('ssr_t_users');
				if ($query->num_rows() > 0)
				{
					 return $query->Result();
				     redirect('login');
				}
				else
				{
					$data=array
						   (
						  'usermailid'=>  $this->input->post('usermailid'),
						  'password'=>  $this->input->post('password'),
						  'role_id'=>'block'
						   );
					$this->db->insert("ssr_t_users",$data);
				}
    }
	function change($filter=false,$data=false,$table=false)
	{
			$this->db->where($filter);
			$this->db->update('ssr_t_users',$data);
	}
}