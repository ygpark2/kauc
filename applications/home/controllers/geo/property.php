<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Property extends CI_Controller {

	private $type_options = array( '1' => '렌트(임대)-weekly(주당)',
				                  '2' => '렌트(임대)-monthly(월당)',
			    	              '3' => '매매',
		            		      '4' => '전세' );

	function __construct()
	{
		parent::__construct();
		
		$this->ci =& get_instance();
		$this->load->helper(array('form', 'url'));
		$this->load->library('security');
		$this->load->library('tank_auth');
		$this->ci->load->model('geo/properties');

/*
		if ($this->tank_auth->is_logged_in()) {					// logged in
			$this->tank_auth->_show_json_message(205, 'already logined');
		} elseif ($this->tank_auth->is_logged_in(FALSE)) {		// logged in, not activated
			$this->tank_auth->_show_json_message(204, 'not activated yet!');
		} else {
		
		}
*/
	}


    function create()
    {
    	if ($this->tank_auth->is_logged_in()) {
	    	$this->load->library('form_validation');
	
			if ($this->form_validation->run()) {
				$geo_loc = "GeomFromText('POINT(" .$this->form_validation->set_value('latitude'). " " .$this->form_validation->set_value('longitude'). ")')";
				$head = array('title' => $this->form_validation->set_value('title'),
								'user_id' => $this->tank_auth->get_user_id(),
								'email' => $this->form_validation->set_value('email'),
								'phone' => $this->form_validation->set_value('phone'),
								'url' => $this->form_validation->set_value('url'),
								'type' => $this->form_validation->set_value('type'),
								'price' => $this->form_validation->set_value('price'),
								'price_unit' => $this->form_validation->set_value('price_unit'),
								'geo_loc' => "%geo_loc%");
				$content = array('content' => $this->form_validation->set_value('content'));
				$log_id = $this->ci->properties->create($geo_loc, $head, $content);
			} else {
				$this->_show_json_message(204, validation_errors());
			}
		} else {
			$this->_show_json_message(1, 'not logined!');
		}
    }

    function retrieve()
    {
        $id = $this->input->get('id', TRUE);
        $data = $this->ci->properties->retrieve($id);

        if ($data[0]->user_id == $this->tank_auth->get_user_id()) {
        	$data[0]->owner = true;
        } else {
        	$data[0]->owner = false;
        }
        $this->load->view('geo/property/retrieve', $data[0]);

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

        $data = $this->ci->properties->search( $search,  $limit, $offset );

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
				$property_id = $this->form_validation->set_value('id');
				$head = array('title' => $this->form_validation->set_value('title'),
								'user_id' => $user_id,
								'email' => $this->form_validation->set_value('email'),
								'phone' => $this->form_validation->set_value('phone'),
								'url' => $this->form_validation->set_value('url'),
								'price' => $this->form_validation->set_value('price'),
								'price_unit' => $this->form_validation->set_value('price_unit'));
				$content = array('content' => $this->form_validation->set_value('content'));
				if( $this->ci->properties->update($property_id, $user_id, $head, $content) ) {
					$this->_show_json_message(200, 'successfully updated!');
				}
			} else {
				$property_id = $this->input->get('id', TRUE);
        		$data = $this->ci->properties->retrieve($property_id);
        		$data[0]->type_options = $this->type_options;
				$this->load->view('geo/property/update', $data[0]);
			}
		} else {
			$this->_show_json_message(1, 'not logined!');
		}

    }

    function delete()
    {
		if ($this->tank_auth->is_logged_in()) {
    		$property_id = $this->input->get('id', TRUE);
			$user_id = $this->tank_auth->get_user_id();
    		if($this->ci->properties->delete($property_id, $user_id)) {
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

/* End of file log.php */
/* Location: ./application/controllers/geo/log.php */