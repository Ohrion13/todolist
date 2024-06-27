<?php

$query = $dbtodolist->prepare("SELECT id_task, priority, text, task_date, status FROM task WHERE status <> 'terminer' ;");
$query->execute();
$result = $query->fetchAll();

foreach ($result as $task) {
    echo '<tr>';
    echo '<th scope="row">' . ($task['priority']) . '</th>';
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
