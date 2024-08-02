<?php
namespace User\Task6\Models;
use PDO;
class CartModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function addCart($bookId, $bookTitle, $bookPrice, $quantity)
    {
        $query = "INSERT INTO cart (book_id, book_title, book_price,quantity)
                                    VALUES (:book_id, :book_title, :book_price,:quantity)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':book_id', $bookId);
        $stmt->bindParam(':book_title', $bookTitle);
        $stmt->bindParam(':book_price', $bookPrice);
        $stmt->bindParam(':quantity', $quantity);
        return $stmt->execute();
    }

    public function getCart()
    {
        $query = "SELECT * FROM cart";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $carts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $carts;
    }

}