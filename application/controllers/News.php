<?php

/** 
 * @property News_model $news_model
 * @property form_validation $form_validation
 * @property input $input 
 * @property session $session
 * 
*/
class News extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('news_model');
                $this->load->helper('url_helper');
				$this->load->library('session');

        }

        public function index()
		{
				$cantidad_por_pagina = isset($_GET['cantidad']) ? $_GET['cantidad'] : 10;
				$pagina_actual = isset($_GET['page']) ? $_GET['page'] : 1;
				$pagina_actual = max(1, (int)$pagina_actual);

				$offset = ($pagina_actual - 1) * $cantidad_por_pagina; 

				$total_news = $this->news_model->count_news();
				$total_paginas = ceil($total_news / $cantidad_por_pagina);
				
				if($pagina_actual > $total_paginas) {
					show_404();
					return;
				}
								
				$data['news'] = $this->news_model->get_news_paginated($cantidad_por_pagina, $offset);
				$data['pagina_actual'] = $pagina_actual;
				$data['total_paginas'] = $total_paginas;
				$data['cantidad_por_pagina'] = $cantidad_por_pagina;
				$data['title'] = 'News archive';

				$this->load->view('templates/header', $data);
				$this->load->view('news/index', $data);
				$this->load->view('templates/pagination', $data);
				$this->load->view('templates/footer');
				echo $this->session->userdata("username");
		}

        public function view($slug = NULL) 
		{
				$data['news_item'] = $this->news_model->get_news_by_slug($slug);

				if (empty($data['news_item']))
				{
						show_404();
				}

				$data['title'] = $data['news_item']['title'];

				$idNoticia = $data['news_item']['id'];

    			$data['upvotes'] = $this->news_model->contar_upvotes($idNoticia);

    			$data['downvotes'] = $this->news_model->contar_downvotes($idNoticia);

				$this->load->view('templates/header', $data);
				$this->load->view('news/view', $data);
				$this->load->view('templates/footer');
		}

		public function create()
		{
			if ($this->session->userdata('logged_in')){
				
				$this->load->helper('form');
				$this->load->library('form_validation');
				
				$data['title'] = 'Create a news item';
	
				$this->form_validation->set_rules('title', 'Title', 'required');
				$this->form_validation->set_rules('text', 'Text', 'required');
	
				if ($this->form_validation->run() === FALSE)
				{
					$this->load->view('templates/header', $data);
					$this->load->view('news/create', $data);
					$this->load->view('templates/footer');
	
				}
				else
				{
					$this->news_model->set_news();
					$this->load->view('news/success');
				}
			}else{
				redirect('users/login');
			}
			}


		public function vote($idNoticia)
    {

		$id_user = $this->session->userdata('user_id');

		if (!$id_user) {
			http_response_code(401); 
			echo json_encode(['error' => 'Debes iniciar sesión para votar']);
			return;
    }

        $json = @file_get_contents('php://input');
		$data = json_decode($json, true);
        $value = (int)$data['value'];

        $result = $this->news_model->guardar_voto($id_user, $idNoticia, $value);

		if($result){
			echo json_encode([
				'mensaje' => "voto con exito",
				'status' => $result,
				'id_news' => $idNoticia,
				'valor' => $value
			]);
		}else {
			http_response_code(500);
			echo json_encode(['error' => 'Error al guardar el voto']);
		}
    }


}

