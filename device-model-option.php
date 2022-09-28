<?php

require_once('./db/database.php');

if ($_GET['brand_id']) {
    $models = Database::getTable('select * from device_model where brand_id = ?', [$_GET['brand_id']]);

    $options = [];

    foreach ($models as $k => $model) {
        array_push($options, "<option value='" . $model['id'] . "'>" . $model['name'] . "</option>");
    }

    echo json_encode(array_map('utf8_encode', $options));
} else {

    echo '[]';
}