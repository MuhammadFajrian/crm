<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Summary_model extends CI_Model
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
        $sql = "SELECT c.fullname, b.name AS company_name, b.address, a.data_source, b.employee, b.employee_family, CASE WHEN b.employee >= 100 THEN 'Besar' WHEN b.employee >= 20 THEN 'Menengah' WHEN b.employee >= 5 THEN 'Kecil' WHEN b.employee >= 1 THEN 'Mikro' ELSE 'Tidak Ada Info' END AS stratifikasi, d.last_call, d.call_response_desc, d.result_desc, d.total
        FROM admin_task a
        LEFT JOIN company b ON a.company_id = b.company_id
        LEFT JOIN user c ON a.user_id = c.user_id
        LEFT JOIN (
            SELECT a.ro_task_id, a.admin_task_id, DATE_FORMAT(a.call_date, '%d-%m-%Y') last_call, c.description AS call_response_desc, d.description AS result_desc, a.notes, b.total 
            FROM `ro_task` a
            INNER JOIN (SELECT MAX(ro_task_id) ro_task_id, COUNT(admin_task_id) total FROM ro_task GROUP BY admin_task_id) b ON a.ro_task_id = b.ro_task_id
            LEFT JOIN parameter c ON a.call_response = c.value AND c.name = 'CALL_RESPONSE'
            LEFT JOIN parameter d ON a.result = d.value AND d.name = 'RESULT'
        ) d ON a.admin_task_id = d.admin_task_id";
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