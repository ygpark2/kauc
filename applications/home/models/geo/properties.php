<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Geo_Properties
 *
 * This model represents user autologin data. It can be used
 * for user verification when user claims his autologin passport.
 *
 * @package	home
 * @author	Young Gyu Park (http://kauc.net/)
 */
class Properties extends CI_Model
{
	private $table_name			= 'geo_properties';
	private $contents_table_name	= 'geo_property_contents';
	
	function __construct()
	{
		parent::__construct();

		$ci =& get_instance();

	}

	/**
	 * Retrieve property record
	 *
	 * @param	array
	 * @return	array
	 */
	function retrieve($id)
	{
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->join($this->contents_table_name, $this->table_name.'.id = '.$this->contents_table_name.'.id');
		$this->db->where($this->table_name.'.id', $id);
		$query = $this->db->get();
		if ($query->num_rows() == 1) return $query->result();
		return NULL;
	}

	/**
	 * Search log where query
	 *
	 * @param	array
	 * @return	null
	 */
	function _search_where( $search_fields ) {
		if (count($search_fields) > 1) {
			$this->db->join($this->contents_table_name, $this->table_name.'.id = '.$this->contents_table_name.'.id');

			$keys = array_keys($search_fields);
			$this->db->like( current($keys), $search_fields[current($keys)] );
			while ( $key = next($keys)) {
				$this->db->or_like( $key, $search_fields[$key] );
			}
		} else {
			$this->db->like($search_fields);
		}
	}

	/**
	 * Search property record
	 *
	 * @param	array
	 * @return	array
	 */
	function search( $search_fields, $limit, $offset )
	{
		$this->_search_where( $search_fields );
		$count_all_results = $this->db->count_all_results($this->table_name);

		$this->db->select( $this->table_name.'.id, user_id, title, AsText(geo_loc) AS geo_loc');
		$this->_search_where( $search_fields );
		$log_query = $this->db->get($this->table_name, $limit, $offset);

		return array("count_all_results" => $count_all_results, "results" => $log_query->result());
	}

	/**
	 * Create new property record
	 *
	 * @param	array
	 * @return	array
	 */
	function create($geo_loc, $head, $content)
	{
		$insert_string = $this->db->insert_string($this->table_name, $head);
		$insert_string = str_replace("'%geo_loc%'", $geo_loc, $insert_string);
		if ( $this->db->query($insert_string) ) {
			$content['geo_property_id'] = $this->db->insert_id();
			if ( $this->db->insert($this->contents_table_name, $content) ) {
				return $content['geo_property_id'];
			}
		}
		return NULL;
	}

	/**
	 * Update property record
	 *
	 * @param	array
	 * @return	array
	 */
	function update($id, $user_id, $head, $content)
	{
		if ( $this->db->update($this->table_name, $head, array('id' => $id, 'user_id' => $user_id)) ) {
			if ( $this->db->update($this->contents_table_name, $content, array('geo_property_id' => $id)) ) {
				return true;
			}
		}
		return NULL;
	}

	/**
	 * Delete property record
	 *
	 * @param	array
	 * @return	array
	 */
	function delete($property_id, $user_id)
	{
		if ( $this->db->delete($this->table_name, array('id' => $property_id, 'user_id' => $user_id)) ) {
			if ( $this->db->delete($this->contents_table_name, array('geo_property_id' => $property_id)) ) {
				return true;
			}
		}
		return NULL;
	}
}

/* End of file user_autologin.php */
/* Location: ./application/models/auth/user_autologin.php */