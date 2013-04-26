<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Get_website_content extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		parent::_get_script(__FILE__);

		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
	}
	
	function index()
	{
		redirect('/');
    }

    function form_instructions()
    {
    	$field_id = $this->input->post('field_id');
    	$str = "SELECT website_content_id, website_content_text FROM website_content"
    		. " WHERE website_content_type_id = 1 AND website_content_for_id = '$field_id'";
    	$result = $this->db->query($str)->result();
    	$content = array();
 
    	foreach($result as $row)
    	{
    		echo $row->website_content_text;
    	}
    	die();
    }
}
?>