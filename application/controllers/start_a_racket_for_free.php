<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Start_a_racket_for_free extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		parent::_get_script(__FILE__);

		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
		$this->load->model('add_racket_model');
	}
	
	function index()
	{
		if($this->tank_auth->is_logged_in())
		{	
			$this->smarty->assign('continents', $this->add_racket_model->get_from_racket_continents());
			$this->smarty->assign('countries', $this->add_racket_model->get_from_racket_country());
			$this->smarty->assign('categories', $this->add_racket_model->get_from_racket_categories());

			$this->smarty->assign('pagetitle', 'Start a Racket For Free');
			$this->smarty->assign('main_content', 'start_racket.tpl');
			$this->smarty->view();
		}
		else
		{
			redirect('/');
		}
    }

    function new_racket()
    {
    	$arr = array();
    	$arr['user_id'] = $this->tank_auth->get_user_id();
		$arr['racket_name'] = $this->input->post('racket_name');
		$arr['racket_price'] = $this->input->post('racket_price');
		$arr['available_pos'] = $this->input->post('available_pos');
		$arr['tasks'] = array();
		$arr['tasks'] = $this->input->post('tasks');
		$arr['duration'] = $this->input->post('duration');
		$arr['category_id'] = $this->input->post('category_id');
		$arr['is_public'] = $this->input->post('is_public');
		$arr['proofs'] = array();
		$arr['proofs'] = $this->input->post('proofs');

    	$this->load->model('Start_a_racket_for_free_model', 'new_racket_model');
    	$this->new_racket_model->add_racket($arr);
    }
}
?>