<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common_functions extends CI_Controller {

	 /*
	 # Programmer : Garima Soni
	 # Common_functions controller.
	 */
	function __construct()
	{
		parent::__construct();
		$this->data = array();
		$this->load->library('parser');
		$this->load->model('mhome');
		$this->data['base_url']=base_url();
	}
	
	/*function get_subitem_list($dep_id,$chap_id,$item_id){
	       
		       $this->data['dep_id'] = $dep_id;
		       $this->data['chap_id'] = $chap_id;
		       $this->data['item_id'] = $item_id;
			$filter = array('dep_id'=> $dep_id,
			                'chap_id'=>$chap_id,
							'item_id'=>$item_id);
			$this->data['subitem_list'] = $this->mhome->get_list($filter,'ssr_t_subitem');
			
			//print_r($this->data['subitem_list']);die;
			
		 $this->parser->parse('subitem_list', $this->data);
		
	}*/
	public function check_email($edit_mode=false)
	{ 
		$email = $this->input->post('email');
		$this->mhome->check_email($email,$edit_mode);
	}
	
public function check_forget($edit_mode=false)
{ 
		$email = $this->input->post('email');
		$pass=$this->mhome->check_for($email,$edit_mode);
		if($pass){
		 $config = Array(
  'protocol' => 'smtp',
  'smtp_host' => 'smtp.gmail.com',
  'smtp_port' => 465,
  'smtp_user' => 'dev_sor@gmail.com', // change it to yours
  'smtp_pass' => '$pass', // change it to yours
  'mailtype' => 'html',
  'charset' => 'iso-8859-1',
  'wordwrap' => TRUE
);
$this->load->library('email', $config);
		$password=$pass[0]->password;
		$this->load->library('email', array('mailtype'=>'html'));
        $this->email->from('dev_sor@gmail.com', "Site");
        $this->email->to($this->input->post('email'));
        $this->email->subject("Reset your Password");
		$message ="<p>Your password is</p>" .$password;
		$this->email->message($message);}	
}  

	function update_order($tablename=false,$filter=false){
		foreach ($_GET['listItem'] as $position => $item){
			$this->mmicrosite->update_details_by_table_info($tablename,
					array("order"=>$position),array((!empty($filter))?$filter:"id"=>$item));
		}
		 
	}
	
	function get_type_value($type_val,$type_code){
	      $data = $this->mhome->get_type_detail($type_val,$type_code);
			
		/*code start......................................................*/

		if($type_val=='refrence'){
			$filter = array('unit_code'=>$data[0]->unit_code);
			 $unit_name= $this->utilities->get_unit_name('ssr_t_uom',$filter);
			 $data[0]->unit_code=$unit_name[0]->unit_code;
			 $data_unit = (array)$data;	
			 print_r(json_encode($data_unit));
			   
			   
		   }else if($type_val=='overhead'){
			  print_r(json_encode($data));
			    
			   
		   }else if($type_val=='labour'){
			       $filter = array('unit_code'=>$data[0]->unit_code);
			 $unit_name= $this->utilities->get_unit_name('ssr_t_uom',$filter);
			 $data[0]->unit_code=$unit_name[0]->unit_code;
			 $data_unit = (array)$data;	
			 print_r(json_encode($data_unit));
			   
			}else if($type_val=='carriage'){
			     $filter = array('unit_code'=>$data[0]->unit_code);
			 $unit_name= $this->utilities->get_unit_name('ssr_t_uom',$filter);
			 $data[0]->unit_code=$unit_name[0]->unit_code;
			 $data_unit = (array)$data;	
			 print_r(json_encode($data_unit));
			   
			}else if($type_val=='plant'){
			    $filter = array('unit_code'=>$data[0]->unit_code);
			 $unit_name= $this->utilities->get_unit_name('ssr_t_uom',$filter);
			 $data[0]->unit_code=$unit_name[0]->unit_code;
			 $data_unit = (array)$data;	
			 print_r(json_encode($data_unit));
			   
			}else if($type_val=='subitem'){
				 $filter = array('unit_code'=>$data[0]->unit_code);
			 $unit_name= $this->utilities->get_unit_name('ssr_t_uom',$filter);
			 $data[0]->unit_code=$unit_name[0]->unit_code;
			 $data_unit = (array)$data;	
			 print_r(json_encode($data_unit));
				
			}else{   
			    $filter = array('unit_code'=>$data[0]->unit_code);
			 $unit_name= $this->utilities->get_unit_name('ssr_t_uom',$filter);
			 $data[0]->unit_code=$unit_name[0]->unit_code;
			 $data_unit = (array)$data;	
			 print_r(json_encode($data_unit));	
			  
		   }


			/*code start......................................................*/
			 
		
	}
	public function show_chapter()
	{
		$dep_id = $this->input->post('dep_id');
		$current_val = $this->input->post('current_value');
		
		$chap_list = $this->utilities->get_chapter($dep_id);
		$demo_function='show_item(this.value,0,"'.$dep_id.'")';
        $demo_function_2="onChange='".$demo_function."'";
		echo "<select name='chap_id' id='chap_id' class='form-control' data-rule-required='true' ".$demo_function_2." >
				<option value='' >Select</option> ";
		foreach($chap_list as $ct)	
		{ 
			if($current_val==$ct->chap_id)
				echo "<option value='".$ct->chap_id."' selected >".$ct->chap_name."</option>";
			else
				echo "<option value='".$ct->chap_id."'>".$ct->chap_name."</option>";
		}
		echo "</select>";	
		echo "<span for='select'  class='help-block'>This field is required.</span>";	
	
	}
	public function show_item()
	{
		$chap_id = $this->input->post('chap_id');
                $dep_id = $this->input->post('dep_id');
		//print_r($chap_id);die;
		$current_val = $this->input->post('current_value');
		
		$filter = array('chap_id'=>$chap_id,'dep_id'=>$dep_id);
		$item_list = $this->utilities->get_item($filter);
		
	$demo_function='show_sitem(this.value,0,"'.$dep_id.'","'.$chap_id.'")';
        $demo_function_2="onChange='".$demo_function."'";
		echo "<select name='item_id' id='item_id' class='form-control' data-rule-required='true' data-rule-required='true' ".$demo_function_2.">
				<option value='' >Item</option> ";
		foreach($item_list as $ct)	
		{
			if($current_val==$ct->id)
				echo "<option value='".$ct->item_id."' selected >".$ct->item_name."</option>";
			else
				echo "<option value='".$ct->item_id."'>".$ct->item_name."</option>";
		}
		echo "</select>";
		echo "<span for='select'  class='help-block'>This field is required.</span>";		
	
	}
	function show_sitem($dep_id=false,$chap_id=false,$item_id=false){
	       
		    //print_r($chap_id);die;
		     
		       $this->data['item_id'] = $item_id;
		       $this->data['chap_id'] = $chap_id;
		       $this->data['dep_id'] = $dep_id;
			$filter = array('item_id'=>$item_id,'chap_id'=>$chap_id,'dep_id'=>$dep_id);
			$subitem_list=$this->data['subitem_list'] = $this->mhome->get_list($filter,'ssr_t_subitem');
		
		echo "<select multiple name='subitem_id[]' id='subitem_id' class='form-control' data-rule-required='true'  >
				<option value='' >Select</option> ";
		foreach($subitem_list as $ct)	
		{ 
			if($current_val==$ct->chap_id)
				echo "<option value='".$ct->subitem_id."' selected >".$ct->subitem_name."</option>";
			else
				echo "<option value='".$ct->subitem_id."'>".$ct->subitem_name."</option>";
		}
		echo "</select>";	
		echo "<span for='select'  class='help-block'>This field is required.</span>";
			//print_r($this->data['subitem_list']);die;
			
		 //$this->parser->parse('filter_manage_subitem', $this->data);
		
	}
public function show_itemchapter()
	{
		$dep_id = $this->input->post('dep_id');
		$chap_id = $this->input->post('chap_id');
		$current_val = $this->input->post('current_value');
		
		$chap_list = $this->utilities->get_chapter($dep_id);
		
		$demo_function='show_item_list(this.value,0,"'.$dep_id.'","'.$chap_id.'")';
		$demo_function_2="onChange='".$demo_function."'";
		echo "<select name='chap_id' id='chap_id' class='form-control' data-rule-required='true' ".$demo_function_2." >
				<option value='' >Chapter</option> ";
		foreach($chap_list as $ct)	
		{
			if($current_val==$ct->id)
				echo "<option value='".$ct->chap_id."' selected >".$ct->chap_name."</option>";
			else
				echo "<option value='".$ct->chap_id."'>".$ct->chap_name."</option>";
		}
		echo "</select>";	
		echo "<span for='select'  class='help-block'>This field is required.</span>";	
	
	}
public function show_item_list($chap_id=false,$dep_id=false){
	
	         $this->data['chap_id'] = $chap_id;
			$filter = array('chap_id'=>$chap_id,'dep_id'=>$dep_id);
			$this->data['item_list'] = $this->mhome->get_list($filter,'ssr_t_item');
			
			//print_r($this->data['item_list']);die;
			
		 $this->parser->parse('filter_manage_item', $this->data);
	
}	
public function show_chapterlist($dep_id=false){
	
	         $this->data['dep_id'] = $dep_id;
			$filter = array('dep_id'=>$dep_id);
			$this->data['chap_list'] = $this->mhome->get_list($filter,'ssr_t_chapter');
			
			//print_r($this->data['subitem_list']);die;
			
		 $this->parser->parse('filter_manage_chapter', $this->data);
	
}
public function check_unitname($edit_mode=false)
	{
		$unit_code = $this->input->post('unit_code');
		
	
		$this->utilities->check_unitname($unit_code,false,$edit_mode);
		
	}
public function show_estimation(){
	
	       //print_r($this->input->post('selected'));die;
		//$selected = $this->input->post('selected');
		 $string = trim($this->input->post('selected'), " ,");
		// print_r($comma_separated);die;
			$this->data['subitem_list'] = $this->mhome->get_subitem_ids_list($string);
			
			//print_r($this->data['subitem_list']);die;
			
		 $this->parser->parse('estimation', $this->data);
	
}



public function check_material($edit_mode=false)
	{  
		$material = $this->input->post('material');
		//print_r($material);die;
	
		$this->utilities->check_material($material,$edit_mode);
		
	}
 
   //function for data table search in subitemcal.php start 15 may by ankit 
   public function search_code_ajax()
{
	 $type_val = $this->input->post('value');
	 $row= $this->input->post('row_id');
	 $code = $this->data['code'] = $this->mhome->search_code_ajax($type_val);
	 if($type_val=='material')
	 {
			  
			 ?>	 
		 <input type="text" class="input-mini-xs span6 " style="margin: 0" id="coded_<?=$row?>" data-provide="typeahead" data-items="5" data-source="[ <?php $i=count($code); foreach($code as $codes){ $i--;  ?>&quot;<?php echo $codes->mat_name;?>&quot;<?php if(!$i==0){ echo ",";} else{ echo ""; } } ?> ]"
											name="code[]" onchange="get_type_value(this.id,'dataTable');" 
											value="<?=(empty($codes->mat_name))?$codes->mat_name:"";?>">
		  <?php
	 }
	 if($type_val=='labour')
	 {
		 $key='';
		 ?>	 
		 <input type="text" class="input-mini-xs span6 " style="margin: 0" id="coded_<?=$row?>" data-provide="typeahead" data-items="5" data-source="[ <?php $i=count($code); foreach($code as $codes){ $i--;  ?>&quot;<?php echo $codes->labour_name;?>&quot;<?php if(!$i==0){ echo ",";} else{ echo ""; } } ?> ]"
											name="code[]" onchange="get_type_value(this.id,'dataTable');" 
											value="<?=(empty($codes->labour_name))?$codes->labour_name:"";?>">
	  <?php
	 }
	if($type_val=='refrence')
	 {
		 $key='';
		 ?>	 
		 <input type="text" class="input-mini-xs span6 " style="margin: 0" id="coded_<?=$row?>" data-provide="typeahead" data-items="5" data-source="[ <?php $i=count($code); foreach($code as $codes){ $i--;  ?>&quot;<?php echo $codes->name;?>&quot;<?php if(!$i==0){ echo ",";} else{ echo ""; } } ?> ]"
											name="code[]" onchange="get_type_value(this.id,'dataTable');" 
											value="<?=(empty($codes->name))?$codes->name:"";?>">
	 <?php
	 }
	if($type_val=='carriage')
	 {
		 $key='';
		 ?>	 
		 <input type="text" class="input-mini-xs span6 " style="margin: 0" id="coded_<?=$row?>" data-provide="typeahead" data-items="5" data-source="[ <?php $i=count($code); foreach($code as $codes){ $i--;  ?>&quot;<?php echo $codes->carriage_code;?>&quot;<?php if(!$i==0){ echo ",";} else{ echo ""; } } ?> ]"
											name="code[]" onchange="get_type_value(this.id,'dataTable');" 
											value="<?=(empty($codes->carriage_code))?$codes->carriage_code:"";?>">
	  <?php
	 }
	if($type_val=='plant')
	 {
		 $key='';
		 ?>	 
		 <input type="text" class="input-mini-xs span6 " style="margin: 0" id="coded_<?=$row?>" data-provide="typeahead" data-items="5" data-source="[ <?php $i=count($code); foreach($code as $codes){ $i--;  ?>&quot;<?php echo $codes->pla_code;?>&quot;<?php if(!$i==0){ echo ",";} else{ echo ""; } } ?> ]"
											name="code[]" onchange="get_type_value(this.id,'dataTable');" 
											value="<?=(empty($codes->pla_code))?$codes->pla_code:"";?>">
	  
	  <?php
	 }
	  if($type_val=='overhead')
	 {
		 $key='';
		 ?>	 
		 <input type="text" class="input-mini-xs span6 " style="margin: 0" id="coded_<?=$row?>" data-provide="typeahead" data-items="5" data-source="[ <?php $i=count($code); foreach($code as $codes){ $i--;  ?>&quot;<?php echo $codes->overhead_name;?>&quot;<?php if(!$i==0){ echo ",";} else{ echo ""; } } ?> ]"
											name="code[]" onchange="get_type_value(this.id,'dataTable');" 
											value="<?=(empty($codes->overhead_name))?$codes->overhead_name:"";?>">
	  <?php
	 }
	 if($type_val=='text')
	 {
		 $key='';
		 ?>
		 <input type="text" class="input-mini-xs span6 " style="margin: 0" id="coded_<?=$row?>" data-provide="typeahead" data-items="5" data-source="[  ]"
									name="code[]" onchange="get_type_value(this.id,'dataTable');" 
									value=""> 
	<?php
	 }
	 if($type_val=='convert')
	 {
		 $key='';
		 ?>
		 <input type="text" class="input-mini-xs span6 " style="margin: 0" id="coded_<?=$row?>" data-provide="typeahead" data-items="5" data-source="[  ]"
									name="code[]" onchange="get_type_value(this.id,'dataTable');" 
									value=""> 
	<?php
	 }
	 if($type_val=='subitem')
	 {
		 $key='';
		 ?>
		 <input type="text" class="input-mini-xs span6 " style="margin: 0" id="coded_<?=$row?>" data-provide="typeahead" data-items="5" data-source="[  ]"
									name="code[]" onchange="get_type_value(this.id,'dataTable');" 
									value=""> 
	<?php
	 }
}
//function for data table search in subitemcal.php End 22 may by ankit 

}	
?>
