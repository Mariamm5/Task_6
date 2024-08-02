<?php
namespace User\Task6\Models;
use PDO;
class OrderModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;

    }

    public function addOrder($full_name, $email, $number, $city, $address, $postal, $quantity, $book_id)
    {
        $query = "INSERT INTO orders (full_name, email,number, city,address,postal,quantity,book_id)
              VALUES (:full_name, :email, :number, :city,:address,:postal,:quantity,:book_id)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":full_name", $full_name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":number", $number);
        $stmt->bindParam(":city", $city);
        $stmt->bindParam(":address", $address);
        $stmt->bindParam(":postal", $postal);
        $stmt->bindParam(":quantity", $quantity);
        $stmt->bindParam(":book_id", $book_id);
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