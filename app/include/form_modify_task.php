<?php

include 'task.php';
include 'security.php';
include 'functions.php';


if (!empty($_POST)) {

    $text = strip_tags($_POST['text']);
    $status = strip_tags($_POST['status']);
    $reminder_date = strip_tags($_POST['reminder_date']);

    $query = $dbtodolist->prepare("UPDATE task SET text = :text, status = :status, reminder_date = :reminder_date WHERE id_task = :id");

    $query->execute(
        [':text' => $text, ':status' => $status, ':reminder_date' => $reminder_date, ':id' => intval($_GET['id'])]
    );
    
    redirectTo('http://localhost:8080/index.php');
}


if (!empty($_GET) && isset($_GET['action']) && $_GET['action'] === 'modify' && isset($_GET['id']) && is_numeric($_GET['id'])) {

    // flawsCsrf();

    $query = $dbtodolist->prepare("SELECT id_task, text, status, reminder_date FROM task WHERE Id_task = :id;;");
    $query->execute(['id' => intval($_GET['id'])]);
    $result = $query->fetch();

    $text = strip_tags($result['text']);
    $status = strip_tags($result['status']);
    $reminder_date = strip_tags($result['reminder_date']);

    echo '<form action="" method="post">';
    echo '<div>';

    echo '<label for="text">Tâches</label>';
    echo '<input name="text" id="text" value = "' . $text . '" />';

    echo '<label class="form-label" for="status">Status</label>';
    echo '<input name="status" id="status" value = "' . $status . '" />';

    echo '<label for="reminder_date">Date de rappel</label>';
    echo '<input type="date" name="reminder_date" id="reminder_date" value = "' . $reminder_date . '" />';

    echo '</div>';

    echo '<button type="submit">Confirmer modification</button>';

    echo '</form>';
}
