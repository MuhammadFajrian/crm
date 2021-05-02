<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model("company_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["companies"] = $this->company_model->getAll();
        $this->load->view("company/list", $data);
    }

    public function add()
    {
        $company = $this->company_model;
        $validation = $this->form_validation;
        $validation->set_rules($company->rules());

        if ($validation->run()) {
            $company->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(site_url('company'));
        }

        $this->load->view("company/new_form");
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('company');
       
        $company = $this->company_model;
        $validation = $this->form_validation;
        $validation->set_rules($company->rules());

        if ($validation->run()) {
            $company->update();
            $this->session->set_flashdata('success', 'Berhasil diperbarui');
            redirect(site_url('company'));
        }

        $data["company"] = $company->getById($id);
        if (!$data["company"]) show_404();
        
        $this->load->view("company/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->company_model->delete($id)) {
            redirect(site_url('company'));
        }
    }
}