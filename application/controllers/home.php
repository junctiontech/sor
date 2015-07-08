<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	 function __construct() {
		parent::__construct();
		$this->data[]="";
		$this->data['user_data']="";
		$this->data['url'] = base_url();
		$this->load->model('mhome');
		$this->load->model('masters_model');
		$this->load->model('estimation_model');
		$this->load->library('parser');
		$this->load->model('authority_model');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->data['base_url']=base_url();
		$this->load->library('upload');
		$this->load->library('authority');
	 }
	public function index()
	{ 
	Authority::is_logged_in ();
		 $filter = array('dep_id !=' => '');
		$this->data['dep_list'] = $this->masters_model->get_list($filter,'ssr_t_department');	
			$this->breadcrumb->clear();
		    $this->breadcrumb->add_crumb('Home', base_url().'index.php/home');
	   $this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->load->view('dep_list',$this->data);
		$this->parser->parse('include/footer',$this->data);
	}
/* function for the finding record of the users */
	function user()
   {
	  Authority::is_logged_in ();
       $user=$this->input->post('usermailid');
       $query=$this->mhome->get_record('ssr_t_users',array('usermailid'=>$user));
       if($query)
       {
          $this->session->set_flashdata('error', '<script type="text/javascript">alert("you are already registered with this email id")</script>'); 
          redirect('login');
       }
       else
       {
   }
   }
   function insertdatamy()
   {
   	$this->acc_setting();
   	$user_data=$user_session_data = $this->session->userdata('user_data');
   	//print_r($user_data);die;
   	$filter=$user_data['usermailid'];
   	//print_r($filter);die;
   	if($_FILES['image']['name']!='')
   	{
   		$data['image_z1']= $_FILES['image']['name'];
   
   		$image=sha1($_FILES['image']['name']).time().rand(0, 9);
   		if(!empty($_FILES['image']['name']))
   		{
   
   			$config =  array(
   					'upload_path'	  => './img/',
   					//	'upload_url'      => base_url()."img/",
   					'file_name'       => $image,
   					'allowed_types'   => "gif|jpg|png|jpeg|JPG|JPEG|PNG|JPG",
   					'overwrite'       => true,
   			);
   			//var_dump($config);
   			$this->upload->initialize($config);
   			$this->load->library('upload');
   
   			if($this->upload->do_upload("image"))
   			{
   				$upload_data = $this->upload->data();
   				$image=$upload_data['file_name'];
   				//print_r($image);die;
   			}
   			else
   			{
   				$this->upload->display_errors()."file upload failed";
   				$image    ="";
   			}
   		}
   	}
   	else
   	{
   		$data['image_error']="Please Select Upload Photo";
   		$image ='';
   	}
   	 
   	if(isset($_POST['submit'])){
   		//print_r($filter);die;
   		$name=$this->input->post('name');
   		//$image=$this->input->post('image');
   		$phone_number=$this->input->post('phone_number');
   		//print_r($name);die;
   		$mobile =$this->input->post('mobile');
   		$address=$this->input->post('address');
   		$row=$this->mhome->insertdatamy($filter,$name,$image,$phone_number,$mobile,$address);
   		$this->session->set_flashdata('message_type', 'success');
   		$this->session->set_flashdata('message', $this->config->item("user_id").' updated successfully');
   		redirect('home/acc_setting');
   	}else{
   		echo "not inserted";
   
   	}
   
   
   }
 /*  function for new add department */    
    function add_department($dep_id=false){
		Authority::is_logged_in ();
			if(Authority::checkAuthority('add_department')==true)
			{
					redirect('home');
			}
		else
		{
		 if($dep_id){
			$filter = array('dep_id'=>$dep_id);
		
		   $dep_info = $this->masters_model->get_list($filter,'ssr_t_department');
		   $this->data = array('dep_name'=>$dep_info[0]->dep_name,
		                       'dep_desc'=>$dep_info[0]->dep_desc,
		                        'dep_heading' =>$dep_info[0]->dep_heading,
					               'dep_notes' =>$dep_info[0]->dep_notes);
			$this->data['dep_id']=$dep_id;
								  
		
		}	
		//Breadcrumb section start
			$this->breadcrumb->clear();
		    $this->breadcrumb->add_crumb('Home', base_url());
		    $this->breadcrumb->add_crumb('Department',  base_url().'index.php/home');
		    $this->breadcrumb->add_crumb('Manage Department',  '');
		//Breadcrumb section end
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->parser->parse('add_department',$this->data);
		$this->parser->parse('include/footer',$this->data);
		
	}
	}
	/* function for view and update the logged user profile data  */	
	function acc_setting($info=false)
	{
		if($this->is_logged_in()){
	
			//redirect('login');
	
		}
		else{
			$user_data=$user_session_data = $this->session->userdata('user_data');
			//print_r($user_data);die;
			$filter=$user_data['usermailid'];
			$a=$this->mhome->checkid($filter);
			if($a=='' || $a==TRUE){
				$aa=$this->mhome->show_account($filter);
				$abc=array('name' => $aa->name,
						'image' => $aa->image,
						'phone_number' => $aa->phone_number,
						'mobile' => $aa->mobile,
						'address' => $aa->address);
					
				$this->data['abc']=$abc;
			}
	
			$this->data['user_data']=$this->session->userdata('user_data');
			$userdata=$this->session->userdata('user_data');
			$this->parser->parse('include/header',$this->data);
			$this->parser->parse('include/leftmenu',$this->data);
			$this->load->view('acc_setting',$this->data);
			$this->parser->parse('include/footer',$this->data);
		}
	}
