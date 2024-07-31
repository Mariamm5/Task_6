<?php

 class CartModel{
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

         if ($stmt->execute()) {
             return true;
         } else {
             // Log SQL error for debugging
             error_log('SQL Error: ' . implode(" ", $stmt->errorInfo()));
             return false;
         }
     }



 }