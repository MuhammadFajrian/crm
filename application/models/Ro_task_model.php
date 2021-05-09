<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ro_task_model extends CI_Model
{
    private $_table = "ro_task";

    public $ro_task_id;
    public $admin_task_id;
    public $call_date;
    public $call_response;
    public $result;
    public $notes;
    public $created_by;
    public $created_at;
    public $updated_by;
    public $updated_at;

    public function rules()
    {
        return [
            ['field' => 'call_date',
            'label' => 'Tanggal Telepon',
            'rules' => 'required'],

            ['field' => 'employee',
            'label' => 'Potensi Pekerja',
            'rules' => 'required'],
            
            ['field' => 'employee_family',
            'label' => 'Potensi Keluarga',
            'rules' => 'required'],

            ['field' => 'call_response',
            'label' => 'Respon Telepon',
            'rules' => 'required'],

            ['field' => 'result',
            'label' => 'Respon Telepon',
            'rules' => 'required']

        ];
    }

    public function getAll()
    {
        $sql = "SELECT `a`.`admin_task_id`, CONCAT(DATE_FORMAT(`a`.`start_date`, '%d %b'), ' - ', DATE_FORMAT(`a`.`end_date`, '%d %b %Y')) AS `deadline`, `u`.`fullname`, `a`.`data_source`, `c`.`name`, DATE_FORMAT(MAX(`ro`.`call_date`), '%d-%m-%Y') AS `last_call`, `ro`.`call_response`, `ro`.`result`, IF(`call_response` = '4', DATE_FORMAT(DATE_ADD(MAX(`ro`.`call_date`), INTERVAL 3 DAY), '%d-%m-%Y'), '-') AS `next_call`, `res_parm`.`description` AS `call_response`, `result_parm`.`description` AS `result`
        FROM `admin_task` AS `a`
        INNER JOIN `company` AS `c` ON `a`.`company_id` = `c`.`company_id`
        INNER JOIN `user` AS `u` ON `a`.`user_id` = `u`.`user_id`
        LEFT JOIN `ro_task` AS `ro` ON `ro`.admin_task_id = `a`.`admin_task_id`
        LEFT JOIN `parameter` AS `res_parm` ON `ro`.`call_response` = `res_parm`.`value` AND `res_parm`.`name` = 'CALL_RESPONSE'
        LEFT JOIN `parameter` AS `result_parm` ON `ro`.`call_response` = `result_parm`.`value` AND `result_parm`.`name` = 'RESULT'
        GROUP BY `a`.`admin_task_id`";
        $query = $this->db->query($sql);

        return $query->result();
    }

    public function getAllAsigned($user_id)
    {
        $sql = "SELECT `a`.`admin_task_id`, CONCAT(DATE_FORMAT(`a`.`start_date`, '%d %b'), ' - ', DATE_FORMAT(`a`.`end_date`, '%d %b %Y')) AS `deadline`, `u`.`fullname`, `a`.`data_source`, `c`.`name`, `ro`.`call_date`, `ro`.`call_response`, `ro`.`result`
        FROM `admin_task` AS `a`
        INNER JOIN `company` AS `c` ON `a`.`company_id` = `c`.`company_id`
        INNER JOIN `user` AS `u` ON `a`.`user_id` = `u`.`user_id`
        LEFT JOIN (
            SELECT * FROM `ro_task` 
            WHERE `ro_task_id` IN (SELECT MAX(ro_task_id) FROM `ro_task` GROUP BY `admin_task_id`)
        ) AS `ro` ON `ro`.admin_task_id = `a`.`admin_task_id`
        WHERE `a`.`user_id` = $user_id";
        $query = $this->db->query($sql);

        return $query->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["admin_task_id" => $id])->row();
    }

    public function save()
    {
        $username = $this->session->user_logged->username;
        $timestamp = date("Y-m-d h:i:s");

        $post = $this->input->post();

        $this->admin_task_id = $post["admin_task_id"];
        $this->call_date = date_format(date_create($post["call_date"]), "Y-m-d");
        $this->call_response = $post["call_response"];
        $this->result = $post["result"];
        $this->notes = $post["notes"];
        $this->created_by = $username;
        $this->created_at = $timestamp;
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