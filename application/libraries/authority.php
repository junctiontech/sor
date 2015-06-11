<?php 
class Authority  
{
	public static function checkAuthority($function)
	{
		$obj =& get_instance();
		$user_session_data = $obj->session->userdata('user_data');	
		$role=$user_session_data['role_id'];
		$list_permision=$obj->data['list_permision']=$obj->authority_model->list_permision($role);
		foreach($list_permision as $var)
		{	
		  if($user_session_data['role_id']==$var->role_id && $var->function_id==$function && $var->auth_read==1 && $var->auth_execute==0)
			{  
			$obj->session->set_flashdata('category_error', 'success message');        
			$obj->session->set_flashdata('message', $obj->config->item("add_department").' You are not authorised person for edit');
					return true;
			}
			if($user_session_data['role_id']==$var->role_id && $var->function_id==$function && $var->auth_read==0 && $var->auth_execute==0)
			{		
				$obj->session->set_flashdata('category_error_block', 'success message');        
				$obj->session->set_flashdata('message', $obj->config->item("add_department").' You Are Not Authorised Person Please Contact Administrator');
						redirect('home');
			}
		}	
	}
}
/*END OF FILE*/
