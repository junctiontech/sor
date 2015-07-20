<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Estimation_Controller extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->data [] = "";
		$this->data ['user_data'] = "";
		$this->data ['url'] = base_url ();
		$this->load->model ( 'masters_model' );
		$this->load->model ( 'login_model' );
		
		$this->load->model ( 'authority_model' );
		$this->load->model ( 'estimation_model' );
		$this->load->library ( 'parser' );
		$this->load->library ( 'form_validation' );
		$this->load->library ( 'session' );
		$this->data ['base_url'] = base_url ();
		$this->load->library ( 'authority' );
		$user_session_data = $this->session->userdata('user_data');
		$name=$user_session_data['language_id'];
		$namehome = $this->data['namehome']= $this->login_model->lang($name,'ssr_t_text');
	}
	public function estimation($select = false, $est_id = false) {
		Authority::is_logged_in ();
		$this->data ['est_id'] = $est_id;
		$filter = $select;
		if($est_id == ''){
			if($select == '' && $est_id == '') {
		$this->session->set_flashdata ( 'aaa_error', 'error' );
				$this->session->set_flashdata ( 'message', $this->config->item ( "est" ) . 'Please Select Atleast One SubItem Code' );
				$this->parser->parse ( 'include/header', $this->data );
				$this->parser->parse ( 'include/leftmenu', $this->data );
				$this->parser->parse ( 'estimation', $this->data );
				$this->parser->parse ( 'include/footer', $this->data );
				//redirect("home/get_subitem_list/".$dep_id."/".$chap_id."/".$item_id."");
			}
else{
			if (! (isset ($_POST ['select'] ) ? $_POST ['select'] : '') == '') {
				$filter = $_POST ['select'];
				$filter = implode ( ',', $filter );
				$this->data ['select'] = $filter;
			}else {
				$filter = $select;
				$this->data ['select'] = $filter;
			}
			$this->data ['subitem_list'] = $this->estimation_model->get_subitem_ids_list_est ( $filter );
			if ($est_id) {
				$filter = $est_id;
				$est_sub = $this->data ['est_sub'] = $this->estimation_model->get_subitem_est_cal ( $filter );
			}
			$this->parser->parse ( 'include/header', $this->data );
			$this->parser->parse ( 'include/leftmenu', $this->data );
			$this->parser->parse ( 'estimation', $this->data );
			$this->parser->parse ( 'include/footer', $this->data );
}	

		}
		else{	
				if (! (isset ($_POST ['select'] ) ? $_POST ['select'] : '') == '') {
					$filter = $_POST ['select'];
					$filter = implode ( ',', $filter );
					$this->data ['select'] = $filter;
				} else {
					$filter = $select;
					$this->data ['select'] = $filter;
				}
				$this->data ['subitem_list'] = $this->estimation_model->get_subitem_ids_list_est ( $filter );
				if ($est_id) {
					$filter = $est_id;
					$est_sub = $this->data ['est_sub'] = $this->estimation_model->get_subitem_est_cal ( $filter );
				}
				//$this->session->set_flashdata ( 'catt_error', 'error' );
			//	$this->session->set_flashdata ( 'message', $this->config->item ( "ref" ) . ' Please Select Atleast One SubItem Code' );
				$this->parser->parse ( 'include/header', $this->data );
				$this->parser->parse ( 'include/leftmenu', $this->data );
				$this->parser->parse ( 'estimation', $this->data );
				$this->parser->parse ( 'include/footer', $this->data );
					
		}	
		
	}