/* function for update the depatment and we create new department */	
  function manage_department(){
			Authority::is_logged_in ();
					if($this->input->post('submit')){
					if($this->input->post('id')){
						//echo"edit";die;
						$info = array('dep_name' => $this->input->post('dep_name'),
					               'dep_desc' => $this->input->post('dep_desc'),
					               'dep_heading' => $this->input->post('dep_heading'),
					               'dep_notes' => $this->input->post('dep_notes'),
					                 'updated_by' => 1,
										'updated_on' => date("Y-m-d"));
			               $this->mhome->manage_department($info,array('dep_id'=>$this->input->post('id')));
			               $this->session->set_flashdata('message_type', 'success');        
                           $this->session->set_flashdata('message', $this->config->item("department").' updated successfully');
					}else{	
					$info = array('dep_name' => $this->input->post('dep_name'),
					               'dep_desc' => $this->input->post('dep_desc'),
					                'dep_heading' => $this->input->post('dep_heading'),
					               'dep_notes' => $this->input->post('dep_notes'),
					                 'created_by' => 1,
										'created_on' => date("Y-m-d"));
					  $c_id=$this->mhome->manage_department($info);
																
							}
					if($this->input->post('id')){
						$this->session->set_flashdata('message_type', 'success');        
                           $this->session->set_flashdata('message', $this->config->item("department").' updated successfully');
						redirect('home');
					}else{
						$this->session->set_flashdata('message_type', 'success');        
                        $this->session->set_flashdata('message', $this->config->item("department").' Added successfully');
								redirect('home');	
					}
				}
 
  }
 /* function used for search the code for calculation in subitem calculation  */ 
			public function auto_search()
			{
				Authority::is_logged_in ();
				$search = $this->input->post('search');
				$search_data=$this->data['search_data']=$this->mhome->search_auto($search);
			}
			
			public function search_result($id=false){
				Authority::is_logged_in ();				//Breadcrumb section start
				   $this->breadcrumb->clear();
				   $this->breadcrumb->add_crumb('Home', base_url());
				   $this->breadcrumb->add_crumb('Search Result', '');
		         //Breadcrumb section end
				$this->parser->parse('include/header',$this->data);
				$this->parser->parse('include/leftmenu',$this->data);
				$this->parser->parse('search_result',$this->data);
			}
// create function for search
			public function search_keyword(){
				Authority::is_logged_in ();
				//Filter In Sub Items Start 
				
				if($this->input->post('item_id') && $this->input->post('search') && $this->input->post('chap_id'))
				{
					$keyword = $this->input->post('search');
					$sub_item_drop = $this->input->post('item_id');
					$sub_items_drop = $this->data['sub_items_drop']=$this->mhome->sub_items_drop($keyword,$sub_item_drop);
					$dipartments=$this->data['dipartments']=$this->mhome->dipart();
				}
				
				//Filter In Sub Items End
				//Filter In Itmes and Sub Items Start
				
				elseif($this->input->post('chap_id') && $this->input->post('search'))
				{	
					$keyword = $this->input->post('search');
					$item_drop = $this->input->post('chap_id');
					$dropdown_item=$this->data['dropdown_item']=$this->mhome->dropdown_item($keyword,$item_drop);
					$dropdown_subitem=$this->data['dropdown_subitem']=$this->mhome->dropdown_subitem($keyword,$item_drop);
					$dipartments=$this->data['dipartments']=$this->mhome->dipart();
				}
				//Filter In Itmes and Sub Items End
				//filter In Items and Sub Items behalf on department start
				
				elseif($this->input->post('dep_id') && $this->input->post('search'))
				{	
					$keyword = $this->input->post('search');
					$item_drop = $this->input->post('dep_id');
					$dep_dropdown_item=$this->data['dep_dropdown_item']=$this->mhome->dep_dropdown_item($keyword,$item_drop);
					$dep_dropdown_subitem=$this->data['dep_dropdown_subitem']=$this->mhome->dep_dropdown_subitem($keyword,$item_drop);
					$dipartments=$this->data['dipartments']=$this->mhome->dipart();
				}
				
				//filter In Items and Sub Items behalf on department end
				//Search in Items and Sub Items Start
				
				else
				{
				   $keyword = $this->input->post('search');
				   $dipartments=$this->data['dipartments']=$this->mhome->dipart();
				   $chapters=$this->data['chapters']=$this->mhome->search($keyword);
				   $items=$this->data['items']=$this->mhome->search_item($keyword);
				   $sub_items=$this->data['sub_items']=$this->mhome->search_subitem($keyword);
				}
				//Search in Items and Sub Items End
				//Breadcrumb section start
				
				   $this->breadcrumb->clear();
				   $this->breadcrumb->add_crumb('Home',base_url());
				   $this->breadcrumb->add_crumb('Search Result', '');
		         //Breadcrumb section end
				 
				   $this->parser->parse('include/header',$this->data);
				 //$this->load->view('search_result',$this->data);
				   $this->parser->parse('include/leftmenu',$this->data);
				   $this->parser->parse('search_result',$this->data);
				   $this->parser->parse('include/footer',$this->data);
					
			}
