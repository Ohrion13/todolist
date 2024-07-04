<?php

$dbtodolist->beginTransaction();

try {

    if (isset($_GET['action']) && $_GET['action'] === 'increase' && isset($_GET['id']) && is_numeric($_GET['id'])) {

        $query = $dbtodolist->prepare("SELECT id_task FROM task WHERE priority = (
            SELECT priority - 1 FROM task WHERE id_task = :id
        );");
        $query->execute(['id' => intval($_GET['id'])]);

        $idToMove = intval($query->fetchColumn());

        if ($idToMove !== false) {
            $queryUpdate = $dbtodolist->prepare("UPDATE task SET priority = priority + 1 WHERE id_task = :id;");
            $queryUpdate->execute(['id' => $idToMove]);
        }

        $queryUpdate = $dbtodolist->prepare("UPDATE task SET priority = priority - 1 WHERE id_task = :id;");
        $isUpdateOk = $queryUpdate->execute(['id' => intval($_GET['id'])]);

    } elseif (isset($_GET['action']) && $_GET['action'] === 'decrease' && isset($_GET['id']) && is_numeric($_GET['id'])) {

        $query = $dbtodolist->prepare("SELECT id_task FROM task WHERE priority = (
            SELECT priority + 1 FROM task WHERE id_task = :id
        );");
        $query->execute(['id' => intval($_GET['id'])]);

        $idToMove = intval($query->fetchColumn());

        if ($idToMove !== false) {
            $queryUpdate = $dbtodolist->prepare("UPDATE task SET priority = priority - 1 WHERE id_task = :id;");
            $queryUpdate->execute(['id' => $idToMove]);
        }

        $queryUpdate = $dbtodolist->prepare("UPDATE task SET priority = priority + 1 WHERE id_task = :id;");
        $isUpdateOk = $queryUpdate->execute(['id' => intval($_GET['id'])]);
    }

} catch (Exception $e) {
    $dbtodolist->rollBack();
}
