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

}