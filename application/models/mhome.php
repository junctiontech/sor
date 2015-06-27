<?php 
//junctiontech 
//Model Class for competition start
class Mhome extends CI_Model {
	
	 /**
	 # This is the change from Ankit's PC
	 # Mhome Model
	 
	 */
	 
	//variable initialize
    var $title   = '';
    var $content = '';
    var $date    = '';
	
    function __construct()
    {
        /* Call the Model constructor */
        parent::__construct();
		
		/* Load database connection */
		$this->load->database();
    }
    /* function for update the depatment and we create new department */
	function manage_department($data=false,$filter=false)
	{  
		if($filter){
			$this->db->where($filter);
			$this->db->update('ssr_t_department',$data);
			$id = $filter['dep_id'];
		} else {
			
			if($this->db->insert('ssr_t_department',$data)){
				$id = $this->db->insert_id();
			}else{
				return false;
			}
		}
		return $id;
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
	
/* function for update and create new chapter */
	function manage_chapter($data=false,$filter=false)
	{  
		if($filter){
			$this->db->where($filter);
			$this->db->update('ssr_t_chapter',$data);
			$id = $filter['chap_id'];
		} else {
			
			if($this->db->insert('ssr_t_chapter',$data)){
				$id = $this->db->insert_id();
			}else{
				return false;
			}
		}
		
		return $id;
	}
	
/* function for calculation of subtiem */
	function get_code(){
		$query=$this->db->query("SELECT code from `ssr_t_calculation` ");
		
		return $query->Result();
	}

/* function used for mail exist from ajax function */	
	function mail_exists($key)
{
    $this->db->where('usermailid',$key);
    $query = $this->db->get('ssr_t_users');
    if ($query->num_rows() > 0){
        return true;
    }
    else{
        return false;
    }
}

/* mail check from common function.php  */
public function check_email($email,$edit_mode=false){
		if($email=='')
				return 1;
			$ci = & get_instance();
			$query = $ci->db->get_where('ssr_t_users',array('usermailid' => $email));
			$result=$query->Result();
			$id=isset($result[0]->id)?$result[0]->id:'';
			if($query->num_rows()>0){
				 	if($id==$edit_mode){
							return 1;
						}else{
								echo "<div class='alert alert-error' >Email id already registered with us.</div>";
								}
				}	
			else{
			
					echo 1;
			}		
		}
		
/* function for check the mail id of user  common function.php */
public function check_for($email,$edit_mode=false){
		if($email=='')
				return 1;
			$ci = & get_instance();
			$query = $ci->db->get_where('ssr_t_users',array('usermailid' => $email));
			$result=$query->Result();
			$id=isset($result[0]->id)?$result[0]->id:'';
			if($query->num_rows()>0){
				 	if($id==$edit_mode){
							return 1;
						}else{
							return $result;
								}
				}	
			else{
					echo 1;
			}		
		}
		
/* function for the finding record of the users */
function get_record(){
	
	$this->db->where('usermailid',$user);
    $query = $this->db->get('ssr_t_users');
}
	
	
/* function for subitem calcultaion for perticular subitem code   */
function update_subitem_cal($info=false,$finaltotal=false,$dep_id=false,$chap_id=false,$item_id=false,$subitem_id=false){

	  $this->db->query("DELETE FROM `ssr_t_calculation` WHERE `dep_id`='".$dep_id."' and `chap_id`='".$chap_id."' and `item_id`='".$item_id."' and `subitem_id`='".$subitem_id."' ");	
	 
	$this->db->query("INSERT ignore INTO ssr_t_calculation (dep_id,chap_id,item_id,subitem_id,class_id,serial,item_type,item_desc,code,unit_code,amount,total_amount,quantity,rate,over_head) VALUES ".$info."");

	if($finaltotal){
	$this->db->query("UPDATE  ssr_t_subitem  SET rate = ".$finaltotal." WHERE subitem_id= '".$subitem_id."'");
	
	$this->db->query("UPDATE  ssr_t_item  SET item_cost_total = ".$finaltotal." WHERE item_id= '".$item_id."'");

	}
	if($this->db->affected_rows()>0){
	return true;
	}else{
		
	return TRUE;
	}
}
function manage_subitem_cal($info=false,$finaltotal=false,$subitem_id=false,$item_id=false){
	$this->db->query("INSERT ignore INTO ssr_t_calculation (dep_id,chap_id,item_id,subitem_id,class_id,serial,item_type,item_desc,code,unit_code,amount,total_amount,quantity,rate,over_head) VALUES ".$info."");
	if($finaltotal){
		$this->db->query("UPDATE  ssr_t_subitem  SET rate = ".$finaltotal." WHERE subitem_id= '".$subitem_id."'");
		$this->db->query("UPDATE  ssr_t_item  SET item_cost_total = ".$finaltotal." WHERE item_id= '".$item_id."'");
	}
	if($this->db->affected_rows()>0){
		return true;
	}else{
		return false;
	}
	 
}

/* function for manage section which is call form ajax common function .js page */
	function get_type_detail($type_val,$type_code){
		   
		  if($type_val==='material'){
			$query = $this->db->query("select rate,unit_code,mat_desc from ssr_t_material WHERE mat_name='".$type_code."'");
			return	 $query->Result();
		  }else if($type_val==='labour'){
			  
			  $query = $this->db->query("select labour_rate,unit_code,labour_description from ssr_t_labor WHERE labour_name='".$type_code."'");
			 return $query->Result();
		  }else if($type_val==='refrence'){
			 $query = $this->db->query("select unit_code,description,cost_total from ssr_t_reference WHERE name='".$type_code."'");
			 return $query->Result(); 
		  }else if($type_val==='carriage'){
			 $query = $this->db->query("select unit_code,carriage_description,carriage_rate from ssr_t_carriage WHERE carriage_code='".$type_code."'");
			 return $query->Result(); 
		  }else if($type_val==='plant'){
			 $query = $this->db->query("select unit_code,pla_desc,rate from ssr_t_plant WHERE pla_code='".$type_code."'");
			 return $query->Result(); 
		  }else if($type_val==='subitem'){
			  	$query = $this->db->query("select unit_code,subitem_desc,rate from ssr_t_subitem WHERE subitem_name='".$type_code."'");
			 return $query->Result(); 
			}else{
			 $query = $this->db->query("select overhead_desc,overhead_percent from ssr_t_overhead WHERE overhead_name='".$type_code."'");
			 return $query->Result(); 
		  }
	}
	
/* function for unit list for the calculation */
	function get_item_cls_list($ids=false)
	{  
	  $query=$this->db->query("select * from ssr_t_class where `id` in (".$ids.")");
	 
	  return $query->Result();
	   }
	   
/* function for update and create new item */
	function update_item($info=false,$filter=false)
	{  
		$this->db->where($filter);
			$this->db->update('ssr_t_item',$info);
			
			$id = $filter['item_id'];
		return $id;
	}
	function manage_item($data=false,$filter=false)
	{
		if($filter){
			$this->db->where($filter);
			$this->db->update('ssr_t_item',$data);
			$id = $filter['item_id'];
		} else {
				
			if($this->db->insert('ssr_t_item',$data)){
				$id = $this->db->insert_id();
			}else{
				return false;
			}
	
		}
	
		return $id;
	}
	
/* function for update and create new subitem */
	function update_subitem($info=false,$filter=false)
	{  
		$this->db->where($filter);
			$this->db->update('ssr_t_subitem',$info);
			$id = $filter['subitem_id'];
		return $id;
	}
	function manage_sitem($info=false)
	{
	$this->db->query("INSERT ignore INTO ssr_t_subitem (dep_id,chap_id,item_id,subitem_name,subitem_desc,unit_code,subitem_class_id,rate,subitem_heading,subitem_notes) VALUES ".$info."");
	if($this->db->affected_rows()>0){
		return true;
	}else{
		return false;
	}
	}

/* function for new item */	
	/*Get table details start*/
    function get_item_list($filter=false,$table=false)
    {
		$query = $this->db->get_where($table, $filter);
		return $query->Result();
    }
    function get_chapist($table=false){
    	$query=$this->db->query("SELECT * from ".$table." ");
    	return $query->Result();
    }
	/*Get table details end*/
	
 /* when we delete item */	
	function delete_item($item_id=false){
		$this->db->query("DELETE FROM `ssr_t_calculation` WHERE `item_id`='".$item_id."' ");
		$this->db->query("DELETE FROM `ssr_t_subitem` WHERE `item_id`='".$item_id."' ");
		$this->db->query("DELETE FROM `ssr_t_item` WHERE `item_id`='".$item_id."' ");

	}
/* when we delete subitem */
	function delete_subitem($subitem_id=false){
		$this->db->query("DELETE FROM `ssr_t_calculation` WHERE `subitem_id`='".$subitem_id."' ");
		$this->db->query("DELETE FROM `ssr_t_subitem` WHERE `subitem_id`='".$subitem_id."' ");
	}
	
function get_subitem_names(){
		$query=$this->db->query("SELECT DISTINCT `item_id`, `subitem_name`, `subitem_desc`, `unit_code` FROM ssr_t_subitem ORDER BY `item_id`, `subitem_name`");
		return $query->Result();
	}
	
	function get_subitem_ids_list($ids=false)
	{   
	  $query=$this->db->query("select * from ssr_t_subitem where `subitem_id` in(".$ids.")");
	  return $query->Result();
	}
    
function search($keyword)
			{		
					$this->db->like('chap_name',$keyword);
					$query  =   $this->db->get('ssr_t_chapter');
					return $query->result();
			} 
			function search_item($keyword)
			{
					$this->db->like('item_name',$keyword);
					$this->db->or_like('item_desc',$keyword);
					$query2 = $this->db->get('ssr_t_item');
					return $query2->result();
			}
			function search_subitem($keyword)
			{
					$this->db->like('subitem_name',$keyword);
					$this->db->or_like('subitem_desc',$keyword);
					$query3= $this->db->get('ssr_t_subitem');
					return $query3->result();
			}
			
/* function used for search the code for calculation in subitem calculation  */
			function search_auto($search)
			{
					$this->db->like('code',$search);
					$query = $this->db->get('ssr_t_calculation');
					return $query->result();
			}
			function dropdown_item($keyword,$item_drop)
			{
					$this->db->like('item_desc',$keyword);
					$this->db->where('chap_id',$item_drop);
					$qry = $this->db->get('ssr_t_item');
					return $qry->result();
			}
			function dropdown_subitem($keyword,$item_drop)
			{
					$this->db->like('subitem_desc',$keyword);
					$this->db->where('chap_id',$item_drop);
					$qry = $this->db->get('ssr_t_subitem');
					return $qry->result();
			}
			function dep_dropdown_item($keyword,$item_drop)
			{
					$this->db->like('item_desc',$keyword);
					$this->db->where('dep_id',$item_drop);
					$qry = $this->db->get('ssr_t_item');
					return $qry->result();
			}
			function dep_dropdown_subitem($keyword,$item_drop)
			{
					$this->db->like('subitem_desc',$keyword);
					$this->db->where('dep_id',$item_drop);
					$qry = $this->db->get('ssr_t_subitem');
					return $qry->result();
			}
	// create function for search
			function sub_items_drop($keyword,$sub_item_drop)
			{
					$this->db->like('subitem_desc',$keyword);
					$this->db->where('item_id',$sub_item_drop);
					$qry = $this->db->get('ssr_t_subitem');
					return $qry->result();
			}
			function dipart()
			{
				$this->db->select("dep_id,dep_name");
				$qry= $this->db->get('ssr_t_department');
				return $qry->result();
			}
//function for data table search in subitemcal.php start 15 may by ankit 		
			function search_code_ajax($type_val)
		{
			if($type_val=='material')
			{
				$this->db->select('mat_name');
				$qry = $this->db->get('ssr_t_material');
				return $qry->result();
			}
			elseif($type_val=='labour')
			{
				$this->db->select('labour_name');
				$qry = $this->db->get('ssr_t_labor');
				return $qry->result();
			}
			elseif($type_val=='refrence')
			{
				$this->db->select('name');
				$qry = $this->db->get('ssr_t_reference');
				return $qry->result();
			}
			elseif($type_val=='carriage')
			{
				$this->db->select('carriage_code');
				$qry = $this->db->get('ssr_t_carriage');
				return $qry->result();
			}
			elseif($type_val=='overhead')
			{
				$this->db->select('overhead_name');
				$qry = $this->db->get('ssr_t_overhead');
				return $qry->result();
			}
			elseif($type_val=='plant')
			{
				$this->db->select('pla_code');
				$qry = $this->db->get('ssr_t_plant');
				return $qry->result();
			}
			else
			{
				$this->db->select('subitem_name');
				$qry = $this->db->get('ssr_t_subitem');
				return $qry->result();
			}
		}
	//function for data table search in subitemcal.php end 22 may by ankit 		
			
			
			
}
?>