/* function start for estimation in subitems. and  we used this function  in edit of estimation_list.php  */
/* public function estimation($select = false, $est_id = false) {
		Authority::is_logged_in ();
	$this->data ['est_id'] = $est_id;
		$filter = $select;
		if ($est_id){
			if($select == '' && $est_id == '') {
				$this->session->set_flashdata ( 'sat_error', 'error' );
				$this->session->set_flashdata ( 'message', $this->config->item ( "ref" ) . ' Please Select Atleast One SubItem Code' );
				redirect("home/get_subitem_list/".$dep_id."/".$chap_id."/".$item_id."");
				}
			else{
				if (! (isset ($_POST ['select'] ) ? $_POST ['select'] : '') == '') {
					$filter = $_POST ['select'];
					$filter = implode ( ',', $filter );
					$this->data ['select'] = $filter;
				}else {
					$filter = $select;
					$this->data ['select'] = $filter;
				}
				$this->data ['subitem_list'] = $this->estimation_model->get_subitem_ids_list_est ( $filter );
				if ($est_id) {
					$filter = $est_id;
					$est_sub = $this->data ['est_sub'] = $this->estimation_model->get_subitem_est_cal ( $filter );
				}
				$this->parser->parse ( 'include/header', $this->data );
				$this->parser->parse ( 'include/leftmenu', $this->data );
				$this->parser->parse ( 'estimation', $this->data );
				$this->parser->parse ( 'include/footer', $this->data );
			}
		}
		 else {
		 if($select =='' || !$est_id =='') {
				$this->session->set_flashdata ( 'q_error', 'error' );
				$this->session->set_flashdata ( 'message', $this->config->item ( "ref" ) . ' there is no data' );
				redirect("estimation_controller/estimation/".$sub."/".$est_id."/");
			}else{
			if (! (isset ($_POST ['select'] ) ? $_POST ['select'] : '') == '') {
				$filter = $_POST ['select'];
				$filter = implode ( ',', $filter );
				$this->data ['select'] = $filter;
			} else {
				$filter = $select;
				$this->data ['select'] = $filter;
			}
			$this->data ['subitem_list'] = $this->estimation_model->get_subitem_ids_list_est ( $filter );
			if ($est_id) {
				$filter = $est_id;
				$est_sub = $this->data ['est_sub'] = $this->estimation_model->get_subitem_est_cal ( $filter );
			}
			
			$this->parser->parse ( 'include/header', $this->data );
			$this->parser->parse ( 'include/leftmenu', $this->data );
			$this->parser->parse ( 'estimation', $this->data );
			$this->parser->parse ( 'include/footer', $this->data );
			
		 	}
		}
	} */
/* function end for estimation in subitems. and  we used this function  in edit of estimation_list.php  */
/* function start for update-estimate ,update-estimate-subitem and insert-estimate, insert-estimate-subitem when we add estimate subitem and click on add buttion  */
				function add_est_submit($select=false,$est_id=false)
				{	
				  Authority::is_logged_in();
		if(Authority::checkAuthority('add_est_submit'))
		{
			redirect('estimation_controller/estimation/'.$select);
		}
		else{  
				if($this->input->post('est_id')){
					$data=array('est_description' => $this->input->post('est_description'),
					'est_total' => $this->input->post('final_total'),
							'updated_by'=>'rohit'
							);
					$filter=array('est_id'=>$this->input->post('est_id'));
					if($est_id=$this->estimation_model->update_estimate($data,$filter)){
						$subitem_id=explode(",",$select);
					for($i=0; $i<=count($subitem_id)-1; $i++){
						$filter=array('est_id'=>$this->input->post('est_id'),
						'subitem_id'=>$subitem_id[$i]);
						$amount=$this->input->post('amount');
					$data=array('amount'=>$amount[$i],
					'updated_by'=>'rohit');
					$this->estimation_model->update_estsitem($data,$filter);
					}
						$filter=$this->input->post('est_id');
				redirect("estimation_controller/estimation/".$select."/".$filter."/");
				}else{
					echo "Error while Adding Estimate";
				}
				} else{
					$data=array('est_description' => $this->input->post('est_description'),
							'est_status'=>'new',
							'est_total' => $this->input->post('final_total'),
							'created_by'=>'rohit',
							'updated_by'=>'rohit');
				if($est_id=$this->estimation_model->insert_estimate($data)){
					$subitem_id=explode(",",$select);
				for($i=0;$i<=count($subitem_id)-1; $i++){
					$data=array('est_id'=>$est_id,
					'subitem_id'=>$subitem_id[$i],
					'amount'=>0,
					'quantity'=>0,
					'created_by'=>'rohit',
					'updated_by'=>'rohit');
					$this->estimation_model->insert_estsitem($data);
						
					}
				redirect("estimation_controller/estimation/".$select."/".$est_id."/");
				
				}else{
					echo "Error while Adding Estimate";
				}
				}
				}
				}
