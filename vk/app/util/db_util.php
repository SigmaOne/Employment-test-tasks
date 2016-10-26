<?php

define('DB_NAME', "highload_test_db");

function getDBConnection($dbname) {
    $servername = "localhost";
    $username = "root";
    $password = getenv("MYSQL_ROOT_PASSWORD");

    if ($dbname == null) {
        $conn = mysqli_connect($servername, $username, $password);
    } else {
        $conn = mysqli_connect($servername, $username, $password, $dbname);
    }

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_error($conn) . PHP_EOL);
    }  

    return $conn;
}

function createSchema() {
    // Create db
    $conn = getDBConnection(null);
    $sql = "create database " . DB_NAME;

    if (mysqli_query($conn, $sql)) {
        echo "Database created successfully" . PHP_EOL;
    } else {
        die("Error creating database: " . mysqli_error($conn) . PHP_EOL);
    }

    mysqli_close($conn);

    // Create table
    $conn = getDBConnection(DB_NAME);
    $sql = "create table products(
                id int(6) unsigned auto_increment primary key,
                name varchar(30) not null,
                description varchar(255) not null,
                price int not null,
                url varchar(255) not null
            )";

    if (mysqli_query($conn, $sql)) {
        echo "Schema created successfully" . PHP_EOL;
    } else {
        die("Error creating products table: " . mysqli_error($conn) . PHP_EOL);
    }

    mysqli_close($conn);
}

function dropSchema() {
    $conn = getDBConnection(DB_NAME);

    $sql = "drop database " . DB_NAME;
    if (mysqli_query($conn, $sql)) {
        echo "Database dropped successfully" . PHP_EOL;
    } else {
        // don't die() because so
        echo "Error dropping products table: " . mysqli_error($conn) . PHP_EOL;
    }

    mysqli_close($conn);
}

?>
