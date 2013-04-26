<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rackets_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_rackets($user_id = NULL)
	{
		$sql = "SELECT rackets.*, cat.short_name FROM rackets"
			." LEFT JOIN(racket_categories as cat) ON(cat.id = rackets.racket_category_id)";

		if($user_id != NULL)//this will get all the rackets for a specific user
		{
			$sql .= " WHERE rackets.user_id = $user_id";
		}
		else//this will get all the rackets except the ones created of this user id
		{
			$user_id = $this->tank_auth->get_user_id();
			$sql .= " WHERE rackets.user_id != $user_id";
		}

		$sql .= " GROUP BY racket_id";

		$query = $this->db->query($sql);
		$result = $query->result();

		$arr = array();
		foreach($result as $racket)
		{
			$arr[$racket->racket_id]['racket_name'] = $racket->racket_name;
			$arr[$racket->racket_id]['racket_price'] = $racket->racket_price;
			$arr[$racket->racket_id]['racket_available_positions'] = $racket->racket_available_positions;
			$arr[$racket->racket_id]['racket_duration'] = $racket->racket_duration;
			$arr[$racket->racket_id]['racket_category'] = $racket->short_name;
			$arr[$racket->racket_id]['racket_is_public'] = $racket->racket_public;
			$arr[$racket->racket_id]['racket_date_created'] = $racket->racket_date_created;
		}

		return $arr;
	}

	function get_racket_info($racket_id)
	{
		$sql = "SELECT rackets.*, user.user_login, user.user_firstname, user.user_lastname,"
			." proofs.proof_id, proofs.proof_description,"
			." tasks.task_id, tasks.task_description, cat.short_name FROM rackets"
			." LEFT JOIN(user, racket_proofs proofs, racket_tasks tasks, racket_categories cat)"
			." ON(user.user_id = rackets.user_id AND proofs.racket_id = rackets.racket_id"
			." AND tasks.racket_id = rackets.racket_id AND cat.id = rackets.racket_category_id)"
			." WHERE rackets.racket_id = $racket_id";

		$query = $this->db->query($sql);
		$result = $query->result();

		$arr = array();
		$arr['tasks'] = array();
		$arr['proofs'] = array();

		foreach($result as $info)
		{
			$arr['racket_name'][$info->racket_id] = $info->racket_name;
			$arr['racket_price'][$info->racket_id] = $info->racket_price;
			$arr['posted_by_login'][$info->racket_id] = $info->user_login;
			$arr['posted_by_name'][$info->racket_id] = ucfirst(strtolower($info->user_firstname))." ".ucfirst(strtolower($info->user_lastname));
			$arr['racket_available_positions'][$info->racket_id] = $info->racket_available_positions;
			$arr['racket_duration'][$info->racket_id] = $info->racket_duration;
			$arr['racket_category'][$info->racket_id] = $info->short_name;
			$arr['is_public'][$info->racket_id] = $info->is_public;
			$arr['racket_date_created'][$info->racket_id] = date("M d, Y", strtotime($info->racket_date_created));
			$arr['tasks'][$info->racket_id][$info->task_id]=$info->task_description;
			$arr['proofs'][$info->racket_id][$info->proof_id] = $info->proof_description;
		}

		return $arr;
	}
}