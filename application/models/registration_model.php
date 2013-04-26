<?php

require_once(APPPATH.'third_party/phpass-0.3/PasswordHash.php');

class Registration_model extends CI_Model
{
	public function __construct()
    {
        parent::__construct();     
    }	
    
    public function countries()
    {
        $str = "SELECT country_id, short_name FROM country";
        $query = $this->db->query($str);
        $result = $query->result();

        $country_array = array();
        $country_array[0] = "Choose Country:";
        foreach($result as $country)
        {
            $country_array[$country->country_id] = $country->short_name;
        }

        return $country_array;
    }

    public function genders()
    {
        return array(0 => "Select Gender:", 'F' => "Female", 'M' => "Male");
    }

    public function months()
    {
        return array('Month:','Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
    }

    public function days($days_in_month)
    {
        $days_in_month = 31;

        $days = array();
        $days[0] = 'Days:';
        for($i=1; $i<=$days_in_month; $i++)
        {
            $days[$i] = $i;
        }

        return $days;
    }

    public function years()
    {
        $current_year = date('Y');

        $year_array = array();
        $year_array[0] = "Year:";
        for($i = $current_year; $i>=$current_year-107; $i--)
        {
            $year_array[$i] = $i;
        }

        return $year_array;
    }
}
?>