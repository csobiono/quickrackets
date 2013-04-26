<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		parent::_get_script(__FILE__);

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('security');
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');

		if ($this->tank_auth->is_logged_in())  // logged in
		{									
			redirect('');
		} 
		elseif ($this->tank_auth->is_logged_in(FALSE))  // logged in, not activated
		{						
			redirect('/register/send_again/');
		}
	}
	
	function index()
	{
		$this->db->truncate('login_attempts');

		$login['login'] = $this->form_validation->xss_clean(trim($this->input->post('login')));
		$login['password'] = $this->form_validation->xss_clean(trim($this->input->post('password')));
		$login['remember'] = $this->form_validation->integer($this->input->post('remember'));
		 
		$this->smarty->view('data', $this->process_login($login));	// validation ok							
		$this->smarty->assign('main_content', 'login.tpl');
		$this->smarty->view();
    }

    function process_login($login_data = array())
    {
    	$login_data['login_by_username'] = ($this->config->item('login_by_username', 'tank_auth') AND $this->config->item('use_username', 'tank_auth'));
		$login_data['login_by_email'] = $this->config->item('login_by_email', 'tank_auth');

		// Get login for counting attempts to login
		if ($this->config->item('login_count_attempts', 'tank_auth') AND ($login = $login_data['login'])) 
		{
			$login = $this->security->xss_clean($login);
		} 
		else 
		{
			$login = '';
		}

		$login_data['use_recaptcha'] = $this->config->item('use_recaptcha', 'tank_auth');
		if ($this->tank_auth->is_max_login_attempts_exceeded($login)) 
		{
			if ($login_data['use_recaptcha'])
				continue; //$this->form_validation->set_rules('recaptcha_response_field', 'Confirmation Code', 'trim|xss_clean|required|callback__check_recaptcha');
			else
				continue; //$this->form_validation->set_rules('captcha', 'Confirmation Code', 'trim|xss_clean|required|callback__check_captcha');
		}

		if ($this->tank_auth->login($login_data['login'], $login_data['password'], $login_data['remember'], $login_data['login_by_username'], $login_data['login_by_email']))  // success
		{								
			redirect('');
		} 
		else 
		{
			$errors = $this->tank_auth->get_error_message();			// banned user
			if (isset($errors['banned'])) 
			{								
				$this->_show_message($this->lang->line('auth_message_banned').' '.$errors['banned']);
			} 
			elseif (isset($errors['not_activated'])) 					// not activated user
			{				
				redirect('/register/send_again/');
			} 
			else 														// fail
			{													
				foreach ($errors as $k => $v)	$login_data['errors'][$k] = $this->lang->line($v);
			}
		}
	
		$login_data['show_captcha'] = FALSE;
		if ($this->tank_auth->is_max_login_attempts_exceeded($login)) 
		{
			$login_data['show_captcha'] = TRUE;
			if ($login_data['use_recaptcha']) 
			{
				//$login_data['recaptcha_html'] = $this->_create_recaptcha();
			} 
			else 
			{
				//$login_data['captcha_html'] = $this->_create_captcha();
			}
		}

		return $login_data;
    }
}
?>