/* function for chapter list of all the chapters */				
   public function chapter($dep_id)
	{ 
Authority::is_logged_in ();
			Authority::checkAuthority('chapter');
	$filter = array('dep_id'=>$dep_id);
		$this->data['chap_list'] = $this->masters_model->get_list($filter,'ssr_t_chapter');
	    $this->data['dep_detail'] = $this->masters_model->get_list($filter,'ssr_t_department');			
		//Breadcrumb section start
			$this->breadcrumb->clear();
		    $this->breadcrumb->add_crumb('Home', base_url().'index.php/home');
		    $this->breadcrumb->add_crumb($this->data['dep_detail'][0]->dep_name, base_url().'index.php/home');
		    $this->breadcrumb->add_crumb('Chapter', '');
		//Breadcrumb section end
		$this->data['dep_id']=$dep_id;
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->load->view('chep_list',$this->data);
		$this->parser->parse('include/footer',$this->data);
	} 
/* function for add new chapter button */	
	public function add_chapter($dep_id=false,$chap_id=false)
	 {
		 Authority::is_logged_in ();
		if(Authority::checkAuthority('add_chapter')==true)
			{
					redirect('home/chapter/'.$dep_id);
			}
		else{
		if($chap_id){
			$filter = array('chap_id'=>$chap_id);
		
		   $chap_info = $this->masters_model->get_list($filter,'ssr_t_chapter');
		   $this->data = array( 'chap_name'=>$chap_info[0]->chap_name,
		                          'chap_desc'=>$chap_info[0]->chap_desc,
		                         'chap_heading'=>$chap_info[0]->chap_heading,
		                          'chap_notes'=>$chap_info[0]->chap_notes,
		                          'created_by' => 1,
									'created_on' => date("Y-m-d"));
			$this->data['chap_id']=$chap_id;
		}
		 $filter1 = array('dep_id'=>$dep_id);
	    $this->data['deprt_detail'] = $this->masters_model->get_list($filter1,'ssr_t_department');			
		//Breadcrumb section start
			$this->breadcrumb->clear();
		    $this->breadcrumb->add_crumb('Home', base_url());
		    $this->breadcrumb->add_crumb($this->data['deprt_detail'][0]->dep_name,base_url().'index.php/home');
		    $this->breadcrumb->add_crumb('Chapter','');
		//Breadcrumb section end
		$this->data['dep'] = $this->estimation_model->get_deplist('ssr_t_department');	
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->parser->parse('add_chapter',$this->data);
		$this->parser->parse('include/footer',$this->data);
	 }
	 }
/* function for update and create new chapter */	 
	 function manage_chapter(){
		 Authority::is_logged_in ();
					if($this->input->post('submit')){
						if($this->input->post('id')){
			          $info = array('dep_id' => $this->input->post('dep_id'),
			                          'chap_name' => $this->input->post('chap_name'),
										'chap_desc' => $this->input->post('chap_desc'),
										'chap_heading' => $this->input->post('chap_heading'),
										'chap_notes' => $this->input->post('chap_notes'),
										'created_by' => 1,
										'created_on' => date("Y-m-d"),
										'updated_by' => 1,
										'updated_on' => date("Y-m-d"));
							$this->mhome->manage_chapter($info,array('chap_id'=>$this->input->post('id')));
							$this->session->set_flashdata('message_type', 'success');        
							$this->session->set_flashdata('message', $this->config->item("chapter").' updated successfully');
	                 }else{
					       $info = array('dep_id' => $this->input->post('dep_id'),
					                     'chap_name' => $this->input->post('chap_name'),
										'chap_desc' => $this->input->post('chap_desc'),
										'chap_heading' => $this->input->post('chap_heading'),
										'chap_notes' => $this->input->post('chap_notes'),
										'created_by' => 1,
										'created_on' => date("Y-m-d"),
										'updated_by' => 1,
										'updated_on' => date("Y-m-d"));
					        $c_id=$this->mhome->manage_chapter($info);
						  }   
					
					if($this->input->post('id')){
						$this->session->set_flashdata('message_type', 'success');        
							$this->session->set_flashdata('message', $this->config->item("chapter").' updated successfully');
						redirect('home/chapter/'.$this->input->post('dep_id'));
					}else{
						$this->session->set_flashdata('message_type', 'success');        
                        $this->session->set_flashdata('message', $this->config->item("chapter").' Added successfully');
								redirect('home/chapter/'.$this->input->post('dep_id'));	
					}
				}
	}
