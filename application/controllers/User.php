<?php

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("user_model");
        $this->load->library('form_validation');
    }

    public function login()
    {
        // jika form login disubmit
        if($this->input->post()){
            if($this->user_model->doLogin()) redirect(site_url('dashboard'));
        }

        // tampilkan halaman login
        $this->load->view("user/login");
    }

    public function logout()
    {
        // hancurkan semua sesi
        $this->session->sess_destroy();
        redirect(site_url('user/login'));
    }

    public function profile($id = null)
    {
        if (!isset($id)) {
            $user_id = $this->session->user_logged->user_id;
        }else{
            $user_id = $id;
        }
        
        $user = $this->user_model;
        $validation = $this->form_validation;
        $validation->set_rules($user->rules());

        if ($validation->run()) {
            $user->updateProfile($user_id);
            redirect(site_url('dashboard'));
        }

        $data["user"] = $user->getById($user_id);

        // tampilkan halaman login
        $this->load->view("user/profile", $data);
    }

    public function setting()
    {
        $user_id = $this->session->user_logged->user_id;
        
        $user = $this->user_model;
        $validation = $this->form_validation;
        $validation->set_rules($user->rules());

        if ($validation->run()) {
            $user->changePassword($user_id);
            redirect(site_url('dashboard'));
        }

        // tampilkan halaman login
        $this->load->view("user/setting");
    }
}