<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * error code table
 * 401 already logined!
 * 402 logged in, not activated!
 */

class Business extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->ci =& get_instance();

		$this->load->helper(array('form', 'url'));
		$this->load->library('security');
		$this->load->library('tank_auth');
		$this->ci->load->model('geo/businesses');
	}

    function create()
    {
    	if ($this->tank_auth->is_logged_in()) {
	    	$this->load->library('form_validation');
	
			if ($this->form_validation->run()) {
				$geo_loc = "GeomFromText('POINT(" .$this->form_validation->set_value('latitude'). " " .$this->form_validation->set_value('longitude'). ")')";
				$head = array('title' => $this->form_validation->set_value('title'),
								'user_id' => $this->tank_auth->get_user_id(),
								'category_id' => $this->form_validation->set_value('category_id'),
								'email' => $this->form_validation->set_value('email'),
								'phone' => $this->form_validation->set_value('phone'),
								'url' => $this->form_validation->set_value('url'),
								'geo_loc' => "%geo_loc%");
				$content = array('content' => $this->form_validation->set_value('content'));
				$log_id = $this->ci->businesses->create($geo_loc, $head, $content);
			} else {
				$this->_show_json_message(204, validation_errors());
			}
		} else {
			$this->_show_json_message(1, 'not logined!');
		}
    }

    function retrieve()
    {
    	$this->ci->load->model('categories');

        $id = $this->input->get('id', TRUE);

        $data = $this->ci->businesses->retrieve($id);
        $path_array = array();
        $this->ci->categories->getParents($data[0]->category_id, $path_array);
        $data[0]->category = implode(' => ', $path_array);

        if ($data[0]->user_id == $this->tank_auth->get_user_id()) {
        	$data[0]->owner = true;
        } else {
        	$data[0]->owner = false;
        }
        $this->load->view('geo/business/retrieve', $data[0]);
    }

    function _search_field_build($field_names, $key) {
    	$search_fields = array();
    	$field_array = explode("+", $field_names);
    	foreach ($field_array as $field_name) {
    		$search_fields[$field_name] = $key;
    	}
    	return $search_fields;
    }

    function search($field_name, $key)
    {
    	$this->load->library('pagination');

		$config['base_url'] = './' . $key . '?';
		$config['per_page'] = '5';

    	$search = $this->_search_field_build($field_name, $key);
    	$limit = $config['per_page'];
    	$offset = $this->input->get('per_page', TRUE);

        $data = $this->ci->businesses->search( $search,  $limit, $offset );

		$config['total_rows'] = $data['count_all_results'];
        $this->pagination->initialize($config);

        echo json_encode($data['results']);
		// $this->load->view('geo/job/search', $data);
    }

    function update()
    {
        if ($this->tank_auth->is_logged_in()) {
        	$user_id = $this->tank_auth->get_user_id();

        	$this->load->library('form_validation');

			if ($this->form_validation->run()) {
				$business_id = $this->form_validation->set_value('id');
				$head = array('title' => $this->form_validation->set_value('title'),
								'user_id' => $user_id,
								'category_id' => $this->form_validation->set_value('category_id'),
								'email' => $this->form_validation->set_value('email'),
								'phone' => $this->form_validation->set_value('phone'),
								'url' => $this->form_validation->set_value('url') );
				$content = array('content' => $this->form_validation->set_value('content'));
				if( $this->ci->businesses->update($business_id, $user_id, $head, $content) ) {
					$this->_show_json_message(200, 'successfully updated!');
				}
			} else {
				$this->ci->load->model('categories');

				$business_id = $this->input->get('id', TRUE);
				$data = $this->ci->businesses->retrieve($business_id);
        		$path_array = array();
        		$this->ci->categories->getParents($data[0]->category_id, $path_array);
        		$data[0]->category = implode(' => ', $path_array);
        		$this->load->view('geo/business/update', $data[0]);
			}
		} else {
			$this->_show_json_message(1, 'not logined!');
		}

    }

    function delete()
    {
		if ($this->tank_auth->is_logged_in()) {
    		$business_id = $this->input->get('id', TRUE);
			$user_id = $this->tank_auth->get_user_id();
    		if($this->ci->businesses->delete($business_id, $user_id)) {
    			$this->_show_json_message(200, 'successfully deleted !');
			}
		} else {
			$this->_show_json_message(1, 'not logined!');
		}
	}

	/**
	 * Show json format info message
	 *
	 * @param	string
	 * @return	void
	 */
	function _show_json_message($code, $message)
	{
		$this->json_result['code'] = $code;
		$this->json_result['message'] = $message;
		$this->load->view('json_message', $this->json_result);
	}
}

/* End of file business.php */
/* Location: ./application/controllers/geo/business.php */