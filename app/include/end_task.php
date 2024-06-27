<?php

if (!empty($_GET) && isset($_GET['action']) && $_GET['action'] === 'end' && isset($_GET['id']) && is_numeric($_GET['id'])) {

    // flawsCsrf();

    $query = $dbtodolist->prepare("UPDATE task SET status = 'terminer' WHERE Id_task = :id;");

    $query->execute(['id' => intval($_GET['id'])]);

}

?>