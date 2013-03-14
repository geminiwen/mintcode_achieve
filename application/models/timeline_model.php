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
		$this->db->select("`mt_userinfo`.`user_id`,`mt_userinfo`.`username`,`mt_useraccount`.`account_id`,".
						  "`mt_useraccount`.`start_time`,`mt_useraccount`.`start_checked`,`mt_useraccount`.`end_time`,`mt_useraccount`.`end_checked`,".
						  "date_format( `mt_useraccount`.`check_date`, '%Y-%m-%d %W' ) as `check_date`",FALSE);
		$this->db->from('mt_useraccount,mt_userinfo');
		$this->db->where('mt_useraccount.check_date >=',$start_date);
		$this->db->where('mt_useraccount.check_date <=',$end_date);
		$this->db->where('mt_useraccount.user_id',$user_id);
		$this->db->where('mt_useraccount.user_id = mt_userinfo.user_id');
		$this->db->order_by('check_date desc');
		$query = $this->db->get();
		$result = $query->result();
		$query->free_result();
		$this->db->close();
		return $result;
	}

	public function query_timeline_by_date($startDate,$endDate) {
		$this->load->database();
		$this->db->select("`mt_userinfo`.`user_id`,`mt_userinfo`.`username`," .
						  "`mt_timetable`.`start_time` as `user_starttime`,`mt_timetable`.`end_time` as `user_endtime`," .
					      "`mt_useraccount`.`account_id`,`mt_useraccount`.`start_time`,`mt_useraccount`.`start_checked`,`mt_useraccount`.`end_time`,`mt_useraccount`.`end_checked`,".
					      "date_format( `mt_useraccount`.`check_date`, '%Y-%m-%d %W' ) as `check_date`",FALSE);
		$this->db->from('mt_useraccount,mt_userinfo,mt_timetable');
		$this->db->where('mt_useraccount.check_date >=',$startDate);
		$this->db->where('mt_useraccount.check_date <=',$endDate);
		$this->db->where('mt_useraccount.user_id = mt_userinfo.user_id');
		$this->db->where('mt_timetable.user_id = mt_userinfo.user_id');
		$this->db->order_by('check_date desc');
		$query = $this->db->get();
		$result = $query->result();
		$query->free_result();
		$this->db->close();
		return $result;
	}

	// 根据日期区间 查询所有人的统计数据
	public function query_statistics_bettween_date($startDate,$endDate) {
		$this->load->database();
		$this->db->select("`mt_userinfo`.`user_id`,`mt_userinfo`.`username`".
						  "sum(case when ( `mt_useraccount`.`end_checked` = 1 and `mt_useraccount`.`end_time` < `mt_timetable`.`end_time` ) or `mt_useraccount`.`end_checked` = '0' then 1 else 0 end) as `early_quit`,".
						  "sum(case when ( `mt_useraccount`.`start_checked` = 1 and `mt_useraccount`.`start_time` > `mt_timetable`.`start_time`) or `mt_useraccount`.`start_checked`  = '0' then 1 else 0 end) as `later_come`,".
						  "sum(case when (( `mt_useraccount`.`start_checked` = 1 and `mt_useraccount`.`start_time` <= `mt_timetable`.`start_time`) and `mt_useraccount`.`is_weekend` = 0 ) then 1 else 0 end) as `come`,".
						  "sum(case when (( `mt_useraccount`.`end_checked` = 1 and `mt_useraccount`.`end_time` >= `mt_timetable`.`end_time`) and `mt_useraccount`.`is_weekend` = 0 ) then 1 else 0 end) as `away`".
						  "",FALSE);
		$this->db->from("`mt_useraccount`,`mt_timetable`,`mt_userinfo`");
		$this->db->where(" `mt_useraccount`.`user_id` = `mt_timetable`.`user_id` and `mt_userinfo`.`user_id` = `mt_useraccount`.`user_id`");
		$this->db->where("`mt_useraccount`.`start_date` >=",$startDate);
		$this->db->where("`mt_useraccount`.`end_date` <=",$endDate);
		$this->db->group_by("`mt_userinfo`.`user_id`, `mt_userinfo`.`username`");
		$query = $this->db->get();
		$result = $query->result();
		$query->free_result();
		$this->db->close();
		return $result;

	}
}
