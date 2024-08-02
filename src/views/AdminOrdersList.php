<?php
session_start();
$orders = $_SESSION['orders'];
if (isset($_SESSION['admin'])): ?>

    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Orders List</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
    <div class="container mt-5">
        <h1 class="mb-4">Orders List</h1>
        <?php foreach ($orders as $order): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">User Information</h5>
                    <div class="mb-4">
                        <p class="card-text"><strong>Full Name:</strong> <?= htmlspecialchars($order['full_name']) ?></p>
                        <p class="card-text"><strong>Email:</strong> <?= htmlspecialchars($order['email']) ?></p>
                        <p class="card-text"><strong>Phone Number:</strong> <?= htmlspecialchars($order['number']) ?></p>
                        <p class="card-text"><strong>Address Info:</strong> <?= htmlspecialchars($order['city'] . " " . $order['address']) ?></p>
                    </div>
                    <h5 class="card-title">Order Information</h5>
                    <div>
                        <p class="card-text"><strong>Book ID:</strong> <?= $order['book_id'] ?></p>
                        <p class="card-text"><strong>Ordered Time:</strong> <?= $order['order_date'] ?></p>
                        <p class="card-text"><strong>Total Quantity:</strong> <?= $order['quantity'] ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
    </html>
<?php
else:
    header("Location: AdminLogin.php");
endif;
?>
