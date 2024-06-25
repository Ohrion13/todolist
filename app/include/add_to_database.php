<?php

if (
    isset($_POST['text'])
    && strlen($_POST['text']) > 0
    && strlen($_POST['text']) <= 50
    && strlen($_POST['status']) > 0
    && strlen($_POST['status']) <= 50
    && ($_POST['priority']) > 0
    && ($_POST['priority']) <= 5

) {

    $insert = $dbtodolist->prepare("INSERT INTO task(priority, text, task_date, status) VALUES (:priority, :text, CURDATE(), :status)");

    $insert->execute(
        [':priority' => strip_tags($_POST['priority']), ':text' => strip_tags($_POST['text']), ':status' => strip_tags($_POST['status'])]
    );
}

?>