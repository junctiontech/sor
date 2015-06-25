<?php 
class estimation_model extends CI_Model {
    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        parent::__construct();
		$this->load->database();
    }
  /* FUNCTION START FOR ESTIMATION PAGE */  
    function get_subitem_ids_list_est($filter=false)
    {
    	$query=$this->db->query("select * from ssr_t_subitem where `subitem_id` in(".$filter.")");
    	return $query->Result();
    }
    function get_subitem_est_cal($filter=false)
    {
    	$query=$this->db->query("select * from ssr_t_estimate_sitem where `est_id` in(".$filter.")");
    	return $query->Result();
    }
/* FUNCTION END FOR ESTIMATION PAGE  */ 
/* FUNCTION START FOR  update estimate and estimate item insert estimate and insert estimate item */
    function update_estimate($data=false,$filter=false){
    	$this->db->where($filter);
    	$this->db->update('ssr_t_estimate',$data);
    	return true;
    }
    function update_estsitem($data=false,$filter=false)
    {
    	$this->db->where($filter);
    	$this->db->update('ssr_t_estimate_sitem',$data);
    }
    function insert_estimate($data=false){
    	$this->db->insert('ssr_t_estimate',$data);
    	if($this->db->affected_rows()>0){
    		return $est_id=mysql_insert_id();
    	}else{
    		return false;
    	}
    }
    function insert_estsitem($data=false)
    {
    	$this->db->insert('ssr_t_estimate_sitem',$data);
    
    }
/* FUNCTION END  FOR  update estimate and estimate item insert estimate and insert estimate item */
/* FUNCTION START FOR UPDATE AND INSERT CALCULATION WHEN WE ENTER THE VALUE */
    function update_estimate_cal($info=false,$finaltotal=false , $subitem_id=false,$est_id=false,$filter=false){
    
    	$this->db->delete('ssr_t_estimate_cal', $filter);
    	$this->db->query("INSERT ignore INTO ssr_t_estimate_cal (est_id,subitem_id,number,length,width,heigth) VALUES ".$info."");
    	if($finaltotal){
    		$this->db->query("UPDATE   ssr_t_estimate_sitem  SET quantity = ".$finaltotal." WHERE subitem_id= '".$subitem_id."'");
    	}
    	if($this->db->affected_rows()>0){
    		return true;
    	}else{
    		return false;
    	}
    }
    function manage_estimate_cal($info=false,$finaltotal=false,$subitem_id=false,$est_id=false){
    
    	$v = $this->db->query("INSERT ignore INTO ssr_t_estimate_cal (est_id,subitem_id,number,length,width,heigth) VALUES ".$info."");
    	if($finaltotal){
    		$this->db->query("UPDATE   ssr_t_estimate_sitem  SET quantity = ".$finaltotal." WHERE subitem_id= '".$subitem_id."'");
    	}
    	if($this->db->affected_rows()>0){
    		return true;
    	}else{
    		return false;
    	}
    }
/* FUNCTION END FOR UPDATE AND INSERT CALCULATION WHEN WE ENTER THE VALUE */
/* FUNCTION START FOR WHEN WE CLICK ON ADD SUBITEMS FOR ESTIMATION */
    function get_deplist(){
    	$query=$this->db->query("SELECT * from `ssr_t_department` ");
    	return $query->Result();
    }
/* FUNCTION END FOR WHEN WE CLICK ON ADD SUBITEMS FOR ESTIMATION */
/* FUNCTION START FOR DELETE BUTTIONS OF ESTIMATION   */
    function delete_estimate($est_id=false){
    
    	$this->db->query("DELETE FROM `ssr_t_estimate_cal` WHERE `est_id`='".$est_id."' ");
    	$this->db->query("DELETE FROM `ssr_t_estimate_sitem` WHERE `est_id`='".$est_id."' ");
    	$this->db->query("DELETE FROM `ssr_t_estimate` WHERE `est_id`='".$est_id."' ");
    }
/* FUNCTION end FOR DELETE BUTTIONS OF ESTIMATION   */
/* FUNCTION START FOR  WHEN WE FINALIZE  BUTTION */
    function final_estimate($est_id=false){
    	$filter=array('est_id'=>$est_id);
    	$data=array('est_status'=>'final');
    	$this->db->where($filter);
    	$this->db->update('ssr_t_estimate',$data);
    }
    /* FUNCTION END FOR  WHEN WE FINALIZE  BUTTION */
    /* FUNCTION START FOR DELETE SUBITEM ESTIMATION  */
    function delete_estimate_sitem($filter=false){
    		
    	$this->db->delete('ssr_t_estimate_cal', $filter);
    	$this->db->delete('ssr_t_estimate_sitem', $filter);
    }
    /* FUNCTION END FOR DELETE SUBITEM ESTIMATION  */
}