/*  funnction for get departmnet list for chapter*/	 
	public function manage_chapter_list($id=false){
		Authority::is_logged_in ();
	 $this->data['dep'] = $this->estimation_model->get_deplist('ssr_t_department');		
			
			
			$this->breadcrumb->clear();
		    $this->breadcrumb->add_crumb('Home', base_url());
		    $this->breadcrumb->add_crumb('Departments', base_url());
		    $this->breadcrumb->add_crumb('Chapter','');
			$this->parser->parse('include/header',$this->data);
			$this->parser->parse('include/leftmenu',$this->data);
			$this->parser->parse('manage_chapter',$this->data);
			$this->parser->parse('include/footer',$this->data);		
		}
			
/* function for item */	
public function item($dep_id=false,$chap_id=false)
	{   
	
	Authority::is_logged_in ();
		Authority::checkAuthority('item');
	$filter = array('dep_id'=>$dep_id,'chap_id'=>$chap_id);
		$this->data['item_list'] = $this->mhome->get_item_list($filter,'ssr_t_item');	
		$filter = array('dep_id'=>$dep_id);
	    $this->data['dep_detail'] = $this->masters_model->get_list($filter,'ssr_t_department');
		$filter = array('chap_id'=>$chap_id);
	    $this->data['chap_detail'] = $this->masters_model->get_list($filter,'ssr_t_chapter');
			$this->breadcrumb->clear();
		    $this->breadcrumb->add_crumb('Home', base_url());
		    $this->breadcrumb->add_crumb($this->data['dep_detail'][0]->dep_name, base_url().'index.php/home');
		    $this->breadcrumb->add_crumb($this->data['chap_detail'][0]->chap_name, base_url().'index.php/home/chapter/'.$this->data['dep_detail'][0]->dep_id);
		    $this->breadcrumb->add_crumb('Items', '');
		$this->data['dep_id']=$dep_id;
	    $this->data['chap_id']=$chap_id;
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->load->view('item_list',$this->data);
		$this->parser->parse('include/footer',$this->data);
	}	
/* function for new item */	
 public function create_item($dep_id=false,$chap_id=false,$item_id=false)
	 {
		Authority::is_logged_in ();
		if(Authority::checkAuthority('create_item'))
				{
					redirect('home/item/'.$dep_id.'/'.$chap_id);	
				}
		else{
	     $this->data['unit_list'] = $this->masters_model->get_unitlist(); 
		  $this->data['class_list'] = $this->masters_model->get_class_list();
		if($item_id){
			$filter = array('item_id'=>$item_id);
		
		   $item_info = $this->mhome->get_item_list($filter,'ssr_t_item');
		   $this->data = array('dep_id'=>$item_info[0]->dep_id,
		                        'chap_id'=>$item_info[0]->chap_id,
		                        'item_name'=>$item_info[0]->item_name,
		                        'item_desc'=>$item_info[0]->item_desc,
								'unit_code'=>$item_info[0]->unit_code,
								 'item_class_id' =>$item_info[0]->item_class_id,
		                        'item_qty_base'=>$item_info[0]->item_qty_base,
		                        'item_cost_total'=>$item_info[0]->item_cost_total,
		                        'item_cost_per_unit'=>$item_info[0]->item_cost_per_unit,
		                        'item_cost_total'=>$item_info[0]->item_cost_total,
		                        'item_heading'=>$item_info[0]->item_heading,
		                        'item_notes'=>$item_info[0]->item_notes,
		                         'created_by' => 1,
									'created_on' => date("Y-m-d"));
			$this->data['item_id']=$item_id;
		}
			
		$this->data['dep_id']=$dep_id;
	    $this->data['chap_id']=$chap_id;
	    $this->data['item_class_id']=$chap_id;
			$this->breadcrumb->clear();
		    $this->breadcrumb->add_crumb('Home', base_url());
		     $this->breadcrumb->add_crumb('Department', base_url().'index.php/home');
		    $this->breadcrumb->add_crumb('Chapter','');
		    $this->breadcrumb->add_crumb('Items','');
		$this->data['dep'] = $this->estimation_model->get_deplist('ssr_t_department');	
		$this->data['chap'] = $this->mhome->get_chapist('ssr_t_chapter');
		$this->data['unit_list'] = $this->masters_model->get_unitlist();
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->parser->parse('add_item',$this->data);
		$this->parser->parse('include/footer',$this->data);
	 }
	 }
