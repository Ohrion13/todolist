<?php

try {
    $dbtodolist = new PDO(
        'mysql:host=db;dbname=todolist;charset=utf8',
        'user1',
        'Newpassword1'
    );

    $todolist->setAttribute(
        PDO::ATTR_DEFAULT_FETCH_MODE,
        PDO::FETCH_ASSOC
    );
} catch (Exception $e) {
    die('Unable to connect to the database.
    ' . $e->getMessage());
}

$query = $dbtodolist->prepare("SELECT text FROM task;");

$query->execute();

$result = $query->fetchAll();

var_dump($result);






?>