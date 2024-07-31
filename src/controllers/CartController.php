<?php
require __DIR__ . '/../../Database.inc';
require __DIR__ . '/../models/CartModel.php';

class CartController
{

    private $cartModel;
    private $database;

    public function __construct()
    {

        $this->database = new Database();
        $this->cartModel = new CartModel($this->database);

    }

    public function addCart()
    {
        if (isset($_POST['id']) && isset($_POST['title']) && isset($_POST['price'])) {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $price = $_POST['price'];
            $quantity = isset($_POST['quantity']);

            // Log data for debugging
            error_log("ID: $id, Title: $title, Price: $price, Quantity: $quantity");

            if ($this->cartModel->addCart($id, $title, $price, $quantity)) {
                echo json_encode(['success' => true, 'message' => 'Book added to cart.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to add book to cart.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Missing parameters.']);
        }
    }

}