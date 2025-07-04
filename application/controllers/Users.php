<?php

/**
 * @property Users_model $Users_model
 */
class Users extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Users_model');
		$this->load->helper('url_helper');
		$this->load->library('session');
	}

	public function login()
	{

		if ($this->input->post()) {

			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$this->load->model('Users_model');

			$usuario = $this->Users_model->get_user_by_username($username);

			if (!$usuario) {
				$data['error'] = "USUARIO INEXISTENTE!!";
				$this->load->view('users/login', $data);
			} elseif (password_verify($password, $usuario['password'])) {

				$this->session->set_userdata([
					'username' => $usuario['username'],
					'fullname' => $usuario['fullname'],
					'user_id'  => $usuario['id'],
					'logged_in' => true
				]);

				redirect('users/me');
			} else {

				$data['error'] = 'CONTRASEÑA INCORRECTA!!';
				$this->load->view('users/login', $data);
			}
		} else {
			$this->load->view('users/login');
		}
	}

	public function me()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('users/login');
			return;
		}

		$data['username'] = $this->session->userdata('username');
		$data['fullname'] = $this->session->userdata('fullname');

		$this->load->view('users/me', $data);
	}

	public function register()
	{
		if ($this->input->post()) {
			$fullname = $this->input->post('fullname');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$password_repeat = $this->input->post('password_repeat');


			if ($password == $password_repeat) {
				try {
					$new_user = $this->Users_model->create_user($fullname, $username, $password);
					$data['username'] = $this->session->userdata($new_user, 'username');
					$data['fullname'] = $this->session->userdata($new_user, 'fullname');

					$this->load->view('users/me', $data);
				} catch (Exception $ex) {
					$this->load->view('users/register', ['error' => $ex->getMessage()]);
				}
			} else {
				$data['error'] = 'Las contraseñas no coinciden';
				$this->load->view('users/register', $data);
			}
		} else {
			$this->load->view('users/register');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('users/login');
	}
}	



// Ejemplo de usuarios y contraseñas:
//pepito    - diego
//pepito123 - diego123
