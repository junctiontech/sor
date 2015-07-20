<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
	/**
	Developer : Rohit
	Utilities : Utilities Class for customization function
	*/
	
class Utilities extends CI_Controller {

public function __construct() {
         # parent::__construct();
		$this->data['title'] = 'dev_phe';
		
		$ci =& get_instance();
		
		$ci->load->model('mhome');
		
	 }
	 
	 function get_lang($language_id)
	 {
	 	$CI = & get_instance();
	 
	 	$CI->db->where('language_id',$language_id);
	 //	$CI->db->order_by('chap_id','asc');
	 	$query = $CI->db->get('ssr_t_language');
	 
	 	return $query->result();
	 }
	
	/* Function to get list of chapter according to selected department*/
	function get_chapter($dep_id)
	{ 
		$CI = & get_instance();
		
		$CI->db->where('dep_id',$dep_id);
		$CI->db->order_by('chap_id','asc');
		$query = $CI->db->get('ssr_t_chapter');
		
		return $query->result();
	}
	/* Function to get list of item according to selected chapter*/

	function get_item($filter=false)
	{ 
		$CI = & get_instance();
		
		$query =  $CI->db->get_where('ssr_t_item', $filter);
	
		return $query->result();
	}
	function unit_list(){
		$CI = & get_instance();
		$query=$CI->db->query("SELECT * from `ssr_t_uom` ");
		
	//echo $this->db->last_query();die;
		return $query->Result();
	
	}
	function class_list(){
		$CI = & get_instance();
		$query=$CI->db->query("SELECT * from `ssr_t_class` ");
		
	//echo $this->db->last_query();die;
		return $query->Result();
	
	}
	function get_unit_name($table=false,$filter=false)
	{ 
		
		
		$CI = & get_instance();
		
		  $CI->db->select('unit_code');
		$query = $CI->db->get_where($table,$filter);
		//echo $CI->db->last_query();die;
		return $query->result();
		
	}
	
	function get_est($table=false,$filter=false)
	{ 
		$CI = & get_instance();
		 $CI->db->select('*');
		$query = $CI->db->get_where($table,$filter);
		//echo $CI->db->last_query();die;
		return $query->result();
		
	}
	
	function get_dep_name($table=false,$filter=false)
	{ 
		
		
		$CI = & get_instance();
		
		  $CI->db->select('dep_name');
		$query = $CI->db->get_where($table,$filter);
		//echo $CI->db->last_query();die;
		return $query->result();
		
		
		
		
		
	}
	function get_chap_name($table=false,$filter=false)
	{ 
		
		
		$CI = & get_instance();
		
		  $CI->db->select('chap_name');
		$query = $CI->db->get_where($table,$filter);
		//echo $CI->db->last_query();die;
		return $query->result();
		
		
		
		
		
	}
	function get_item_name($table=false,$filter=false)
	{ 
		
		
		$CI = & get_instance();
		
		  $CI->db->select('item_name');
		$query = $CI->db->get_where($table,$filter);
		//echo $CI->db->last_query();die;
		return $query->result();
		
		
		
		
		
	}
	 public function check_unitname($unit_code,$typ=false,$edit_mode=false){
		
			if($unit_code=='')
				return 1;
		$CI = & get_instance();
			
		
					$query = $CI->db->get_where('ssr_t_uom',array('unit_code' => $unit_code));
					//echo $CI->db->last_query();die;
			//print_r($query);die;
			$result=$query->Result();
			$id=isset($result[0]->id)?$result[0]->id:'';
			if($query->num_rows()>0){
				 	//echo"hhh";die;
					if($id==$edit_mode){
							return 1;
						}else{
								echo "<div class='alert alert-error' >This Unit already exist </div>";			
							}
			
			}else{
				//echo"dfkljdl";die;
				echo 1;
			}	
			
		}
		function get_cls_name($table=false,$filter=false)
	{ 
		
		
		$CI = & get_instance();
		
		  $CI->db->select('class_name');
		$query = $CI->db->get_where($table,$filter);
		//echo $CI->db->last_query();die;
		return $query->result();
		
	}
	function cat_list(){
		$CI = & get_instance();
		$query=$CI->db->query("SELECT * from `ssr_t_carriage_cate` ");
		
	//echo $this->db->last_query();die;
		return $query->Result();
	
	}
	function sub_cat_list(){
		$CI = & get_instance();
		$query=$CI->db->query("SELECT * from `ssr_t_carriage_sub_cate` ");
		
	//echo $this->db->last_query();die;
		return $query->Result();
	
	}
	function get_cat_name($table=false,$filter=false)
	{ 
		
		
		$CI = & get_instance();
		
		  $CI->db->select('name');
		$query = $CI->db->get_where($table,$filter);
		//echo $CI->db->last_query();die;
		return $query->result();
		
	}
	function get_subcat_name($table=false,$filter=false)
	{ 
		
		
		$CI = & get_instance();
		
		  $CI->db->select('sub_category');
		$query = $CI->db->get_where($table,$filter);
		//echo $CI->db->last_query();die;
		return $query->result();
		
	}
	
	
	public function check_material($material,$edit_mode=false){
		
			if($material=='')
				return 1;
			$ci = & get_instance();
			
			$query = $ci->db->get_where('ssr_t_material',array('mat_name' => $material));
			$result=$query->Result();
			//print_r($result);
			$id=isset($result[0]->id)?$result[0]->id:'';
			if($query->num_rows()>0){
				 	
					if($id==$edit_mode){
							return 1;
						}else{
								echo "<div class='alert alert-error' >material id already registered with us.</div>";			
							}
				
			}	
			else{
			
					echo 1;
			}		
		}
		
	
	
}



?>
