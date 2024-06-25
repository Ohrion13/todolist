<?php

$query = $dbtodolist->prepare("SELECT priority, text, task_date, status FROM task;");
$query->execute();
$result = $query->fetchAll();

foreach ($result as $task) {
    echo '<tr>';
    echo '<th scope="row">' . ($task['priority']) . '</th>';
    echo '<td>' . ($task['text']) . '</td>';
    echo '<td>' . ($task['task_date']) . '</td>';
    echo '<td>' . ($task['status']) . '</td>';
    echo '<td>';
    echo '<button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-success ms-1">Terminer</button>';
    echo '<button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-danger">Supprimer</button>';
    echo '</td>';
    echo '</tr>';
}

?>