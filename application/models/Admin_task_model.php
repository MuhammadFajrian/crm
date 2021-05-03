<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_task_model extends CI_Model
{
    private $_table = "admin_task";

    public $admin_task_id;
    public $start_date;
    public $end_date;
    public $data_source;
    public $company_id;
    public $user_id;

    public function rules()
    {
        return [
            ['field' => 'start_date',
            'label' => 'Target Mulai',
            'rules' => 'required'],

            ['field' => 'end_date',
            'label' => 'Target Selesai',
            'rules' => 'required'],
            
            ['field' => 'company_id',
            'label' => 'Badan Usaha',
            'rules' => 'required'],
            
            ['field' => 'user_id',
            'label' => 'Nama',
            'rules' => 'required'],
            
            ['field' => 'data_source',
            'label' => 'Sumber Data',
            'rules' => 'required'],
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["company_id" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->start_date = date_format(date_create($post["start_date"]), "Y-m-d");
        $this->end_date = date_format(date_create($post["end_date"]), "Y-m-d");
        $this->data_source = $post["data_source"];
        $this->company_id = $post["company_id"];
        $this->user_id = $post["user_id"];
        $this->created_by = $this->session->user_logged->username;
        $this->created_at = date("Y-m-d h:i:s");
        return $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->company_id = $post["id"];
        $this->name = $post["name"];
        $this->address = $post["address"];
        $this->contact = $post["contact"];
        $this->pic_name = $post["pic_name"];
        $this->email = $post["email"];
        return $this->db->update($this->_table, $this, array('company_id' => $post['id']));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("company_id" => $id));
    }
}