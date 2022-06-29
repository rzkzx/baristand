<?php

Class PersediaanModel
{
  private $table = 'persediaan';

  public function __construct()
  {
      $this->db = new Database;
  }
  
  public function getAll()
  {
      $query = "SELECT * FROM ".$this->table;
      $this->db->query($query);

      return $this->db->resultSet();
  }
}
?>