<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->load->view('welcome_message');
	}

	function user_login_form()
	{
		$this->load->view('user/login_form');
	}

	function user_register_form()
	{
		$this->load->view('user/register_form');
	}

	function user_profile()
	{
		$this->load->view('home');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */