<?php 
//Model Class for competition start
class Mhome extends CI_Model {
	
	 /**
	 # Programmer : Garima
	 # Mhome Model
	 
	 */
	 
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
    
	
	/*Get table details start*/
    function get_list($filter=false,$table=false)
    {
		//print_r($filter);die;
				
		$query = $this->db->get_where($table, $filter);
		//echo $this->db->last_query();die;
		return $query->Result();
	
    }
	/*Get table details end*/
	
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
	//function change_pass(){
		
	//	$this->db->select('id');
       // $this->db->where('username',$this->session->userdata('uname'));
     //   $this->db->where('password',md5($this->input->post('password')));
      //  $query=$this->db->get('ssr_t_users');
	
	//}
	function get_deplist(){
		$query=$this->db->query("SELECT * from `ssr_t_department` ");
		
	//echo $this->db->last_query();die;
		return $query->Result();
		
	
	}
	function get_chapist($table=false){
		$query=$this->db->query("SELECT * from ".$table." ");
		
	//echo $this->db->last_query();die;
		return $query->Result();
		
	
	}
	function get_costtype(){
		$query=$this->db->query("SELECT * from `ssr_t_cost_type` ");
		
	//echo $this->db->last_query();die;
		return $query->Result();
		
	
	}
	
	function get_code(){
		$query=$this->db->query("SELECT code from `ssr_t_calculation` ");
		//print_r($query);die;
	//echo $this->db->last_query();die;
		return $query->Result();
		
	
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
	function manage_sitem($info=false)
	{ //print_r($info);die;
		$this->db->query("INSERT ignore INTO ssr_t_subitem (dep_id,chap_id,item_id,subitem_name,subitem_desc,unit_code,subitem_class_id,rate,subitem_heading,subitem_notes) VALUES ".$info."");
		//echo $this->db->last_query();die;
		
		if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}  
	}
	function get_unitlist(){
		$query=$this->db->query("SELECT * from `ssr_t_uom` ");
		
	//echo $this->db->last_query();die;
		return $query->Result();
	
	}
	function get_material_list(){
		$query=$this->db->query("SELECT * from `ssr_t_material` ORDER BY `mat_name` ASC");
		
	//echo $this->db->last_query();die;
		return $query->Result();
	
	}
	function manage_material($info=false)
	{  
	      $this->db->query("INSERT ignore INTO ssr_t_material (mat_name,mat_desc,material_class_id,unit_code,rate) VALUES ".$info."");
		//echo $this->db->last_query();die;
		
		if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}  
	}
