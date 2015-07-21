<?php
 
class Csv extends CI_Controller {
 
    function __construct() {
        parent::__construct();
		
		$this->data[]="";
		$this->data['url'] = base_url();
		$this->load->model('authority_model');
		$this->load->library('parser');
		$this->data['base_url']=base_url();
        $this->load->model('csv_model');
        $this->load->library('csvimport');
        $this->load->model('login_model');
        
        $this->load->library('authority');
        $user_session_data = $this->session->userdata('user_data');
        $name=$user_session_data['language_id'];
        $namehome = $this->data['namehome']= $this->login_model->lang($name,'ssr_t_text');
        
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
	 
	
    function index($listname=false,$msg=false) {
		if($this->is_logged_in()){
			redirect('login');
		}else{
		Authority::checkAuthority('index');
		 $this->data['list_name']=$this->uri->segment(3);
		 $this->data['csv_data']='';
		if($msg){
		if($listname=='material'){
		
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
		elseif(Authority::checkAuthority('importcsv')==true)
			{
					redirect('csv/index');
			}
		else{
  
    
   	if($this->input->post('submit')){
		
          $this->data['list_name']=$this->input->post('list_type');
            if($this->input->post('list_type')=='material'){
			
        $this->data['csv_data'] = $this->csv_model->get_csv_list('ssr_t_material');
       
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
 
            $this->load->view('csv', $this->data);
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
		         $this->csv_model->insert_csv('ssr_t_material',$insert_data,'mat_name');
				 
                        }
                        $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
						 //redirect(base_url().'csv/index/material'); 
                      redirect('csv/index/material/msg'); 
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
                     $this->csv_model->insert_csv('ssr_t_item',$insert_data,'item_name');
                    }
		    $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
                      redirect('csv/index/item/msg'); 	
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
                      $this->csv_model->insert_csv('ssr_t_calculation',$insert_data,'subitem_id');
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
                     $this->csv_model->insert_csv('ssr_t_labor',$insert_data,'labour_name');
                    }
                    $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
                      redirect('csv/index/labour/msg'); 
			
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
                     $this->csv_model->insert_csv('ssr_t_carriage',$insert_data,'carriage_name');
                    }
                     $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
                      redirect('csv/index/carriage/msg'); 
			
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
                     $this->csv_model->insert_csv('ssr_t_plant',$insert_data,'pla_code');
                    }
                      $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
                      redirect('csv/index/plant/msg');
                    
		}  
              //echo "<pre>"; print_r($insert_data);
            } else 
                $data['error'] = "Error occured";
                $this->load->view('csv', $this->data);
            }
 
        } 
     }
	}
}
/*END OF FILE*/
