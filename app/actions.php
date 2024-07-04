<?php

include 'include/config.php';
include 'include/functions.php';
include 'include/task.php';

if (!isset($_REQUEST['action'])) {
    redirectTo('index.php');
}

flawsCsrf();


// add_to_database

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

    if (empty($errorsList)) {

        $insert = $dbtodolist->prepare("INSERT INTO task(priority, text, task_date, status) VALUES (0, :text, CURDATE(), :status)");

        $insert->execute(
            [':text' => strip_tags($_POST['text']), ':status' => strip_tags($_POST['status'])]
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


// end_task

if (!empty($_GET) && isset($_GET['action']) && $_GET['action'] === 'end' && isset($_GET['id']) && is_numeric($_GET['id'])) {

    // flawsCsrf();

    $query = $dbtodolist->prepare("UPDATE task SET status = 'terminer' WHERE Id_task = :id;");

    $query->execute(['id' => intval($_GET['id'])]);

}

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


// modify_task

if (!empty($_GET) && isset($_GET['action']) && $_GET['action'] === 'modify' && isset($_GET['id']) && is_numeric($_GET['id'])) {

    // flawsCsrf();

    $id = $_GET['id'];

    header('Location: http://localhost:8080/include/form_modify_task.php?action=modify&id=' . $id);
    exit;
}


// form_modify_task

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


// delete_task

if (!empty($_GET) && isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id']) && is_numeric($_GET['id'])) {

    // flawsCsrf();

    $query = $dbtodolist->prepare("DELETE FROM task WHERE id_task = :id;");

    $query->execute(['id' => intval($_GET['id'])]);
}

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


// change_display_order

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

}


if (isset($_GET['action']) && $_GET['action'] === 'decrease' && isset($_GET['id']) && is_numeric($_GET['id'])) {
    
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


// recover_database

$query = $dbtodolist->prepare("SELECT id_task, priority, text, task_date, status FROM task WHERE status <> 'terminer' ORDER BY priority ASC ;");
$query->execute();
$result = $query->fetchAll();

foreach ($result as $task) {
    echo '<tr>';
    echo '<td>';
    echo '<a href="?action=increase&id=' . $task['id_task'] . '">⬆️</a>';
    echo '<a href="?action=decrease&id=' . $task['id_task'] . '">⬇️</a>';
    echo '</td>';
    echo '<td scope="row">' . ($task['priority']) . '</td>';
    echo '<td>' . ($task['text']) . '</td>';
    echo '<td>' . ($task['task_date']) . '</td>';
    echo '<td>' . ($task['status']) . '</td>';
    echo '<td>';
    echo '<a class="btn" href="?action=modify&id=' . $task['id_task'] . '">Modifier</a>';
    echo '<a class="btn" href="?action=end&id=' . $task['id_task'] . '">Terminer</a>';
    echo '<a class="btn" href="?action=delete&id=' . $task['id_task'] . '">Supprimer</a>';
    echo '</td>';
    echo '</tr>';
}

?>


?>