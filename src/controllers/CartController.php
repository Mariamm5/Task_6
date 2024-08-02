<?php

namespace User\Task6\Controllers;
session_start();

use User\Task6\Database;
use User\Task6\Models\CartModel;

class CartController
{

    private $cartModel;
    private $database;

    public function __construct()
    {
        $this->database = new Database();
        $conn = $this->database->getConnection();
        $this->cartModel = new CartModel($conn);
    }

    public function addCart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bookId = $_POST['id'];
            $bookTitle = $_POST['title'];
            $bookPrice = $_POST['price'];
            $this->cartModel->addCart($bookId, $bookTitle, $bookPrice, 1);
        }
    }

    public function getCart()
    {
        $carts = $this->cartModel->getCart();
        $_SESSION['carts'] = $carts;
    }
}