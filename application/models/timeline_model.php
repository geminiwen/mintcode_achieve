<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Timeline_model extends CI_Model {

	function __construct()
	{
		parent :: __construct();
	}

	public function insert_timeline($timeline) {

		$this->load->database();
		$affected_num = 0;
	
		$count = count($timeline);

		for( $i = 0; $i < $count; $i++ )
		{
			$_timeline = $timeline[$i];
			$username = $_timeline['username'];
			$this->db->where('username',$username);
			$query = $this->db->get('mt_userinfo');
			$result = $query->result();
			$query->free_result();
			if( count ( $result ) <= 0 ) {
				continue;
			}
			
			$user_id = $result[0]->user_id;

			$check_date = $_timeline['date'];

			$this->db->where('user_id',$user_id);
			$this->db->where('check_date',$check_date);

			$query = $this->db->get('mt_useraccount');

			$result = $query->result();
			$query->free_result();
			$kind = $_timeline['kind'];
			$time = $_timeline['time'];

			$timeline_data = array();
			$timeline_data['user_id'] = $user_id;
			
			
			if( $kind === 1 ) {
				$timeline_data['end_time'] = $time;
				$timeline_data['end_checked'] = TRUE;
			} else {
				$timeline_data['start_time'] = $time;
				$timeline_data['start_checked'] = TRUE;
			}
			
			if( count( $result ) <= 0 ) {
				$timeline_data['check_date'] = $check_date;
				$this->db->insert('mt_useraccount', $timeline_data);

			} else {
				$exists_model = $result[0];

				if( $kind === 1 ) {
					$_starttime = $exists_model->start_time;

				}

				$this->db->where('user_id',$user_id);
				$this->db->where('check_date',$check_date);
				$this->db->update('mt_useraccount', $timeline_data);
			}

			$affected_num += $this->db->affected_rows();
		}
		
		$this->db->close();
		return $affected_num;
	}

	public function query_bettween_date_by_user($user_id,$timeline_info) {
		$this->load->database();
		$start_date = $timeline_info['start_date'];
		$end_date	= $timeline_info['end_date'];
		$this->db->select('mt_userinfo.user_id,mt_userinfo.username,mt_useraccount.account_id,mt_useraccount.start_time,mt_useraccount.start_checked,mt_useraccount.end_time,mt_useraccount.end_checked,mt_useraccount.check_date
			');
		$this->db->from('mt_useraccount,mt_userinfo');
		$this->db->where('mt_useraccount.check_date >=',$start_date);
		$this->db->where('mt_useraccount.check_date <=',$end_date);
		$this->db->where('mt_useraccount.user_id',$user_id);
		$this->db->where('mt_useraccount.user_id = mt_userinfo.user_id');
		$query = $this->db->get();
		$result = $query->result();
		$query->free_result();

		return $result;
	}

	public function query_timeline_by_date($check_date) {
		$this->load->database();
		$this->db->select('mt_userinfo.user_id,mt_userinfo.username,'+
						  'mt_timetable.start_time as user_starttime,mt_timetable.end_time as user_endtime'+
					      'mt_useraccount.account_id,mt_useraccount.start_time,mt_useraccount.start_checked,mt_useraccount.end_time,mt_useraccount.end_checked,mt_useraccount.check_date');
		$this->db->from('mt_useraccount,mt_userinfo,mt_timetable');
		$this->db->where('mt_useraccount.check_date',$check_date);
		$this->db->where('mt_useraccount.user_id = mt_userinfo.user_id');
		$this->db->where('mt_timetable.user_id = mt_userinfo.user_id');
		$query = $this->db->get();
		$result = $query->result();
		$query->free_result();

		return $result;
	}
}