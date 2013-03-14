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

			if( $this->string_equals($action,"add_user") ) {
				
				$username = $this->input->post("username");
				$starttime = $this->input->post("starttime");
				$endtime = $this->input->post("endtime");
			
				$this->inner_add_user($username,$starttime,$endtime);

			}
		} while( false );
	}

	// ajax function
	public function query( $action = 'normal' ) {
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

			if( !$can_access ) {
				$result_data['result'] = false;
				$result_data['message']=  "U have no authority to enter in";
				break;
			}

			if( $this->string_equals($action, "normal") ) {
				$startDate	= $this->input->post('startDate');
				$endDate	= $this->input->post('endDate');

				$this->load->model('Timeline_model');

				$data = $this->Timeline_model->query_timeline_by_date($startDate,$endDate);

				$result_data['data'] = $data;
				$result_data['result'] = TRUE;
			} elseif ( $this->string_equals($action,"statistics" ) ) {
				$startDate	= $this->input->post('startDate');
				$endDate	= $this->input->post('endDate');

				$this->load->model('Timeline_model');

				$data = $this->Timeline_model->query_timeline_by_date($startDate,$endDate);

				$result_data['data'] = $data;
				$result_data['result'] = TRUE;
			}

		} while ( false );

		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($result_data);
	}


	public function query_index( $action = 'normal' ) {
		do {
			if( ! isset($_SESSION['user'])){
				echo 'Please login first';
				break;
			}

			$user = $_SESSION['user'];

			$authority = $user->user_authority;

			$can_access = $this->can_access_manager( $authority );
			if( ! $can_access ) {
				echo 'You have no access to this page';
				break;
			}

			if( $this->string_equals( $action,'normal' ) ) {
				$this->load->view("manager_query");
			} elseif( $this->string_equals( $action,"statistics" ) ) {
				$this->load->view("manager_statistics");
			}

			

		} while( false );
	}


	// ajax function
	private function inner_add_user ($username,$starttime,$endtime) {
		$this->load->model("User_model");
		$result_data = array();
		$user = array( 'username' => $username ,
					   'start_time' => $starttime,
					   'end_time' => $endtime );
		$is_success = $this->User_model->insert($user);
		
		if( $is_success > 0 ) {
			$result_data['result'] = true;
		} else {
			$result_data['result'] = false;
		}
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($result_data);
	}


	private function can_access_manager( $user_authority ) {
		return ( ( ( $user_authority >> 1 ) & 1 ) >= 1 );
	}

	private function string_equals( $str1, $str2 ) {
		return ( 0 === strcmp($str1,$str2) );
	}
}
