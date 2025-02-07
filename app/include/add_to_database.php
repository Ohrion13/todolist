<?php

$errorsList = [];

if (isset($_POST['submitTask'])) {

    if (!isset($_POST['text']) || strlen($_POST['text']) === 0) {
        $errorsList[] = 'Saisissez un nom de tâche valide';
    }

    if (strlen($_POST['text']) > 50) {
        $errorsList[] = 'Merci saisir 50 caractères maximums';
    }

    if (!isset($_POST['status']) || strlen($_POST['status']) === 0) {
        $errorsList[] = 'Saisissez un status valide';
    }

    if (strlen($_POST['status']) > 50) {
        $errorsList[] = 'Merci saisir 50 caractères maximums';
    }

    if (!isset($_POST['reminder_date']) || empty($_POST['reminder_date'])) {
        $errorsList[] = 'Merci de choisir une date de rappel';
    }

    if (empty($errorsList)) {

        $insert = $dbtodolist->prepare("INSERT INTO task(priority, text, task_date, status, reminder_date) VALUES (0, :text, CURDATE(), :status, :reminder_date)");

        $insert->execute(
            [':text' => strip_tags($_POST['text']), ':status' => strip_tags($_POST['status']), ':reminder_date' => strip_tags($_POST['reminder_date'])]
        );

        $update = $dbtodolist->prepare("
            UPDATE task t 
            JOIN (SELECT id_task, ROW_NUMBER() OVER (ORDER BY task_date ASC) AS new_priority
                FROM task
                WHERE status <> 'terminer'
            ) AS ranked_tasks
            ON t.id_task = ranked_tasks.id_task
            SET t.priority = ranked_tasks.new_priority;
        ");

        $update->execute();
    }
}
