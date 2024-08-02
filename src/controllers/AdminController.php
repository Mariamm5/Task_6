<?php

namespace User\Task6\Controllers;
session_start();

class AdminController
{
    public function adminLogin()
    {
        include __DIR__ . "/../views/AdminLogin.php";
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['username'];
            $password = $_POST['password'];
            if ($name === 'admin' && $password === 'admin') {
                $_SESSION['admin'] = true;
                header("Location:/admin/dashboard");
            } else {
                header("Location:/admin/login");
            }
        }
    }

    public function dashboard()
    {
        include __DIR__ . "/../views/Dashboard.php";
    }

    public function logout()
    {
        unset($_SESSION['admin']);
        session_destroy();
        header("Location:/admin/login");
    }

}