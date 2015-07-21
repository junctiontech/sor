<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Masters extends CI_Controller {
	 function __construct() {
		parent::__construct();
		$this->data[]="";
		$this->data['user_data']="";
		$this->data['url'] = base_url();
		$this->load->model('masters_model');
		$this->load->model('login_model');
		
		$this->load->model('authority_model');
		$this->load->model('mhome');
		$this->load->library('parser');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->data['base_url']=base_url();
		$this->load->library('authority');
		$user_session_data = $this->session->userdata('user_data');
		$name=$user_session_data['language_id'];
		$namehome = $this->data['namehome']= $this->login_model->lang($name,'ssr_t_text');
	 }
 public function index()
	 {
	 	$this->breadcrumb->clear();
	 	$this->breadcrumb->add_crumb('Home', base_url().'index.php/masters');
	 	$this->parser->parse('include/header',$this->data);
	 	$this->parser->parse('masters',$this->data);
	 	 $this->parser->parse('include/footer',$this->data);
	 } 
/* function start for MATERIAL */
	 public function material()
	 {
	 	    Authority::is_logged_in();
	 		Authority::checkAuthority('material');
	 		$this->data['mat_list'] = $this->masters_model->get_material_list();
	 		$this->data['unit_list'] = $this->masters_model->get_unitlist();
	 		$this->breadcrumb->clear();
	 		$this->breadcrumb->add_crumb('Home', base_url());
	 		$this->breadcrumb->add_crumb('Deshboard', base_url().'index.php/masters');
	 		$this->breadcrumb->add_crumb('Material', '');
	 		$this->parser->parse('include/header',$this->data);
	 		$this->parser->parse('include/leftmenu',$this->data);
	 		$this->load->view('material_list',$this->data);
	 		$this->parser->parse('include/footer',$this->data);
	 }
	 
/* function  end for  MATERIAL  */
/*function start for ADD NEW MATERIAL & WHEN WE CLICK ON EDIT BUTTION  */
	 
	 public function manage_material($mat_code=false)
	 {
	 	      Authority::is_logged_in();
	 	if(Authority::checkAuthority('manage_material')==true)
	 	{
	 		redirect('masters/material');
	 	}
	 	else{
	 		if($mat_code){
	 			$filter = array('mat_name'=>$mat_code);
	 			$material_info = $this->masters_model->get_list($filter,'ssr_t_material');
	 			$this->data['material_info'] = $this->masters_model->get_list($filter,'ssr_t_material');
	 			$this->data = array('mat_name'=>$material_info[0]->mat_name,
	 					'mat_desc'=>$material_info[0]->mat_desc,
	 					'material_class_id'=>$material_info[0]->material_class_id,
	 					'unit_code'=>$material_info[0]->unit_code,
	 					'rate'=>$material_info[0]->rate,
	 					'created_by' => 1,
	 					'created_on' => date("Y-m-d"));
	 			$this->data['mat_name']=$mat_code;
	 	 		}else{
	 			$this->data['material_info']='';
	 		}
	 		$this->breadcrumb->clear();
	 		$this->breadcrumb->add_crumb('Home', base_url());
	 		$this->breadcrumb->add_crumb('Deshboard', base_url().'index.php/masters');
	 		$this->breadcrumb->add_crumb('Material', base_url().'index.php/masters/labour');
	 		$this->breadcrumb->add_crumb('Manage Material', base_url().'index.php/masters/material');
	 		$this->data['unit_list'] = $this->masters_model->get_unitlist();
	 		$this->data['class_list'] = $this->masters_model->get_class_list();
	 		$this->parser->parse('include/header',$this->data);
	 		$this->parser->parse('include/leftmenu',$this->data);
	 		$this->parser->parse('add_material',$this->data);
	 		$this->parser->parse('include/footer',$this->data);
	 	}
	 }
/* function end for  ADD NEW  MATERIAL  & WHEN WE CLICK ON EDIT BUTTION  */
/*function  start for  INSERT & UPDATE MATERIAL */
	 
	 function add_material(){
	 	      Authority::is_logged_in();
	 		if($this->input->post('submit')){
	 			$data = $this->input->post();
	 			$value = "";
	 			if($this->input->post('id')){
	 			$info = array( 'mat_name'=>$this->input->post('mat_name'),
	 						'mat_desc' => $this->input->post('mat_desc'),
	 						'material_class_id' => $this->input->post('material_class_id'),
	 						'unit_code' => $this->input->post('unit_code'),
	 						'rate' => $this->input->post('rate'),
	 						'created_by' => 1,
	 						'created_on' => date("Y-m-d"),
	 						'updated_by' => 1,
	 						'updated_on' => date("Y-m-d"));
	 				$this->masters_model->update_material($info,array('mat_name'=>$this->input->post('id')));
	 				
	 				$filter=array('code'=>$this->input->post('mat_name'));
	 				$this->update_rate($filter);
	 				
	 				$this->session->set_flashdata('message_type', 'success');
	 				$this->session->set_flashdata('message', $this->config->item("material").' updated successfully');
	 				redirect("masters/material");
	 			}
	 			else{
	 				for($i=0;$i<=count($data['mat_name'])-1; $i++){
	 					$value .= "('".$data['mat_name'][$i]."','".$data['mat_desc'][$i]."','".$data['material_class_id'][$i]."','".$data['unit_code'][$i]."','".$data['rate'][$i]."')".",";
	 				}

	 				if($this->masters_model->manage_material(rtrim($value,","))){
	 					$this->session->set_flashdata('message_type', 'success');
	 					$this->session->set_flashdata('message', $this->config->item("material").' Added successfully');
	 					redirect("masters/material");
	 
	 				}
	 				else{
	 					echo "Error while Adding Material";
	 				}
	 			}
	 		}
	 }
 /* function end  for INSERT & UPDATE MATERIAL  */
/* function start for LABOUR */ 
	 
	    public function labour()
	 {
	 	Authority::is_logged_in();
         Authority::checkAuthority('labour');
	 		$this->data['labour_list'] = $this->masters_model->get_labour_list();
	 		$this->data['unitlist'] = $this->masters_model->get_unitlist();
	 		$this->breadcrumb->clear();
	 		$this->breadcrumb->add_crumb('Home', base_url());
	 		$this->breadcrumb->add_crumb('Deshboard', base_url().'index.php/masters');
	 		$this->breadcrumb->add_crumb('Labour', '');
	 		$this->parser->parse('include/header',$this->data);
	 		$this->parser->parse('include/leftmenu',$this->data);
	 		$this->load->view('labour_list',$this->data);
	 		$this->parser->parse('include/footer',$this->data);
	 	}  
/* function end for LABOUR */
/* function start for  ADD NEW  LABOUR  & WHEN WE CLICK ON EDIT BUTTION   */
	 	
	 public function manage_labour($labour_code=false)
	 {
	 	Authority::is_logged_in();
	 	if(Authority::checkAuthority('manage_labour')==true)
	 	{
	 		redirect('masters/labour');
	 	}
	 	else{
	 		$user_session_data = $this->session->userdata('user_data');
	 		$name=$user_session_data['language_id'];
	 		$namehome = $this->data['namehome']= $this->login_model->lang($name,'ssr_t_text');
	 		$this->data['unit_list'] = $this->masters_model->get_unitlist();
	 		if($labour_code){
	 			$filter = array('labour_name'=>$labour_code);
	 
	 			$labour_info = $this->masters_model->get_list($filter,'ssr_t_labor');
	 			$this->data = array('labour_name'=>$labour_info[0]->labour_name,
	 					'labour_description'=>$labour_info[0]->labour_description,
	 					'unit_code'=>$labour_info[0]->unit_code,
	 					'labour_rate'=>$labour_info[0]->labour_rate,
	 					'created_by' => 1,
	 					'created_on' => date("Y-m-d"));
	 			$this->data['labour_name']=$labour_code;
	 			if($labour_code !== ''){
	 			
	 				$namehome = $this->data['namehome']= $this->login_model->lang($name,'ssr_t_text');
	 				
	 			}
	 		}
	 		$this->breadcrumb->clear();
	 		$this->breadcrumb->add_crumb('Home', base_url());
	 		$this->breadcrumb->add_crumb('Deshboard', base_url().'index.php/masters');
	 		$this->breadcrumb->add_crumb('Labour', base_url().'index.php/masters/labour');
	 		$this->breadcrumb->add_crumb('Manage Labour', base_url().'index.php/masters/labour');
	 		$this->parser->parse('include/header',$this->data);
	 		$this->parser->parse('include/leftmenu',$this->data);
	 		$this->parser->parse('add_labour',$this->data);
	 		$this->parser->parse('include/footer',$this->data);
	 	}
	 }
/* function end for  ADD NEW LABOUR  & WHEN WE CLICK ON EDIT BUTTION  */
/* function start for INSERT & UPDATE  LABOUR */
	 function add_labour(){
	 			Authority::is_logged_in();
	 	if($this->input->post('submit')){
	 			$data = $this->input->post();	 
	 			$value = "";
	 			if($this->input->post('id')){	
	 				$info = array( 'labour_name'=>$this->input->post('labour_name'),
	 						'labour_description' => $this->input->post('labour_description'),
	 						'unit_code' => $this->input->post('unit_code'),
	 						'labour_rate' => $this->input->post('labour_rate'),
	 						'created_by' => 1,
	 						'created_on' => date("Y-m-d"),
	 						'updated_by' => 1,
	 						'updated_on' => date("Y-m-d"));
	 				$this->masters_model->update_labour($info,array('labour_name'=>$this->input->post('id')));
	 				
	 				$filter=array('code'=>$this->input->post('labour_name'));
	 				$this->update_rate($filter);
	 				
	 				$this->session->set_flashdata('message_type', 'success');
	 				$this->session->set_flashdata('message', $this->config->item("labour").' updated successfully');
	 				redirect("masters/labour");
	 			}else{
	 				for($i=0;$i<=count($data['labour_name'])-1; $i++){
	 					$value .= "('".$data['labour_name'][$i]."','".$data['labour_description'][$i]."','".$data['unit_code'][$i]."','".$data['labour_rate'][$i]."')".",";
	 				}
	 				if($this->masters_model->manage_labour(rtrim($value,","))){
	 					$this->session->set_flashdata('message_type', 'success');
	 					$this->session->set_flashdata('message', $this->config->item("labour").' Added successfully');
	 					redirect("masters/labour");
	 				}else{
	 					echo "Error while Adding Labour";
	 				}
	 			}
	 	}
	 }
/* function end for INSERT  & UPDATE  LABOUR */
/* function start for OVERHEAD */

	  public function overhead()
	 {
	 		Authority::is_logged_in();
	 		Authority::checkAuthority('overhead');
	 		$this->data['overhead_list'] = $this->masters_model->get_overhead_list();
	 		$this->breadcrumb->clear();
	 		$this->breadcrumb->add_crumb('Home', base_url());
	 		$this->breadcrumb->add_crumb('Deshboard', base_url().'index.php/masters');
	 		$this->breadcrumb->add_crumb('Overhead', base_url());
	 		$this->parser->parse('include/header',$this->data);
	 		$this->parser->parse('include/leftmenu',$this->data);
	 		$this->load->view('overhead_list',$this->data);
	 		$this->parser->parse('include/footer',$this->data);
	 	}
	 
/* function end for OVERHEAD */
/* function  start for ADD NEW  OVERHEAD & WHEN WE CLICK ON EDIT BUTTION  */
	 	
	 	public function manage_overhead($overhead_code=false)
	 	{
	 				Authority::is_logged_in();
	 		if(Authority::checkAuthority('manage_overhead')==true)
	 		{
	 			redirect('masters/overhead');
	 		}
	 		else{
	 			$user_session_data = $this->session->userdata('user_data');
	 			$name=$user_session_data['language_id'];
	 			$namehome = $this->data['namehome']= $this->login_model->lang($name,'ssr_t_text');
	 			
	 			if($overhead_code){
	 				$filter = array('overhead_name'=>$overhead_code);
	 				$overhead_info = $this->masters_model->get_list($filter,'ssr_t_overhead');
	 				$this->data = array('overhead_name'=>$overhead_info[0]->overhead_name,
	 						'overhead_desc'=>$overhead_info[0]->overhead_desc,
	 						'overhead_percent'=>$overhead_info[0]->overhead_percent,
	 						'created_by' => 1,
	 						'created_on' => date("Y-m-d"));
	 				$this->data['overhead_name']=$overhead_code;
	 				if($overhead_code !== ''){
	 					$namehome = $this->data['namehome']= $this->login_model->lang($name,'ssr_t_text');
	 					
	 					
	 				}
	 			}
	 			$this->breadcrumb->clear();
	 			$this->breadcrumb->add_crumb('Home', base_url());
	 			$this->breadcrumb->add_crumb('Deshboard', base_url().'index.php/masters');
	 			$this->breadcrumb->add_crumb('Overhead', base_url().'index.php/masters/unit');
	 			$this->breadcrumb->add_crumb('Manage Overhead', base_url().'index.php/masters/unit');
	 			$this->parser->parse('include/header',$this->data);
	 			$this->parser->parse('include/leftmenu',$this->data);
	 			$this->parser->parse('add_overhaed',$this->data);
	 			$this->parser->parse('include/footer',$this->data);
	 		}
	 	}
/* function end for ADD NEW OVERHEAD & WHEN WE CLICK ON EDIT BUTTION  */
/* function start for INSERT & UPDATE  OVERHEAD */
	 	
	 	function add_overhead(){
	 			Authority::is_logged_in();
	 			if($this->input->post('submit')){
	 				$data = $this->input->post();
		 			$value = "";
	 				if($this->input->post('id')){
	 					$info = array( 'overhead_name'=>$this->input->post('overhead_name'),
	 							'overhead_desc' => $this->input->post('overhead_desc'),
	 							'overhead_percent' => $this->input->post('overhead_percent'),
	 							'created_by' => 1,
	 							'created_on' => date("Y-m-d"),
	 							'updated_by' => 1,
	 							'updated_on' => date("Y-m-d"));	 	
	 					$this->masters_model->update_overhead($info,array('overhead_name'=>$this->input->post('id')));
	 					
	 					$filter=array('code'=>$this->input->post('overhead_name'));
	 					$this->update_rate($filter);
	 					
	 					$this->session->set_flashdata('message_type', 'success');
	 					$this->session->set_flashdata('message', $this->config->item("overhead").' updated successfully');
	 					redirect("masters/overhead");
	 				} else {
	 					for($i=0;$i<=count($data['overhead_name'])-1; $i++){
	 						$value .= "('".$data['overhead_name'][$i]."','".$data['overhead_desc'][$i]."','".$data['overhead_percent'][$i]."')".",";
	 					}
	 					if($this->masters_model->manage_overhead(rtrim($value,","))){
	 						$this->session->set_flashdata('message_type', 'success');
	 						$this->session->set_flashdata('message', $this->config->item("overhead").' Added successfully');
	 						redirect("masters/overhead");
	 					}else{
	 						echo "Error while Adding Overhead";
	 					}
	 				}
	 		}
	 	}
/* function end  for INSERT  & UPDATE  OVERHEAD */
/* function start for UNIT */
	 	
	 	public function unit()
	 	{
	 			Authority::is_logged_in();
                Authority::checkAuthority('unit');
	 			$this->data['unit_list'] = $this->masters_model->get_unit_list();
	 			$this->breadcrumb->clear();
	 			$this->breadcrumb->add_crumb('Home', base_url());
	 			$this->breadcrumb->add_crumb('Deshboard', base_url().'index.php/masters');
	 			$this->breadcrumb->add_crumb('Unit', '');
	 			$this->parser->parse('include/header',$this->data);
	 			$this->parser->parse('include/leftmenu',$this->data);
	 			$this->load->view('unit_list',$this->data);
	 			$this->parser->parse('include/footer',$this->data);
	 		}
/* function end for UNIT */
 
 /* function start for ADD NEW UNIT & WHEN WE CLICK ON EDIT BUTTION  */
	 		
	 		public function manage_unit($unit_code=false)
	 		{
	 			Authority::is_logged_in();
	 			if(Authority::checkAuthority('manage_unit')==true)
	 			{
	 				redirect('masters/unit');
	 			}
	 			else{
	 				$user_session_data = $this->session->userdata('user_data');
	 				$name=$user_session_data['language_id'];
	 				$namehome = $this->data['namehome']= $this->login_model->lang($name,'ssr_t_text');
	 				
	 				if($unit_code){
	 					$unit_code=urldecode($unit_code);
	 					$filter = array('unit_code'=>$unit_code);
	 				//	print_r($filter);die;
	 					$unit_info = $this->masters_model->get_list($filter,'ssr_t_uom');
	 					$this->data = array(
	 							'unit_code'=>$unit_info[0]->unit_code,
	 							'unit_desc'=>$unit_info[0]->unit_desc,
	 							'created_by' =>1,
	 							'created_on' =>date("Y-m-d"));
	 					$this->data['unit_code']=urldecode($unit_code);
	 					if($unit_code !== ''){
	 						$namehome = $this->data['namehome']= $this->login_model->lang($name,'ssr_t_text');
	 						
	 						
	 					}
	 				}
	 				$this->breadcrumb->clear();
	 				$this->breadcrumb->add_crumb('Home', base_url());
	 				$this->breadcrumb->add_crumb('Deshboard', base_url().'index.php/masters');
	 				$this->breadcrumb->add_crumb('Unit', base_url().'index.php/masters/unit');
	 				$this->breadcrumb->add_crumb('Manage Unit','');
	 				$this->parser->parse('include/header',$this->data);
	 				$this->parser->parse('include/leftmenu',$this->data);
	 				$this->parser->parse('add_unit',$this->data);
	 				$this->parser->parse('include/footer',$this->data);
	 			}
	 		}
/* function end for ADD NEW UNIT & WHEN WE CLICK ON EDIT BUTTION */
/* function start for INSERT  & UPDATE UNIT */
	 		
	 		function add_unit(){
	 			Authority::is_logged_in();
	 				if($this->input->post('submit')){
	 					$data = $this->input->post();
	 					$value = "";
	 					if($this->input->post('id')){
	 						$info = array( 'unit_code'=>$this->input->post('unit_code'),
	 								'unit_desc' => $this->input->post('unit_desc'),
	 								'created_by' => 1,
	 								'created_on' => date("Y-m-d"),
	 								'updated_by' => 1,
	 								'updated_on' => date("Y-m-d"));
	 						$this->masters_model->update_unit($info,array('unit_code'=>$this->input->post('id')));
	 						$this->session->set_flashdata('message_type', 'success');
	 						$this->session->set_flashdata('message', 'Unit updated successfully');
	 						redirect("masters/unit");
	 					} else {
	 						for($i=0;$i<=count($data['unit_code'])-1; $i++){
	 							$value .= "('".$data['unit_code'][$i]."','".$data['unit_desc'][$i]."')".",";
	 						}
	 						if($this->masters_model->manage_unit(rtrim($value,","))){
	 							$this->session->set_flashdata('message_type', 'success');
	 							$this->session->set_flashdata('message', 'Unit Added successfully');
	 							redirect("masters/unit");
	 						}else{
	 							echo "Error while Adding Unit";
	 						}
	 					}
	 				}
	 			}
	 		
/* function end for  INSERT & UPDATE UNIT */
/* function start for CARRIAGE */
	 			public function carriage()
	 			{
	 					Authority::is_logged_in();
	 					Authority::checkAuthority('carriage');
	 					$this->data['carriage_list'] = $this->masters_model->get_carriage_list();
	 					$this->data['unitlist'] = $this->masters_model->get_unitlist();
	 					$this->breadcrumb->clear();
	 					$this->breadcrumb->add_crumb('Home', base_url());
	 					$this->breadcrumb->add_crumb('Deshboard', base_url().'index.php/masters');
	 					$this->breadcrumb->add_crumb('Carriage', '');
	 					$this->parser->parse('include/header',$this->data);
	 					$this->parser->parse('include/leftmenu',$this->data);
	 					$this->load->view('carriage_list',$this->data);
	 					$this->parser->parse('include/footer',$this->data);
	 				}
/* function end for CARRIAGE */
/* function start for ADD NEW CARRIAGE  & WHEN WE CLICK ON EDIT BUTTION */
	 				
	 				public function manage_carriage($carriage_id=false)
	 				{
	 						Authority::is_logged_in();
	 					if(Authority::checkAuthority('manage_carriage')==true)
	 					{
	 						redirect('masters/carriage');
	 					}
	 					else{
	 						$user_session_data = $this->session->userdata('user_data');
	 						$name=$user_session_data['language_id'];
	 						$namehome = $this->data['namehome']= $this->login_model->lang($name,'ssr_t_text');
	 						if($carriage_id){
	 							$filter = array('carriage_code'=>$carriage_id);
	 							$carriage_info = $this->masters_model->get_list($filter,'ssr_t_carriage');
	 							$this->data = array('carriage_code'=>$carriage_info[0]->carriage_code,
	 									'carriage_description'=>$carriage_info[0]->carriage_description,
	 									'carriage_category'=>$carriage_info[0]->carriage_category,
	 									'carriage_sub_category'=>$carriage_info[0]->carriage_sub_category,
	 									'unit_code'=>$carriage_info[0]->unit_code,
	 									'carriage_rate'=>$carriage_info[0]->carriage_rate,
	 									'created_by' => 1,
	 									'created_on' => date("Y-m-d"));
	 							$this->data['carriage_code']=$carriage_id;
	 							if($carriage_id !== ''){
	 								
	 								$namehome = $this->data['namehome']= $this->login_model->lang($name,'ssr_t_text');
	 									
	 								
	 							}
	 						}
	 						$this->breadcrumb->clear();
	 						$this->breadcrumb->add_crumb('Home', base_url());
	 						$this->breadcrumb->add_crumb('Deshboard', base_url().'index.php/masters');
	 						$this->breadcrumb->add_crumb('Carriage', base_url().'index.php/masters/carriage');
	 						$this->breadcrumb->add_crumb('Manage Carriage','');
	 						$this->data['unit_list'] = $this->masters_model->get_unitlist();
	 						$this->data['catlist'] = $this->masters_model->get_catlist();
	 						$this->data['subcate'] = $this->masters_model->get_subcate();
	 						$this->parser->parse('include/header',$this->data);
	 						$this->parser->parse('include/leftmenu',$this->data);
	 						$this->parser->parse('add_carriage',$this->data);
	 						$this->parser->parse('include/footer',$this->data);
	 					}
	 				}
/* function end for ADD NEW CARRIAGE & WHEN WE CLICK ON EDIT BUTTION */
/* function start for INSERT & UPDATE CARRIAGE */
	 				
	 				function add_carriage(){
	 					Authority::is_logged_in();
	 						if($this->input->post('submit')){
	 							$data = $this->input->post();
	 							$value = "";
	 							if($this->input->post('carriage_id')){
	 								$info = array( 'carriage_code'=>$this->input->post('carriage_code'),
	 										'carriage_description' => $this->input->post('carriage_description'),
	 										'carriage_category' => $this->input->post('carriage_category'),
	 										'carriage_sub_category' => $this->input->post('carriage_sub_category'),
	 										'unit_code' => $this->input->post('unit_code'),
	 										'carriage_rate' => $this->input->post('carriage_rate'),
	 										'created_by' => 1,
	 										'created_on' => date("Y-m-d"),
	 										'updated_by' => 1,
	 										'updated_on' => date("Y-m-d"));
	 								$this->masters_model->update_carriage($info,array('carriage_code'=>$this->input->post('carriage_id')));
	 								
	 								$filter=array('code'=>$this->input->post('carriage_code'));
	 								$this->update_rate($filter);
	 								
	 								$this->session->set_flashdata('message_type', 'success');
	 								$this->session->set_flashdata('message', $this->config->item("carriage").' updated successfully');
	 								redirect("masters/carriage");
	 							}else{
	 								for($i=0;$i<=count($data['carriage_code'])-1; $i++){
	 									$value .= "('".$data['carriage_code'][$i]."','".$data['carriage_description'][$i]."','".$data['carriage_category'][$i]."','".$data['carriage_sub_category'][$i]."','".$data['unit_code'][$i]."','".$data['carriage_rate'][$i]."')".",";
	 								}
	 								if($this->masters_model->manage_carriage(rtrim($value,","))){
	 									$this->session->set_flashdata('message_type', 'success');
	 									$this->session->set_flashdata('message', 'carriage Added successfully');
	 									redirect("masters/carriage");
	 								}else{
	 									echo "Error while Adding carriage";
	 								}
	 							}
	 						}
	 				}
/* function end for INSERT & UPDATE CARRIAGE */
/* function start for PLANT */
	 				public function plant()
	 				{
	 					     Authority::is_logged_in();
	 						Authority::checkAuthority('plant');
	 						$this->data['plan_list'] = $this->masters_model->get_plan_list();
	 						$this->data['unitlist'] = $this->masters_model->get_unitlist();
	 						$this->breadcrumb->clear();
	 						$this->breadcrumb->add_crumb('Home', base_url());
	 						$this->breadcrumb->add_crumb('Deshboard', base_url().'index.php/masters');
	 						$this->breadcrumb->add_crumb('Plant', '');
	 						$this->parser->parse('include/header',$this->data);
	 						$this->parser->parse('include/leftmenu',$this->data);
	 						$this->load->view('plant_list',$this->data);
	 						$this->parser->parse('include/footer',$this->data);
	 					}
/* function end for PLANT */
/* function start for ADD NEW  PLANT  & WHEN WE CLICK ON EDIT BUTTION */
	 					
	 		public function manage_plant($plan_code=false)
	 					{
	 						Authority::is_logged_in();
	 						if(Authority::checkAuthority('manage_plant')==true)
	 						{
	 							redirect('masters/plant');
	 						}
	 						else{
	 							$user_session_data = $this->session->userdata('user_data');
	 							$name=$user_session_data['language_id'];
	 							$namehome = $this->data['namehome']= $this->login_model->lang($name,'ssr_t_text');
	 								
	 							$this->data['unit_list'] = $this->masters_model->get_unitlist();
	 							if($plan_code){
	 								$plan_code=urldecode($plan_code);
	 								$filter = array('pla_code'=>$plan_code);
	 					
	 								$paln_info = $this->masters_model->get_list($filter,'ssr_t_plant');
	 								$this->data = array(
	 										'pla_code'=>$paln_info[0]->pla_code,
	 										'pla_desc'=>$paln_info[0]->pla_desc,
	 										'unit_code'=>$paln_info[0]->unit_code,
	 										'rate'=>$paln_info[0]->rate,
	 										'created_by' => 1,
	 										'created_on' => date("Y-m-d"));
	 								$this->data['plan_code']=urldecode($plan_code);
	 								if($plan_code !== '' ){
	 									
	 									$namehome = $this->data['namehome']= $this->login_model->lang($name,'ssr_t_text');
	 										
	 								}
	 							}
	 							$this->breadcrumb->clear();
	 							$this->breadcrumb->add_crumb('Home', base_url());
	 							$this->breadcrumb->add_crumb('Deshboard', base_url().'index.php/masters');
	 							$this->breadcrumb->add_crumb('Plant', base_url().'index.php/masters/plant');
	 							$this->breadcrumb->add_crumb('Manage Plant', '');
	 							$this->parser->parse('include/header',$this->data);
	 							$this->parser->parse('include/leftmenu',$this->data);
	 							$this->parser->parse('add_plant',$this->data);
	 							$this->parser->parse('include/footer',$this->data);
	 						}
	 					}
	 					
/* function end  for ADD NEW PLANT & WHEN WE CLICK ON EDIT BUTTION */
/* function start for INSERT & UPDATE PLANT */
	 					function add_plant(){
	 						Authority::is_logged_in();
	 							if($this->input->post('submit')){
	 								$data = $this->input->post();
	 								$value = "";
	 								if($this->input->post('id')){
	 									$info = array( 'pla_code'=>$this->input->post('pla_code'),
	 											'pla_desc' => $this->input->post('pla_desc'),
	 											'unit_code' => $this->input->post('unit_code'),
	 											'rate' => $this->input->post('rate'),
	 											'created_by' => 1,
	 											'created_on' => date("Y-m-d"),
	 											'updated_by' => 1,
	 											'updated_on' => date("Y-m-d"));
	 									$this->masters_model->update_plant($info,array('pla_code'=>$this->input->post('id')));
	 									
	 									$filter=array('code'=>$this->input->post('pla_code'));
	 									$this->update_rate($filter);
	 									
	 									$this->session->set_flashdata('message_type', 'success');
	 									$this->session->set_flashdata('message', $this->config->item("Plan").' updated successfully');
	 									redirect("masters/plant");
	 								}else{
	 									for($i=0;$i<=count($data['pla_code'])-1; $i++){
	 										$value .= "('".$data['pla_code'][$i]."','".$data['pla_desc'][$i]."','".$data['unit_code'][$i]."','".$data['rate'][$i]."')".",";
	 									}
	 									if($this->masters_model->manage_plant(rtrim($value,","))){
	 										$this->session->set_flashdata('message_type', 'success');
	 										$this->session->set_flashdata('message', $this->config->item("Plan").' Added successfully');
	 										redirect("masters/plant");
	 									}else{
	 										echo "Error while Adding Labour";
	 										redirect("masters/plant");
	 									}
	 								}
	 							}
	 					} 
/* function end for INSERT & UPDATE PLANT */
/*functon start for ITEM CLASS */
	 					public function item_class()
	 					{
	 						Authority::is_logged_in();
	 							Authority::checkAuthority('item_class');
	 							$this->data['class_list'] = $this->masters_model->get_class_list();
	 							$this->breadcrumb->clear();
	 							$this->breadcrumb->add_crumb('Home', base_url());
	 							$this->breadcrumb->add_crumb('Deshboard', base_url().'index.php/masters');
	 							$this->breadcrumb->add_crumb('Class', '');
	 							$this->parser->parse('include/header',$this->data);
	 							$this->parser->parse('include/leftmenu',$this->data);
	 							$this->load->view('item_class',$this->data);
	 							$this->parser->parse('include/footer',$this->data);
	 						}
/*functon end for ITEM CLASS  */
/*functon start for ADD NEW  ITEM CLASS & WHEN WE CLICK ON EDIT BUTTION  */
	 						
	 						public function manage_item_class($id=false)
	 						{
	 							Authority::is_logged_in();
	 							if(Authority::checkAuthority('manage_item_class')==true)
	 							{
	 								redirect('masters/item_class');
	 							}
	 							else{
	 								$user_session_data = $this->session->userdata('user_data');
	 								$name=$user_session_data['language_id'];
	 								$namehome = $this->data['namehome']= $this->login_model->lang($name,'ssr_t_text');
	 									
	 								if($id){
	 									$filter = array('id'=>$id);
	 									$class_info = $this->masters_model->get_list($filter,'ssr_t_class');
	 									$this->data = array('class_name'=>$class_info[0]->class_name,
	 											'class_desc'=>$class_info[0]->class_desc,
	 											'class_heading'=>$class_info[0]->class_heading,
	 											'class_notes'=>$class_info[0]->class_notes,
	 											'created_by' => 1,
	 											'created_on' => date("Y-m-d"));
	 									$this->data['id']=$id;
	 									if($id !== ''){
	 										$namehome = $this->data['namehome']= $this->login_model->lang($name,'ssr_t_text');
	 											
	 										
	 									}
	 								}
	 								$this->breadcrumb->clear();
	 								$this->breadcrumb->add_crumb('Home', base_url());
	 								$this->breadcrumb->add_crumb('Deshboard', base_url().'index.php/masters');
	 								$this->breadcrumb->add_crumb('Class', base_url().'index.php/masters/item_class');
	 								$this->breadcrumb->add_crumb('Manage Class','');
	 								$this->parser->parse('include/header',$this->data);
	 								$this->parser->parse('include/leftmenu',$this->data);
	 								$this->parser->parse('add_item_class',$this->data);
	 								$this->parser->parse('include/footer',$this->data);
	 							}
	 						}
	 						
/*functon END  for ADD NEW  ITEM CLASS & WHEN WE CLICK ON EDIT BUTTION  */
/*functon start for INSERT & UPDATE  ITEM CLASS  */
	 						function add_item_class(){
	 							Authority::is_logged_in();
	 								if($this->input->post('submit')){
	 									$data = $this->input->post();
	 									$value = "";
	 									if($this->input->post('id')){
	 										$info = array( 'class_name'=>$this->input->post('class_name'),
	 												'class_desc' => $this->input->post('class_desc'),
	 												'class_heading' => $this->input->post('class_heading'),
	 												'class_notes' => $this->input->post('class_notes'),
	 												'created_by' => 1,
	 												'created_on' => date("Y-m-d"),
	 												'updated_by' => 1,
	 												'updated_on' => date("Y-m-d"));
	 										$this->masters_model->update_item_class($info,array('id'=>$this->input->post('id')));
	 										$this->session->set_flashdata('message_type', 'success');
	 										$this->session->set_flashdata('message', 'Class updated successfully');
	 										redirect("masters/item_class");
	 									} else {
	 										for($i=0;$i<=count($data['class_name'])-1; $i++){
	 											$value .= "('".$data['class_name'][$i]."','".$data['class_desc'][$i]."','".$data['class_heading'][$i]."','".$data['class_notes'][$i]."')".",";
	 										}
	 										if($this->masters_model->manage_class(rtrim($value,","))){
	 											$this->session->set_flashdata('message_type', 'success');
	 											$this->session->set_flashdata('message', 'Class Added successfully');
	 											redirect("masters/item_class");
	 										}else{
	 											echo "Error while Adding Class";
	 										}
	 									}
	 								}
	 						}
/*functon end  for INSERT & UPDATE  ITEM CLASS  */
/* function start for REFERENCE */
	 						
	 						public function refrence($id=false){
	 							Authority::is_logged_in();
	 								Authority::checkAuthority('refrence');
	 								$filter = array('id'=>$id);
	 								$this->data['dep_id'] = 2147483647;
	 								$this->data['chap_id'] = 2147483647;
	 								$this->data['item_id'] = 2147483647;
	 								$this->breadcrumb->clear();
	 								$this->breadcrumb->add_crumb('Home', base_url().'index.php/masters');
	 								$this->breadcrumb->add_crumb('Refrence','');
	 								$this->data['refrence_list'] = $this->masters_model->get_refrence();
	 								$this->parser->parse('include/header',$this->data);
	 								$this->parser->parse('include/leftmenu',$this->data);
	 								$this->parser->parse('manage_refrence',$this->data);
	 								$this->parser->parse('include/footer',$this->data);
	 							}
/* function end  for REFERENCE */
/* function start  for ADD NEW  REFERENCE & WHEN WE CLICK ON EDIT BUTTION */
	 							
	 						public function manage_refrence($id=false)
	 						{
	 							Authority::is_logged_in();
	 							if(Authority::checkAuthority('manage_refrence')==true)
	 							{
	 								redirect('masters/refrence');
	 							}
	 							else{
	 								$user_session_data = $this->session->userdata('user_data');
	 								$name=$user_session_data['language_id'];
	 								$namehome = $this->data['namehome']= $this->login_model->lang($name,'ssr_t_text');
	 									
	 								if($id){
	 									$filter = array('id'=>$id);
	 									$refrence_info = $this->masters_model->get_list($filter,'ssr_t_reference');
	 									$this->data = array('dep_id'=>$refrence_info[0]->dep_id,
	 											'chap_id'=>$refrence_info[0]->chap_id,
	 											'item_id'=>$refrence_info[0]->item_id,
	 											'name'=>$refrence_info[0]->name,
	 											'description'=>$refrence_info[0]->description,
	 											'unit_code'=>$refrence_info[0]->unit_code,
	 											'cost_total'=>$refrence_info[0]->cost_total,
	 											'class_id'=>$refrence_info[0]->class_id,
	 											'heading'=>$refrence_info[0]->heading,
	 											'notes'=>$refrence_info[0]->notes);
	 									$this->data['id']=$id;
	 									if($id !== ''){
	 										
	 										$namehome = $this->data['namehome']= $this->login_model->lang($name,'ssr_t_text');
	 											
	 									}
	 								}
	 								$this->breadcrumb->clear();
	 								$this->breadcrumb->add_crumb('Home', base_url());
	 								$this->breadcrumb->add_crumb('Refrence','');
	 								$this->data['unit_list'] = $this->masters_model->get_unitlist();
	 								$this->data['cls_list']=$this->masters_model->get_cls_list();
	 								$this->parser->parse('include/header',$this->data);
	 								$this->parser->parse('include/leftmenu',$this->data);
	 								$this->parser->parse('create_refrence',$this->data);
	 								$this->parser->parse('include/footer',$this->data);
	 							}
	 						}
/* function end  for ADD NEW  REFERENCE & WHEN WE CLICK ON EDIT BUTTION  */
/* function start  for INSERT & UPDATE  REFERENCE */
	 						
	 						function add_refrence(){
	 							Authority::is_logged_in();
	 								if($this->input->post('submit')){
	 									$data = $this->input->post();
	 									$value = "";
	 									if($this->input->post('id')){
	 										$info = array( 'name'=>$this->input->post('name'),
	 												'description' => $this->input->post('description'),
	 												'unit_code' => $this->input->post('unit_code'),
	 												'cost_total' => $this->input->post('cost_total'),
	 												'class_id' => $this->input->post('class_id'),
	 												'heading' => $this->input->post('heading'),
	 												'notes' => $this->input->post('notes'));
	 										$this->masters_model->update_refrence($info,array('id'=>$this->input->post('id')));
	 										$this->session->set_flashdata('message_type', 'success');
	 										$this->session->set_flashdata('message', 'Refrence updated successfully');
	 										redirect("masters/refrence");
	 									}else{
	 										for($i=0;$i<=count($data['name'])-1; $i++){
	 											$value .= "('".$data['dep_id']."','".$data['chap_id']."','".$data['item_id']."','".$data['name'][$i]."','".$data['description'][$i]."','".$data['unit_code'][$i]."','".$data['class_id'][$i]."','".$data['cost_total'][$i]."','".$data['heading'][$i]."','".$data['notes'][$i]."')".",";
	 										}
	 										if($this->masters_model->manage_ref(rtrim($value,","))){
	 											#echo "Menus Added Sucessfully";
	 											$this->session->set_flashdata('message_type', 'success');
	 											$this->session->set_flashdata('message', 'Refrence Added successfully');
	 											redirect("masters/refrence");
	 										}else{
	 											echo "Error while Adding Refrence";
	 										}
	 									}
	 							}
	 						}
/* function end  for INSERT  & UPDATE  REFERENCE */
/* function start for REF CALCULATION  */
	 						
 public function create_ref_cal($dep_id=false,$chap_id=false,$item_id=false,$ref_id=false,$class_id=false)
	{ 
Authority::is_logged_in();
		if(Authority::checkAuthority('create_ref_cal')==true)
			{
					redirect('masters/refrence');
			}
		else{	
		       $this->data['dep_id'] = $dep_id;
		       $this->data['chap_id'] = $chap_id;
		       $this->data['item_id'] = $item_id;
		       $this->data['id'] = $ref_id;
		       $this->data['class_id'] = $class_id;
		   
		$filter = array('ref_id'=>$ref_id);
	    $this->data['ref_costing'] = $this->masters_model->get_list($filter,'ssr_t_rel_calculation');
	    
	    $filter = array('id'=>$ref_id);
	    $this->data['ref_detail'] = $this->masters_model->get_list($filter,'ssr_t_reference');
			$this->breadcrumb->clear();
		    $this->breadcrumb->add_crumb('Home', base_url());
		    $this->breadcrumb->add_crumb($this->data['ref_detail'][0]->name, base_url().'index.php/masters/refrence');
                   $this->data['ref_des'] = $this->data['ref_detail'][0]->description;
                   $this->data['class_id'] = $this->data['ref_detail'][0]->class_id;
		 $this->data['cost_type'] = $this->masters_model->get_costtype('ssr_t_cost_type');
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->load->view('ref_cal',$this->data);
		$this->parser->parse('include/footer',$this->data);
	}
	}
/* function end  for REF CALCULATION  */
/* function start for SUBMIT CAL OF REF  */	
	 						
public function submit_ref_cal()
	{  
	Authority::is_logged_in();
		$data = $this->input->post();
		$value = "";
		if($this->input->post('edit_costing')==1){
			for($i=0;$i<=count($data['code'])-1; $i++){
				$value .= "('".$data['dep_id']."','".$data['chap_id']."','".$data['item_id']."','".$data['ref_id']."',".$data['serial'][$i].",'".$data['item_type'][$i]."','".$data['item_desc'][$i]."','".$data['code'][$i]."','".$data['unit_code'][$i]."','".$data['amount'][$i]."','".$data['total_amount'][$i]."','".$data['quantity'][$i]."','".$data['rate'][$i]."','".$data['Ovehead'][$i]."')".",";
			}
			if($this->masters_model->update_rel_cal(rtrim($value,","),$data['final_total'],$data['dep_id'],$data['chap_id'],$data['item_id'],$data['ref_id'])){
				
				$filter=array('code'=>$ref_detail[0]->name);
				$this->update_rate($filter);
				
				redirect("masters/refrence/");
			}else{
				echo "Error while Editing Refrence calculation";
			}
		} else {
		
		for($i=0;$i<=count($data['code'])-1; $i++){
				$value .= "('".$data['dep_id']."','".$data['chap_id']."','".$data['item_id']."','".$data['ref_id']."',".$data['serial'][$i].",'".$data['item_type'][$i]."','".$data['item_desc'][$i]."','".$data['code'][$i]."','".$data['unit_code'][$i]."','".$data['amount'][$i]."','".$data['total_amount'][$i]."','".$data['quantity'][$i]."','".$data['rate'][$i]."','".$data['Ovehead'][$i]."')".",";
			}
			if($this->masters_model->manage_rel_cal(rtrim($value,","),$data['final_total'],$data['ref_id'])){
				redirect("masters/refrence/");
			}else{
				echo "Error while Adding Refrence calculation";
			}
}
	}
/* function END for SUBMIT CAL REF  */	 						 						 						
/* function start  for DELETE SECTION OF MATERIAL,LABOUR,OVERHEAD,UNIT,CARRIAGE,PLANT,ITEMCLASS,REFRENCE   */

	  public function delete_material($mat_code=false,$labour_code=false,$overhead_code=false,$unit_code=false,$carriage_id=false,$pla_code=false,$id=false,$id1=false){
        Authority::is_logged_in();
	 		if($mat_code){
	 			if(Authority::checkAuthority('delete_material')==true)
	 			{
	 				redirect('masters/material');
	 			}
	 			$filter = array('mat_code'=>$mat_code);
	 			$this->masters_model->delete_material($filter,'ssr_t_material');
	 			$this->session->set_flashdata('message_type', 'success');
	 			$this->session->set_flashdata('message', $this->config->item("item").' DELETE successfully');
	 			redirect('masters/material');
	 		}
	 		elseif($labour_code){
	 			if(Authority::checkAuthority('delete_material')==true)
	 			{
	 				redirect('masters/labour');
	 			}
	 			$filter = array('labour_code'=>$labour_code);
	 			$this->masters_model->delete_material($filter,'ssr_t_labor');
	 			$this->session->set_flashdata('message_type', 'success');
	 			$this->session->set_flashdata('message', $this->config->item("item").' DELETE successfully');
	 			redirect('masters/labour');
	 		}
	 		elseif($overhead_code){
	 			if(Authority::checkAuthority('delete_material')==true)
	 			{
	 				redirect('masters/overhead');
	 			}
	 			$filter = array('overhead_code'=>$overhead_code);
	 			$this->masters_model->delete_material($filter,'ssr_t_overhead');
	 			$this->session->set_flashdata('message_type', 'success');
	 			$this->session->set_flashdata('message', $this->config->item("item").' DELETE successfully');
	 			redirect('masters/overhead');
	 		}
	 		elseif($unit_code){
	 			if(Authority::checkAuthority('delete_material')==true)
	 			{
	 				redirect('masters/unit');
	 			}
	 			$filter = array('unit_code'=>$unit_code);
	 			$this->masters_model->delete_material($filter,'ssr_t_uom');
	 			$this->session->set_flashdata('message_type', 'success');
	 			$this->session->set_flashdata('message', $this->config->item("item").' DELETE successfully');
	 			redirect('masters/unit');
	 		}
	 		elseif($carriage_id){
	 			if(Authority::checkAuthority('delete_material')==true)
	 			{
	 				redirect('masters/carriage');
	 			}
	 			$filter = array('carriage_id'=>$carriage_id);
	 			$this->masters_model->delete_material($filter,'ssr_t_carriage');
	 			$this->session->set_flashdata('message_type', 'success');
	 			$this->session->set_flashdata('message', $this->config->item("item").' DELETE successfully');
	 			redirect('masters/carriage');
	 		}
	 		elseif($pla_code){
	 			if(Authority::checkAuthority('delete_material')==true)
	 			{
	 				redirect('masters/plant');
	 			}
	 			$filter = array('pla_code'=>$pla_code);
	 			$this->masters_model->delete_material($filter,'ssr_t_plant');
	 			$this->session->set_flashdata('message_type', 'success');
	 			$this->session->set_flashdata('message', $this->config->item("item").' DELETE successfully');
	 			redirect('masters/plant');
	 		}
	 		elseif($id){
	 			if(Authority::checkAuthority('delete_material')==true)
	 			{
	 				redirect('masters/item_class');
	 			}
	 			$filter = array('id'=>$id);
	 			$this->masters_model->delete_material($filter,'ssr_t_class');
	 			$this->session->set_flashdata('message_type', 'success');
	 			$this->session->set_flashdata('message', $this->config->item("item").' DELETE successfully');
	 			redirect('masters/item_class');
	 		}
	 		elseif($id1){
	 			if(Authority::checkAuthority('delete_material')==true)
	 			{
	 				redirect('masters/refrence');
	 			}
	 			$filter = array('id'=>$id1);
	 			$this->masters_model->delete_material($filter,'ssr_t_reference');
	 			$this->session->set_flashdata('message_type', 'success');
	 			$this->session->set_flashdata('message', $this->config->item("item").' DELETE successfully');
	 			redirect('masters/refrence');
	 		}
	 }
	 /* function  end for DELETE SECTION OF MATERIAL,LABOUR,OVERHEAD,UNIT,CARRIAGE,PLANT,ITEMCLASS,REFRENCE    */
	 
	 function update_rate($filter=FALSE)
	 {
	 	
	 		/*rate update coding stared.............................................................*/
	 		$sub_detail=$this->data['$sub_detail']=$this->masters_model->get_cal_details($filter,'ssr_t_calculation');
	 	 	
	 		for($j=0;$j<=count($sub_detail)-1; $j++){
	 			$subitem_id =array('subitem_id'=>$sub_detail[$j]->subitem_id);
	 
	 			$sub_detail_cal=$this->masters_model->get_cal_details($subitem_id,'ssr_t_calculation');
	 
	 			$total=0;
	 			$overamount=array('');
	 			for($i=0;$i<=count($sub_detail_cal)-1; $i++){
	 					
	 				if($sub_detail_cal[$i]->item_type=='material'){
	 
	 					$filter=array('mat_name'=>$sub_detail_cal[$i]->code);
	 					$material=$this->masters_model->get_cal_details($filter,'ssr_t_material');
	 					$overamount[$i]=$amount= $material[0]->rate  * $sub_detail_cal[$i]->quantity  ;
	 					if($i==0){
	 						$total=$amount;
	 							
	 					}else{
	 						$total=$total+$amount;
	 							
	 					}
	 
	 					$info=array('item_desc'=>$material[0]->mat_desc,
	 							'unit_code'=> $material[0]->unit_code,
	 							'rate'=>$material[0]->rate ,
	 							'amount'=>$amount,
	 							'total_amount'=>$total);
	 					$filter=array('cal_id'=>$sub_detail_cal[$i]->cal_id);
	 					$this->masters_model->update_rate($info,$filter);
	 
	 				}
	 				elseif($sub_detail_cal[$i]->item_type=='labour'){
	 
	 					$filter=array('labour_name'=>$sub_detail_cal[$i]->code);
	 
	 					$labour=$this->masters_model->get_cal_details($filter,'ssr_t_labor');
	 
	 					$overamount[$i]=$amount= $labour[0]->labour_rate  * $sub_detail_cal[$i]->quantity;
	 
	 					if($i==0){
	 						$total=$amount;
	 							
	 					}else{
	 						$total=$total+$amount;
	 							
	 					}
	 
	 					$info=array('item_desc'=>$labour[0]->labour_description,
	 							'unit_code'=> $labour[0]->unit_code ,
	 							'rate'=>$labour[0]->labour_rate ,
	 							'amount'=>$amount,
	 							'total_amount'=>$total);
	 					$filter=array('cal_id'=>$sub_detail_cal[$i]->cal_id);
	 					$this->masters_model->update_rate($info,$filter);
	 
	 
	 				}elseif($sub_detail_cal[$i]->item_type=='refrence'){
	 
	 					$filter=array('name'=>$sub_detail_cal[$i]->code);
	 					$refrence=$this->masters_model->get_cal_details($filter,'ssr_t_reference');
	 					$overamount[$i]=$amount= $refrence[0]->cost_total  * $sub_detail_cal[$i]->quantity  ;
	 					if($i==0){
	 						$total=$amount;
	 							
	 					}else{
	 						$total=$total+$amount;
	 							
	 					}
	 					$info=array('item_desc'=>$refrence[0]->description,
	 							'unit_code'=> $refrence[0]->unit_code,
	 							'rate'=>$refrence[0]->cost_total,
	 							'amount'=>$amount,
	 							'total_amount'=>$total);
	 					$filter=array('cal_id'=>$sub_detail_cal[$i]->cal_id);
	 					$this->masters_model->update_rate($info,$filter);
	 
	 				}elseif($sub_detail_cal[$i]->item_type=='overhead'){
	 
	 					$filter=array('overhead_name'=>$sub_detail_cal[$i]->code);
	 					$overhead=$this->masters_model->get_cal_details($filter,' ssr_t_overhead');
	 					$sub_detail_cal[$i]->quantity  ;
	 
	 					if($i==0){
	 						$amount1= $overhead[0]->overhead_percent  * $total  ;
	 						$overamount[$i]=$amount=$amount1/100;
	 						$total=$amount;
	 							
	 
	 					}else{
	 						if(!$sub_detail_cal[$i]->over_head==''){
	 							$sum=0;
	 							$val=$sub_detail_cal[$i]->over_head;
	 							$coma_sap_val=explode(",", $val);
	 							for($v=0;$v<=count($coma_sap_val)-1;$v++){
	 								$sum=$sum+$overamount[$coma_sap_val[$v]-1];
	 							}
	 
	 							$amount1= $overhead[0]->overhead_percent  * $sum  ;
	 							$overamount[$i]=$amount=$amount1/100;
	 							$total=$amount+$total;
	 
	 						}else{
	 							$amount1= $overhead[0]->overhead_percent  * $total  ;
	 							$overamount[$i]=$amount=$amount1/100;
	 							$total=$amount+$total;
	 
	 						}
	 					}
	 					$info=array('item_desc'=>$overhead[0]->overhead_desc,
	 							'rate'=>$overhead[0]->overhead_percent,
	 							'amount'=>$amount,
	 							'total_amount'=>$total);
	 					$filter=array('cal_id'=>$sub_detail_cal[$i]->cal_id);
	 					$this->masters_model->update_rate($info,$filter);
	 
	 				}elseif($sub_detail_cal[$i]->item_type=='carriage'){
	 
	 					$filter=array('carriage_code'=>$sub_detail_cal[$i]->code);
	 					$carriage=$this->masters_model->get_cal_details($filter,'ssr_t_carriage');
	 					$overamount[$i]=$amount= $carriage[0]->carriage_rate  * $sub_detail_cal[$i]->quantity  ;
	 					if($i==0){
	 						$total=$amount;
	 							
	 					}else{
	 						$total=$total+$amount;
	 							
	 
	 					}
	 					$info=array('item_desc'=>$carriage[0]->carriage_description,
	 							'unit_code'=> $carriage[0]->unit_code,
	 							'rate'=>$carriage[0]->carriage_rate,
	 							'amount'=>$amount,
	 							'total_amount'=>$total);
	 					$filter=array('cal_id'=>$sub_detail_cal[$i]->cal_id);
	 					$this->masters_model->update_rate($info,$filter);
	 
	 				}elseif($sub_detail_cal[$i]->item_type=='plant'){
	 
	 					$filter=array('pla_code'=>$sub_detail_cal[$i]->code);
	 					$plant=$this->masters_model->get_cal_details($filter,'ssr_t_plant');
	 					$overamount[$i]=$amount= $plant[0]->rate  * $sub_detail_cal[$i]->quantity  ;
	 					if($i==0){
	 						$total=$amount;
	 							
	 					}else{
	 						$total=$total+$amount;
	 							
	 					}
	 					$info=array('item_desc'=>$plant[0]->pla_desc,
	 							'unit_code'=> $plant[0]->unit_code,
	 							'rate'=>$plant[0]->rate,
	 							'amount'=>$amount,
	 							'total_amount'=>$total);
	 					$filter=array('cal_id'=>$sub_detail_cal[$i]->cal_id);
	 					$this->masters_model->update_rate($info,$filter);
	 
	 
	 				}elseif($sub_detail_cal[$i]->item_type=='subitem'){
	 
	 					$filter=array('subitem_name'=>$sub_detail_cal[$i]->code);
	 					$subitem=$this->masters_model->get_cal_details($filter,'ssr_t_subitem');
	 					$overamount[$i]=$amount= $subitem[0]->rate  * $sub_detail_cal[$i]->quantity  ;
	 					if($i==0){
	 						$total=$amount;
	 							
	 					}else{
	 						$total=$total+$amount;
	 							
	 					}
	 					$info=array('item_desc'=>$subitem[0]->subitem_desc,
	 							'unit_code'=> $subitem[0]->unit_code,
	 							'rate'=>$subitem[0]->rate,
	 							'amount'=>$amount,
	 							'total_amount'=>$total);
	 					$filter=array('cal_id'=>$sub_detail_cal[$i]->cal_id);
	 					$this->masters_model->update_rate($info,$filter);
	 
	 				}elseif($sub_detail_cal[$i]->item_type=='convert'){
	 
	 					$overamount[$i]=$amount= $total / $sub_detail_cal[$i]->quantity  ;
	 					if($i==0){
	 						$total=$amount;
	 							
	 					}else{
	 						$total=$amount;
	 							
	 					}
	 					$info=array('amount'=>$amount,
	 							'total_amount'=>$total);
	 					$filter=array('cal_id'=>$sub_detail_cal[$i]->cal_id);
	 					$this->masters_model->update_rate($info,$filter);
	 
	 				}elseif($sub_detail_cal[$i]->item_type=='text'){
	 
	 					if($i==0){
	 						$overamount[$i]=$amount= 0 ;
	 						$total=$amount;
	 							
	 					}else{
	 						$overamount[$i]=$amount= 0 ;
	 						$total=$total;
	 							
	 					}
	 				}
	 			}
	 
	 			$finaltotal=round($total, 0, PHP_ROUND_HALF_UP);
	 			$this->masters_model->update_subitem_rate($finaltotal,$sub_detail_cal[0]->item_id,$sub_detail_cal[0]->subitem_id);
	 
	 			/*rate update coding end.............................................................*/
	 		}}
	 
	 
}