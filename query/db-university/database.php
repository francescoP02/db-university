<?php

$conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);

if ($conn && $conn->connect_error) {
    echo 'DB Connection Error' . $conn->connect_error;
    die();
}