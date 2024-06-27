<?php

if (!empty($_GET) && isset($_GET['action']) && $_GET['action'] === 'modify' && isset($_GET['id']) && is_numeric($_GET['id'])) {

    // flawsCsrf();

    $id = $_GET['id'];

    header('Location: http://localhost:8080/include/form_modify_task.php?action=modify&id=' . $id);
    exit;
}

?>