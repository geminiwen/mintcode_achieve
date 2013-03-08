<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Query extends CI_Controller {
	
	function __construct()
	{
		parent :: __construct();
		session_start();
	}

	public function index() {
		do {
			if( ! isset($_SESSION['user']) ) {
				echo "Please login first.";
				break;
			}
			$this->load->view("query");
		} while( false );
	}

	public function single() {

		$result_data = array();
		do {
			if( ! isset($_SESSION['user']) ) {
				$result_data['result'] = false;
				break;
			}
			$user = $_SESSION['user'];

			$action = $this->input->get('action');
			
			$user_id = 0;

			if( ! $action ) {
				// quer login-userself
				$user_id = $user->user_id;

			} else if ( $this->stringEquals($action,"indicate") ) {
				// indicate the user to query

				$this->load->model("User_model");
				$username = $this->input->get("user_name");
				
				$result = $this->User_model->query_by_username($username);
				
				if( count($result) > 0 ) {
					$user = $result[0];
					$user_id = $user->user_id;
				} else {
					$result_data['result'] = false;
					break;
				}
				
			}

			$start_date = $this->input->post('start_date');
			$end_date   = $this->input->post('end_date');

			$this->load->model("Timeline_model");

			$timeline_info = array( "start_date" => $start_date,
									"end_date" => $end_date);
			
		
			$user_data = array();
			$user_data['user_name'] = $user->username;
			$user_data['start_time'] = $user->start_time;
			$user_data['end_time'] = $user->end_time;
			
			
			$result = $this->Timeline_model->query_bettween_date_by_user($user_id,$timeline_info);
			$result_data['result'] = TRUE;
			$result_data['data'] = $result;
			$result_data['userinfo'] = $user_data;


			
			
		} while( false );

		//header("Content-Type: application/json; charset=utf-8");
		echo json_encode($result_data);
	}

	private function stringEquals($str1,$str2) {
		return 0 === strcmp($str1,$str2);
	}

}