<?php
class Database
{
    const DB_HOST = 'localhost';
    const DB_USER = 'root';
    const DB_PASS = 'root';
    const DB_NAME = 'survey';

    public $pdo;
    
    function __construct()
    {
        try {
            $this->pdo = new PDO('mysql:dbname='.self::DB_NAME.';host='.self::DB_HOST, self::DB_USER, self::DB_PASS);
        } catch (PDOException $e) {
            throw new Exception("MYSQL CONNECTION FAILED: " . $e->getMessage(), 5);
        }
    }
    
    public function query($sql, $single = false) {
        
        $q = $this->pdo->query($sql);
        if ($q === false)
            throw new Exception("Database error - PDO::query fails");

        $data = $q->fetchAll(PDO::FETCH_ASSOC);
        return !empty($data) ? $single ? $data[0] : $data : false;
    }

    public function insert($table, array $data)
    {
        if (empty($table) || empty($data)) {
            throw new Exception("Empty param given");
        }

        // $table = $this->pdo->quote($table);
        
        $setter = [];
        foreach ($data as $key => $value) {
            $setter[] = " $key= :$key";
            $values[":$key"] = $value; 
        }

        $sth = $this->pdo->prepare('INSERT INTO ' . $table . ' SET' . implode(', ', $setter));
        return $sth->execute($values);
    }

    public function update($table, array $data)
    {
        die('not implemented yet.');
        if (empty($table) || empty($data)) {
            # code...
        }
    }

    public function delete($table, $id = false)
    {
        die('not implemented yet.');
        if (empty($table) || empty($data)) {
            # code...
        }
    }
}