<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model("user_model");
        !($this->user_model->isNotLogin()) ?: redirect(site_url('user/login'));
    }
	public function index()
	{
		$this->load->view('dashboard');
	}
}
