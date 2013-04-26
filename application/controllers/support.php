<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Support extends MY_Controller
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

		if(!$this->tank_auth->is_logged_in())
		{
			redirect('/');
		}
	}
	
	function index()
	{
		$this->smarty->assign('main_content', 'support/create.tpl');
		$this->smarty->view();
    }

    function outbox()
    {
		$this->smarty->assign('main_content', 'support/outbox.tpl');
		$this->smarty->view();
    }
}
?>