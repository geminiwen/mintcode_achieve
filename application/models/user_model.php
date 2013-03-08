<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model {

	function __construct()
	{
		parent :: __construct();
	}

	function query_by_username($username) {

		$this->load->database();
		$this->db->select('mt_userinfo.*, mt_timetable.start_time, mt_timetable.end_time');
		$this->db->from('mt_userinfo,mt_timetable');
		$this->db->where("mt_timetable.user_id = mt_userinfo.user_id");
		$this->db->where('mt_userinfo.username',$username);
		$query = $this->db->get();
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


	function insert($user)  {
		
		$username = $user['username'];

		$this->load->database();

		$this->db->trans_begin();
		
		$this->db->set('username', $username);
		$this->db->insert('mt_userinfo');
		$affcted_row_num = $this->db->affected_rows();     
		
		$id = $this->db->insert_id();


		$start_time = $user['start_time'];
		$end_time   = $user['end_time'];
		
		if( isset($start_time) && isset($end_time) ) {
			$this->db->set("user_id",$id);
			$this->db->set("start_time",$start_time);
			$this->db->set("end_time", $end_time);
			$this->db->insert("mt_timetable");
			$affcted_row_num += $this->db->affected_rows();
		}

		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		}
		else
		{
		    $this->db->trans_commit();
		}

		$this->db->close();
		return $affcted_row_num;
	}

	public function update($user) {
		$id = $user['id'];
		$username = $user['username'];
		$password = $user['password'];
		$user_authority = $user['user_authority'];

		$this->load->database();
		$this->db->where('user_id',$id);
		$this->db->update('mt_userinfo',array( 'username' => $username,
											   'password' => $password,
											   'user_authority' => $user_authority ));
		$affected_rows = $this->db->affected_rows();
		$this->db->close();
		return $affected_rows;
	}

}