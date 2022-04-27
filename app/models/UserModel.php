<?php
class UserModel {
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    //register new user
    public function register($data){
        $this->db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
    //find user by email
    public function findUserByUsernameOrNIP($username){
        $this->db->query('SELECT * FROM users WHERE username = :username OR nip=:nip');
        $this->db->bind(':username', $username);
        $this->db->bind(':nip', $username);

        $row = $this->db->single();

        //check the row 
        if($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function login($username, $password){
        $this->db->query('SELECT * FROM users WHERE username = :username OR nip=:nip');
        $this->db->bind(':username', $username);
        $this->db->bind(':nip', $username);
       
        $row = $this->db->single();

        $hash_password = $row->password;

        if(password_verify($password, $hash_password)){
            return $row;
        }else{
            return false;
        }
    }

    public function getUserById($id){
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }
}