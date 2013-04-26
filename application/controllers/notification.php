<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends MY_Controller
{
    //--------------------------------------------------------------------

    public function __construct() 
    {
        parent::__construct();    
        $this->load->model('Billings', 'billing');  
        $this->load->model('pending_shipments_model', 'pending_shipment'); 
        $this->load->model('Work_order', 'work_order');     
    }
    
    public function index()
    {
    	$this->send_delayed_shipments();
    	$this->send_shipment_pending();
    	$this->send_pending_activation();
	}
	
	public function send_delayed_shipments()
	{
		$user_company_id = $this->session->userdata('user_company_id'); 
		$subject = 'Delayed Shipment for '. date('Y-m-d g:i A');
    	$result = $this->billing->get_delayed_shipment_by_filter('today', $user_company_id);
    	$cell_color = "style='background-color: #99CCFF'";
    	
    	if(count($result) > 0)
    	{
	    	$msg = "<p>Showing 1 to ".count($result)." of ".count($result)." entries</p>"
	    		."<table style='border: 1px solid gray'>"
				."<tr><th>ID</th>"
				."<th>Customer</th><th>Sale Date</th>"
				."<th>Ship Date</th><th>Install Date</th>"
				."<th>Agent</th><th>Amount</th>"
				."<th>Account Type</th></tr>";
		
			foreach($result as $item)
			{
				$msg .= "<tr ".$cell_color."><td>".$item['client_id']."</td>"
					."<td style='text-transform: capitalize'>".$item['client_first_name']." ".$item['client_last_name']."</td>"
					."<td>".$item['work_order_date_created']."</td>"
					."<td>".$item['work_order_date_shipped']."</td>"
					."<td>".$item['work_order_date_installed']."</td>"
					."<td style='text-transform: capitalize'>".$item['user_firstname']." ".$item['user_lastname']."</td>"
					."<td>".$item['work_order_billing_amount']."</td>"
					."<td>".$item['payment_type_name']."</td></tr>";
				
				$cell_color == "style='background-color: #99CCFF'"? $cell_color = "style='background-color: #CCFFFF'" : $cell_color = "style='background-color: #99CCFF'";
			}
			
			$msg .= "</table><p>Showing 1 to ".count($result)." of ".count($result)." entries</p>";
		}
		else
       	{
       		$msg = 'None for Today '. date('Y-m-d g:i A');
       	}
       	
       	$this->send_email($subject, $msg);
	}
	
	public function send_shipment_pending()
	{
		$user_company_id = $this->session->userdata('user_company_id'); 
		$subject = 'Shipment Pending for '. date('Y-m-d g:i A');
		$result = $this->pending_shipment->get_clients_with_pending_shipments('today', $user_company_id);
		$cell_color = "style='background-color: #99CCFF'";
    	
    	if(count($result) > 0)
    	{
	    	$msg =  "<p>Showing 1 to ".count($result)." of ".count($result)." entries</p>"
	    		."<table style='border: 1px solid gray; cell-padding: 3px 2px 3px 2px'>"
				."<tr><th>Client ID</th>"
				."<th>Work Order ID</th><th>Customer</th>"
				."<th>Sale Date</th></tr>";
				
			foreach($result as $item)
			{
				$msg .= "<tr ".$cell_color."><td>".$item->client_id."</td><td>".$item->work_order_id."</td>"
					. "<td style='text-transform: capitalize'>".$item->client_first_name." ".$item->client_last_name."</td>"
					. "<td>".$item->work_order_date_created."</td></tr>";
					
				$cell_color == "style='background-color: #99CCFF'"? $cell_color = "style='background-color: #CCFFFF'" : $cell_color = "style='background-color: #99CCFF'";
			}
			
			$msg .= "</table><p>Showing 1 to ".count($result)." of ".count($result)." entries</p>";
		}
		else
       	{
       		$msg = 'None for Today '. date('Y-m-d g:i A');
       	}
       	
       	$this->send_email($subject, $msg);
	}
	
	public function send_pending_activation()
	{
		$user_id = $this->session->userdata('user_id');
        $user_role_id = $this->session->userdata('user_role_id');
    	$user_company_id = $this->session->userdata('user_company_id');

		$subject = 'Pending Activation for '. date('Y-m-d g:i A');
		$str = 'pending_activation';
        $result = $this->work_order->get_work_orders(0, $user_id, $user_role_id, $user_company_id, 'today');
        $cell_color = "style='background-color: #99CCFF'";

        if(count($result[$str]) > 0)
        {
        	$msg = "<p>Showing 1 to ".count($result[$str])." of ".count($result[$str])." entries</p>"
        	."<table style='border: 1px solid gray; cell-padding: 3px 2px 3px 2px'>"
			."<tr><th>Customer</th>"
			."<th>Sale Date</th><th>Ship Date</th>"
			."<th>Install Date</th><th>Agent</th>"
			."<th>Comment</th></tr>";
			
        	foreach($result[$str] as $rec)
        	{
        		$msg .= "<tr ".$cell_color."><td style='text-transform: capitalize'>".$rec->client_first_name." ".$rec->client_last_name."</td>"
        			. "<td>".$rec->work_order_date_created."</td><td>".$rec->work_order_date_shipped."</td>"
        			. "<td>".$rec->work_order_date_installed."</td>"
        			. "<td style='text-transform: capitalize'>".$rec->user_firstname." ".$rec->user_lastname."</td>"
        			. "<td>".$rec->work_order_last_comment."</td>";
        			
				$cell_color == "style='background-color: #99CCFF'"? $cell_color = "style='background-color: #CCFFFF'" : $cell_color = "style='background-color: #99CCFF'";
        	}
        	
        	$msg .= "</table><p>Showing 1 to ".count($result[$str])." of ".count($result[$str])." entries</p>";
        }
       	else
       	{
       		$msg = 'None for Today '. date('Y-m-d g:i A');
       	}
       	
       	$this->send_email($subject, $msg);
	}
	
	public function send_email($subject, $msg)
	{
		//$recipients = array('clark@greenwireglobal.com', 'bpenrod@greenwireglobal.com', 'bertrand@greenwireglobal.com');
		$recipients = array('clark@greenwireglobal.com');
		
		$this->email->to($recipients); 
		$this->email->subject($subject);
		$this->email->message($msg);
		$this->email->send();
		
		//echo $this->email->print_debugger();
	}
}
?>