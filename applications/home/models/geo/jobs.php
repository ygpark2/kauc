<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Geo_Jobs
 *
 * This model represents user autologin data. It can be used
 * for user verification when user claims his autologin passport.
 *
 * @package	home
 * @author	Young Gyu Park (http://kauc.net/)
 */
class Jobs extends CI_Model
{
	private $table_name			= 'geo_jobs';
	private $contents_table_name	= 'geo_job_contents';
	private $tag_join_table_name	= 'geo_job_tag';
	private $tag_table_name		= 'tags';

	function __construct()
	{
		parent::__construct();

		$ci =& get_instance();
	}

	/**
	 * Retrieve log record
	 *
	 * @param	array
	 * @return	array
	 */
	function retrieve($id, $search_fields=array() )
	{

		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->join($this->contents_table_name, $this->table_name.'.id = '.$this->contents_table_name.'.id');
		$this->db->where($this->table_name.'.id', $id);

		$job_query = $this->db->get();
		if ($job_query->num_rows() == 1) {
			$geoJob = array_pop($job_query->result());
	
			$this->db->select( $this->tag_table_name . '.tag' );
			$this->db->from($this->tag_table_name);
			$this->db->join($this->tag_join_table_name, $this->tag_table_name.'.id = '.$this->tag_join_table_name.'.tag_id');
			$this->db->where($this->tag_join_table_name.'.geo_job_id', $id);
			$tag_query = $this->db->get();
			$result_rows = $tag_query->result();
			if ($tag_query->num_rows() > 1) {
				$tag_array = array();
				foreach ($result_rows as $tag_row)
				{
				    array_push($tag_array, $tag_row->tag);
				}
				$comma_separated_tag = implode( ", ", $tag_array );
				$geoJob->tag = $comma_separated_tag;
			} else {
				if ( is_array($result_rows) && count($result_rows) ==  1 ) {
					$geoJob->tag = array_pop($result_rows)->tag;
				} else {
					$geoJob->tag = '';
				}
			}
			
			return $geoJob;
		}
		
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
	 * Search log record
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
	 * Create new log record
	 *
	 * @param	array
	 * @return	array
	 */
	function create($geo_loc, $head, $content)
	{
		$insert_string = $this->db->insert_string($this->table_name, $head);
		$insert_string = str_replace("'%geo_loc%'", $geo_loc, $insert_string);
		if ( $this->db->query($insert_string) ) {
			$content['geo_job_id'] = $this->db->insert_id();
			if ( $this->db->insert($this->contents_table_name, $content) ) {
				return $content['geo_job_id'];
			}
		}
		return NULL;
	}

	/**
	 * Update log record
	 *
	 * @param	array
	 * @return	array
	 */
	function update($id, $user_id, $head, $content)
	{
		if ( $this->db->update($this->table_name, $head, array('id' => $id, 'user_id' => $user_id)) ) {
			if ( $this->db->update($this->contents_table_name, $content, array('geo_job_id' => $id)) ) {
				return true;
			}
		}
		return NULL;
	}

	/**
	 * Delete new job record
	 *
	 * @param	array
	 * @return	array
	 */
	function delete($job_id, $user_id)
	{
		if ( $this->db->delete($this->table_name, array('id' => $job_id, 'user_id' => $user_id)) ) {
			if ( $this->db->delete($this->contents_table_name, array('geo_job_id' => $job_id)) ) {
				return true;
			}
		}
		return NULL;
	}
}

/* End of file user_autologin.php */
/* Location: ./application/models/auth/user_autologin.php */