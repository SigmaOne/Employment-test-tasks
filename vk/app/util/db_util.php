<?php
define('DB_NAME', "highload_test_db");

function getDbConnection($dbname) {
    $servername = "localhost";
    $username = "root";
    $password = getenv("MYSQL_ROOT_PASSWORD");

    if ($dbname == null) {
        $connection = mysqli_connect($servername, $username, $password);
    } else {
        $connection = mysqli_connect($servername, $username, $password, $dbname);
    }

    // Check connection
    if (!$connection) {
        die("Connection failed: " . mysqli_error($connection) . PHP_EOL);
    }  

    return $connection;
}

function closeDbConnection($connection) {
    mysqli_close($connection);
}

function createSchema() {
    // Create db
    $connection = getDbConnection(null);
    $sql = "create database " . DB_NAME;

    if (mysqli_query($connection, $sql)) {
        echo "Database created successfully" . PHP_EOL;
    } else {
        die("Error creating database: " . mysqli_error($connection) . PHP_EOL);
    }

    mysqli_close($connection);

    // Create table
    $connection = getDbConnection(DB_NAME);
    $sql = "create table products(
                id int(6) unsigned auto_increment primary key,
                name varchar(30) not null,
                description varchar(255) not null,
                price int not null,
                img_url varchar(255) not null
            )";

    if (mysqli_query($connection, $sql)) {
        echo "Schema created successfully" . PHP_EOL;
    } else {
        die("Error creating products table: " . mysqli_error($connection) . PHP_EOL);
    }

    mysqli_close($connection);
}

function dropSchema() {
    $connection = getDbConnection(DB_NAME);

    $sql = "drop database " . DB_NAME;
    if (mysqli_query($connection, $sql)) {
        echo "Database dropped successfully" . PHP_EOL;
    } else {
        // don't die() because so
        echo "Error dropping products table: " . mysqli_error($connection) . PHP_EOL;
    }

    mysqli_close($connection);
}
