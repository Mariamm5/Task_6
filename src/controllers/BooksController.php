<?php
session_start();
require __DIR__ . '/../../Database.inc';
require __DIR__ . '/../models/BookModel.php';

class BooksController
{
    private $bookModel;


    public function __construct()
    {

        $dataBase = new Database();
        $this->bookModel = new BookModel($dataBase->getConnection());
    }

    public function getAllBooks()
    {
        $_SESSION['books'] = $this->bookModel->getAllBooks();
        require __DIR__ . "/../views/AdminBooksList.php";
    }

    public function getBooks()
    {
        $_SESSION['books'] = $this->bookModel->getAllBooks();
        require __DIR__ . "/../views/BooksList.php";
    }

    public function showBookById($id)
    {
        $_SESSION['bookById'] = $this->bookModel->getBookById($id);
        require __DIR__ . '/../views/BookInfo.php';
    }
    public
    function editBook()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_id'])) {
            $bookId = $_POST['book_id'];
            $this->bookModel->editBook($bookId);
            require __DIR__ . '/../views/AdminEditBook.php';
        }
    }


    public
    function saveEditBook()
    {

        if (isset($_POST['edited'])) {
            if (isset($_FILES['newImg'])) {
                $id = $_SESSION["book_id"];
                $newTitle = $_POST['newTitle'];
                $newAuthor = $_POST['newAuthor'];
                $newDescription = $_POST['newDescription'];
                $newPrice = $_POST['newPrice'];
                $uploadDir = __DIR__ . "/../assets/img/";
                $newImgPath = $uploadDir . basename($_FILES['newImg']['name']);
                move_uploaded_file($_FILES['newImg']['tmp_name'], $newImgPath);
                $this->bookModel->saveEditedBook($newTitle, $newAuthor, $newDescription, $newPrice, $newImgPath, $id);
            }
            echo
            "<script>
                     alert('Book updated successfully!');
                </script>";
            header("Location:/admin/dashboard/adminBooksList");
        }


    }

    public
    function deleteBook()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_id'])) {
            $bookId = $_POST['book_id'];
            $result = $this->bookModel->deleteBook($bookId);

            if ($result) {
                header("Location: /admin/dashboard/adminBooksList");
            } else {
                echo "Failed to delete the book.";
            }
        } else {
            echo "Invalid request.";
        }
    }

    public
    function addBook()
    {
        if (isset($_POST['addBook'])) {
            $title = $_POST['title'];
            $author = $_POST['author'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $imgPath = '';

            if (isset($_FILES['img'])) {
                $uploadDir = __DIR__ . "/../assets/img/";
                $imgPath = $uploadDir . basename($_FILES['img']['name']);
                move_uploaded_file($_FILES['img']['tmp_name'], $imgPath);
            }
            if ($this->bookModel->addBook($title, $author, $description, $price, $imgPath)) {
                echo
                "<script>
            alert('Book added successfully!');
                </script>";
                header("Location:/admin/dashboard/adminBooksList");
            } else {
                echo "Failed to add book.";
            }


        }


    }


}