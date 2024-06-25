<?php

try {
    $dbtodolist = new PDO(
        'mysql:host=db;dbname=todolist;charset=utf8',
        'user1',
        'Newpassword1'
    );

    $dbtodolist->setAttribute(
        PDO::ATTR_DEFAULT_FETCH_MODE,
        PDO::FETCH_ASSOC
    );
} catch (Exception $e) {
    die('Unable to connect to the database.
    ' . $e->getMessage());
}

session_start();

if (!isset($_SESSION['myToken'])) {
    $_SESSION['myToken'] = md5(uniqid(mt_rand(), true));
}

?>