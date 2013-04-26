<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Quick_rackets extends MY_Controller
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
			$this->smarty->assign('rackets', $this->rackets_model->get_rackets());
    		$this->smarty->assign('main_content', 'quick_rackets.tpl');
			$this->smarty->view();
		}
		else
		{
			redirect('/');
		}
    }

    function get_racket_info()
    {
    	echo json_encode($this->rackets_model->get_racket_info($this->input->post("racket_id")));
    	die();
    }

    function submit_participation()
    {
    	$this->load->model("racket_participation_model", "participate");
        $this->participate->submit_participation($racket_id);
        
    }
}
?>