/* FUNCTION end FOR update-estimate ,update-estimate-subitem and insert-estimate, insert-estimate-subitem when ew add estimate subitem and click on add buttion  */
/* FUNCTION START FOR WHEN WE CLICK On ENTER VALUE for selected subitem code */
public function estimation_val($subitem_id=false,$class_id=false,$select=false,$est_id=false)
				{
				  Authority::is_logged_in();
		if(Authority::checkAuthority('estimation_val'))
		{
			redirect('estimation_controller/estimation/'.$subitem_id);
		}
		else{
				$this->data['subitem_id'] = $subitem_id;
				$this->data['class_id'] = $class_id;
				$this->data['select'] = $select;
				$this->data['est_id'] = $est_id;
				$filter = array(
				'subitem_id'=>$subitem_id,
				'est_id'=>$est_id);
				$this->data['estimate_cal'] = $this->masters_model->get_list($filter,'ssr_t_estimate_cal');
				$filter = array('subitem_id'=>$subitem_id);
				$this->data['subitem_list'] = $this->masters_model->get_list($filter,'ssr_t_subitem');	
				$this->parser->parse('include/header',$this->data);
				$this->parser->parse('include/leftmenu',$this->data);
				$this->parser->parse('estimation_val',$this->data);
				$this->parser->parse('include/footer',$this->data);
				}
				}
/* FUNCTION END FOR WHEN WE CLICK On ENTER VALUE for selected subitem code */
/* FUNCTION START FOR UPDATE AND INSERT CALCULATION when we click on ente value then calculation pages will be open*/
	public function estimation_create($subitem_id=false,$class_id=false,$select=false,$est_id=false){
				  Authority::is_logged_in();
				$data = $this->input->post();
				$value = "";
				if($this->input->post('edit_costing')==1){
				for($i=0;$i<=count($data['no'])-1; $i++){
				$value .= "('".$data['est_id']."','".$data['subitem_id']."',".$data['no'][$i].",'".$data['length'][$i]."','".$data['width'][$i]."','".$data['depth'][$i]."')".",";
				}
				$filter=array('est_id'=>$data['est_id'],
				'subitem_id'=>$subitem_id
				);
				if($this->estimation_model->update_estimate_cal(rtrim($value,","),$data['final_total'],$data['subitem_id'],$data['est_id'],$filter)){
				$this->session->set_flashdata('category_success', 'success message');  
		$this->session->set_flashdata('message',$this->config->item("ref").' successfully saved');
				redirect("estimation_controller/estimation/".$data['select']."/".$data['est_id']);
				}else{
					$this->session->set_flashdata('category_error', 'error message');  
		$this->session->set_flashdata('message',$this->config->item("ref").' subitem does not contain rate');
		redirect("estimation_controller/estimation/".$data['select']."/".$data['est_id']);
				}
				} else {
				
				for($i=0;$i<=count($data['no'])-1; $i++){
			
				$value .= "('".$data['est_id']."','".$data['subitem_id']."',".$data['no'][$i].",'".$data['length'][$i]."','".$data['width'][$i]."','".$data['depth'][$i]."')".",";
				}
				if($this->estimation_model->manage_estimate_cal(rtrim($value,","),$data['final_total'],$data['subitem_id'],$data['est_id'])){
					$this->session->set_flashdata('category_success', 'success message');
					$this->session->set_flashdata('message',$this->config->item("ref").' successfully saved');
				redirect("estimation_controller/estimation/".$data['select']."/".$data['est_id']);
				
				}else{
					$this->session->set_flashdata('category_error', 'error message');  
		$this->session->set_flashdata('message',$this->config->item("ref").' subitem does not contain rate');
		redirect("estimation_controller/estimation/".$data['select']."/".$data['est_id']);
				}
				}
				}
/* FUNCTION END FOR UPDATE AND INSERT CALCULATION  when we click on enter value then calculation pages will be open*/
/* FUNCTION START FOR WHEN WE CLICK ON ADD SUBITEMS button for add new subitems in estimation page */
function add_estsubitem($select=false,$est_id=false)
				{
					  Authority::is_logged_in();
		if(Authority::checkAuthority('add_estsubitem'))
		{
			redirect('estimation_controller/estimation/'.$select);
		}
		else{
				$this->data['select'] = $select;
				$this->data['est_id'] = $est_id;
				$this->data['dep'] = $this->estimation_model->get_deplist('ssr_t_department');
				$this->parser->parse('include/header',$this->data);
				$this->parser->parse('include/leftmenu',$this->data);
				$this->load->view('add_estsubitem',$this->data);
				$this->parser->parse('include/footer',$this->data);
				} 
				}
