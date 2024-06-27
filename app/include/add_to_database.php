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

    if (!isset($_POST['priority']) || !is_numeric($_POST['priority']) || $_POST['priority'] < 0 || $_POST['priority'] > 6) {
        $errorsList[] = 'Merci de saisir une priorité entre 1 et 5';
    }

    if (empty($errorsList)) {

        $insert = $dbtodolist->prepare("INSERT INTO task(priority, text, task_date, status) VALUES (:priority, :text, CURDATE(), :status)");

        $insert->execute(
            [':priority' => strip_tags($_POST['priority']), ':text' => strip_tags($_POST['text']), ':status' => strip_tags($_POST['status'])]
        );
    }
}
