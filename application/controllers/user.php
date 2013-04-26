<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        parent::_get_script(__FILE__);
    }

    public function index()
    {
    	  $this->load->model('User', 'user');
     $users = $this->user->get_users();
     print_r($users);
      $this->smarty->assign('listusers', $users);
      
        $this->smarty->assign('main_content', 'user.tpl');
        $this->smarty->view();
    }

}
