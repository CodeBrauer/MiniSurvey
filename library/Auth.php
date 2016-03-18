<?php

class Auth
{

    const USERS_TABLE = 'users';

    public function __construct()
    {
        $this->db      = new Database();
        $this->session = new Session();
    }

    public function auth($user, $password)
    {
        $user  = $this->db->pdo->quote($user);
        $query = "SELECT id, username, password FROM " . self::USERS_TABLE . " WHERE username=$user";

        $result = $this->db->query($query, true);

        if (!empty($result)) {
            if (password_verify($password, $result['password'])) {
                return [true, "Logged in successfully"];
            }
            return [false, "Login failed: Wrong password"];
        }
        return [false, "Login failed: User not found"];
    }

    public function register($user, $password)
    {
        $user     = $this->db->pdo->quote($user);
        $password = password_hash($password, PASSWORD_DEFAULT);
        
        $query  = "INSERT INTO " . self::USERS_TABLE . " VALUES (null, $user, '$password', 'user', null);";
        $result = (bool)$this->db->pdo->exec($query);
        if ($result) {
            return [true, "User created"];
        }
        return [false, "User creation failed. Maybe try another username."];

        return $result;
    }

    public function getUserData($username)
    {
        $username = $this->db->pdo->quote(trim($username));
        $result = $this->db->query("SELECT id,username FROM " . self::USERS_TABLE . " WHERE username = $username", true);
        if ($result && !empty($result)) {
            return $result;
        }
        return false;
    }

    public function isAuthed()
    {
        return $this->session->exists('logged_in');
    }

    public function isAdmin($user_id)
    {
        $role = $this->db->query("SELECT role FROM users WHERE id='$user_id'", true)['role'];
        return $role == 'admin';
    }

    public function logout()
    {
        $this->session->destroy();
    }
}