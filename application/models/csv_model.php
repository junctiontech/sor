<?php
 
class Csv_model extends CI_Model {
 
    function __construct() {
        parent::__construct();
 
    }
 
    function get_csv_list($table=false) { 
   
        $query = $this->db->get($table);
     
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
 
    function insert_csv($table=false,$data=false) {
		
        $this->db->insert($table, $data);
    }
    function update_subitem_rate($subitem_id=false,$finaltotal=false) {
   
    	$this->db->query("UPDATE  ssr_t_subitem  SET rate = ".$finaltotal." WHERE subitem_id= '".$subitem_id."'");
    }
}