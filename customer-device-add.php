<?php

// print_r(get_defined_vars());
require_once('./db/database.php');

if ($_POST) {

    $sn = $_POST['sn'];
    $customer_id = $_POST['customer_id'];


    Database::execute("INSERT INTO `customer_device` (`customer_id`, `device_id`) VALUES (?, ?)", [$customer_id, $sn]);
}


header("location:customer-detail.php?id=$customer_id");