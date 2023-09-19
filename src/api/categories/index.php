<?php

use api\categories\CategoryApi;
require_once 'CategoryApi.php';
try {
    $api = new CategoryApi();
    echo $api->run();
} catch (Exception $e) {
    echo json_encode(Array('error' => $e->getMessage()));
}