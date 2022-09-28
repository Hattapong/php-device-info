<?php

require_once('./db/database.php');

if ($_GET['model_id']) {
    $devices = Database::getTable('select * from device where model_id = ?', [$_GET['model_id']]);

    $options = [];

    foreach ($devices as $k => $device) {
        // var_dump($device);
        array_push($options, "<option value='" . $device['id'] . "'>" . $device['sn'] . "</option>");
    }

    echo json_encode(array_map('utf8_encode', $options));
} else {

    echo '[]';
}