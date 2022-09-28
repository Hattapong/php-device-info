<?php
if (!$_POST) header('location:customer.php');

session_start();
require_once('./db/database.php');

try {
    $lastid = Database::addCustomer($_POST['customer_name']);
    $_SESSION['add'] = true;
} catch (\Throwable $th) {
    $_SESSION['add'] = false;
}

header('location:customer.php');
session_destroy();