<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Parameter_model extends CI_Model
{
    private $_table = "parameter";

    public $name;
    public $value;
    public $description;

    public function getAll()
    {
        return $this->db->order_by('name', 'ASC')->get($this->_table)->result();
    }
    
    public function getByName($name)
    {
        return $this->db->get_where($this->_table, ["name" => $name])->result();
    }

}