function manage_labour($info=false)
	{  
		$this->db->query("INSERT ignore INTO ssr_t_labor (labour_name,labour_description,unit_code,labour_rate) VALUES ".$info."");
		//echo $this->db->last_query();die;
		
		if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}  
		
	}
	function update_material($info=false,$filter=false)
	{  
		$this->db->where($filter);
			$this->db->update('ssr_t_material',$info);
			$id = $filter['mat_code'];
		return $id;
	}
	function update_labour($info=false,$filter=false)
	{  
		$this->db->where($filter);
			$this->db->update('ssr_t_labor',$info);
			$id = $filter['labour_code'];
		return $id;
	}
	function get_labour_list(){
		$query=$this->db->query("SELECT * from `ssr_t_labor` ORDER BY `labour_name` ASC");
		
	//echo $this->db->last_query();die;
		return $query->Result();
	
	}
	function get_overhead_list(){
		$query=$this->db->query("SELECT * from `ssr_t_overhead` ORDER BY `overhead_name` ASC");
		
	//echo $this->db->last_query();die;
		return $query->Result();
	
	}
	  function manage_overhead($info=false)
	{  
		$this->db->query("INSERT ignore INTO ssr_t_overhead (overhead_name,overhead_desc,overhead_percent) VALUES ".$info."");
		//echo $this->db->last_query();die;
		
		if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}  
		
	}
	 function update_overhead($info=false,$filter=false)
	{  
		$this->db->where($filter);
			$this->db->update('ssr_t_overhead',$info);
			//echo $this->db->last_query();die;
			$id = $filter['overhead_code'];
		return $id;
		
	}
	public function pwd($opw)
	
	{
		 $cpw = $this->input->post('cpassword');

		$data = array(
		'password'=>$cpw
		);
		print_r($data);die;
		$this->db->where('password',$opw);
		 $this->db->select('password');
		$query = $this->db->get('ssr_t_users');
		if(count($query)>0)
		{
			//$this->db->where('name',$oo);
			$upd = $this->input->post('cpassword');
			
			  $this->db->where('
			  password', $opw);
			
			$query1=$this->db->update('ssr_t_users',$data);
		
		$query1 = $this->db->get('ssr_t_users');
		//	print_r($query1);die;
		echo "update successfully";
		}
		//print_r($query);die;
	}
	function change($filter=false,$data=false,$table=false){
			$this->db->where($filter);
			$this->db->update('ssr_t_users',$data);
	}
 function insert_sign()
      {
		$a= $this->input->post('usermailid');
		$this->db->where('usermailid',$a);
        $query = $this->db->get('ssr_t_users');
	   //print_r($query);die;
	if ($query->num_rows() > 0){
	     	// return true;
        	//echo "mail id already exist";
       //  die;
		 return $query->Result();
	redirect('login');
			
            }
			else{
				$data=array
               (
              'usermailid'=>  $this->input->post('usermailid'),
              'password'=>  $this->input->post('password')
               );
        $this->db->insert("ssr_t_users",$data);
			}
    }
	function mail_exists($key)
{
    $this->db->where('usermailid',$key);
    $query = $this->db->get('ssr_t_users');
	//print_r($query);die;
    if ($query->num_rows() > 0){
        return true;
    }
    else{
        return false;
    }
}
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
		

public function check_for($email,$edit_mode=false){
		if($email=='')
				return 1;
			$ci = & get_instance();
			$query = $ci->db->get_where('ssr_t_users',array('usermailid' => $email));
			$result=$query->Result();
			$id=isset($result[0]->id)?$result[0]->id:'';
			if($query->num_rows()>0){
				//print_r("rohit");
				 	if($id==$edit_mode){
							return 1;
						}else{
							return $result;
								//echo "<div class='alert alert-error' >email id  exist in db</div>";
								}
				}	
			else{
			
					echo 1;
			}		
		}
		


function get_record(){
	
	$this->db->where('usermailid',$user);
    $query = $this->db->get('ssr_t_users');
}
	function get_unit_list(){
		$query=$this->db->query("SELECT * from `ssr_t_uom` ORDER BY `unit_code` ASC");
		
	//echo $this->db->last_query();die;
		return $query->Result();
	
	}
	 function manage_unit($info=false)
	{  
		$this->db->query("INSERT ignore INTO ssr_t_uom (unit_code,unit_desc) VALUES ".$info."");
		//echo $this->db->last_query();die;
		
		if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}  
		
	}
	 function update_unit($info=false,$filter=false)
	{  
		$this->db->where($filter);
			$this->db->update('ssr_t_uom',$info);
			
			$id = $filter['unit_code'];
		return $id;
		
	}
	function manage_subitem_cal($info=false,$finaltotal=false,$subitem_id=false,$item_id=false){
		//print_r($finaltotal=false);die;
		$this->db->query("INSERT ignore INTO ssr_t_calculation (dep_id,chap_id,item_id,subitem_id,class_id,serial,item_type,item_desc,code,unit_code,amount,total_amount,quantity,rate) VALUES ".$info."");
		//echo $this->db->last_query();die;
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
function update_subitem_cal($info=false,$finaltotal=false,$dep_id=false,$chap_id=false,$item_id=false,$subitem_id=false){

	  $this->db->query("DELETE FROM `ssr_t_calculation` WHERE `dep_id`='".$dep_id."' and `chap_id`='".$chap_id."' and `item_id`='".$item_id."' and `subitem_id`='".$subitem_id."' ");	
	 
	$this->db->query("INSERT ignore INTO ssr_t_calculation (dep_id,chap_id,item_id,subitem_id,class_id,serial,item_type,item_desc,code,unit_code,amount,total_amount,quantity,rate) VALUES ".$info."");

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
	function get_type_detail($type_val,$type_code){
		   
		  if($type_val==='material'){
			
			$query = $this->db->query("select rate,unit_code,mat_desc from ssr_t_material WHERE mat_name='".$type_code."'");
			//echo $this->db->last_query();die;
			return	 $query->Result();
			 
			 
			 
		  }else if($type_val==='labour'){
			  
			  $query = $this->db->query("select labour_rate,unit_code,labour_description from ssr_t_labor WHERE labour_name='".$type_code."'");
			//echo $this->db->last_query();die;
			 return $query->Result();
			  
			  
		  }else if($type_val==='refrence'){
			 $query = $this->db->query("select unit_code,description,cost_total from ssr_t_reference WHERE name='".$type_code."'");
			//echo $this->db->last_query();die;
			 return $query->Result(); 
			  
		  }else if($type_val==='carriage'){
			 $query = $this->db->query("select unit_code,carriage_description,carriage_rate from ssr_t_carriage WHERE carriage_code='".$type_code."'");
			//echo $this->db->last_query();die;
			 return $query->Result(); 
			  
		  }else if($type_val==='plant'){
			 $query = $this->db->query("select unit_code,pla_desc,rate from ssr_t_plant WHERE pla_code='".$type_code."'");
			//echo $this->db->last_query();die;
			 return $query->Result(); 
			  
		  }else if($type_val==='subitem'){
			  
			  	$query = $this->db->query("select unit_code,subitem_desc,rate from ssr_t_subitem WHERE subitem_name='".$type_code."'");
			//echo $this->db->last_query();die;
			 return $query->Result(); 
			  
			}else{
			 $query = $this->db->query("select overhead_desc,overhead_percent from ssr_t_overhead WHERE overhead_name='".$type_code."'");
			//echo $this->db->last_query();die;
			 return $query->Result(); 
			  
		  }
		
	}
	function get_plan_list(){
		$query=$this->db->query("SELECT * from `ssr_t_plant` ORDER BY `pla_code` ASC");
		
	//echo $this->db->last_query();die;
		return $query->Result();
	
	}
	function manage_plant($info=false)
	{  
		$this->db->query("INSERT ignore INTO ssr_t_plant (pla_code,pla_desc,unit_code,rate) VALUES ".$info."");
		//echo $this->db->last_query();die;
		
		if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}  
	}
	function update_plant($info=false,$filter=false)
	{  
		$this->db->where($filter);
			$this->db->update('ssr_t_plant',$info);
			$id = $filter['pla_code'];
		return $id;
	}
	function get_carriage_list(){
		$query=$this->db->query("SELECT * from `ssr_t_carriage` ORDER BY `carriage_code` ASC");
		
	//echo $this->db->last_query();die;
		return $query->Result();
	
	}
	
	function manage_carriage($info=false)
	{  
		$this->db->query("INSERT ignore INTO ssr_t_carriage (carriage_code,carriage_description,carriage_category,carriage_sub_category,unit_code,carriage_rate) VALUES ".$info."");
		//echo $this->db->last_query();die;
		
		if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}  
		
	}
	function update_carriage($info=false,$filter=false)
	{  
		$this->db->where($filter);
			$this->db->update('ssr_t_carriage',$info);
			$id = $filter['carriage_code'];
		return $id;
	}
		function export_pdf($filter=false)
    {
		//print_r($filter);die;
				
		$query = $this->db->get_where('ssr_t_costing', $filter);
		//echo $this->db->last_query();
		return $query->Result();
	
    }
 function get_class_list(){
		$query=$this->db->query("SELECT * from `ssr_t_class` ORDER BY `class_name` ASC");
		
	//echo $this->db->last_query();die;
		return $query->Result();
	
	}	

 function manage_class($info=false)
	{  
		$this->db->query("INSERT ignore INTO ssr_t_class (class_name,class_desc,class_heading,class_notes) VALUES ".$info."");
		//echo $this->db->last_query();die;
		
		if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}  
		
	}
	function update_item_class($info=false,$filter=false)
	{  
		$this->db->where($filter);
			$this->db->update('ssr_t_class',$info);
			//echo $this->db->last_query();die;
			$id = $filter['class_code'];
		return $id;
		
	}
	function get_item_cls_list($ids=false)
	{   // print_r($ids);die;
		//$this->db->from('ssr_t_class');

	  // if($ids !== NULL) 
	  // {
		  // $this->db->where_in('id',$ids);
	   //}    
	   //$query = $this->db->get();
	 
	  //return $query->Result();
	  $query=$this->db->query("select * from ssr_t_class where `id` in (".$ids.")");
	  //echo $this->db->last_query();die;
	  return $query->Result();
	   }
		function get_cls_list(){
		$query=$this->db->query("SELECT * from `ssr_t_class` ");
		
	//echo $this->db->last_query();die;
		return $query->Result();
	
	
		   
	   }
	   function get_refrence(){
		$query=$this->db->query("SELECT * from `ssr_t_reference` ORDER BY `name` ASC");
		
	//echo $this->db->last_query();die;
		return $query->Result();
	
	
		   
	   }
	   function manage_ref($info=false)
	{ //print_r($info);die;
		$this->db->query("INSERT ignore INTO ssr_t_reference (dep_id,chap_id,item_id,name,description,unit_code,class_id,cost_total,heading,notes) VALUES ".$info."");
		//echo $this->db->last_query();die;
		
		if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}  
	}
	function manage_rel_cal($info=false,$finaltotal=false,$ref_id=false){
		//print_r($finaltotal=false);die;
		$this->db->query("INSERT ignore INTO ssr_t_rel_calculation (dep_id,chap_id,item_id,ref_id,serial,item_type,item_desc,code,unit_code,amount,total_amount,quantity,rate) VALUES ".$info."");
		//echo $this->db->last_query();die;
		if($finaltotal){
		$this->db->query("UPDATE  ssr_t_reference  SET cost_total = ".$finaltotal." WHERE id= '".$ref_id."'");
		
		}
		if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}
	  
	}
	
	

