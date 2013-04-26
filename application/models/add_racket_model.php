<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Add_racket_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_from_racket_categories($category_id = NULL)
	{
		$query = "SELECT * FROM racket_categories";
		if($category_id)
		{
			$query .= " WHERE id = $category_id";
		}

		$result = $this->db->query($query)->result();
		$category = array();

		foreach($result as $row)
		{
			$category[$row->id]['category_name'] = $row->category_name;
			$category[$row->id]['short_name'] = $row->short_name;
		}

		return $category;
	}

	function get_from_racket_country($country_id = NULL)
	{
		$query = "SELECT * FROM country";
		if($country_id)
		{
			$query .= " WHERE country_id = $country_id";
		}

		$query .= " ORDER BY continent_id ASC";
		$result = $this->db->query($query)->result();
		$country = array();

		foreach($result as $row)
		{
			$country[$row->country_id]['iso2'] = $row->iso2;
			$country[$row->country_id]['short_name'] = $row->short_name;
			$country[$row->country_id]['long_name'] = $row->long_name;
			$country[$row->country_id]['continent_id'] = $row->continent_id;
			$country[$row->country_id]['iso3'] = $row->iso3;
			$country[$row->country_id]['numcode'] = $row->numcode;
			$country[$row->country_id]['un_member'] = $row->un_member;
			$country[$row->country_id]['calling_code'] = $row->calling_code;
			$country[$row->country_id]['cctld'] = $row->cctld;
		}
		return $country;
	}

	function get_from_racket_continents($continent_id = NULL)
	{
		$query = "SELECT * FROM continents";
		if($continent_id)
		{
			$query .= " WHERE id = $continent_id";
		}

		$result = $this->db->query($query)->result();
		$continent = array();

		foreach($result as $row)
		{
			$continent[$row->id]['continent_abbrev'] = $row->continent_abbrev;
			$continent[$row->id]['continent_name'] = $row->continent_name;
		}
		return $continent;
	}
}