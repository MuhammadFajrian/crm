<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Company_model extends CI_Model
{
    private $_table = "company";

    public $company_id;
    public $name;
    public $address;
    public $contact;
    public $pic_name;
    public $email;
    public $employee;
    public $employee_family;

    public function rules()
    {
        return [
            ['field' => 'name',
            'label' => 'Name',
            'rules' => 'required'],

            ['field' => 'address',
            'label' => 'Address',
            'rules' => 'required'],
            
            ['field' => 'contact',
            'label' => 'Contact Number',
            'rules' => 'required'],
            
            ['field' => 'pic_name',
            'label' => 'PIC Name',
            'rules' => 'required']
        ];
    }

    public function getAll()
    {
        return $this->db->order_by('name', 'ASC')->get($this->_table)->result();
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

    public function updateEmployee($company_id)
    {
        $username = $this->session->user_logged->username;
        $timestamp = date("Y-m-d h:i:s");

        $post = $this->input->post();
        $this->db->set('employee', $post["employee"]);
        $this->db->set('employee_family', $post["employee_family"]);
        $this->db->set('updated_by', $username);
        $this->db->set('updated_at', $timestamp);
        $this->db->where('company_id', $company_id);

        return $this->db->update($this->_table);
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("company_id" => $id));
    }
}