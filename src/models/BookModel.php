<?php

namespace User\Task6\Models;

use PDO;

class BookModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllBooks()
    {
        $query = "SELECT * FROM books";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getBookById($id)
    {
        $query = "SELECT * FROM books WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addBook($title, $author, $description, $price, $img_path)
    {
        $query = "INSERT INTO books (title, author, description, price, image_path)
                  VALUES (:title, :author, :description, :price, :img_path)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":author", $author);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":img_path", $img_path);
        return $stmt->execute();
    }

    public function editBook($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM books WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function saveEditedBook($newTitle, $newAuthor, $newDescription, $newPrice, $newImg_path, $id)
    {
        $query = "UPDATE books SET 
                        title=:newTitle,author=:newAuthor,
                        description=:newDescription,
                        price=:newPrice,
                        image_path=:newImg_path
                WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":newTitle", $newTitle);
        $stmt->bindParam(":newAuthor", $newAuthor);
        $stmt->bindParam(":newDescription", $newDescription);
        $stmt->bindParam(":newPrice", $newPrice);
        $stmt->bindParam(":newImg_path", $newImg_path);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    public function deleteBook($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM books WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

}