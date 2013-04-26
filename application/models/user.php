<?php

require_once(APPPATH.'third_party/phpass-0.3/PasswordHash.php');

class User extends CI_Model
{
	public function __construct()
    {
        parent::__construct();     
        
    }	
    
  
    public function get_users()
    {
        $str = "SELECT * FROM user WHERE user_activated = 1 ORDER BY user_firstname;";

        $query = $this->db->query($str);
        
        return $query->result();	
    }

    public function get_users_by_user_role_id($user_role_id)
    {
        $query = $this->db->get_where('user', array('user_role_id' => $user_role_id, 'user_activated' => 1));

        return $query->result();
    }
    
    public function get_sales($user_id, $filter = NULL)
    {
        $date = date("Y-m-d");

        if ($filter == NULL)
        {
            $query = $this->db->get_where('work_order', array('user_id' => $user_id));
        }
        elseif ($filter == 'today')
        {
            $start_date = date("Y-m-d");// current date
            $start_date .= ' 00:00:00';

            $end_date = date("Y-m-d", strtotime(date("Y-m-d", strtotime($date)) . " +1 day"));
            $end_date .= ' 00:00:00';
        }
        elseif($filter == 'week')
        {
            $end_date = date("Y-m-d");// current date
            $end_date .= ' 00:00:00';

            $start_date = date("Y-m-d", strtotime(date("Y-m-d", strtotime($date)) . " -1 week"));
            $start_date .= ' 00:00:00';
        }
        elseif($filter == 'month')
        {
            $end_date = date("Y-m-t");
            $end_date .= ' 00:00:00';

            $start_date = date("Y-m-01");
            $start_date .= ' 00:00:00';
        }

        $this->db->from('work_order');
        $this->db->where('user_id', $user_id);

        if ($filter != NULL)
        {
            $this->db->where('work_order_last_modified >=', $start_date);
            $this->db->where('work_order_last_modified <=', $end_date);
        }
        

        $query = $this->db->get();

        $rowcount = $query->num_rows();
        
        return $rowcount;
    }

    public function get_installs($user_id, $filter = NULL)
    {
        $date = date("Y-m-d");

        if ($filter == 'today')
        {
            $start_date = strtotime(date("Y-m-d"));// current date

            $end_date = strtotime(date("Y-m-d", strtotime($date)) . " +1 day");
        }
        elseif($filter == 'week')
        {
            $end_date = strtotime(date("Y-m-d"));// current date

            $start_date = strtotime(date("Y-m-d", strtotime($date)) . " -1 week");
        }
        elseif($filter == 'month')
        {
            $end_date = date("Y-m-t");
            $end_date .= ' 00:00:00';

            $start_date = date("Y-m-01");
            $start_date .= ' 00:00:00';
        }

        $this->load->model('work_order');

        $completed_accounts = $this->work_order->get_work_orders_by_date_range(15, NULL, $filter);

        $result = array();
        foreach($completed_accounts as $record)
        {

            if($user_id == $record->user_id)
            {
                $result[] = $record;
            }
        }

        return count($result);
    }

    public function get_user_by_user_id($user_id)
    {
        $query = $this->db->get_where('user', array('user_id' => $user_id));

        foreach($query->result() as $record)
        {
            return $record;
        }
    }
    
    public function add_new_user($username, $password,$email,$role) 
    {
       $hasher = new PasswordHash(8, true);
       
       $hashed_password = $hasher->HashPassword($password); 
		       
       $data = array('user_date_created' => date("Y-m-d H:i:s"), 'user_login' => $username, 'user_password' => $hashed_password, 'user_email' => $email,'user_role_id' => $role);
       $this->db->insert('user', $data);
    }
    
    public function update_user_name($email, $role, $firstname, $middlename, $lastname, $user_id)
    {
    	  $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user_id', $user_id);
        
        $query = $this->db->get();
               
       if (count($query->result())) {
       $data = array('user_email' => $email, 'user_role_id'=> $role ,'user_firstname' => $firstname, 'user_middlename' => $middlename, 'user_lastname' => $lastname);
		 $this->db->where('user_id', $user_id);
       $this->db->update('user', $data);
       }
       
    }
    
