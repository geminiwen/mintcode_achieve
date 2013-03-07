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

			if( count ( $result ) <= 0 ) {
				continue;
			}
			
			$user_id = $result[0]->user_id;

			$check_date = $_timeline['date'];

			$this->db->where('user_id',$user_id);
			$this->db->where('check_date',$check_date);

			$query = $this->db->get('mt_useraccount');

			$result = $query->result();

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
}