/* function for update and create new item */	 
	function add_item(){
		Authority::is_logged_in ();
					if($this->input->post('submit')){
						if($this->input->post('id')){
							  $comma_separated = implode(",", $this->input->post('item_class_id'));
			            $info = array('dep_id'=>$this->input->post('dep_id'),
						                   'chap_id'=>$this->input->post('chap_id'),
						                   'item_class_id' => $comma_separated,
										   'item_name'=>$this->input->post('item_name'),
										    'item_desc'=>$this->input->post('item_desc'),
											'unit_code'=>$this->input->post('unit_code'),
		                                   'item_qty_base'=>$this->input->post('item_qty_base'),
		                                   'item_cost_total'=>$this->input->post('item_cost_total'),
		                                   'item_cost_per_unit'=>$this->input->post('item_cost_per_unit'),
		                                   'item_cost_total'=>$this->input->post('item_cost_total'),
		                                   'item_notes'=>$this->input->post('item_notes'),
		                                   	 'created_by' => 1,
												'created_on' => date("Y-m-d"));
							$this->mhome->update_item($info,array('item_id'=>$this->input->post('id')));
							$this->session->set_flashdata('message_type', 'success');        
							$this->session->set_flashdata('message', $this->config->item("item").' updated successfully');
					
	                 }else{
					       $comma_separated = implode(",", $this->input->post('item_class_id'));
					       $info = array('dep_id'=>$this->input->post('dep_id'),
						                   'chap_id'=>$this->input->post('chap_id'),
						                    'item_class_id' => $comma_separated,
										   'item_name'=>$this->input->post('item_name'),
										    'item_desc'=>$this->input->post('item_desc'),
											'unit_code'=>$this->input->post('unit_code'),
						  'item_qty_base'=>$this->input->post('item_qty_base'),
		                                   'item_cost_total'=>$this->input->post('item_cost_total'),
		                                   'item_cost_per_unit'=>$this->input->post('item_cost_per_unit'),
		                                   'item_cost_total'=>$this->input->post('item_cost_total'),
		                                   'item_notes'=>$this->input->post('item_notes'),
		                                   'created_by' => 1,
										   'created_on' => date("Y-m-d"));
								  $item_class_id = $this->input->post('item_class_id');
											 $c_id=$this->mhome->manage_item($info);
						  }   
					if($this->input->post('id')){
						redirect('home/item/'.$this->input->post('dep_id').'/'.$this->input->post('chap_id'));
					}else{
						$this->session->set_flashdata('message_type', 'success');        
                        $this->session->set_flashdata('message', $this->config->item("item").' Added successfully');
								redirect('home/item/'.$this->input->post('dep_id').'/'.$this->input->post('chap_id'));	
					}
				}
             }
/* function for item where we getting deparetment list */	
	public function manage_item($id=false){
		Authority::is_logged_in ();
			
	  $this->data['dep'] = $this->estimation_model->get_deplist('ssr_t_department');			
			$this->breadcrumb->clear();
		    $this->breadcrumb->add_crumb('Home', base_url());
		    $this->breadcrumb->add_crumb('Departments', base_url().'index.php/home');
		    $this->breadcrumb->add_crumb('Chapters','');
		    $this->breadcrumb->add_crumb('Items','');
			$this->parser->parse('include/header',$this->data);
			$this->parser->parse('include/leftmenu',$this->data);
			$this->parser->parse('manage_item',$this->data);
			$this->parser->parse('include/footer',$this->data);		
		}	
