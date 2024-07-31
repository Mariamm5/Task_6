<?php

class OrderModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;

    }

    public function addCart($book_id, $book_title, $book_price, $quantity)
    {
        $query = "INSERT INTO cart (book_id, book_title, book_price, quantity)
              VALUES (:id, :title, :price, :quantity)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $book_id);
        $stmt->bindParam(":title", $book_title);
        $stmt->bindParam(":price", $book_price);
        $stmt->bindParam(":quantity", $quantity);
        return $stmt->execute();
    }

    public function getOrderInfo()
    {
        $query = "SELECT * FROM orders";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}