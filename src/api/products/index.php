<?php
require_once __DIR__.'/ProductApi.php';
try {
    $api = new \api\products\ProductApi();
    echo $api->run();
} catch (Exception $e) {
    echo json_encode(Array('error' => $e->getMessage()));
}