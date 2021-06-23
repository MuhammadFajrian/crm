<?php

class User_model extends CI_Model
{
    private $_table = "user";

    public function rules()
    {
        return [
            ['field' => 'email',
            'label' => 'Email',
            'rules' => 'required'],

            ['field' => 'username',
            'label' => 'Username',
            'rules' => 'required'],
            
            ['field' => 'fullname',
            'label' => 'Fullname',
            'rules' => 'required']
            
        ];
    }

    public function doLogin(){
		$post = $this->input->post();

        // cari user berdasarkan email dan username
        $this->db->where('email', $post["email"])
                ->or_where('username', $post["email"]);
        $user = $this->db->get($this->_table)->row();

        // jika user terdaftar
        if($user){
            // periksa password-nya
            $isPasswordTrue = password_verify($post["password"], $user->password);
            // periksa role-nya
            $isAdmin = $user->role == "admin";
            // jika password benar dan dia admin
            if($user->is_active == 0){
                $this->session->set_flashdata('login_failed', 'Maaf akun anda sudah tidak aktif');
            }else if($isPasswordTrue){ 
                // login sukses yay!
                $this->session->set_userdata(['user_logged' => $user]);
                $this->_updateLastLogin($user->user_id);
                return true;
            }
        }else{
            $this->session->set_flashdata('login_failed', 'Email atau password salah');
        }
        
        // login gagal
		return false;
    }

    public function isNotLogin(){
        return $this->session->userdata('user_logged') === null;
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["user_id" => $id])->row();
    }

    public function updateProfile($user_id)
    {
        $post = $this->input->post();
        $this->email        = $post["email"];
        $this->npp          = $post["npp"];
        $this->username     = $post["username"];
        $this->fullname     = $post["fullname"];
        $this->address      = $post["address"];
        $this->is_active    = (isset($post["is_active"]) == 1) ? 1 : 0;
        return $this->db->update($this->_table, $this, array('user_id' => $user_id));
    }

    private function _updateLastLogin($user_id){
        $sql = "UPDATE {$this->_table} SET last_login=now() WHERE user_id={$user_id}";
        $this->db->query($sql);
    }

    public function getUserRoleAdmin()
    {
        return $this->db->get_where($this->_table, ["role" => 'admin'])->result();
    }

    public function getUserRoleTelemarketing()
    {
        return $this->db->get_where($this->_table, ["role" => 'telemarketing'])->result();
    }

    public function saveUser()
    {
        $post = $this->input->post();
        $this->npp          = $post["npp"];
        $this->email        = $post["email"];
        $this->username     = $post["username"];
        $this->fullname     = $post["fullname"];
        $this->address      = $post["address"];
        $this->role         = $post["role"];;
        $this->is_active    = 1;
        $this->password     = password_hash("123456", PASSWORD_DEFAULT);
        return $this->db->insert($this->_table, $this);
    }

}