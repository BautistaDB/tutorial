<?php

class Users extends CI_Controller{

	public function __construct()
        {
                parent::__construct();
				$this->load->model('Users_model');
				$this->load->helper('url_helper');
				$this->load->library('session');
        }

	public function index(){

				$this->load->view('users/login');
	}

	public function login(){
		
			if ($this->input->post()) {

				$username = $this->input->post('username');
				$password = $this->input->post('password');

				$this->load->model('Users_model');

				$usuario = $this->Users_model->get_user_by_username($username);

				if(!$usuario){
					echo "USUARIO INEXISTENTE!!";
				}				 															
				elseif (password_verify($password, $usuario['password'])) {

					$this->session->set_userdata([
					'username' => $usuario['username'],
					'fullname' => $usuario['fullname'],
					'user_id'  => $usuario['id'],
					'logged_in' => true ]);

					redirect('users/me');
				} else {
					
					$data['error'] = 'CONTRASEÑA INCORRECTA!!';
					$this->load->view('users/login', $data);
				}
				}

			}
			
			public function me()
			{
				if (!$this->session->userdata('logged_in')) {
				redirect('users'); // no faltaria redireccionar a users/login en la URL ???   o 
									// no redirecciona a users/login porque en el modelo index carga la vista de login
				return;

				}

				$data['username'] = $this->session->userdata('username');
				$data['fullname'] = $this->session->userdata('fullname');

				$this->load->view('users/me', $data);
			}

			public function logout()
			{
				$this->session->sess_destroy(); 
				redirect('users');         
			}
}	



// Ejemplo de usuarios y contraseñas:
//pepito    - diego
//pepito123 - diego123
