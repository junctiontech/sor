<?php
 
class Csv extends CI_Controller {
 
    function __construct() {
        parent::__construct();
		
		$this->data[]="";
		$this->data['url'] = base_url();
		
		
		$this->load->library('parser');
		$this->data['base_url']=base_url();
		$this->load->model('authority_model');
        $this->load->model('csv_model');
        $this->load->library('csvimport');
        //$debug_mode=n;
    }
  function is_logged_in()
	 {
		 $user_data=$user_session_data = $this->session->userdata('user_data');
	 if($user_session_data==''){
	
		 $this->session->set_flashdata('message_type', 'error');
         $this->session->set_flashdata('message',$this->config->item("user").'First Login with Your account');
 		redirect('login');
		
	}									
	else{
		
		
	}
		 
		 
	 }
	 
	 // Start function for check permissions for particular role_id
	function check_authority($function)
	{	
		$user_session_data = $this->session->userdata('user_data');	
		$role=$user_session_data['role_id'];
		$list_permision=$this->data['list_permision']=$this->authority_model->list_permision($role);
		foreach($list_permision as $var)
		{	
		  if($user_session_data['role_id']==$var->role_id && $var->function_id==$function && $var->auth_read==1 && $var->auth_execute==0)
			{  
			$this->session->set_flashdata('category_error', 'success message');        
			$this->session->set_flashdata('message', $this->config->item("add_department").' You are not authorised person for edit');
					return true;
			}
			if($user_session_data['role_id']==$var->role_id && $var->function_id==$function && $var->auth_read==0 && $var->auth_execute==0)
			{		
				$this->session->set_flashdata('category_error_block', 'success message');        
				$this->session->set_flashdata('message', $this->config->item("add_department").' You Are Not Authorised Person Please Contact Administrator');
						redirect('home');
			}
		}
	}
	// Start function for check permissions for particular role_id
	 
