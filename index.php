<?php
require 'vendor/autoload.php';

use User\Task6\Controllers\BooksController;
use User\Task6\Controllers\AdminController;
use User\Task6\Controllers\OrdersController;
use User\Task6\Controllers\CartController;
use User\Task6\Controllers\HomeController;

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];
$adminController = new AdminController();
$bookController = new BooksController();
$orderController = new OrdersController();
$cartController = new CartController();
$homeController = new HomeController();

switch ($requestUri) {
    case '/':
        $homeController->homePage();
        break;
    case '/admin/login':
        if ($requestMethod === 'GET') {
            $adminController->adminLogin();
        } elseif ($requestMethod === 'POST') {
            $adminController->login();
        }
        break;
    case"/admin/dashboard":
        if ($requestMethod === 'GET') {
            $adminController->dashboard();
        } elseif ($requestMethod === 'POST' && $requestUri === '/admin/dashboard') {
            $adminController->addedBook();
            $bookController->addBook();
        }
        break;
    case "/admin/dashboard/logOut":
        $adminController->logout();
        break;
    case '/admin/dashboard/adminBooksList':
        $bookController->getAllBooks();
        break;
    case '/admin/booksList/editBook':
        $bookController->editBook();
        if ($requestMethod === 'POST') {
            $bookController->saveEditBook();
        }
        break;
    case'/admin/booksList/deleteBook':
        $bookController->deleteBook();
        break;
    case '/books':
        $bookController->getBooks();
        break;
    case '/books/bookInfo':
        if (isset($_GET['id'])) {
            $bookController->showBookById($_GET['id']);
        } else {
            echo "Book ID is missing.";
        }
        break;
    case "/books/orders":
        require 'src/views/MakeOrder.php';
        break;
    case '/books/makeorder':
        if (isset($_SESSION['order_book_id'])) {
            $orderController->addOrder($_SESSION['order_book_id']);
            header("Location:/books");
        } else {
            echo "Book Not found!";
        }
        break;
    case '/books/addtocart':
        if ($requestMethod === 'POST') {
            $cartController->addCart();
        }
        break;
    case "/books/wishlist":
        require 'src/views/WishList.php';
        $cartController->getCart();
        break;
    case '/admin/dashboard/ordersList':
        require 'src/views/AdminOrdersList.php';
        $orderController->getOrderInfo();
        break;
    default:
        http_response_code(404);
        echo "Page not found";
}