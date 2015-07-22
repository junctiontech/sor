<?php
/* Model for login and sign up   */

class Login_model extends CI_Model 
{
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
    function get_list($filter=false,$table=false)
    {
    	$query = $this->db->get_where($table, $filter);
    	return $query->Result();
    }
   // function get_dropdown_list()
   // {
    //	$this->db->from('city');
    //	$this->db->order_by('name');
    //	$result = $this->db->get();
    //	$return = array();
    //	if($result->num_rows() > 0) {
    //		foreach($result->result_array() as $row) {
    //			$return[$row['id']] = $row['name'];
    //		}
    //	}
    
    //	return $return;
    
  //  }
    function get($filter=false,$table=false)
    {
    	$query = $this->db->get_where($table, $filter);
   	return $query->Result();
    }
    function lang($name=false,$table=false) {
    	$this->db->select('*');
    	$this->db->where('language_id',$name);
    	$query = $this->db->get($table);
    	//echo $this->db->last_query();die;
    	return $query->result();
    	}
    function language($code=false,$table=false){
    	$this->db->select('*');
    //	$this->db->from('ssr_t_text');
    	$this->db->where('language_id',$code);
    	$query = $this->db->get($table);
    	//print_r($query);die;
    	return $query->result();
    }
    /* function for login check email id ragisterd or not   */
    
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
   
   
   	/* function for insert user data and if not already exist */
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
    
    /*  function for insert change password  */
	function change($filter=false,$data=false,$table=false)
	{
			$this->db->where($filter);
			$this->db->update('ssr_t_users',$data);
	}
}