<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manager extends CI_Controller {
	
	function __construct()
	{
		parent :: __construct();
		session_start();
	}

	public function index() 
	{
		
		$this->load->model("User_model");
		$this->load->library('parser');
		do {
			
			if( !isset($_SESSION['user']) ) {
				echo "Please login first.";
				break;
			}
			$user = $_SESSION['user'];
			$authority = $user->user_authority;

			$can_access = ( $authority >> 1 ) & 1;

			if( $can_access < 1 ) {
				echo "U have no authority to enter in";
				break;
			}

			$users = $this->User_model->query_all();

			$data = array();

			$data['users'] = $users;

			$this->parser->parse("manager",$data);
			
		}while (false);
	}

	public function user() {

		$action = $this->input->get('action');
		
		do {

			if( !isset($_SESSION['user']) ) {
				echo "Please <a href='/'>login</a> first.";
				break;
			}
			$user = $_SESSION['user'];

			$authority = $user->user_authority;

			$can_access = $this->can_access_manager($authority);

			if( !$can_access) {
				echo "U have no authority to enter in";
				break;
			}
			
			if( $action === false ) {
				$this->load->view("add_user");
				break;
			}

			if( 0 == strcmp($action,"add_user") ) {
				
				$username = $this->input->post("username");
				$starttime = $this->input->post("starttime");
				$endtime = $this->input->post("endtime");
			
				$this->inner_add_user($username,$starttime,$endtime);

			}
		} while( false );
	}

	public function query_index() {
		do {
			if( ! isset($_SESSION['user'])){
				echo 'Please login first';
				break;
			}

			$user = $_SESSION['user'];

			$authority = $user->user_authority;

			$can_access = $this->can_access_manager( $authority );
			if( ! $can_access ) {
				echo 'U have no access to this page';
				break;
			}

			$this->load->view("manager_query");

		} while( false );
	}

	// ajax function
	public function query() {
		$result_data = array();
		do {
			if( ! isset($_SESSION['user']) ){
				$result_data['result'] = false;
				$result_data['message']=  'Please login first';
				break;
			}

			$user = $_SESSION['user'];

			$authority = $user->user_authority;

			$can_access = $this->can_access_manager($authority);

			if( !$can_access) {
				$result_data['result'] = false;
				$result_data['message']=  "U have no authority to enter in";
				break;
			}

			$date = $this->input->post('date');

			$this->load->model('Timeline_model');

			$data = $this->Timeline_model->query_timeline_by_date($date);

			$result_data['data'] = $data;
			$result_data['result'] = TRUE;

		} while ( false );

		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($result_data);
	}


	private function inner_add_user ($username,$starttime,$endtime) {
		$this->load->model("User_model");
		
		$user = array( 'username' => $username ,
					   'start_time' => $starttime,
					   'end_time' => $endtime );
		$is_success = $this->User_model->insert($user);
		
		if( $is_success > 0 ) {
			echo "添加用户成功";
		} else {
			echo "添加用户失败";
		}
		echo "&nbsp;&nbsp;<a href='/manager'>返回</a>";
	}


	private function can_access_manager( $user_authority ) {
		return ( ( ( $user_authority >> 1 ) & 1 ) >= 1 );
	}
}
