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

		if( isset($password) ) {
			$password = md5(md5($password));
		}
		
		
		$query_result = $this->User_model->query_by_username($username);
		
		$result_count = count( $query_result ) ;

		$login_user = null;
		do {
			if( $result_count === 0 ) {
				echo "用户名错误!";
				break;
			}
			
			$login_user = $query_result[0];

			$user_pwd = $login_user->password;
			$user_authority = (int)$login_user->user_authority;

			if( $user_authority == 0 ) {
				$_SESSION['user'] = $login_user;
				$url = base_url("/user/change_password");
				redirect($url);
				break;
			}

			if( 0 != strcmp($user_pwd,$password) ) {
				echo "密码错误";
				breawk;
			}
			
			$_SESSION['user'] = $login_user;
			$can_entry_manager = (($user_authority >> 1 ) & (0x01)) > 0;
			if( $can_entry_manager ) {
				$url = base_url("/manager");
				redirect($url);
				break;
			} else {
				echo "普通用户界面";
				break;
			}

			

			
		} while( false );
		
	}
	
	public function change_password() {

		$this->load->library('parser');
		$action = $this->input->get("action");

		$this->load->model("User_model");

		do {
			
			$login_user = $_SESSION['user'];

			if( ! isset($login_user) ) {
				echo "Please login first.";
				break;
			}
			
			$data['username'] = $login_user->username;
			if( !$action ) 	{
				$this->parser->parse("user_info",$data);
				break;
			}

			$is_change = strcmp($action,"change");

			if( 0 == $is_change ) {
				$username = $this->input->post('username');

				$password = $this->input->post('password');

				$password = md5(md5($password));

				if( !$username ) {
					echo 'Invalid parameter';
					break;
				}

				$id = $login_user->user_id;
				$user_authority = (int)$login_user->user_authority;
				$user_authority = $user_authority === 0 ? 1 : $user_authority;
				
				$user = array( 'id' => $id,
							   'username' => $username,
							   'password' => $password,
							   'user_authority' => $user_authority );

				$affected_row_num = $this->User_model->update($user);

				if( $affected_row_num > 0 ){
					echo "密码修改成功";
					break;
				} else {
					echo "内容没有改变";
					break;
				}
			}
			
		}while(false);

	}
	
	public function index() {
		echo "hello !";
	}

	private function strEquals($str1,$str2) {
		return (0 === strcmp($str1,$str2));
	}
}