<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->ci =& get_instance();
		$this->load->helper(array('form', 'url'));
		$this->load->library('parser');
		$this->load->library('form_validation');
		$this->load->library('security');
		$this->load->library('tank_auth');
		$this->ci->load->model('categories');
	}

	function manage()
	{
		$data = array();
		$data['rootCategories'] = $this->ci->categories->getRoot();
		$this->parser->parse('category/manage', $data);
	}

	function login_menu()
	{
		if ($this->tank_auth->is_logged_in()) {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$this->load->view('category/menu', $data);
		} else {
		
		}
	}

	function load_root_data()
	{
		if ($this->ci->categories->load_root_data()) {
			echo 'successfully loaded';
		} else {
			echo 'already loaded!';
		}
		
		/*
		if ($this->tank_auth->is_logged_in()) {
			$this->ci->categories->load_root_data();
		} else {
		
		}
		*/
	}

	function create()
	{
		if ($this->form_validation->run()) {
			$name = $this->form_validation->set_value('name');
			$parent_id = $this->form_validation->set_value('parent_id');
			$description = $this->form_validation->set_value('description');
			$weight = 0;
			$display = 1;
			$this->ci->categories->create($name, $description, $weight, $display, $parent_id);
			echo "{message : 'successfully saved!'}";
		} else {
			echo "{message : 'form validation error!'}";
		}
	}

	function get_childs()
	{
		$parent_id = $this->input->get('parent_id', TRUE);
		if ($results = $this->ci->categories->getChilds($parent_id)) {
			echo json_encode($results);
		} else {
			echo '[]';
		}
	}

	function get_path()
	{
		$id = $this->input->get('id', TRUE);
		if ($results = $this->ci->categories->getParents($id)) {
			var_dump($results);
			echo json_encode($results);
		} else {
			echo '[]';
		}
	}

	function update()
	{
		if ($this->tank_auth->is_logged_in()) {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$this->load->view('category/menu', $data);
		} else {
		
		}
	}

	function delete()
	{
		if ($this->tank_auth->is_logged_in()) {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$this->load->view('category/menu', $data);
		} else {
		
		}
	}
}

/* End of file category */
/* Location: ./application/controllers/category.php */