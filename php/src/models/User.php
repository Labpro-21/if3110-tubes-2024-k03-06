<?php
require_once __DIR__ . '/../config/Database.php';

class User {
    public $id;
    public $email;
    public $password;
    public $role;
    public $nama;

    public function __construct($id, $email, $password, $role, $nama) {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->nama = $nama;
    }

    public static function create($email, $hashedPassword, $role, $nama) {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("INSERT INTO _user (email, password, role, nama) VALUES (:email, :password, :role, :nama)");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':nama', $nama);

        return $stmt->execute();
    }

    public static function findByEmail($email) {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT * FROM _user WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $user = $stmt->fetch();

        if ($user) {
            return new User($user['user_id'], $user['email'], $user['password'], $user['role'], $user['nama']);
        }
        return null;
    }

    public static function findById($id) {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT * FROM _user WHERE user_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $user = $stmt->fetch();

        if ($user) {
            return new User($user['user_id'], $user['email'], $user['password'], $user['role'], $user['nama']);
        }
        return null;
    }

    public function validatePassword($password) {
        return password_verify($password, $this->password);
    }
}
