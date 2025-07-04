<?php
class Users_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

		public function get_user_by_username($username)
		{
			$query = $this->db->get_where('users', ['username' => $username]);
    		return $query->row_array();
		}


}
