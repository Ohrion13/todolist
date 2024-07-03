<?php

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
