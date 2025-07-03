<?php
class News_model extends CI_Model {

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

				if (empty($title) || empty($text)) {
					return false;
				}

			$slug = url_title($title, 'dash', TRUE);

			$data = [
				'title' => $title,
				'slug'  => $slug,
				'text'  => $text
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

}
