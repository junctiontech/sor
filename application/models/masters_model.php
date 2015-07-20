<?php
class masters_model extends CI_Model 
{
    var $title   = '';
    var $content = '';
    var $date    = '';
    function __construct()
    {
        parent::__construct();
		$this->load->database();
    }
/*function start for INSERT CLASS , UNIT AND MATERIAL NAME IN MATERIAL */
     function get_class_list(){
    	$query=$this->db->query("SELECT * from `ssr_t_class` ORDER BY `class_name` ASC");
    	return $query->Result();
    }
    function get_material_list(){
    	$query=$this->db->query("SELECT * from `ssr_t_material` ORDER BY `mat_name` ASC");
    	return $query->Result();
    }
    function get_unitlist(){
    	$query=$this->db->query("SELECT * from `ssr_t_uom` ");
    	
    	return $query->Result();
    }
 /* function end for INSERT CLASS , UNIT AND MATERIAL NAME IN MATERIAL */
    
/* function start for TABLE DETAILS OF chapter list */
    function get_chap_list($filter=false,$table=false)
    {	$this->db->order_by("chap_name", "ASC");
    	$query = $this->db->get_where($table, $filter);
    	return $query->Result();
    }
/* function end for TABLE DETAILS OF chapter list  */
	
/* function start for TABLE DETAILS OF MATERIAL */
    function get_list($filter=false,$table=false)
    {
    	$query = $this->db->get_where($table, $filter);
    	return $query->Result();
    }
/* function end for TABLE DETAILS OF MATERIAL  */
/* function start for INSERT  & UPDATE MATERIAL */
    function update_material($info=false,$filter=false)
    {
    	$this->db->where($filter);
    	$this->db->update('ssr_t_material',$info);
    	$id = $filter['mat_code'];
    	return $id;
    }
    function manage_material($info=false)
    {
    	$this->db->query("INSERT ignore INTO ssr_t_material (mat_name,mat_desc,material_class_id,unit_code,rate) VALUES ".$info."");
    	if($this->db->affected_rows()>0){
    		return true;
    	}else{
    		return false;
    	}
    }
 /* fuction end for INSERT & UPDATE MATERIAL */
/* function start for DELETE ALL THE MANAGE SECTION LIKE MATERIAL,LABOUR,OVERHEAD,UNIT,CARRIAGE,PLANT,ITEMCLASS,REF */
    function delete_material($filter=false,$table=false){
    	$this->db->delete($table, $filter);
    }
/* function end for DELETE ALL THE MANAGE SECTION LIKE MATERIAL,LABOUR,OVERHEAD,UNIT,CARRIAGE,PLANT,ITEMCLASS,REF */

/* function for LABOUR LIST */
    function get_labour_list(){
    	$query=$this->db->query("SELECT * from `ssr_t_labor` ORDER BY `labour_name` ASC");
    	return $query->Result();
    }
/* function end for LABOUR LIST */

/* function start for INSERT and UPDATE  LABOUR */
    function update_labour($info=false,$filter=false)
    {
    	$this->db->where($filter);
    	$this->db->update('ssr_t_labor',$info);
    	$id = $filter['labour_name'];
    	return $id;
    }
    function manage_labour($info=false)
    {
    	$this->db->query("INSERT ignore INTO ssr_t_labor (labour_name,labour_description,unit_code,labour_rate) VALUES ".$info."");
    	if($this->db->affected_rows()>0){
    		return true;
    	}else{
    		return false;
    	}
    }
/* function end for INSERT  and UPDATE LABOUR */
/*  function start for OVERHEAD */
    function get_overhead_list(){
    	$query=$this->db->query("SELECT * from `ssr_t_overhead` ORDER BY `overhead_name` ASC");
    	return $query->Result();
    }
/* function end for OVERHEAD  */
/* function start for INSERT AND UPDATE OVERHEAD */
    function update_overhead($info=false,$filter=false)
    {
    	$this->db->where($filter);
    	$this->db->update('ssr_t_overhead',$info);
    	$id = $filter['overhead_code'];
    	return $id;
    }
    function manage_overhead($info=false)
    {
    	$this->db->query("INSERT ignore INTO ssr_t_overhead (overhead_name,overhead_desc,overhead_percent) VALUES ".$info."");
    	if($this->db->affected_rows()>0){
    		return true;
    	}else{
    		return false;
    	}
    }
/* function end for INSERT AND UPDATE OVERHEAD */
 
/* function start for UNIT */
    function get_unit_list(){
    	$query=$this->db->query("SELECT * from `ssr_t_uom` ORDER BY `unit_code` ASC");
    	return $query->Result();
    }
/* function END  for UNIT */
/*  function start for INSERT & UPDATE UNIT */
    function manage_unit($info=false)
    {
    	$this->db->query("INSERT ignore INTO ssr_t_uom (unit_code,unit_desc) VALUES ".$info."");
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
/*  function end  for INSERT & UPDATE UNIT */
/* function start for CARRIAGE */
    function get_carriage_list(){
    	$query=$this->db->query("SELECT * from `ssr_t_carriage` ORDER BY `carriage_code` ASC");
    	return $query->Result();
    }
/* function end for CARRIAGE */
/* function start for SELECT CATEGORIES  & SUBCATEGORIES LIST IN  CARRIAGE */
    function get_catlist(){
    	$query=$this->db->query("SELECT * from `ssr_t_carriage_cate` ");
    	return $query->Result();
    }
    function get_subcate(){
    	$query=$this->db->query("SELECT * from `ssr_t_carriage_sub_cate` ");
    	return $query->Result();
    }
/* function end for SELECT CATEGORIES  & SUBCATEGORIES LIST IN  CARRIAGE */
/* function start for INSERT & UPDATE CARRIAGE */
    function manage_carriage($info=false)
    {
    	$this->db->query("INSERT ignore INTO ssr_t_carriage (carriage_code,carriage_description,carriage_category,carriage_sub_category,unit_code,carriage_rate) VALUES ".$info."");
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
/* function end for INSERT & UPDATE CARRIAGE */
/* function start for PLANT */
    function get_plan_list(){
    	$query=$this->db->query("SELECT * from `ssr_t_plant` ORDER BY `pla_code` ASC");
    	return $query->Result();
    }
/* function end for PLANT */
  
/* function start for INSERT & UPDATE PLANT */
    function manage_plant($info=false)
    {
    	$this->db->query("INSERT ignore INTO ssr_t_plant (pla_code,pla_desc,unit_code,rate) VALUES ".$info."");
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
/* function end for INSERT  & UPDATE PLANT */
/*functon start for INSERT  & UPDATE  ITEM CLASS  */
    function manage_class($info=false)
    {
    	$this->db->query("INSERT ignore INTO ssr_t_class (class_name,class_desc,class_heading,class_notes) VALUES ".$info."");
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
/*functon end  for INSERT & UPDATE  ITEM CLASS  */

/* function start for REFERENCE */
    function get_refrence(){
    	$query=$this->db->query("SELECT * from `ssr_t_reference` ORDER BY `name` ASC");
    	return $query->Result();
    }
/* function end  for REFERENCE */
/* function start  for SELECT CLASS LIST FOR  REFERENCE */
    function get_cls_list(){
    	$query=$this->db->query("SELECT * from `ssr_t_class` ");
    	return $query->Result();
    }
/* function end  forSELECT CLASS LIST FOR  REFERENCE */
/* function start  for INSERT  & UPDATE  REFERENCE */
    function manage_ref($info=false)
    { 
    $this->db->query("INSERT ignore INTO ssr_t_reference (dep_id,chap_id,item_id,name,description,unit_code,class_id,cost_total,heading,notes) VALUES ".$info."");
    if($this->db->affected_rows()>0){
    	return true;
    }else{
    	return false;
    }
    }
    function update_refrence($info=false,$filter=false)
    {
    	$this->db->where($filter);
    	$this->db->update('ssr_t_reference',$info);
    	$id = $filter['subitem_id'];
    	return $id;
    }
/* function end  for INSERT & UPDATE  REFERENCE */
/*  function stArt for CALCULATION OF REFRENCE */
    function get_costtype(){
    	$query=$this->db->query("SELECT * from `ssr_t_cost_type` ");
    	return $query->Result();
    }
/*  function end for CALCULATION OF REF */
/* function start  for INSERT & UPDATE CALCULATION   */   
    function manage_rel_cal($info=false,$finaltotal=false,$ref_id=false){
    	$this->db->query("INSERT ignore INTO ssr_t_rel_calculation (dep_id,chap_id,item_id,ref_id,serial,item_type,item_desc,code,unit_code,amount,total_amount,quantity,rate,over_head) VALUES ".$info."");
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
    	$this->db->query("DELETE FROM `ssr_t_rel_calculation` WHERE `dep_id`='".$dep_id."' and `chap_id`='".$chap_id."' and `item_id`='".$item_id."' and `ref_id`='".$ref_id."' ");
    	$this->db->query("INSERT ignore INTO ssr_t_rel_calculation (dep_id,chap_id,item_id,ref_id,serial,item_type,item_desc,code,unit_code,amount,total_amount,quantity,rate,over_head) VALUES ".$info."");
    	if($finaltotal){
    		$this->db->query("UPDATE  ssr_t_reference  SET cost_total = ".$finaltotal." WHERE id= '".$ref_id."'");
    	}
    	if($this->db->affected_rows()>0){
    		return true;
    	}else{
    		return false;
    	}
    }
 /* function end for INSERT & UPDATE CALCULATION */   

    /*Update rate and calculation in ssr_t_cal table start....................................*/
    function get_cal_details($filter=false,$table=false)
    {
    	$query = $this->db->get_where($table, $filter);
    	return $query->Result();
    }
    
    function update_rate($info=false,$filter=false)
    {
    	$this->db->where($filter);
    	$this->db->update('ssr_t_calculation',$info);
    }
    function update_subitem_rate($finaltotal=false,$item_id=false,$subitem_id=false)
    {
    	$this->db->query("UPDATE  ssr_t_subitem  SET rate = ".$finaltotal." WHERE subitem_id= '".$subitem_id."'");
    	$this->db->query("UPDATE  ssr_t_item  SET item_cost_total = ".$finaltotal." WHERE item_id= '".$item_id."'");
    }
    /*Update rate and calculation in ssr_t_cal table end....................................*/
    
}