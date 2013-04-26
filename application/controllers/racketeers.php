<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Racketeers extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		parent::_get_script(__FILE__);

		$this->load->helper(array('form', 'url'));
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
		$this->load->model('add_racket_model');
		$this->load->model('racketeers_model');

		if($this->tank_auth->is_logged_in())
		{	
			$this->smarty->assign('main_content', 'racketeers.tpl');
			$this->smarty->view();
		}
		else
		{
			redirect('/');
		}
	}
	
	function index()
	{
		$this->load->model('racketeers_model');

		print_r($this->racketeers_model->get_racketeers); die();
		$this->smarty->assign('continents', $this->add_racket_model->get_from_racket_continents());
		$this->smarty->assign('countries', $this->add_racket_model->get_from_racket_country());
		$this->smarty->assign('categories', $this->add_racket_model->get_from_racket_categories());
		$this->smarty->view();
    }

    function get_racketeers()
    {
    	echo json_encode($this->racketeers_model->get_racketeers());
    	die();
    }

    function trytry()
    {
    	for($x=17; $x<=61; $x++)
    	{
    		if($x<18)
    		{
    			$y = 1;
    		}
    		elseif($x == 18 && $x<=24)
    		{
    			$y = 2;
    		}
    		elseif($x > 24 && $x <40)
    		{
    			$y = 3;
    		}
    		elseif($x > 39 && $x<50)
    		{
    			$y = 4;
    		}
    		elseif($x> 49 && $x<60)
    		{
    			$y = 5;
    		}
    		else
    		{
    			$y = 6;
    		}
    		$sql = "INSERT INTO age (age, age_bracket) VALUES($x,$y)";
    		$this->db->query($sql);
    	}
    	
    }
}
?>	