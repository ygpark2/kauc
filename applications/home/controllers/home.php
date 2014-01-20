<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->ci =& get_instance();

		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->config->load('kauc_config', TRUE);
	}

	function index()
	{
		// $this->output->enable_profiler(TRUE);

		// $url = 'http://freegeoip.appspot.com/json/' . $this->ci->input->ip_address();
		// $json = json_decode( file_get_contents($url) );
		// $data = array('start_latitude' => $json['latitude'], 'start_longitude' => $json['longitude']);

		if ($this->config->item('app_mode', 'kauc_settings') === "production") {
			$url = 'http://api.hostip.info/get_html.php?ip=' . $this->ci->input->ip_address() . '&position=true';
			$geoip_contents = file_get_contents($url);
			preg_match('/Latitude: [\-+]?[0-9]*\.*[0-9]*/', $geoip_contents, $matches, PREG_OFFSET_CAPTURE);
			$start_latitude = array_pop(explode(' ', $matches[0][0], 2));
			preg_match('/Longitude: [\-+]?[0-9]*\.*[0-9]*/', $geoip_contents, $matches, PREG_OFFSET_CAPTURE);
			$start_longitude = array_pop(explode(' ', $matches[0][0], 2));
			if ($start_latitude && $start_longitude)
				$data = array('start_latitude' => $start_latitude, 'start_longitude' => $start_longitude);
			else 
				$data = array('start_latitude' => "-34.397", 'start_longitude' => "150.644");
		} else {
			// -34.397, 150.644
			$data = array('start_latitude' => "-34.397", 'start_longitude' => "150.644");
		}

		$data['app_mode'] = $this->config->item('app_mode', 'kauc_settings');
		$data['url_prefix'] = $this->config->item('url_prefix', 'kauc_settings');
		$data['media_url_prefix'] = $this->config->item('media_url_prefix', 'kauc_settings');
		if ($this->tank_auth->is_logged_in()) {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
		} else {
			$data['username']	= NULL;
		}
		$this->load->view('home', $data);
	}

	function gmapInfoWindowForm()
	{
		if ($this->tank_auth->is_logged_in()) {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$this->load->view('gmapInfoWindowForm', $data);
		} else {
			$data['username']	= NULL;
			$this->load->view('gmapInfoWindowLoginForm', $data);
		}
	}

	function _makeMBR($swLat, $swLon, $neLat, $neLon) {
		//swLat swLon, neLat swLon, neLat neLon, swLat neLon, swLat swLon
	 	if($swLon > $neLon) {
		 	return array(' (' .
				 'MBRContains(GeomFromText(\'Polygon((' .
				 $swLat . ' ' . $swLon . ',' . $neLat . ' ' . $swLon . ',' .
				 $neLat . ' 180,' . $swLat . ' 180,' .
				 $swLat . ' ' . $swLon .
				 '))\'), geo_loc) ' .
				 ' OR ' .
				 ' MBRContains(GeomFromText(\'Polygon((' .
				 $swLat . ' -180,' . $neLat . ' -180,' .
				 $neLat . ' ' . $neLon . ',' . $swLat . ' ' . $neLon . ',' .
				 $swLat . ' -180' .
				 '))\'), geo_loc) ' .
				 ') ', 1);
	 	} else {
		 	return array(' MBRContains(GeomFromText(\'Polygon((' .
			 			$swLat . ' ' . $swLon . ',' . $neLat . ' ' . $swLon . ',' .
					 	$neLat . ' ' . $neLon . ',' . $swLat . ' ' . $neLon . ',' .
			 			$swLat . ' ' . $swLon .
			 			'))\'), geo_loc) ', 0);
	 	}
	}

	function get_markers() {
	   	$this->load->library('form_validation');

	   	if ($this->form_validation->run()) {

			$neLat = $this->form_validation->set_value('neLat');
			$neLon = $this->form_validation->set_value('neLng');
			$swLat = $this->form_validation->set_value('swLat');
			$swLon = $this->form_validation->set_value('swLng');

			$conf_log      = $this->form_validation->set_value('conf_log');
			$conf_business = $this->form_validation->set_value('conf_business');
			$conf_property = $this->form_validation->set_value('conf_property');
			$conf_job      = $this->form_validation->set_value('conf_job');
			
			$selectedInfos = array( array("table_name" => "geo_logs", "selectedVal" => $conf_log, "marker_url" => "geo/log"), 
								array("table_name" => "geo_businesses", "selectedVal" => $conf_business, "marker_url" => "geo/business"), 
								array("table_name" => "geo_properties", "selectedVal" => $conf_property, "marker_url" => "geo/property"), 
								array("table_name" => "geo_jobs", "selectedVal" => $conf_job, "marker_url" => "geo/job") );

			$geo_query = $this->_makeMBR($swLat, $swLon, $neLat, $neLon);

			$markers = array();
			$polygon_select_sql = "SELECT `id`, `user_id`, AsText(geo_loc) AS geo_loc FROM `?` WHERE " . $geo_query[0];
			$polygon_select_sql .= " LIMIT 50";

	   		foreach($selectedInfos as $val)
		    {
		    	if($val["selectedVal"] == "Y") {
					$query = $this->db->query(str_replace("`?`", '`'. $val["table_name"] . '`', $polygon_select_sql)); 
					$markers[ $val["marker_url"] ] = $query->result();
		    	}
		    }
			echo json_encode($markers);

			/*
			$query = $this->db->query(str_replace("`?`", '`geo_logs`', $polygon_select_sql)); 
			$markers['geo/log'] = $query->result();
			$query = $this->db->query(str_replace("`?`", '`geo_businesses`', $polygon_select_sql)); 
			$markers['geo/business'] = $query->result();
			$query = $this->db->query(str_replace("`?`", '`geo_properties`', $polygon_select_sql)); 
			$markers['geo/property'] = $query->result();
			$query = $this->db->query(str_replace("`?`", '`geo_jobs`', $polygon_select_sql)); 
			$markers['geo/job'] = $query->result();
			echo json_encode($markers);
			*/

			/*
	   		$where = array( 'latitude >' => $swLat, 'latitude <' => $neLat, 'longitude >' => $swLng, 'longitude <' => $neLng);
			$limit = 25;
			$offset = 0;

			$markers = array();
			$markers['geo/log'] = $this->db->get_where('geo_logs', $where, $limit, $offset)->result();
			$markers['geo/business'] = $this->db->get_where('geo_businesses', $where, $limit, $offset)->result();
			$markers['geo/property'] = $this->db->get_where('geo_properties', $where, $limit, $offset)->result();
			$markers['geo/job'] = $this->db->get_where('geo_jobs', $where, $limit, $offset)->result();
			echo json_encode($markers);
			*/

			/*
 			// $this->load->library('kml');
			$kmlDoc = new kml_Document();
			$kmlDoc->set_id('uid000000111');
			// include_once('kml_Placemark.php');

			foreach($kml_query->result() as $kml)
		    {
		    	$kmlPlacemark = new kml_Placemark($kml->title);
				$kmlPlacemark->set_description($kml->title);
				$kmlPlacemark->add_Geometry(new kml_Point($kml->latitude, $kml->longitude));
				$kmlDoc->add_Feature($kmlPlacemark);
		    }
	
			$kmlDoc->dump();
			*/
		} else {
			echo "form validation error!";
		}
	}

	function welcome()
	{
		$data = array();
		$data['app_mode'] = $this->config->item('app_mode', 'kauc_settings');
		$data['url_prefix'] = $this->config->item('url_prefix', 'kauc_settings');
		$data['media_url_prefix'] = $this->config->item('media_url_prefix', 'kauc_settings');
		$data['username']	= NULL;
		$this->load->view('welcome_message', $data);
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */