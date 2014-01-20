<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Categories
 *
 * This model represents user autologin data. It can be used
 * for user verification when user claims his autologin passport.
 *
 * @package	models
 * @author	Young Gyu Park (http://kauc.net/)
 */
class Categories extends CI_Model
{
	private $table_name	= 'categories';

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Get user data for auto-logged in user.
	 * Return NULL if given key or user ID is invalid.
	 *
	 */
	function load_root_data()
	{
		$query = $this->db->get_where($this->table_name, array('parent_id' => 0));
		if ($query->num_rows() > 0) {
			return false;
		} else {
			$data_array = array(
							array(name => '직업', description => ' 대분류 카테고리 중 직업 ',
									 weight => 0, display => 1, parent_id => 0),
							array(name => '부동산', description => ' 대분류 카테고리 중 부동산 ',
									 weight => 0, display => 1, parent_id => 0),
							array(name => '생활 로그', description => ' 대분류 카테고리 중 생활 로그 ',
									 weight => 0, display => 1, parent_id => 0),
							array(name => '업체', description => ' 대분류 카테고리 중 업체 ',
									 weight => 0, display => 1, parent_id => 0)
						);
			foreach($data_array as $data) {
				$this->db->insert($this->table_name, $data);
			}
			return true;
		}
	}
	
	/**
	 * Get user data for auto-logged in user.
	 * Return NULL if given key or user ID is invalid.
	 *
	 */
	function getRoot()
	{
		$query = $this->db->get_where($this->table_name, array('parent_id' => 0));
		if ($query->num_rows() > 0) return $query->result();
		return NULL;
	}

	/**
	 * Get user data for auto-logged in user.
	 * Return NULL if given key or user ID is invalid.
	 *
	 */
	function getChilds($parent_id)
	{
		$query = $this->db->get_where($this->table_name, array('parent_id' => $parent_id));
		if ($query->num_rows() > 0) return $query->result();
		return NULL;
	}

	/**
	 * Get user data for auto-logged in user.
	 * Return NULL if given key or user ID is invalid.
	 *
	 */
	function getParents($id, &$path_array)
	{
		$query = $this->db->get_where($this->table_name, array('id' => $id));
		if ($query->num_rows() == 1) {
			$result = $query->result();
			array_push($path_array, $result[0]->name);
			$this->getParents($result[0]->parent_id, $path_array);
		} else {
			return $path_array;
		}
	}

	/**
	 * Save data for user's autologin
	 *
	 * @param	int
	 * @param	string
	 * @return	bool
	 */
	function create($name, $description, $weight, $display, $parent_id)
	{
		return $this->db->insert($this->table_name, array(
			'name' 			=> $name,
			'description'	=> $description,
			'weight' 		=> $weight,
			'parent_id' 	=> $parent_id
		));
	}

	/**
	 * Delete user's autologin data
	 *
	 * @param	int
	 * @param	string
	 * @return	void
	 */
	function delete($user_id, $key)
	{
		$this->db->where('user_id', $user_id);
		$this->db->where('key_id', $key);
		$this->db->delete($this->table_name);
	}

	/**
	 * Delete all autologin data for given user
	 *
	 * @param	int
	 * @return	void
	 */
	function clear($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->delete($this->table_name);
	}

	/**
	 * Purge autologin data for given user and login conditions
	 *
	 * @param	int
	 * @return	void
	 */
	function purge($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->where('user_agent', substr($this->input->user_agent(), 0, 149));
		$this->db->where('last_ip', $this->input->ip_address());
		$this->db->delete($this->table_name);
	}
}

/* End of file user_autologin.php */
/* Location: ./application/models/auth/user_autologin.php */