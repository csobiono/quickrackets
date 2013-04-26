<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Create_racket extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		parent::_get_script(__FILE__);

		$this->load->helper(array('form', 'url'));
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');

		/*if($this->tank_auth->is_logged_in())
		{	
			$this->smarty->assign('main_content', 'events.tpl');
			$this->smarty->view();
		}
		else
		{
			redirect('/');
		}*/
	}
	
	function index()
	{
		$this->smarty->assign('main_content', 'create_racket.tpl');
		$this->smarty->view();
    }
}
?>