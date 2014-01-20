<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Tags
 *
 * This model represents user autologin data. It can be used
 * for user verification when user claims his autologin passport.
 *
 * @package	models
 * @author	Young Gyu Park (http://kauc.net/)
 */
class Tags extends CI_Model
{
	private $table_name		= 'tags';
	// private $geo_log_table_name = 'geo_log_tag';

	/**
	 * Model Constructor
	 *
	 * @access	public
	 */
	public function __construct()
	{
		parent::__construct();

		$this->pk_name = 	'id';
	}


	// ------------------------------------------------------------------------

	function _make_tag_array($tags)
	{
		// Array of tags	
		$tag_array = array();
		
		// First clean input tags
		if ($tags)
		{
			$tags = explode( ',', $this->_clear_tag_string($tags) );
			
			foreach ($tags as $tag)
			{
				array_push($tag_array, trim($tag));
				// $tag_array[] = strtolower($tag);
				// $tag_array[] = preg_replace("/[^a-z0-9s]/", "", strtolower($tag));
			}
		}
		return $tag_array;
	}

	function _clear_tag_string($tags)
	{
		$filter_str = array(', '=>',', '; '=>',', ';'=>',', '"'=>'', "'"=>'', 
							"/"=>'',   "\\"=>'',  "("=>'',  ")"=>'', "\""=>'', 
							"&"=>'-',  ":"=>'-',  "*"=>'');
		foreach ($filter_str as $key => $val) {
			$tags = str_replace($key, $val, $tags);
		}
		/*
		// Prepare tags string before insertion
		$tags = str_replace(', ', ',', $tags);
		$tags = str_replace('; ', ',', $tags);
		$tags = str_replace(';', ',', $tags);
		$tags = str_replace('"', '', $tags);
		$tags = str_replace("'", '', $tags);
		$tags = str_replace("/", '', $tags);
		$tags = str_replace("\\", '', $tags);
		$tags = str_replace("(", '', $tags);
		$tags = str_replace(")", '', $tags);
		$tags = str_replace("\"", '', $tags);
		$tags = str_replace("&", '-', $tags);
		$tags = str_replace(":", '-', $tags);
		$tags = str_replace("*", '', $tags);
		*/
		return $tags;
	}

	/**
	 * Update tags linked to a parent element
	 * 
	 * @param	string		Tags as string (coma separated or ; separated, depending on what the user inputs...)
	 * @param	string		Parent type. Can be 'article, 'page', etc.
	 * @param	int			Parent ID
	 *
	 */
	function update($tags, $join_table, $join_id_field, $join_id)
	{
		$this->db->delete($join_table, array($join_id_field => $join_id)); 
		$this->save($tags, $join_table, $join_id_field, $join_id);
		return true;
	}

	/**
	 * Save tags linked to a parent element
	 * 
	 * @param	string		Tags as string (coma separated or ; separated, depending on what the user inputs...)
	 * @param	string		Parent type. Can be 'article, 'page', etc.
	 * @param	int			Parent ID
	 *
	 */
	function save($tags, $join_table, $join_id_field, $join_id)
	{
		$tag_array = $this->_make_tag_array($tags);
		// Update tag table
		foreach	($tag_array as $tag)
		{
			$this->db->where('tag', $tag);
			$query = $this->db->get($this->table_name, 1);
			
			if ($query->num_rows == 1)
			{
				$row = $query->row_array();
				$tag_id = $row['id'];
			}
			else
			{
				$query = $this->db->insert($this->table_name, array('tag'=>$tag, 'created'=>time()) );
				$tag_id = $this->db->insert_id();
			}
			
			// Update the parent join table
			$tag_data = array($join_id_field => $join_id, 'tag_id' => $tag_id );
			$query = $this->db->insert($join_table, $tag_data);
		}
		
		// Clean up the tag table : Remove unused tags
		// ...
	}


	// ------------------------------------------------------------------------


	/** Get the tag cloud datas
	 *  @param	$lang		Code lang. Submitted to get tag on translated articles only
	 *	@param	$id_page	If submitted, get only the tags from articles in this page
	 */
	function tag_cloud($lang, $id_page=false)
	{
		$built = array();
		
		$sql = 	' SELECT t.tag, COUNT(t2.id_tag) as qty '
				.'FROM (article_tags t)'
				.' INNER JOIN article_tag t2  ON t2.id_tag = t.id_tag '
				.' INNER JOIN article_lang t3 ON t3.id_article = t2.id_article '
				.' INNER JOIN article t4 ON t4.id_article = t3.id_article '
				.' WHERE t3.lang = \''.$lang.'\' '
				.' AND t3.title is not null '
				.' AND t3.title != \'\'' ;

		if ($id_page)
		{
			$sql .= ' AND t4.id_page = \''.$id_page.'\'' ;
		}
		
		$sql .=' GROUP BY t.id_tag';

		$query = $this->db->query($sql);
		
//		echo($this->db->last_query());
		
		$built = array();
		
		if ($query->num_rows > 0)
		{
			$result = $query->result_array();
			
			foreach ($result as $row)
			{
				$built[$row['tag']] = $row['qty'];
			}
		}
		
		$query->free_result();

		return $built;
	}


	// ------------------------------------------------------------------------


	/**
	 * Returns all tags as string or as simple array
	 *
	 * @param	string	Type of wished return. Can be 'array' or 'string'
	 *
	 */
	function get_tags($return = 'array')
	{
		$built = array();
		$string = '';

		// DB query
		$this->db->select('tag');
		$query = $this->db->get($this->table);
		
		if ($query->num_rows() > 0)
		{
			$result = $query->result();
			
			foreach ($result as $tag)
			{
				$built[] = $tag->tag;
			}
			
			if ($return == 'string')
			{
				foreach ($built as $tag)
				{
					$string .= $tag.', ';
				}
					
				$string = substr($string, 0, -2);
			}
		}
		
		$query->free_result();
		
		return ($return == 'array') ? $built : $string;
		
	}

}

/* End of file user_autologin.php */
/* Location: ./application/models/auth/user_autologin.php */