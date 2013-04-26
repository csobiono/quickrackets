<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
	 * Register user on the site
	 *
	 * @return void
	 */

class Register extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('security');
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');

		if ($this->tank_auth->is_logged_in())  // logged in
		{									
			redirect('');
		} 
		elseif ($this->tank_auth->is_logged_in(FALSE)) // logged in, not activated
		{						
			redirect('/register/send_again/');
		}
	}
	
	function index()
	{
		$this->load->model('registration_model', 'reg_tools');
		$this->smarty->assign('gender', $this->reg_tools->genders());
		$this->smarty->assign('country', $this->reg_tools->countries());
		$this->smarty->assign('month', $this->reg_tools->months());
		$this->smarty->assign('day', $this->reg_tools->days());
		$this->smarty->assign('year', $this->reg_tools->years());

		$this->smarty->assign('main_content', 'registration.tpl');
		$this->smarty->view();
	}

	function process_registration()
	{
		$this->load->library('tank_auth');
		$reg_data = array();
		
		$reg_data['user_login'] = $this->form_validation->xss_clean(trim($this->input->post('username')));
		$reg_data['user_firstname'] = $this->form_validation->xss_clean(trim($this->input->post('firstname')));
		$reg_data['user_lastname'] = $this->form_validation->xss_clean(trim($this->input->post('lastname')));
		$reg_data['user_email'] = $this->form_validation->xss_clean(trim($this->input->post('email')));
		$reg_data['user_password'] = $this->form_validation->xss_clean(trim($this->input->post('password')));
		$reg_data['user_gender'] = $this->input->post('gender');
		$reg_data['user_country_id'] = $this->input->post('country');
		$bday_month = $this->input->post('month');
		$bday_day = $this->input->post('day');
		$bday_year = $this->input->post('year');
		$reg_data['user_bday'] = "".$bday_year."-".$bday_month."-".$bday_day;
		$reg_data['confirm_password'] = $this->form_validation->xss_clean(trim($this->input->post('confirm_password')));

		$error = "null";
		$uname_minlen = $this->config->item('username_min_length', 'tank_auth');
		$uname_maxlen = $this->config->item('username_max_length', 'tank_auth');
		$pass_minlen = $this->config->item('password_min_length', 'tank_auth');
		$pass_maxlen = $this->config->item('password_max_length', 'tank_auth');
		
		if(!$this->form_validation->min_length($reg_data['user_login'], $uname_minlen))
		{
			$error = "Your username must be at least ".$uname_minlen." characters long. Please try another.";
		}
		
		if(!$this->form_validation->max_length($reg_data['user_login'], $uname_maxlen))
		{
			$error = "Your username must not exceed to ".$uname_maxlen." characters long. Please try another.";
		}
		
		if($this->form_validation->is_numeric($reg_data['user_login']))
		{
			$error = "Invalid username. Please try another.";
		}

		if(!$this->form_validation->is_unique($reg_data['user_login'], 'user.user_login'))
		{
			$error = "That username already exists. Please try another.";
		}

		if(!$this->form_validation->min_length($reg_data['user_password'], $pass_minlen))
		{
			$error = "Your password must be at least ".$pass_minlen." characters long. Please try another.";
		}
		
		if(!$this->form_validation->max_length($reg_data['user_password'], $pass_maxlen))
		{
			$error = "Your password must not exceed to ".$pass_maxlen." characters long. Please try another.";
		}

		if($reg_data['confirm_password'] != $reg_data['user_password'])
		{
			$error = "Password don't match.";
		}

		if(!$this->form_validation->valid_email($reg_data['user_email']))
		{
			$error = "Please enter a valid email address.";
		}

		if(!$this->form_validation->is_unique($reg_data['user_email'], 'user.user_email'))
		{
			$error = "Sorry, it looks like ".$reg_data['user_email']." belongs to an existing account."
				. " Would you like to <a href='/claim-email?'".$reg_data['user_email'].">claim this email address</a>?";
		}

		$email_activation = $this->config->item('email_activation', 'tank_auth');
		if($error === "null")
		{
			$cpass = array_pop($reg_data);
			$reg_data = $this->tank_auth->create_user($reg_data, $email_activation);
			$reg_data['confirm_password'] = $cpass;
		}
		else
		{
			$reg_data['top_error'] = $error;
		}

		echo json_encode($reg_data);
	}

	/**
	 * Send activation email again, to the same or new email address
	 *
	 * @return void
	 */
	function send_again()
	{
		if (!$this->tank_auth->is_logged_in(FALSE)) {							// not logged in or activated
			redirect('/auth/login/');

		} else {
			$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if (!is_null($data = $this->tank_auth->change_email(
						$this->form_validation->set_value('email')))) {			// success

					$data['site_name']	= $this->config->item('website_name', 'tank_auth');
					$data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;

					$this->_send_email('activate', $data['email'], $data);

					$this->_show_message(sprintf($this->lang->line('auth_message_activation_email_sent'), $data['email']));

				} else {
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			$this->smarty->view($data, 'auth/send_again_form.tpl');
		}
	}

	/**
	 * Send email message of given type (activate, forgot_password, etc.)
	 *
	 * @param	string
	 * @param	string
	 * @param	array
	 * @return	void
	 */
	function _send_email($type, $email, &$data)
	{
		$this->load->library('email');
		$this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->to($email);
		$this->email->subject(sprintf($this->lang->line('auth_subject_'.$type), $this->config->item('website_name', 'tank_auth')));
		$this->email->message($this->load->view('email/'.$type.'-html.php', $data, TRUE));
		$this->email->set_alt_message($this->load->view('email/'.$type.'-txt', $data, TRUE));
		$this->email->send();
	}

	/**
	 * Create CAPTCHA image to verify user as a human
	 *
	 * @return	string
	 */
	function _create_captcha()
	{
		$this->load->helper('captcha');

		$cap = create_captcha(array(
			'img_path'		=> './'.$this->config->item('captcha_path', 'tank_auth'),
			'img_url'		=> base_url().$this->config->item('captcha_path', 'tank_auth'),
			'font_path'		=> './'.$this->config->item('captcha_fonts_path', 'tank_auth'),
			'font_size'		=> $this->config->item('captcha_font_size', 'tank_auth'),
			'img_width'		=> $this->config->item('captcha_width', 'tank_auth'),
			'img_height'	=> $this->config->item('captcha_height', 'tank_auth'),
			'show_grid'		=> $this->config->item('captcha_grid', 'tank_auth'),
			'expiration'	=> $this->config->item('captcha_expire', 'tank_auth'),
		));

		// Save captcha params in session
		$this->session->set_flashdata(array(
				'captcha_word' => $cap['word'],
				'captcha_time' => $cap['time'],
		));

		return $cap['image'];
	}
}
?>