/* FUNCTION END FOR WHEN WE CLICK ON ADD SUBITEMS FOR ESTIMATION button for add new subitems in estimation page */
/* FUNCTION START FOR WHEN WE ADD SUBITEM ESTIMATION AND SUBMIT THE SAVE BUTTON */
function add_estsubitem_submit($select=false,$est_id=false)
				{
            Authority::is_logged_in();					
					if(!$est_id == '')
					{	
						$subitem_id=$_POST['subitem_id'];
						for($i=0;$i<=count($subitem_id)-1; $i++){
							$data=array('est_id'=>$est_id,
									'subitem_id'=>$subitem_id[$i],
									'amount'=>0,
									'quantity'=>0,
									'created_by'=>'rohit',
									'updated_by'=>'rohit');
							$this->estimation_model->insert_estsitem($data);
							$subitem_id = implode(',',$subitem_id);
						    $select= $select.",".$subitem_id;
						    $this->session->set_flashdata('ct_success', 'success message');
						    $this->session->set_flashdata('message',$this->config->item("ref").' subitem successfully saved');
						 redirect("estimation_controller/estimation/".$select."/".$est_id."/");
						}
					}
					else{
					$subitem_id=$_POST['subitem_id'];
					$subitem_id = implode(',',$subitem_id);
					$select= $select.",".$subitem_id;
					$this->session->set_flashdata('ct_success', 'success message');
					$this->session->set_flashdata('message',$this->config->item("ref").' subitem successfully saved');
					redirect("estimation_controller/estimation/".$select."/".$est_id."/");	
				} 
				}
/* FUNCTION END FOR WHEN WE ADD SUBITEM ESTIMATION AND SUBMIT THE SAVE BUTTON */
/* FUNCTION START FOR the ESTIMASTION LIST of all the estimation */
				function estimation_list($select=false)
				{
					  Authority::is_logged_in();
				Authority::checkAuthority('estimation_list');
				$this->data['select'] = $select;
				$filter = array('est_id !=' => '');
				$this->data['estimate'] = $this->masters_model->get_list($filter,'ssr_t_estimate');
				$this->parser->parse('include/header',$this->data);
				$this->parser->parse('include/leftmenu',$this->data);
				$this->load->view('estimation_list',$this->data);
				$this->parser->parse('include/footer',$this->data);
				}
/* FUNCTION END FOR the ESTIMASTION LIST of all the estimation */
/* FUNCTION START FOR EDIT AND VIEW BUTTIONS OF ESTIMATION_LIST PAGE */
				function edit_estimation($est_id=false,$v=false)
				{		
						  Authority::is_logged_in();
					$value = array('');
					$sub="";
					$this->data['value']="";
					$filter=array('est_id'=>$est_id);
					$value=$this->data['value']=$this->masters_model->get_list($filter,'ssr_t_estimate_sitem');
					for($i=0;$i<=count($value); $i++){
					$filter=array('est_id'=>$est_id);
					$value=$this->data['value']=$this->masters_model->get_list($filter,'ssr_t_estimate_sitem');
					$sub.="".$value[$i]->subitem_id."".",";
					}
					$sub=rtrim($sub,",");
					if($v==1){
					redirect("estimation_controller/estimation_view/".$sub."/".$est_id."/");
					}else{
						redirect("estimation_controller/estimation/".$sub."/".$est_id."/");
					}
					}
/* FUNCTION START FOR EDIT AND VIEW BUTTIONS OF ESTIMATION_LIST PAGE */
/* FUNCTION START FOR DELETE BUTTIONS OF ESTIMATION_LIST  PAGE*/
				function delete_estimate($est_id=false){
					  Authority::is_logged_in();
					if(Authority::checkAuthority('delete_estimate'))
						{
							redirect('estimation_controller/estimation_list');
						}
					else{
								$this->estimation_model->delete_estimate($est_id);
								redirect("estimation_controller/estimation_list");
						}
				}
/* FUNCTION START FOR DELETE BUTTIONS OF ESTIMATION LIST PAGE  */
/* FUNCTION START FOR WHEN WE CLICK ON FINALIZE BUTTION OF ESTIMATION_LIST PAGE */
				function final_estimate($est_id=false){
					  Authority::is_logged_in();
					$this->estimation_model->final_estimate($est_id);
					redirect("estimation_controller/estimation_list");
				}
