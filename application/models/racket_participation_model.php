<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Racket_participation_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function submit_participation()
	{
		$racket_id = $this->input->post('racket_id');
		$racketeer_id = $this->tank_auth->get_user_id();

		$sql = "INSERT INTO racket_participations (racketeer_id, racket_id)"
			." VALUES($racketeer_id, $racket_id)";

		$this->db->query($sql);
		$participation_id = $this->db->insert_id();

		$this->save_proofs($participation_id);

		//Inserting an entry to the Status History of a participation
		$sql = "INSERT INTO racket_participation_status_history"
				."(participation_id, participation_status_id)"
				." VALUES($participation_id, 1)";

		$this->db->query($sql);
	}

	function save_proofs($participation_id)
	{
		//proof_texts array provided by function submit_proof_to_participate@racket_participate.js
		$proof_texts = array();
		$proof_texts = $this->input->post('proof_texts');
		
		foreach($proof_texts as $key=>$val)
		{
			$proof_specifics = array();
			$proof_specifics = explode("BREAKFORPROOFID", $val);

			$proof_id = $proof_specifics[1];
			$proof_text = $proof_specifics[0];

			$sql = "INSERT INTO racket_participation_proofs (participation_id, proof_id, proof_text)"
				." VALUES($participation_id, $proof_id, '$proof_text')";
				
			$this->db->query($sql);
		}
	}

	function update_participation_status($status_id, $participation_id)
	{
		$query = $this->db->query("SELECT * FROM `racket_participation_status_history` WHERE participation_id = $participation_id");

		if($query->result())
		{
			$sql = "INSERT INTO racket_participation_status_history"
				."(participation_id, participation_status_id)"
				." VALUES($participation_id, $status_id)";
		}
		else
		{
			$sql = "UPDATE racket_participation_status_history"
				." SET participation_status_id = $status_id"
				." WHERE participation_id = $participation_id";
		}

		$this->db->query($sql);
	}

	function user_participations($user_id = NULL)
	{
		/*
		**This query will
		**1. Get everything from racket_participations table.
		**2. Will get the racket_name from rackets table of the racket participated at.
		**3. will get the racket_participation_status from racket_participation_statuses table.
		**4. Will get the date_occured from racket_participation_status_history table
		**5. Will get the date of submission from racket_participation_status_history table
		*/
		
		$sql = "SELECT p.*, r.racket_name, n.racket_participation_status_name status_name, s.date_occured,"
			." s3.date_occured date_submitted FROM racket_participations p"
			." JOIN(racket_participation_status_history s) ON(p.participation_id = s.participation_id"
			." AND s.date_occured = (SELECT MAX(s.date_occured) FROM racket_participation_status_history s"
			." WHERE s.participation_id = p.participation_id)) JOIN(racket_participation_status_history s3)"
			." ON(p.participation_id = s3.participation_id AND s3.participation_status_id = 1)"
			." JOIN(rackets r) ON(p.racket_id = r.racket_id) JOIN(racket_participation_statuses n)"
			." ON(s.participation_status_id = n.racket_participation_status_id)";

		if($user_id != NULL)
		{
			$sql .= " WHERE p.racketeer_id = $user_id";
		}

		$query = $this->db->query($sql);
		$result = $query->result();

		$arr = array();
		foreach($result as $p)
		{
			$arr[$p->participation_id]['racket_id'] = $p->racket_id;
			$arr[$p->participation_id]['racket_name'] = $p->racket_name;
			$arr[$p->participation_id]['participation_status'] = $p->status_name;
			$arr[$p->participation_id]['status_updated_date'] = $p->date_occured;

			$date_time = array();
			$date_time = explode(" ", $p->date_submitted);
			$date = date("M j, Y", strtotime($date_time[0]));
			$time = $date_time[1];

			$arr[$p->participation_id]['participation_submitted_date'] = $date;
		}

		return $arr;
	}
}