<?php

namespace config;

use Exception;
use mysqli;

require_once 'config_db.php';
class Database
{
    private  $connection = null;

    public function __construct()
    {
        try {
            $this->connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE_NAME);

            if ( mysqli_connect_errno()) {
                echo "Could not connect to database.";
            }
        } catch (Exception $e) {
            echo  $e->getMessage();
        }
    }
    public function get_connection(): ?mysqli
    {
        return $this -> connection;
    }

}