function update_rel_cal($info=false,$finaltotal=false,$dep_id=false,$chap_id=false,$item_id=false,$ref_id=false){
		//print_r($finaltotal);die;
	
		
		 $this->db->query("DELETE FROM `ssr_t_rel_calculation` WHERE `dep_id`='".$dep_id."' and `chap_id`='".$chap_id."' and `item_id`='".$item_id."' and `ref_id`='".$ref_id."' ");	 
		 
		$this->db->query("INSERT ignore INTO ssr_t_rel_calculation (dep_id,chap_id,item_id,ref_id,serial,item_type,item_desc,code,unit_code,amount,total_amount,quantity,rate) VALUES ".$info."");
		//echo $this->db->last_query();die;
		if($finaltotal){
		$this->db->query("UPDATE  ssr_t_reference  SET cost_total = ".$finaltotal." WHERE id= '".$ref_id."'");
		//echo $this->db->last_query();die;
		}
		if($this->db->affected_rows()>0){
			//echo"r";die;
			return true;
		}else{
			//echo"t";die;
			return false;
		}
	}
	function update_item($info=false,$filter=false)
	{  
		$this->db->where($filter);
			$this->db->update('ssr_t_item',$info);
			
			$id = $filter['item_id'];
		return $id;
	}
	function update_subitem($info=false,$filter=false)
	{  
		$this->db->where($filter);
			$this->db->update('ssr_t_subitem',$info);
			$id = $filter['subitem_id'];
		return $id;
	}
	
	/*Get table details start*/
    function get_item_list($filter=false,$table=false)
    {
		//print_r($filter);die;
		//$this->db->order_by("item_name", "asc"); 		
		$query = $this->db->get_where($table, $filter);
		//$this->db->order_by("item_name","asc");
	//echo $this->db->last_query();die;
		return $query->Result();
	
    }
	/*Get table details end*/
	
	/*estimation model start*/
	
	function get_subitem_ids_list_est($filter=false)
	{  
		//print_r($filter);die;	
	  $query=$this->db->query("select * from ssr_t_subitem where `subitem_id` in(".$filter.")");
	  return $query->Result();
	}
	function get_subitem_est_cal($filter=false)
	{   
	  $query=$this->db->query("select * from ssr_t_estimate_sitem where `est_id` in(".$filter.")");
	 
	  return $query->Result();
	}
	
	function insert_estsitem($data=false)
	{   
	 $this->db->insert('ssr_t_estimate_sitem',$data);
	
	}
	function update_estsitem($data=false,$filter=false)
	{   
	 $this->db->where($filter);
			$this->db->update('ssr_t_estimate_sitem',$data);
	
	}
	
	function manage_estimate_cal($info=false,$finaltotal=false,$dep_id=false,$chap_id=false,$item_id=false,$subitem_id=false,$est_id=false){
		
		$v = $this->db->query("INSERT ignore INTO ssr_t_estimate_cal (est_id,dep_id,chap_id,item_id,subitem_id,number,length,width,heigth) VALUES ".$info."");
//	print_r($v);die;
		if($finaltotal){
			/*$info=array('est_id'=>$est_id,
			'dep_id'=>$dep_id,
			'chap_id'=>$chap_id,
			'item_id'=>$item_id,
			'subitem_id'=>$subitem_id,
			'amount'=>0,
			'quantity'=>$finaltotal,
			'created_by'=>'rohit',
			'updated_by'=>'rohit');
			$this->db->insert('ssr_t_estimate_sitem',$info);*/
			$this->db->query("UPDATE   ssr_t_estimate_sitem  SET quantity = ".$finaltotal." WHERE subitem_id= '".$subitem_id."'");
		}
		if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}
	}
	
	function update_estimate_cal($info=false,$finaltotal=false,$dep_id=false,$chap_id=false,$item_id=false,$subitem_id=false,$est_id=false,$filter=false){
		
	$this->db->delete('ssr_t_estimate_cal', $filter); 
	 $this->db->query("INSERT ignore INTO ssr_t_estimate_cal (est_id,dep_id,chap_id,item_id,subitem_id,number,length,width,heigth) VALUES ".$info."");
	// print_r($v);die;
	
	if($finaltotal){
		
	$this->db->query("UPDATE   ssr_t_estimate_sitem  SET quantity = ".$finaltotal." WHERE subitem_id= '".$subitem_id."'");
	//echo $this->db->last_query();die;
	}
	if($this->db->affected_rows()>0){
	return true;
	}else{
	return false;
	}
}

