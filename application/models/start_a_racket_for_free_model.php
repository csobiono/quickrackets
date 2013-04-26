<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Start_a_racket_for_free_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function add_racket($arr)
	{
		$sql = "INSERT INTO rackets (user_id, racket_name, racket_price, racket_available_positions,"
				." racket_duration, racket_category_id, racket_public)"
				." VALUES(".$arr['user_id'].", '".$arr['racket_name']."', ".$arr['racket_price'].","
				." ".$arr['available_pos'].", ".$arr['duration'].", ".$arr['category_id'].", ".$arr['is_public'].");";
	
		$this->db->query($sql);
		$racket_id = $this->db->insert_id();

		foreach($arr['tasks'] as $key=>$val)
		{
			$sql = "INSERT INTO racket_tasks (racket_id, task_description) VALUES($racket_id, '$val')";
			$this->db->query($sql);
		}
		
		foreach($arr['proofs'] as $key=>$val)
		{
			$sql = "INSERT INTO racket_proofs (racket_id, proof_description) VALUES($racket_id, '$val')";
			$this->db->query($sql);
		}
	}
}
