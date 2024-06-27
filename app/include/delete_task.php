<?php

if (!empty($_GET) && isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id']) && is_numeric($_GET['id'])) {

    // flawsCsrf();

    $query = $dbtodolist->prepare("DELETE FROM task WHERE id_task = :id;");

    $query->execute(['id' => intval($_GET['id'])]);

}

?>