/* function for subitem list for the calcultaion */			
  public function subitem_list($id=false){
	  Authority::is_logged_in ();
   $this->data['dep'] = $this->estimation_model->get_deplist('ssr_t_department');	
		//Breadcrumb section start
			$this->breadcrumb->clear();
		    $this->breadcrumb->add_crumb('Home', base_url());
		    $this->breadcrumb->add_crumb('Departments', base_url().'index.php/home');
		    $this->breadcrumb->add_crumb('Chapters','');
		    $this->breadcrumb->add_crumb('Items','');
		    $this->breadcrumb->add_crumb('Subitems','');
		   
		//Breadcrumb section end
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->parser->parse('manage_subitem',$this->data);
		$this->parser->parse('include/footer',$this->data);		
		
		}
 /* function for unit list for the calculation */
 	
 public function manage_subitem($dep_id=false,$chap_id=false,$item_id=false,$subitem_id=false)
	 {
		Authority::is_logged_in ();
		if(Authority::checkAuthority('manage_subitem'))
		{
			redirect('home/get_subitem_list/'.$dep_id.'/'.$chap_id.'/'.$item_id);
		}
		else{
	   if($subitem_id){
			$filter = array('subitem_id'=>$subitem_id);
		
		   $subitem_info = $this->masters_model->get_list($filter,'ssr_t_subitem');
		   $this->data = array('dep_id'=>$subitem_info[0]->dep_id,
		                         'chap_id'=>$subitem_info[0]->chap_id,
		                          'item_id'=>$subitem_info[0]->item_id,
		                          'subitem_name'=>$subitem_info[0]->subitem_name,
		                          'subitem_desc'=>$subitem_info[0]->subitem_desc,
		                         'unit_code'=>$subitem_info[0]->unit_code,
		                         'rate'=>$subitem_info[0]->rate,
		                         'subitem_class_id'=>$subitem_info[0]->subitem_class_id,
		                        'subitem_heading'=>$subitem_info[0]->subitem_heading,
		                        'subitem_notes'=>$subitem_info[0]->subitem_notes,
		                          'created_by' => 1,
									'created_on' => date("Y-m-d"));
			$this->data['subitem_id']=$subitem_id;
		}
		//Breadcrumb section start
			$this->breadcrumb->clear();
		    $this->breadcrumb->add_crumb('Home', base_url());
		    $this->breadcrumb->add_crumb('Departments',base_url().'index.php/home');
		    $this->breadcrumb->add_crumb('Chapters','');
		    $this->breadcrumb->add_crumb('Items','');
		    $this->breadcrumb->add_crumb('Subitems','');
		   
		//Breadcrumb section end
		 $this->data['unit_list'] = $this->masters_model->get_unitlist();
		  $this->data['dep'] = $this->estimation_model->get_deplist('ssr_t_department');
	    $this->data['chap_id']=$chap_id;
	    $this->data['dep_id']=$dep_id;
	    $this->data['item_id']=$item_id;
	      $filter = array('dep_id'=>$dep_id,'chap_id'=>$chap_id,'item_id'=>$item_id);
	   $this->data['item_list'] = $this->mhome->get_item_list($filter,'ssr_t_item');	
		$class_ids=$this->data['item_list'][0]->item_class_id;
	    $this->data['chap'] = $this->mhome->get_chapist('ssr_t_chapter');
	    $this->data['item_cls_list']=$this->mhome->get_item_cls_list($class_ids);
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->parser->parse('create_subitem',$this->data);
		$this->parser->parse('include/footer',$this->data);
		
	 }
	 }