     public function changed_user_password($newpassword, $user_id)
    {
    	  $this->db->select('*');
        $this->db->from('user');
         $this->db->where('user_id', $user_id);
        
        $query = $this->db->get();
        
       $hasher = new PasswordHash(8, true);
       $hashed_password = $hasher->HashPassword($newpassword); 

       if (count($query->result())) {
       $data = array('user_password' => $hashed_password);
       $this->db->where('user_id', $user_id);
       $this->db->update('user', $data);
       }
       
    }
    
    public function get_user_state()
    {
        $query = $this->db->get_where('state');
        return $query->result();        
    }
    
    public function get_user_address_by_user_id($user_id)
    {
        $query = $this->db->get_where('user_address', array('user_id' => $user_id));

        foreach ($query->result() as $row)
        {
            return $row;
        }
    }
    
    public function get_user_phone_by_user_id($user_id)
    {
        $query = $this->db->get_where('user_phone', array('user_id' => $user_id, 'user_phone_is_primary' => 1));

        foreach ($query->result() as $row)
        {
            return $row;
        }
    }
    
    public function get_user_mobile_by_user_id($user_id)
    {
        $query = $this->db->get_where('user_phone', array('user_id' => $user_id, 'user_phone_is_primary' => 0));

        foreach ($query->result() as $row)
        {
            return $row;
        }
    }
    
     public function get_user_social_link_by_user_id($user_id, $social_type_id)
    {
        $query = $this->db->get_where('social_link', array('user_id' => $user_id, 'social_type_id' => $social_type_id));

        foreach ($query->result() as $row)
        {
            return $row;
        }
    }
    
    public function update_user_address($user_address1, $user_address2, $user_city, $user_zip, $user_state, $user_id) 
    {
    	 $this->db->select('*');
        $this->db->from('user_address');
        $this->db->where('user_id', $user_id);
        
        $query = $this->db->get();
       
       if (count($query->result())) {
       $data = array('user_address_line1' => $user_address1, 'user_address_line2' => $user_address2, 'user_address_line3' => $user_city, 'user_address_zip' => $user_zip, 'state_id' => $user_state);
       $this->db->update('user_address', $data);
       }else{
       	$data = array('user_address_date_created' => date("Y-m-d H:i:s"),'user_address_line1' => $user_address1, 'user_address_line2' => $user_address2, 'user_address_line3' => $user_city, 'user_address_zip' => $user_zip, 'state_id' => $user_state, 'country_id' => 1, 'user_address_is_primary' => 1,'user_id' => $user_id);            
         $this->db->insert('user_address', $data); 
       }
       
    }
    
    public function update_user_phone($user_number, $is_primary, $user_id) 
    {
    	 $this->db->select('*');
       $this->db->from('user_phone');
       $this->db->where('user_phone_is_primary', $is_primary);
       $this->db->where('user_id', $user_id);
        
       $query = $this->db->get();
       
       if (count($query->result())) {
       $data = array('user_phone' => $user_number, 'user_phone_is_primary' => $is_primary, 'user_id' => $user_id);
       $this->db->update('user_phone', $data);
       }else{
       	$data = array('user_phone_date_created' => date("Y-m-d H:i:s"),'user_phone' => $user_number, 'user_phone_is_primary' => $is_primary, 'user_id' => $user_id);            
         $this->db->insert('user_phone', $data); 
       }
       
    }
    
    public function update_user_social_link($link_name, $type_id, $user_id) 
    {
    	 $this->db->select('*');
       $this->db->from('social_link');
       $this->db->where('social_type_id', $type_id);
       $this->db->where('user_id', $user_id);
        
       $query = $this->db->get();
       
       if (count($query->result())) {
       $data = array('social_link_name' => $link_name, 'social_type_id' => $type_id, 'user_id' => $user_id);
       $this->db->update('social_link', $data);
       }else{
       	$data = array('social_link_last_modified' => date("Y-m-d H:i:s"), 'social_link_name' => $link_name, 'social_type_id' => $type_id, 'user_id' => $user_id);            
         $this->db->insert('social_link', $data); 
       }
       
    }
    
 }