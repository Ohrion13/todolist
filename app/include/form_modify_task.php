<?php

include 'task.php';
include 'security.php';
include 'functions.php';


if (!empty($_POST)) {

    $text = strip_tags($_POST['text']);
    $status = strip_tags($_POST['status']);

    $query = $dbtodolist->prepare("UPDATE task SET text = :text, status = :status WHERE id_task = :id");

    $query->execute(
        [':text' => $text, ':status' => $status, ':id' => intval($_GET['id'])]
    );
    
    redirectTo('http://localhost:8080/index.php');
}


if (!empty($_GET) && isset($_GET['action']) && $_GET['action'] === 'modify' && isset($_GET['id']) && is_numeric($_GET['id'])) {

    // flawsCsrf();

    $query = $dbtodolist->prepare("SELECT id_task, text, status FROM task WHERE Id_task = :id;;");
    $query->execute(['id' => intval($_GET['id'])]);
    $result = $query->fetch();

    $text = strip_tags($result['text']);
    $status = strip_tags($result['status']);

    echo '<form action="" method="post">';
    echo '<div>';

    echo '<label for="text">Tâches</label>';
    echo '<input name="text" id="text" value = "' . $text . '" />';

    echo '<label class="form-label" for="status">Status</label>';
    echo '<input name="status" id="status" value = "' . $status . '" />';

    echo '</div>';

    echo '<button type="submit">Confirmer modification</button>';

    echo '</form>';
}
