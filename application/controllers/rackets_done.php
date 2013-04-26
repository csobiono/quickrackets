<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rackets_done extends MY_Controller
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
		$this->load->model("racket_participation_model", "participation");
		$user_id = $this->tank_auth->get_user_id();

		$arr = array();
		$arr = $this->participation->user_participations($user_id);

		//print_r($this->participation->user_participations()); die();
		$this->smarty->assign('participations', $this->participation->user_participations());
		$this->smarty->assign('main_content', 'rackets_done.tpl');
		$this->smarty->view();
    }
}
?>