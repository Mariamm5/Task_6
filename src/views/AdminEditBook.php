<?php
session_start();
if(isset($_SESSION['admin'])): ?>

    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Edit Book</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>

    <div class="container mt-5">
        <a href="/admin/dashboard/adminBooksList" class="btn btn-secondary mb-3">Back to Books List</a>
        <h1 class="mb-4">Edit Book</h1>
        <form action="/admin/booksList/editBook" method="POST" enctype="multipart/form-data">
            <h2>Book ID is: <?=  $_POST['book_id'] ?></h2>
            <span style="display: none"> <?php  $_SESSION["book_id"] = $_POST['book_id']?></span>
            <div class="form-group">
                <label for="newTitle">Book Title</label>
                <input type="text" class="form-control" id="newTitle" name="newTitle" placeholder="Enter new title"
                       required>
            </div>
            <div class="form-group">
                <label for="newAuthor">Author</label>
                <input type="text" class="form-control" id="newAuthor" name="newAuthor" placeholder="Enter new author"
                       required>
            </div>
            <div class="form-group">
                <label for="newDescription">Description</label>
                <input type="text" class="form-control" id="newDescription" name="newDescription" required
                       placeholder="Enter new description">
            </div>
            <div class="form-group">
                <label for="newPrice">Price</label>
                <input type="text" class="form-control" id="newPrice" name="newPrice" placeholder="Enter new price"
                       required>
            </div>
            <div class="form-group">
                <label for="newImg">Image</label>
                <input type="file" class="form-control-file" id="newImg" name="newImg" required>
            </div>
            <input type="submit" class="btn btn-primary" name="edited" value="Save Edited Book" >
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    </body>
    </html>
<?php
else:
    header("Location: /admin/login" );
endif;
?>

