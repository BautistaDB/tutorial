<?php
class News_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

		public function get_news($slug = FALSE)
		{
				if ($slug === FALSE)
				{
					$query = $this->db->get('news');
					return $query->result_array();
				}

				$query = $this->db->get_where('news', array('slug' => $slug));
				return $query->row_array();
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



}
