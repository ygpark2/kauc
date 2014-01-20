<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Comments
 *
 * This model represents user autologin data. It can be used
 * for user verification when user claims his autologin passport.
 *
 * @package	models
 * @author	Young Gyu Park (http://kauc.net/)
 */
class Comments extends CI_Model
{
	private $table_name			= '_comments';

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Save data for user's autologin
	 *
	 * @param	array
	 * @return	bool
	 */
	function setTableName($name)
	{
		return $this->$table_name = $name . $this->table_name;
	}

	/**
	 * Save data for user's autologin
	 *
	 * @param	array
	 * @return	bool
	 */
	function create($data)
	{
		return $this->db->insert($this->table_name, $data);
	}

	/**
	 * Get user data for auto-logged in user.
	 * Return NULL if given key or user ID is invalid.
	 *
	 */
	function retrieve($id)
	{
		$query = $this->db->get_where($this->table_name, array('id' => $id));
		if ($query->num_rows() == 1) return $query->result();
		return NULL;
	}

	/**
	 * Update profile record
	 *
	 * @param	array
	 * @return	array
	 */
	function update($data, $id)
	{
		return $this->db->update($this->table_name, $data, array('user_id' => $user_id, 'id' => $id));
	}

}

/* End of file user_autologin.php */
/* Location: ./application/models/auth/user_autologin.php */