function update_estimate_submit($amount=false,$est_id=false,$total=false,$description=false){
	
	$this->db->query("UPDATE  ssr_t_estimate_sitem  SET amount = ".$amount." WHERE est_id= '".$est_id."'");
	if($this->db->affected_rows()>0){
	return true;
	}else{
	return false;
	}
}

function insert_estimate($data=false){
					$this->db->insert('ssr_t_estimate',$data);
					
					if($this->db->affected_rows()>0){
					return $est_id=mysql_insert_id();
					}else{
					return false;
					}
}

function update_estimate($data=false,$filter=false){
	$this->db->where($filter);
			$this->db->update('ssr_t_estimate',$data);
			//echo $this->db->last_query();die;
	//$this->db->query("UPDATE  ssr_t_estimate  SET est_total = ".$data." WHERE est_id= '".$filter."'");
	/*if($this->db->affected_rows()>0){*/
return true;
	/*}else{
	return false;
	}*/
}
		function delete_estimate($est_id=false){
		
		$this->db->query("DELETE FROM `ssr_t_estimate_cal` WHERE `est_id`='".$est_id."' ");
		$this->db->query("DELETE FROM `ssr_t_estimate_sitem` WHERE `est_id`='".$est_id."' ");
		$this->db->query("DELETE FROM `ssr_t_estimate` WHERE `est_id`='".$est_id."' ");
		}
		function final_estimate($est_id=false){
			$filter=array('est_id'=>$est_id);
			$data=array('est_status'=>'final');
			$this->db->where($filter);
			$this->db->update('ssr_t_estimate',$data);
		
		}
		function delete_estimate_sitem($filter=false){
			
		$this->db->delete('ssr_t_estimate_cal', $filter);
		$this->db->delete('ssr_t_estimate_sitem', $filter);
		}
	/**estimation model end*/
	
	function delete_item($item_id=false){

		//$this->db->delete($table, $filter);
		$this->db->query("DELETE FROM `ssr_t_calculation` WHERE `item_id`='".$item_id."' ");
		$this->db->query("DELETE FROM `ssr_t_subitem` WHERE `item_id`='".$item_id."' ");
		//echo $this->db->last_query();die;
		$this->db->query("DELETE FROM `ssr_t_item` WHERE `item_id`='".$item_id."' ");
		//echo $this->db->last_query();die;
		

	}
	function delete_subitem($subitem_id=false){

		//$this->db->delete($table, $filter); 
		$this->db->query("DELETE FROM `ssr_t_calculation` WHERE `subitem_id`='".$subitem_id."' ");
		$this->db->query("DELETE FROM `ssr_t_subitem` WHERE `subitem_id`='".$subitem_id."' ");
		//echo $this->db->last_query();die;
		

	}
	function delete_material($filter=false,$table=false){

		$this->db->delete($table, $filter); 
		
		//echo $this->db->last_query();die;
	}
	function update_refrence($info=false,$filter=false)
	{  
		$this->db->where($filter);
			$this->db->update('ssr_t_reference',$info);
			$id = $filter['subitem_id'];
		return $id;
	}
	function get_subitem_names(){
		$query=$this->db->query("SELECT DISTINCT `item_id`, `subitem_name`, `subitem_desc`, `unit_code` FROM ssr_t_subitem ORDER BY `item_id`, `subitem_name`");
		
	//echo $this->db->last_query();die;
		return $query->Result();
	
	}
	function get_catlist(){
		$query=$this->db->query("SELECT * from `ssr_t_carriage_cate` ");
		
	//echo $this->db->last_query();die;
		return $query->Result();
	
	}
	function get_subcate(){
		$query=$this->db->query("SELECT * from `ssr_t_carriage_sub_cate` ");
		
	//echo $this->db->last_query();die;
		return $query->Result();
	
	}
	function get_subitem_ids_list($ids=false)
	{   
	  $query=$this->db->query("select * from ssr_t_subitem where `subitem_id` in(".$ids.")");
	  //echo $this->db->last_query();die;
	  return $query->Result();
	}
    function login_check($table=false,$data=false){
		
	  $query = $this->db->get_where($table,$data);
		
		//echo $this->db->last_query();die;
	  if($query->num_rows()>0){
		   return $query->row();
		}else{
			//echo"invalid user name or password";
			//die;
			return false;
		}

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
			function dipart()
			{
					$this->db->select("dep_id,dep_name");
					$qry= $this->db->get('ssr_t_department');
					return $qry->result();
			}
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
			function sub_items_drop($keyword,$sub_item_drop)
			{
					$this->db->like('subitem_desc',$keyword);
					$this->db->where('item_id',$sub_item_drop);
					$qry = $this->db->get('ssr_t_subitem');
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
				//print_r($qry);die;
				return $qry->result();
			}
			elseif($type_val=='refrence')
			{
				$this->db->select('name');
				$qry = $this->db->get('ssr_t_reference');
				//print_r($qry);die;
				return $qry->result();
			}
			elseif($type_val=='carriage')
			{
				$this->db->select('carriage_code');
				$qry = $this->db->get('ssr_t_carriage');
				//print_r($qry);die;
				return $qry->result();
			}
			elseif($type_val=='overhead')
			{
				$this->db->select('overhead_name');
				$qry = $this->db->get('ssr_t_overhead');
				//print_r($qry);die;
				return $qry->result();
			}
			elseif($type_val=='plant')
			{
				$this->db->select('pla_code');
				$qry = $this->db->get('ssr_t_plant');
				//print_r($qry);die;
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
