<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ro_task_model extends CI_Model
{
    private $_table = "ro_task";

    public $ro_task_id;
    public $start_date;
    public $end_date;
    public $data_source;
    public $company_id;
    public $user_id;

    public function rules()
    {
        return [
            ['field' => 'call_date',
            'label' => 'Call Date',
            'rules' => 'required'],

            ['field' => 'call_response',
            'label' => 'Call Response',
            'rules' => 'required'],
            
            ['field' => 'result',
            'label' => 'Result',
            'rules' => 'required']

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

    public function getAllAsigned($user_id)
    {
        # code...
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["company_id" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->name = $post["name"];
        $this->address = $post["address"];
        $this->contact = $post["contact"];
        $this->pic_name = $post["pic_name"];
        $this->email = $post["email"];
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