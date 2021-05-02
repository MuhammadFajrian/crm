<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class RoTask extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model("ro_task_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["ro_tasks"] = $this->ro_task_model->getAll();
        $this->load->view("ro_task/list", $data);
    }

    public function add()
    {
        $ro_task = $this->ro_task_model;
        $validation = $this->form_validation;
        $validation->set_rules($ro_task->rules());

        if ($validation->run()) {
            $ro_task->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(site_url('ro_task'));
        }

        $this->load->view("ro_task/new_form");
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('ro_task');
       
        $ro_task = $this->ro_task_model;
        $validation = $this->form_validation;
        $validation->set_rules($ro_task->rules());

        if ($validation->run()) {
            $ro_task->update();
            $this->session->set_flashdata('success', 'Berhasil diperbarui');
            redirect(site_url('ro_task'));
        }

        $data["ro_task"] = $ro_task->getById($id);
        if (!$data["ro_task"]) show_404();
        
        $this->load->view("ro_task/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->ro_task_model->delete($id)) {
            redirect(site_url('ro_task'));
        }
    }
}