/* FUNCTION END FOR WHEN WE CLICK ON FINALIZE BUTTION OF ESTIMATION LIST PAGE */
/*function for generate pdf for each estimation id in estimation_list.php page  */
				function estimate_pdf($est_id=false){
					  Authority::is_logged_in();
		if(Authority::checkAuthority('estimate_pdf'))
				{
						redirect('estimation_controller/estimation_list');	
				}
		else{
					print_r("Generate PFD");die;
				}
				}
/*function for generate pdf for each estimation id in estimation_list.php page  */
				
/*FUNCTION START FOR WHEN WE CLICK ON VIEW buttion  FOR  SUBITEM CODE of each estimation description in ESTIMATION_list */
public function estimation_view($select=false,$est_id=false)
			{
  Authority::is_logged_in();			
				$this->data['est_id'] = $est_id;
				if(!(isset($_POST['select'])?$_POST['select']:'')==''){
				$filter=$_POST['select'];
				$filter = implode(',',$filter);
				$this->data['select'] =$filter;
				}else{
					$filter= $select;
					$this->data['select'] =$filter;
				}
				$this->data['subitem_list'] = $this->estimation_model->get_subitem_ids_list_est($filter);
				if($est_id){
					
					$filter= $est_id;
					$est_sub=$this->data['est_sub'] = $this->estimation_model->get_subitem_est_cal($filter);
				}
				$this->parser->parse('include/header',$this->data);
				$this->parser->parse('include/leftmenu',$this->data);
				$this->parser->parse('estimate_veiwonly',$this->data);
				$this->parser->parse('include/footer',$this->data);
				} 
			
/*FUNCTION START FOR WHEN WE CLICK ON VIEW buttion  FOR  SUBITEM CODE of each estimation description in ESTIMATION_list */
/* FUNCTION START FOR WHEN WE CLICK ON VIEW BUTTION OF ESTIMATION_list and estimation THEN ONE ANOTHER BUTTON IS GIVEN INSIDE THE VIEW IS VIEW VALUE */
public function estimation_val_view($subitem_id=false,$class_id=false,$select=false,$est_id=false)
				{
					  Authority::is_logged_in();
				$this->data['subitem_id'] = $subitem_id;
				$this->data['class_id'] = $class_id;
				$this->data['select'] = $select;
				$this->data['est_id'] = $est_id;
				$filter = array(
				'subitem_id'=>$subitem_id,
				'est_id'=>$est_id);
				$this->data['estimate_cal'] = $this->masters_model->get_list($filter,'ssr_t_estimate_cal');
				$filter = array('subitem_id'=>$subitem_id);
				$this->data['subitem_list'] = $this->masters_model->get_list($filter,'ssr_t_subitem');	
				$this->parser->parse('include/header',$this->data);
				$this->parser->parse('include/leftmenu',$this->data);
				$this->parser->parse('est_val_veiwonly',$this->data);
				$this->parser->parse('include/footer',$this->data);
				}
/* FUNCTION START FOR WHEN WE CLICK ON VIEW BUTTION OF ESTIMATION THEN ONE ANOTHER BUTTON IS GIVEN INSIDE THE VIEW IS VIEW VALUE */
/* FUNCTION START FOR DELETE SUBITEM ESTIMATION */
function del_sitem_est($select = false, $est_id = false) {
		Authority::is_logged_in ();
		if (Authority::checkAuthority ( 'del_sitem_est' )) {
			redirect ( 'estimation_controller/estimation/'. $select );
		} else {
			$sub_select = $_POST ['select'];
			for($i = 0; $i <= count ( $sub_select ); $i ++) {
				$filter = array (
						'est_id' => $est_id,
						'subitem_id' => $sub_select [$i] 
				);
				$this->estimation_model->delete_estimate_sitem ( $filter );
			}
			
			$array = explode ( ',', $select );
			$array = array_diff ( $array, $sub_select );
			$select = implode ( ',', $array );
			$this->session->set_flashdata('qqq_success', 'success message');
			$this->session->set_flashdata('message',$this->config->item("ref").' subitem deleted  successfully');
			redirect("estimation_controller/estimation/".$select."/".$est_id."/");
		}
	}
/* FUNCTION END FOR DELETE SUBITEM ESTIMATION */
}