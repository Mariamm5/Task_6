<?php
require __DIR__ . '/../../Database.inc';
require __DIR__ . '/../models/OrderModel.php';

class OrdersController
{

    private $orderModel;


    public function __construct()
    {

        $dataBase = new Database();
        $this->orderModel = new OrderModel($dataBase->getConnection());
    }

    public function addOrder($id)
    {
        if (isset($_POST['order'])) {
            $full_name = $_POST['full_name'];
            $email = $_POST['email'];
            $number = $_POST['number'];
            $city = $_POST['city'];
            $address = $_POST['address'];
            $postal = $_POST['postal'];
            $quantity = $_POST['quantity'];
            $book_id = $id;
            $this->orderModel->addOrder($full_name, $email, $number, $city, $address, $postal, $quantity, $book_id);

        }
    }

    public function getOrderInfo()
    {
        return $this->orderModel->getOrderInfo();
    }

}