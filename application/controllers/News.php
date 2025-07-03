<?php

/** 
 * @property News_model $news_model
 * @property form_validation $form_validation
 * @property input $input 
*/
class News extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('news_model');
                $this->load->helper('url_helper');
        }

        public function index()
		{
				$cantidad_por_pagina = isset($_GET['cantidad']) ? $_GET['cantidad'] : 10;
				$pagina_actual = isset($_GET['page']) ? $_GET['page'] : 1;
				$pagina_actual = max(1, (int)$pagina_actual);

				$offset = ($pagina_actual - 1) * $cantidad_por_pagina;

				$total_news = $this->news_model->count_news();
				$total_paginas = ceil($total_news / $cantidad_por_pagina);

				$data['news'] = $this->news_model->get_news_paginated($cantidad_por_pagina, $offset);

				$data['pagina_actual'] = $pagina_actual;
				$data['total_paginas'] = $total_paginas;
				$data['cantidad_por_pagina'] = $cantidad_por_pagina;
				$data['title'] = 'News archive';

				$this->load->view('templates/header', $data);
				$this->load->view('news/index', $data);
				$this->load->view('templates/pagination', $data);
				$this->load->view('templates/footer');
		}

        public function view($slug = NULL) 
		{
				$data['news_item'] = $this->news_model->get_news_by_slug($slug);

				if (empty($data['news_item']))
				{
						show_404();
				}

				$data['title'] = $data['news_item']['title'];

				$this->load->view('templates/header', $data);
				$this->load->view('news/view', $data);
				$this->load->view('templates/footer');
		}

		public function create()
		{
			$this->load->helper('form');
			$this->load->library('form_validation');

			$data['title'] = 'Create a news item';

			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('text', 'Text', 'required');

			if ($this->form_validation->run() === FALSE)
			{
				$this->load->view('templates/header', $data);
				$this->load->view('news/create');
				$this->load->view('templates/footer');

			}
			else
			{
				$this->news_model->set_news();
				$this->load->view('news/success');
			}
		}

}
