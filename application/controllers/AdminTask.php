<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AdminTask extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model("admin_task_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["admin_tasks"] = $this->admin_task_model->getAll();
        $this->load->view("admin_task/list", $data);
    }

    public function add()
    {
        $admin_task = $this->admin_task_model;
        $validation = $this->form_validation;
        $validation->set_rules($admin_task->rules());

        if ($validation->run()) {
            $admin_task->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(site_url('admin_task'));
        }

        $this->load->view("admin_task/new_form");
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin_task');
       
        $admin_task = $this->admin_task_model;
        $validation = $this->form_validation;
        $validation->set_rules($admin_task->rules());

        if ($validation->run()) {
            $admin_task->update();
            $this->session->set_flashdata('success', 'Berhasil diperbarui');
            redirect(site_url('admin_task'));
        }

        $data["admin_task"] = $admin_task->getById($id);
        if (!$data["admin_task"]) show_404();
        
        $this->load->view("admin_task/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->admin_task_model->delete($id)) {
            redirect(site_url('admin_task'));
        }
    }
}