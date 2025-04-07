<?php
namespace App\Models;

use App\Core\Database;

class BlogPost
{

    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllPosts()
    {
        $this->db->query("SELECT * FROM blogpost");
        $this->db->execute();
        return $this->db->results();
    }

    public function addPost($title, $author, $content)
    {
        $this->db->query("INSERT INTO blogpost (title, author, content) VALUES (:title, :author, :content);");
        $this->db->bind(':title', $title);
        $this->db->bind(':author', $author);
        $this->db->bind(':content', $content);
        $this->db->execute();
    }

    // TODO: implement update, getByID, delete
}
