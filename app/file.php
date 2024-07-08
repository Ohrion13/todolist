<?php
session_start();

include 'include/task.php';
include 'include/security.php';
include 'include/config.php';

header('Content-type:application/json');

if (!isset($_REQUEST['action'])) {
    triggerError('no_action');
}

preventCSRFAPI();

if ($_REQUEST['action'] === 'end' && isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) {

    $query = $dbtodolist->prepare("UPDATE task SET status = 'terminer' WHERE Id_task = :id;");
    $isEndOk = $query->execute(['id' => intval($_REQUEST['id'])]);

    if (!$isEndOk) triggerError('modify_ko');

    echo json_encode([
        'isOk' => $isEndOk,
        'id' => intval($_REQUEST['id']),
    ]);
}


if ($_REQUEST['action'] === 'delete' && isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) {

    $query = $dbtodolist->prepare("DELETE FROM task WHERE id_task = :id;");
    $isDeleteOk = $query->execute(['id' => intval($_REQUEST['id'])]);

    if (!$isDeleteOk) triggerError('modify_ko');

    echo json_encode([
        'isOk' => $isDeleteOk,
        'id' => intval($_REQUEST['id']),
    ]);
}
