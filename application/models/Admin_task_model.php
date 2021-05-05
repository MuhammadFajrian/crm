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
        $sql = "SELECT `a`.`admin_task_id`, `a`.`start_date`, `a`.`end_date`, CONCAT(DATE_FORMAT(`a`.`start_date`, '%d %b'), ' - ', DATE_FORMAT(`a`.`end_date`, '%d %b %Y')) AS `deadline`, `u`.`fullname`, `a`.`data_source`, `c`.`name`
        FROM `admin_task` AS `a`
        INNER JOIN `company` AS `c` ON `a`.`company_id` = `c`.`company_id`
        INNER JOIN `user` AS `u` ON `a`.`user_id` = `u`.`user_id`";
        $query = $this->db->query($sql);

        return $query->result();
    }
    
    public function getById($id)
    {
        $sql = "SELECT `a`.`admin_task_id`, DATE_FORMAT(`a`.`start_date`, '%d-%m-%Y') AS `start_date`, DATE_FORMAT(`a`.`end_date`, '%d-%m-%Y') AS `end_date`, `u`.`fullname`, `a`.`data_source`, `a`.`user_id`, `a`.`company_id`, `c`.`address`
        FROM `admin_task` AS `a`
        INNER JOIN `company` AS `c` ON `a`.`company_id` = `c`.`company_id`
        INNER JOIN `user` AS `u` ON `a`.`user_id` = `u`.`user_id`
        WHERE `a`.`admin_task_id` = '$id'";
        $query = $this->db->query($sql);

        return $query->row();
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
        $this->admin_task_id = $post['id'];
        $this->start_date = date_format(date_create($post["start_date"]), "Y-m-d");
        $this->end_date = date_format(date_create($post["end_date"]), "Y-m-d");
        $this->data_source = $post["data_source"];
        $this->company_id = $post["company_id"];
        $this->user_id = $post["user_id"];
        $this->updated_by = $this->session->user_logged->username;
        $this->updated_at = date("Y-m-d h:i:s");
        return $this->db->update($this->_table, $this, array('admin_task_id' => $post['id']));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("admin_task_id" => $id));
    }
}