/* function for update and create new subitem */	 	 
	 function add_subitem(){
		Authority::is_logged_in ();
			if($this->input->post('submit')){
						$data = $this->input->post();
		$value = "";
		if($this->input->post('subitem_id')){
					    $info = array( 'subitem_name'=>$this->input->post('subitem_name'),
										'subitem_desc' => $this->input->post('subitem_desc'),
										'unit_code' => $this->input->post('unit_code'),
										'rate' => $this->input->post('rate'),
										'subitem_class_id' => $this->input->post('subitem_class_id'),
										'subitem_heading' => $this->input->post('subitem_heading'),
										'subitem_notes' => $this->input->post('subitem_notes'));
										
										
							$this->mhome->update_subitem($info,array('subitem_id'=>$this->input->post('subitem_id')));
								
							$this->session->set_flashdata('message_type', 'success');        
							$this->session->set_flashdata('message', 'Subitem updated successfully');
							redirect("home/get_subitem_list/".$data['dep_id']."/".$data['chap_id']."/".$data['item_id']);
		  
		}else{
		
		for($i=0;$i<=count($data['subitem_name'])-1; $i++){
			
				$value .= "('".$data['dep_id']."','".$data['chap_id']."','".$data['item_id']."','".$data['subitem_name'][$i]."','".$data['subitem_desc'][$i]."','".$data['unit_code'][$i]."','".$data['subitem_class_id'][$i]."','".$data['rate'][$i]."','".$data['subitem_heading'][$i]."','".$data['subitem_notes'][$i]."')".","; 
			}
			
			
				if($this->mhome->manage_sitem(rtrim($value,","))){
					$this->session->set_flashdata('message_type', 'success');        
                        $this->session->set_flashdata('message', 'Subitem Added successfully');
					redirect("home/get_subitem_list/".$data['dep_id']."/".$data['chap_id']."/".$data['item_id']);
					
				}else{
					echo "Error while Adding SubItem";
				}
		}
    }
}
 /* function for calculation of subtiem */
  public function create_sub_item($dep_id=false,$chap_id=false,$item_id=false,$subitem_id=false,$class_id=false)
	{  
	Authority::is_logged_in ();
		if(Authority::checkAuthority('create_sub_item'))
		{
			redirect('home/get_subitem_list/'.$dep_id.'/'.$chap_id.'/'.$item_id);
		}
		else{
		       $this->data['dep_id'] = $dep_id;
		       $this->data['chap_id'] = $chap_id;
		       $this->data['item_id'] = $item_id;
		       $this->data['subitem_id'] = $subitem_id;
		       $this->data['class_id'] = $class_id;
		$filter = array('subitem_id'=>$subitem_id);
		$this->data['subitem_costing'] = $this->masters_model->get_list($filter,'ssr_t_calculation');
		$filter = array('dep_id'=>$dep_id);
	    $this->data['dep_detail'] = $this->masters_model->get_list($filter,'ssr_t_department');
		$filter = array('chap_id'=>$chap_id);
	    $this->data['chap_detail'] = $this->masters_model->get_list($filter,'ssr_t_chapter');
		$filter = array('item_id'=>$item_id);
	    $this->data['item_detail'] = $this->mhome->get_item_list($filter,'ssr_t_item');
	    $filter = array('subitem_id'=>$subitem_id);
	    $this->data['subitem_detail'] = $this->masters_model->get_list($filter,'ssr_t_subitem');
		//Breadcrumb section start
			$this->breadcrumb->clear();
		    $this->breadcrumb->add_crumb('Home', base_url());
		    $this->breadcrumb->add_crumb($this->data['dep_detail'][0]->dep_name, base_url());
		    $this->breadcrumb->add_crumb($this->data['chap_detail'][0]->chap_name, base_url().'index.php/home/chapter/'.$dep_id);
		    $this->breadcrumb->add_crumb($this->data['item_detail'][0]->item_name, base_url().'index.php/home/item/'.$dep_id.'/'.$chap_id);
		    $this->breadcrumb->add_crumb($this->data['subitem_detail'][0]->subitem_name, base_url().'index.php/home/item/'.$dep_id.'/'.$chap_id);
		//Breadcrumb section end
                   $this->data['subitem_des'] = $this->data['subitem_detail'][0]->subitem_desc;
                   $this->data['class_id'] = $this->data['subitem_detail'][0]->subitem_class_id;
		 $this->data['cost_type'] = $this->masters_model->get_costtype('ssr_t_cost_type');
		 $this->data['code_type'] = $this->mhome->get_code('ssr_t_calculation');
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->load->view('subitem_cal',$this->data);
		$this->parser->parse('include/footer',$this->data);
	}
	}
/* function for subitem calcultaion for perticular subitem code   */	
	public function create_sub_cal()
	{  
	Authority::is_logged_in ();
		
		$data = $this->input->post();
		$value = "";
		if($this->input->post('edit_costing')==1){
			for($i=0;$i<=count($data['code'])-1; $i++){
				$value .= "('".$data['dep_id']."','".$data['chap_id']."','".$data['item_id']."','".$data['subitem_id']."','".$data['class_id']."',".$data['serial'][$i].",'".$data['item_type'][$i]."','".$data['item_desc'][$i]."','".$data['code'][$i]."','".$data['unit_code'][$i]."','".$data['amount'][$i]."','".$data['total_amount'][$i]."','".$data['quantity'][$i]."','".$data['rate'][$i]."','".$data['Ovehead'][$i]."')".",";
			}
			if($this->mhome->update_subitem_cal(rtrim($value,","),$data['final_total'],$data['dep_id'],$data['chap_id'],$data['item_id'],$data['subitem_id'])){
				$this->session->set_flashdata('ct_success', 'success');
				$this->session->set_flashdata('message', 'Subitem Calcultaion Updated Successfully');
				redirect("home/get_subitem_list/".$data['dep_id']."/".$data['chap_id']."/".$data['item_id']);
			}else{
				echo "Error while Editing SubItem";
			}
		} else {
		for($i=0;$i<=count($data['code'])-1; $i++){
				$value .= "('".$data['dep_id']."','".$data['chap_id']."','".$data['item_id']."','".$data['subitem_id']."','".$data['class_id']."',".$data['serial'][$i].",'".$data['item_type'][$i]."','".$data['item_desc'][$i]."','".$data['code'][$i]."','".$data['unit_code'][$i]."','".$data['amount'][$i]."','".$data['total_amount'][$i]."','".$data['quantity'][$i]."','".$data['rate'][$i]."','".$data['Ovehead'][$i]."')".",";
			}
			if($this->mhome->manage_subitem_cal(rtrim($value,","),$data['final_total'],$data['subitem_id'],$data['item_id'])){
				$this->session->set_flashdata('cat_success', 'success');
				$this->session->set_flashdata('message', 'Subitem Calcultaion Added Successfully');
				redirect("home/get_subitem_list/".$data['dep_id']."/".$data['chap_id']."/".$data['item_id']);
				
			}else{
				echo "Error while Adding SubItem";
			}
		}
	}
	
