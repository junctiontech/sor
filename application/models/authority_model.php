<?php

 /*	      Model for check authority permissions   */
class Authority_model extends CI_Model 
{
 
    function __construct() 
	{
        parent::__construct();
		$this->load->database();
    }
    /*check user id present in database*/
    function checkid($uid){
    	//print_r($uid);die;
    	$query=$this->db->query("SELECT usermailid FROM ssr_t_users WHERE usermailid='$uid'");
    	$a=$query->result();
    	if($a == null){
    		$query=$this->db->query("SELECT usermailid FROM ssr_t_users WHERE usermailid='$uid' and name='' ");
    		//print_r($query);die;
    		$a=$query->num_rows;
    		if($a !== 0){
    			$data=array(
    					'usermailid' =>$uid,
    					'name' =>'',
    					'image' =>'',
    					'phone_number' =>'',
    					'mobile' =>'',
    					'address' =>''
    			);
    			$this->db->update('ssr_t_users',$data);
    			//print_r($uid);die;
    			return TRUE;
    		}
    		else{
    				
    			$data=array(
    					'usermailid' =>$uid,
    					'name' =>'',
    					'image' =>'',
    					'phone_number' =>'',
    					'mobile' =>'',
    					'address' =>''
    			);
    			$this->db->insert('ssr_t_users',$data);
    			$this->db->insert_id();
    			return TRUE;
    		}
    	}else{
    		$ci = & get_instance();
    		$query = $ci->db->get_where('ssr_t_users',array('usermailid' => $uid));
    		$result=$query->Result();
    		$id=$result[0]->usermailid;
    
    		//print_r($id);die;
    		if($uid == $id){
    			//print_r($b);die;
    			return TRUE;
    		}
    
    	}
    }
    /* start fetching data and show stored data*/
    function show_account($id){
    	$query =array($this->db->query("SELECT name,image,phone_number,mobile,address FROM ssr_t_users WHERE usermailid='$id'"));
    	foreach($query as $qry)
    	{
    		return $qry->row();
    	}
    }
    /* start storing data from logged user*/
    function insertdatamy($filter=0,$name=0,$image=0,$phone_number=0,$mobile=0,$address=0)
    {  if($image==null) {
    
    	$ci = & get_instance();
    	$query = $ci->db->get_where('ssr_t_users',array('usermailid' => $filter));
    	$result=$query->Result();
    	$image=$result[0]->image;
    }
    //print_r($filter);die;
    $data=array(
    		//'usermailid' =>$filter,
    		'name' =>$name,
    		'image' =>$image,
    		'phone_number' =>$phone_number,
    		'mobile' =>$mobile,
    		'address' =>$address
    );
    
    
    //$this->db->query("update name,image,phone,mobile,address from acc_stt_data where 'user_id' => $filter",$data);
    $fill=array('usermailid' => $filter);
    $this->db->where($fill);
    $this->db->update('ssr_t_users',$data);
    
    //echo $this->db->last_query();die;
    $this->show_account($filter);
    }
    
		/*   Function for start assign user list for user_role view    */
	function verify_list()
	{
		$this->db->select('*');
		$this->db->where('user_id !=', 1);
		$qry=$this->db->get('ssr_t_users');
		return $qry->result();
	}
	
		/*    Start function for retrieve function list for add role     */
	function list_function()
	{
		$this->db->select('*');
		$qry=$this->db->get('ssr_t_function');
		return $qry->result();
	}
		
		/*     Start function for retrieve role list from role table for user role view     */
	function role_list()
	{		
			$this->db->select('*');
			$qry=$this->db->get('ssr_t_role');
			return $qry->result();
	}
		
		/*    Start function for read check authority permission for role id     */
	function list_permision($role)
	{
		$this->db->select('*');
		$this->db->where('role_id',$role);
		$qry=$this->db->get('ssr_t_role_permission');
		if($qry->num_rows()>0)
		{
		  return $qry->result(); 
		}
		else
		{
			echo"invalid user name or password";
			return false;
		}
	}
		
		/*    Start function for list role_id for role management view    */ 
	function list_permsn($a=false)
	{
		//print_r($a);die;
		$this->db->distinct();
		$this->db->select('role_id');
		$this->db->where('role_id !=' ,'Administrator');
		$qry=$this->db->get('ssr_t_role_permission');
		 return $qry->result(); 
	}
		
	
			/*    Start function for update role for user_role view     */
	function role_assign($data,$info)
	{	
		$this->db->where('user_id',$info);
		 $this->db->update('ssr_t_users',$data);
	}
		
			/*    Start function for delete user in user role    */
	function delete_user($filter=false,$table=false)
	{
		$this->db->delete($table, $filter); 
	}
		
	
		/*     function for add user in role view      */
		function user_add($table,$email,$role,$password)
		{	
			$this->db->where('usermailid',$email);
			$query = $this->db->get('ssr_t_users');
			if ($query->num_rows() > 0)
				{
				 return $query->Result();
				}
			else{
				$data=array
						   (
						  'usermailid'=>  $this->input->post('usermailid'),
						  'role_id'=>	$role,
						  'password'=>  $password
						   );
				$this->db->insert("ssr_t_users",$data);
				}
		}

		
			/*		start function for retrive function list from role_function table		*/
		function functions_list()
		{
			$this->db->select('*');
			//$this->db->where('role_id',$info);
			$qry=$this->db->get('ssr_t_function');
			return $qry->result();
		}
	

			/*		Start function for retrieve permission list for role_permission view 		*/
	function permissions($info)
	{	
		$this->db->select('*');
		$this->db->where('role_id',$info);
		$qry=$this->db->get('ssr_t_role_permission');
		return $qry->result();
	}

	
				/*		Start function for insert role for add_role view		*/	
	function insert_role($info)
	{
		$this->db->query("INSERT INTO ssr_t_role_permission (role_id,function_id,auth_read,auth_execute) VALUES ".$info."");
		return true;
	}
	

				/*		function for update role	*/
	function update_role_permission($info,$filter)
	{   
		$this->db->trans_start();
		$this->db->delete('ssr_t_role_permission', $filter);
		$this->db->query("INSERT INTO ssr_t_role_permission (role_id,function_id,auth_read,auth_execute) VALUES ".$info."");
		$this->db->trans_complete();
		return true;
	}
	

		/*		function for insert role in role table		*/
	function insert_role_table($role)
	{
		//print_r($role);die;
		$data=array('role_id'=>$role);
		$this->db->insert('ssr_t_role',$data);
		return true;
	}	
		
		
						/*		function for blocked role in user	*/
	function  blocked_user($data,$user)
	{
		$this->db->select('*');
		$this->db->where('user_id',$user);
		$qry= $this->db->update('ssr_t_users',$data);
	}	
}
//~~End~~