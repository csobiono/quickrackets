<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_settings extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		parent::_get_script(__FILE__);

		$this->load->helper(array('form', 'url'));
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');

		if(!$this->tank_auth->is_logged_in())
		{
			redirect('/');
		}
	}
	
	function index()
	{	
		$this->smarty->assign('main_content', 'user_settings/basic_info.tpl');
		$this->smarty->view();
    }

    function funds()
    {
    	$this->smarty->assign('main_content', 'user_settings/funds.tpl');
		$this->smarty->view();
    }
}
?>