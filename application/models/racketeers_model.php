<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Racketeers_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_racketeers()
	{
		$date_today = date('Y-m-d');
		$gender = "";
		$str = "SELECT user.*, country.iso2 FROM user LEFT JOIN(country) ON(user.user_country_id = country.country_id)";

		$query = $this->db->query($str);
		$result = $query->result();

		$arr = array();

		foreach($result as $user)
		{
			$arr['firstname'][$user->user_id] = ucfirst(strtolower($user->user_firstname));
			$arr['lastname'][$user->user_id] = ucfirst(strtolower($user->user_lastname));
			$arr['country_iso'][$user->user_id] = $user->iso2;
			$arr['bday'][$user->user_id] = $date_today - $user->user_bday;

			if($user->user_gender == 'M')
			{
				$gender = "Male";
			}
			else
			{
				$gender = "Female";
			}

			$arr['gender'][$user->user_id] = $gender;
		}
		
		return $arr;
	}
}