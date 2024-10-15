<?php
require_once __DIR__ . '/../config/Database.php';

class User {
    public $id;
    public $role;
    public $nama;

    public function __construct($id, $role, $nama) {
        $this->id = $id;
        $this->role = $role;
        $this->nama = $nama;
    }
}
?>
