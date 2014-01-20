<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Profiles
 *
 * This model represents user autologin data. It can be used
 * for user verification when user claims his autologin passport.
 *
 * @package	models
 * @author	Young Gyu Park (http://kauc.net/)
 */
class Profiles extends CI_Model
{
	private $table_name			= 'user_profiles';

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Get user data for auto-logged in user.
	 * Return NULL if given key or user ID is invalid.
	 *
	 */
	function isRegistered($user_id)
	{
		$query = $this->db->get_where($this->table_name, array('user_id' => $user_id));
		if ($query->num_rows() > 0) return $query->result();
		return NULL;
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
	function retrieve($user_id)
	{
		$query = $this->db->get_where($this->table_name, array('user_id' => $user_id));
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
		return $this->db->update($this->table_name, $data, array('id' => $id));
	}

}

/* End of file user_autologin.php */
/* Location: ./application/models/auth/user_autologin.php */