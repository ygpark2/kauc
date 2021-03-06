<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->ci =& get_instance();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('tank_auth');
		$this->ci->load->model('profiles');
	}

	function login_menu()
	{
		if ($this->tank_auth->is_logged_in()) {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			if ( $this->ci->profiles->isRegistered( $data['user_id'] ) ) {
				$data['profile_label']	= '사용자 정보 수정';
				$data['profile_link']	= '/profile/update/';
				$data['profile_registered']	= true;
				$result = $this->ci->profiles->retrieve( $data['user_id'] );
				$data['result']	= $result[0];
				// var_dump($data);
			} else {
				$data['profile_label']	= '사용자 정보 등록';
				$data['profile_link']	= '/profile/register/';
				$data['profile_registered']	= false;
			}
			$this->load->view('profile/menu', $data);
		} else {
		
		}
	}

	function _save()
	{
		
		
	}

	function register()
	{
		if ($this->tank_auth->is_logged_in()) {
			if ($this->form_validation->run()) {
				$data['user_id'] = $this->form_validation->set_value('user_id');
				$data['name'] = $this->form_validation->set_value('name');
				$data['mobile'] = $this->form_validation->set_value('mobile');
				$data['phone'] = $this->form_validation->set_value('phone');
				$data['birth'] = date($this->form_validation->set_value('birth').' 00:00:00');
				$data['twitter_id'] = $this->form_validation->set_value('twitter_id');
				$data['facebook_id'] = $this->form_validation->set_value('facebook_id');
				$data['occupation'] = $this->form_validation->set_value('occupation');
				$data['website'] = $this->form_validation->set_value('website');
				$data['introduction'] = $this->form_validation->set_value('introduction');
				$data['created'] = date('Y-m-d H:i:s');
				$this->ci->profiles->create($data);
				echo "{message : 'successfully saved!'}";
			} else {
				$data['user_id']	= $this->tank_auth->get_user_id();
				$data['username']	= $this->tank_auth->get_username();
				$this->load->view('profile/register', $data);
			}
		} else {
		
		}
	}

	function update()
	{
		if ($this->tank_auth->is_logged_in()) {
			if ($this->form_validation->run()) {
				$id = $this->form_validation->set_value('id');
				$data['user_id'] = $this->form_validation->set_value('user_id');
				$data['name'] = $this->form_validation->set_value('name');
				$data['mobile'] = $this->form_validation->set_value('mobile');
				$data['phone'] = $this->form_validation->set_value('phone');
				$data['birth'] = date($this->form_validation->set_value('birth').' 00:00:00');
				$data['twitter_id'] = $this->form_validation->set_value('twitter_id');
				$data['facebook_id'] = $this->form_validation->set_value('facebook_id');
				$data['occupation'] = $this->form_validation->set_value('occupation');
				$data['website'] = $this->form_validation->set_value('website');
				$data['introduction'] = $this->form_validation->set_value('introduction');
				$this->ci->profiles->update($data, $id);
				echo "{message : 'successfully saved!'}";
			} else {
				$data = $this->ci->profiles->retrieve( $this->tank_auth->get_user_id() );
				$this->load->view('profile/update', $data[0]);
			}
		} else {
		
		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */