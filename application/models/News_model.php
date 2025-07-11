<?php

/**
 * @property CI_DB_query_builder $db
 */
class News_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	public function get_news_by_slug($slug = FALSE)
	{
		$query = $this->db->get_where('news', array('slug' => $slug));
		return $query->row_array();
	}

	public function get_news()
	{
		$query = $this->db->get('news');
		return $query->result_array();
	}


	public function set_news()
	{
		$this->load->helper('url');

		$title = $this->input->post('title', TRUE);
		$text = $this->input->post('text', TRUE);
		$username = $this->input->post('username');

		if (empty($title) || empty($text)) {
			return false;
		}

		$slug = url_title($title, 'dash', TRUE);

		$data = [
			'title' => $title,
			'slug'  => $slug,
			'text'  => $text,
			'users_id' => $username
		];

		return $this->db->insert('news', $data);
	}

	public function get_news_paginated($limit, $offset)
	{
		return $this->db->get('news', $limit, $offset)->result_array();
	}

	public function count_news()
	{
		return $this->db->count_all('news');
	}

	public function guardar_voto($id_user, $id_news, $value)
	{
		 $voto_existente = $this->db
        	->where('id_user', $id_user)
        	->where('id_news', $id_news)
       		->get('votes')
        	->row();

		if ($voto_existente) {

			if ((int)$voto_existente->value === (int)$value) {

				$this->db
					->where('id_user', $id_user)
					->where('id_news', $id_news)
					->delete('votes');
					
				return 'delete';

			} else {
				
				$this->db
					->where('id_user', $id_user)
					->where('id_news', $id_news)
					->update('votes', ['value' => $value]);

				return 'update';
			}
		} else {
				
			$this->db->insert('votes', [
				'id_user' => $id_user,
				'id_news' => $id_news,
				'value' => $value
			]);
			return 'insert';
		}

	}

	public function contar_upvotes($id_news)
	{
		$this->db->select('COUNT(*) as total_upvotes');
		$this->db->from('votes');
		$this->db->where('id_news', $id_news);
		$this->db->where('value', 1);
		$query = $this->db->get();
		return $query->row()->total_upvotes;
	}

		public function contar_downvotes($id_news)
	{
		$this->db->select('COUNT(*) as total_downvotes');
		$this->db->from('votes');
		$this->db->where('id_news', $id_news);
		$this->db->where('value', -1);
		$query = $this->db->get();
		return $query->row()->total_downvotes;
	}

}
