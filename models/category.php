<?php

class Category
{
    //db
    private $connection;
    private $table = 'my_blog.categories';

    //properties
    public $id;
    public $name;
    public $created_at;

    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function read()
    {
        $query = 'SELECT id, name, created_at FROM ' . $this->table . ' ORDER BY created_at DESC';
        $stmt = $this->connection->prepare($query);
        $stmt->execute();

        return $stmt;
    }
    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . ' SET name=:name ';

        $stmt = $this->connection->prepare($query);
        //clean

        $this->name = htmlspecialchars(strip_tags($this->name));


        $stmt->bindParam(':name', $this->name);


        if ($stmt->execute()) {
            return true;
        } else {
            printf("Error: %s.\n", $stmt->error);
            return false;
        }
    }
}
