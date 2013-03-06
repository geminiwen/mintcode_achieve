<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model {

	function __construct()
	{
		parent :: __construct();
	}

	function query_by_username_and_password($username,$password) {

		$this->load->database();
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		$query = $this->db->get('mt_userinfo');
		$result	= $query->result();
		$query->free_result();
		$this->db->close();

		return $result;
	}

	function query_all() {
		$this->load->database();
		
		$this->db->select('mt_userinfo.user_id, mt_userinfo.username, mt_timetable.start_time, mt_timetable.end_time');
		$this->db->from('mt_userinfo,mt_timetable');
		$this->db->where("mt_timetable.user_id = mt_userinfo.user_id");
		$query = $this->db->get();
		$result	= $query->result();
		$query->free_result();
		$this->db->close();

		return $result;
	}

}