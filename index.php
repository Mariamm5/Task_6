<?php
require 'vendor/autoload.php';
session_start();
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];

switch ($requestUri) {
    case '/':
        require 'src/controllers/HomeController.php';
        $controller = new HomeController();
        $controller->homePage();
        break;
    case '/admin/login':
        require 'src/controllers/AdminController.php';
        $controller = new AdminController();
        if ($requestMethod === 'GET') {
            $controller->adminLogin();
        } elseif ($requestMethod === 'POST') {
            $controller->login();
        }
        break;
    case"/admin/dashboard":
        require "src/controllers/BooksController.php";
        if ($requestMethod === 'GET') {
            require "src/controllers/AdminController.php";
            $controller = new AdminController();
            $controller->dashboard();
        } elseif ($requestMethod === 'POST' && $requestUri === '/admin/dashboard') {
            $controller = new BooksController();
            $controller->addBook();
        }
        break;
    case "/admin/dashboard/logOut":
        require 'src/controllers/AdminController.php';
        $controller = new AdminController();
        $controller->logout();
        break;
    case '/admin/dashboard/adminBooksList':
        include 'src/controllers/BooksController.php';
        $controller = new BooksController();
        $controller->getAllBooks();
        break;
    case '/admin/booksList/editBook':
        include "src/controllers/BooksController.php";
        $controller = new BooksController();
        $controller->editBook();
        if ($requestMethod === 'POST') {
            $controller->saveEditBook();
        }
        break;
    case'/admin/booksList/deleteBook':
        include 'src/controllers/BooksController.php';
        $controller = new BooksController();
        $controller->deleteBook();
        break;
    case '/books':
        require 'src/controllers/BooksController.php';
        $controller = new BooksController();
        $controller->getBooks();
        break;
    case '/books/bookInfo':
        include 'src/controllers/BooksController.php';
        $controller = new BooksController();
        if (isset($_GET['id'])) {
            $controller->showBookById($_GET['id']);
        } else {
            echo "Book ID is missing.";
        }
        break;
//    case '/admin/BooksList':
//        require 'src/controllers/AdminController.php';
//        $controller = new AdminController();
//        $controller->addedBook();
//        break;
    case "/books/orders":
        require 'src/views/MakeOrder.php';
        break;
    case '/books/makeorder':
        if (isset($_SESSION['order_book_id'])) {
            require 'src/controllers/OrdersController.php';
            $controller = new OrdersController();
            $controller->addOrder($_SESSION['order_book_id']);
            header("Location:/books");
        } else {
            echo "Book Not found!";
        }
        break;
    case '/books/addtocart':
        require 'src/controllers/CartController.php';
        if ($requestMethod === 'POST') {

            $controller = new CartController();
            $controller->addCart();
        }
        break;
    case "/books/wishlist":
        echo "WishList";
        break;


    default:
        http_response_code(404);
        echo "Page not found";
        exit;
}

//switch ($requestMethod) {
//    case 'GET':
//        $controller->get();
//        break;
////    case 'POST':
////        $controller->post();
////        break;
//    // Add more methods as needed
//    default:
//        http_response_code(405);
//        echo "Method not allowed";
//        exit;
//}