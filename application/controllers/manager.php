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
		
		$user = $_SESSION['user'];
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

			$users = $this->User_model->query_all();

			$data = array();

			$data['users'] = $users;

			$this->load->view("manager",$data);
			
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

			if( !strcmp($action,'adduser') ) {

				$username = $this->load->post("username");
				$password = $this->load->post("password");
			}
		} while( false );
	}
}