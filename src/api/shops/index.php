<?php

use api\shops\ShopApi;
require_once 'ShopApi.php';
try {
    $api = new ShopApi();
    echo $api->run();
} catch (Exception $e) {
    echo json_encode(Array('error' => $e->getMessage()));
}