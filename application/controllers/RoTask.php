<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class RoTask extends CI_Controller
{
    public function __construct()
    {
        // $this->role = $this->session->user_logged->role;
        parent::__construct();
        $this->load->library('session');
        $this->load->model("ro_task_model");
        $this->load->model("admin_task_model");
        $this->load->model("user_model");
        $this->load->model("company_model");
        $this->load->model("parameter_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $role = $this->session->user_logged->role;
        $user_id = $this->session->user_logged->user_id;
        if($role == "admin"){
            $data["ro_tasks"] = $this->ro_task_model->getAll();
        }else{
            $data["ro_tasks"] = $this->ro_task_model->getAllAsigned($user_id);
        }
         
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
        if (!isset($id)) redirect('telemarketing');
       
        $ro_task = $this->ro_task_model;
        $admin_task = $this->admin_task_model;
        $company = $this->company_model;

        $admin_task_data = $admin_task->getById($id);
        $company_id = $admin_task_data->company_id;
        $validation = $this->form_validation;
        $validation->set_rules($ro_task->rules());

        if ($validation->run()) {
            $company->updateEmployee($company_id);
            $ro_task->save();

            $this->session->set_flashdata('success', 'Berhasil diperbarui');
            redirect(site_url('telemarketing'));
        }

        $data["admin_task"] = $admin_task_data;
        
        $data["users"] = $this->user_model->getUserRoleTelemarketing();
        $data["company"] = $company->getById($company_id);
        $data["response_parameters"] = $this->parameter_model->getByName("CALL_RESPONSE");
        $data["result_parameters"] = $this->parameter_model->getByName("RESULT");
        if (!$data["admin_task"]) show_404();
        
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