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
		$user = $_SESSION['user'];

		$action = $this->input->get('action');
		do {

			if( !isset($user) ) {
				echo "Please login first.";
				break;
			}

			$authority = $user->user_authority;

			$can_access = ( $authority >> 1 ) & 1;

			if( $can_access < 1 ) {
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
		
	}
}