    function index($listname=false) {
		if($this->is_logged_in()){
			redirect('login');
		}else{
		$this->check_authority('index');
		 $this->data['list_name']=$this->uri->segment(3);
		//print_r($listname);die;
		if($listname=='material'){
		//	print_r($listname);die;
                  $this->data['csv_data'] = $this->csv_model->get_csv_list('ssr_t_material');
	    }else if($listname=='item'){
			
		 $$this->data['csv_data'] = $this->csv_model->get_csv_list('ssr_t_item');
		 	
		}else if($listname=='subitem'){
		  $this->data['csv_data'] = $this->csv_model->get_csv_list('ssr_t_subitem');	
			
		}else if($listname=='labour'){
		 $this->data['csv_data'] = $this->csv_model->get_csv_list('ssr_t_labor');	
			
		}else if($listname=='carriage'){
			 $this->data['csv_data'] = $this->csv_model->get_csv_list('ssr_t_carriage');
			
		}else{
			
			 $this->data['csv_data'] = $this->csv_model->get_csv_list('ssr_t_plant');
		}
       
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->load->view('csv',$this->data);
		$this->parser->parse('include/footer',$this->data);
    }
	}
    function importcsv() {
    if($this->is_logged_in()){
			redirect('login');
		}
		elseif($this->check_authority('importcsv')==true)
			{
					redirect('csv/index');
			}
		else{
   //print_r($_POST);die;
    
   	if($this->input->post('submit')){
		
          $this->data['list_name']=$this->input->post('list_type');
            if($this->input->post('list_type')=='material'){
			//print_r($listname);die;
        $this->data['csv_data'] = $this->csv_model->get_csv_list('ssr_t_material');
        //print_r($data['csv_data']);die;
	    }else if($this->input->post('list_type')=='item'){
			
		 $this->data['csv_data'] = $this->csv_model->get_csv_list('ssr_t_item');
		 	
		}else if($this->input->post('list_type')=='subitem'){
		  $this->data['csv_data'] = $this->csv_model->get_csv_list('ssr_t_subitem');	
			
		}else if($this->input->post('list_type')=='labour'){
		$this->data['csv_data'] = $this->csv_model->get_csv_list('ssr_t_labor');	
			
		}else if($this->input->post('list_type')=='carriage'){
			 $this->data['csv_data'] = $this->csv_model->get_csv_list('ssr_t_carriage');
			
		}else{
			
			 $this->data['csv_data'] = $this->csv_model->get_csv_list('ssr_t_plant');
		}
        $this->data['error'] = '';    //initialize image upload error array to empty
 
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '2048';
 
        $this->load->library('upload', $config);
    
 
        // If upload failed, display error //
        if (!$this->upload->do_upload()) {
			
            $this->data['error'] = $this->upload->display_errors();
 
            $this->load->view('csv', $data);
        } else {
			 
            $file_data = $this->upload->data();
            $file_path =  './uploads/'.$file_data['file_name'];
         
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);

      
             
            if($this->input->post('list_type')=='material'){
			
		      foreach ($csv_array as $row) {
		                    $insert_data = array(
		                        'mat_name'=>$row['mat_name'],
		                        'mat_desc'=>$row['mat_desc'],
		                        'unit_code'=>$row['unit_code'],
		                        'rate'=>$row['rate'],
		                        'created_by'=>1,
		                        'created_on'=>date("Y-m-d"),
		                        'updated_by'=>1,
		                        'updated_on'=>date("Y-m-d"),
		                    );
		         $this->csv_model->insert_csv('ssr_t_material',$insert_data);
				 
                        }
                        $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
						 //redirect(base_url().'csv/index/material'); 
                      redirect('csv/index/material'); 
	    }else if($this->input->post('list_type')=='item'){
			
		         foreach ($csv_array as $row) {
                    $insert_data = array(
                        'dep_id'=>$row['dep_id'],
                        'chap_id'=>$row['chap_id'],
                        'item_id'=>$row['item_id'],
                        'item_name'=>$row['item_name'],
                        'item_desc'=>$row['item_desc'],
                        'created_by'=>1,
                        'created_on'=>date("Y-m-d"),
                        'updated_by'=>1,
                        'updated_on'=>date("Y-m-d"),
                    );
                     $this->csv_model->insert_csv('ssr_t_item',$insert_data);
                    }
		    $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
                      redirect('csv/index/item'); 	
		}else if($this->input->post('list_type')=='subitem'){
			
		          foreach ($csv_array as $row) {
                    $insert_data = array(
                        'dep_id'=>$this->input->post('dep_id'),
                        'chap_id'=>$this->input->post('chap_id'),
                        'item_id'=>$this->input->post('item_id'),
                        'subitem_id'=>$this->input->post('subitem_id'),
                        'class_id'=>$this->input->post('class_id'),
                        'serial'=>$row['serial'],
                        'item_type'=>$row['item_type'],
                    		'code'=>$row['code'],
                    		'item_desc'=>$row['item_desc'],
                    		'unit_code'=>$row['unit_code'],
                    		'quantity'=>$row['quantity'],
                    		'rate'=>$row['rate'],
                    		'amount'=>$row['amount'],
                    		'total_amount'=>$row['total_amount'],
                       
                    );
					$finaltotal=$row['total_amount'];
					$subitem_id=$this->input->post('subitem_id');
                  //  print_r($insert_data);die;
                      $this->csv_model->insert_csv('ssr_t_calculation',$insert_data);
					 $this->csv_model->update_subitem_rate($subitem_id,$finaltotal);
                    }	
		      $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
                      redirect('home/create_sub_item/'.$this->input->post('dep_id')."/".$this->input->post('chap_id')."/".$this->input->post('item_id')."/".$this->input->post('subitem_id')."/".$this->input->post('class_id')); 	
		}else if($this->input->post('list_type')=='labour'){
		              foreach ($csv_array as $row) {
                    $insert_data = array(
                        'labour_name'=>$row['labour_name'],
                        'labour_description'=>$row['labour_description'],
                        'unit_code'=>$row['unit_code'],
                        'labour_rate'=>$row['labour_rate'],
                        'created_by'=>1,
                        'created_on'=>date("Y-m-d"),
                        'updated_by'=>1,
                        'updated_on'=>date("Y-m-d"),
                    );
                     $this->csv_model->insert_csv('ssr_t_labor',$insert_data);
                    }
                    $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
                      redirect('csv/index/labour'); 
			
		}else if($this->input->post('list_type')=='carriage'){
			   foreach ($csv_array as $row) {
                    $insert_data = array(
                        'carriage_name'=>$row['carriage_name'],
                        'carriage_description'=>$row['carriage_description'],
                        'unit_code'=>$row['unit_code'],
                        'carriage_rate'=>$row['carriage_rate'],
                        'created_by'=>1,
                        'created_on'=>date("Y-m-d"),
                        'updated_by'=>1,
                        'updated_on'=>date("Y-m-d"),
                    );
                     $this->csv_model->insert_csv('ssr_t_carriage',$insert_data);
                    }
                     $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
                      redirect('csv/index/carriage'); 
			
		}else{
			
			foreach ($csv_array as $row) {
                    $insert_data = array(
                        'pla_code'=>$row['pla_code'],
                        'pla_desc'=>$row['pla_desc'],
                        'unit_code'=>$row['unit_code'],
                        'rate'=>$row['rate'],
                        'created_by'=>1,
                        'created_on'=>date("Y-m-d"),
                        'updated_by'=>1,
                        'updated_on'=>date("Y-m-d"),
                    );
                     $this->csv_model->insert_csv('ssr_t_plant',$insert_data);
                    }
                      $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
                      redirect('csv/index/plant');
                    
		}  
             
            
                    
                 // print_r($insert_data);die;  
                   
                
              
                //echo "<pre>"; print_r($insert_data);
            } else 
                $data['error'] = "Error occured";
                $this->load->view('csv', $data);
            }
 
        } 
     }
	}
}
/*END OF FILE*/
