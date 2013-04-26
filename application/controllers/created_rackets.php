<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Created_rackets extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		parent::_get_script(__FILE__);

		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
		$this->load->model('rackets_model');
	}
	
	function index()
	{
		if($this->tank_auth->is_logged_in())
		{	
			$this->smarty->assign('user_rackets', $this->rackets_model->get_rackets($this->tank_auth->get_user_id()));
			$this->smarty->assign('pagetitle', 'Created Rackets');
    		$this->smarty->assign('main_content', 'created_rackets.tpl');

			$this->smarty->view();
		}
		else
		{
			redirect('/');
		}
    }
}
?>