<?php
class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
    }

    // LOGIN
    public function login() {
        if ($this->input->post()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->User_model->getUser($username);

            if ($user && password_verify($password, $user->password)) {
                $this->session->set_userdata([
                    'login' => TRUE,
                    'username' => $user->username,
                    'role' => $user->role
                ]);
                redirect('dashboard');
            } else {
                echo "Login gagal!";
            }
        }

        $this->load->view('auth/login');
    }

    // REGISTER
    public function register() {
        if ($this->input->post()) {
            $data = [
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
            ];
            $this->db->insert('users', $data);
            redirect('auth/login');
        }

        $this->load->view('auth/register');
    }

    // LOGOUT
    public function logout() {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