/* function  for subitem of item */
function get_subitem_list($dep_id=false,$chap_id=false,$item_id=false){
	      Authority::is_logged_in ();
			Authority::checkAuthority('get_subitem_list');
		       $this->data['dep_id'] = $dep_id;
		       $this->data['chap_id'] = $chap_id;
		       $this->data['item_id'] = $item_id;
			$filter = array('dep_id'=> $dep_id,
			                'chap_id'=>$chap_id,
							'item_id'=>$item_id);
			$this->data['subitem_list'] = $this->masters_model->get_list($filter,'ssr_t_subitem');
			
			
		$filter = array('dep_id'=>$dep_id);
	    $this->data['dep_detail'] = $this->masters_model->get_list($filter,'ssr_t_department');
		$filter = array('chap_id'=>$chap_id);
	    $this->data['chap_detail'] = $this->masters_model->get_list($filter,'ssr_t_chapter');
		$filter = array('item_id'=>$item_id);
	    $this->data['item_detail'] = $this->mhome->get_item_list($filter,'ssr_t_item');
		//Breadcrumb section start	
		
			$this->breadcrumb->clear();
		    $this->breadcrumb->add_crumb('Home', base_url());
		    $this->breadcrumb->add_crumb($this->data['dep_detail'][0]->dep_name,base_url().'index.php/home');
		   $this->breadcrumb->add_crumb($this->data['chap_detail'][0]->chap_name, base_url().'index.php/home/chapter/'.$dep_id);
		    $this->breadcrumb->add_crumb($this->data['item_detail'][0]->item_name, base_url().'index.php/home/item/'.$dep_id.'/'.$chap_id);
		    if($this->data['subitem_list']){
			  $this->breadcrumb->add_crumb($this->data['subitem_list'][0]->subitem_name, base_url().'index.php/home/item/'.$dep_id.'/'.$chap_id);
			
		}else{
	    $this->breadcrumb->add_crumb('Subitem', '');
	    
  	}
			//print_r($this->data['subitem_list']);die;
		
		 $this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		 $this->parser->parse('subitem_list', $this->data);
		$this->parser->parse('include/footer',$this->data);
		
	}
/* when we delete item */	
public function delete_item($dep_id=false,$chap_id=false,$item_id=false){
	Authority::is_logged_in ();
		if(Authority::checkAuthority('delete_item'))
		{
			redirect('home/item/'.$dep_id.'/'.$chap_id);
		}
		else{
		$this->mhome->delete_item($item_id);
	
	                   $this->session->set_flashdata('message_type', 'success');        
                        $this->session->set_flashdata('message', $this->config->item("item").' DELETE successfully');
								redirect('home/item/'.$dep_id.'/'.$chap_id);		
}
}
/* function for delete subitem */
public function delete_subitem($dep_id=false,$chap_id=false,$item_id=false,$subitem_id=false,$class_id=false){
	Authority::is_logged_in ();
		if(Authority::checkAuthority('delete_subitem'))
		{
			redirect('home/get_subitem_list/'.$dep_id.'/'.$chap_id.'/'.$item_id);
		}
		else{
	
						$this->mhome->delete_subitem($subitem_id);
	
	                   $this->session->set_flashdata('cate_success', 'success');        
                        $this->session->set_flashdata('message', $this->config->item("subitem").' DELETE successfully');
						redirect('home/get_subitem_list/'.$dep_id.'/'.$chap_id.'/'.$item_id);		
}
}
 /* function for the carriage calculation */
public function create_carriage_cal($carriage_id=false){
	Authority::is_logged_in ();
	$filter = array('carriage_id'=>$carriage_id);
$this->data['carriage_costing'] = $this->masters_model->get_list($filter,'ssr_t_carriage_cal');
  $this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/leftmenu',$this->data);
		$this->load->view('carriage_cal',$this->data);
		$this->parser->parse('include/footer',$this->data);	
}
/*  function is used for auto search of the calcultaion */	
public function index1(){
	Authority::is_logged_in ();
		$search=  $this->input->post('search');
		$query = $this->mhome->search_auto($search);
		echo json_encode ($query);
}
/* function for show the authentication msessage */
public function msg($dep_id=false)
	{
	$this->session->set_flashdata('category_error_block', 'success message');        
	$this->session->set_flashdata('message', $this->config->item("add_department").' You Are Not Authorised Person For Genrate PDF');
		redirect('home/chapter/'.$dep_id);
	}
}
/* Ended */


