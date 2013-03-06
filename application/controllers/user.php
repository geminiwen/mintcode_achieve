<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		session_start();
	}

	public function login() 
	{
		$this->load->helper('url');
		$this->load->model("User_model");


		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$password = md5(md5($password));

		$query_result = $this->User_model->query_by_username_and_password($username,$password);
		
		$result_count = count( $query_result ) ;

		$login_user = null;
		do {
			if( $result_count === 0 ) {
				echo "username or password error!";
				break;
			}
			
			$login_user = $query_result[0];
			$_SESSION['user'] = $login_user;

			$user_authority = (int)$login_user->user_authority;
			$can_entry_manager = ($user_authority >> 1 ) & (0x01);
			var_dump($can_entry_manager);
			if( $can_entry_manager > 0 ) {
				$url = base_url("/manager");
				redirect($url);
			}
			
		} while( false );
	}

	public function index() {
		echo "hello !";
	}
}