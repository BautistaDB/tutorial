<?php

/**
 * @property CI_DB_query_builder $db
 */
class Users_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	public function get_user_by_username($username)
	{
		$query = $this->db->get_where('users', ['username' => $username]);
		return $query->row_array();
	}

	public function create_user($fullname, $username, $password)
	{
		$data = array(
			'fullname' => $fullname,
			'username' => $username,
			'password' => password_hash($password, PASSWORD_BCRYPT),
		);

		return $this->db->insert('users', $data);
	}
}
