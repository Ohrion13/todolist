<?php

if (isset($_POST['Filtre'])) {

    if (isset($_POST['Filtre']) && $_POST['Filtre'] === "0") {

        $query = $dbtodolist->prepare("SELECT id_task, priority, text, task_date, status, reminder_date FROM task WHERE status === 'terminer' ORDER BY priority ASC ;");
        $query->execute();
        $result = $query->fetchAll();
        
        $current_date = date('Y-m-d');
        
        foreach ($result as $task) {
            $reminder_date = $task['reminder_date'];
        
            if ($reminder_date === $current_date) {
                $reminder_class = 'reminder-today';
            } else {
                $reminder_class = '';
            }
            
            
            echo '<tr>';
            echo '<td>';
            echo '<a href="?action=increase&id=' . $task['id_task'] . '">⬆️</a>';
            echo '<a href="?action=decrease&id=' . $task['id_task'] . '">⬇️</a>';
            echo '</td>';
            echo '<td scope="row">' . ($task['priority']) . '</td>';
            echo '<td>' . ($task['text']) . '</td>';
            echo '<td>' . ($task['task_date']) . '</td>';
            echo '<td>' . ($task['status']) . '</td>';
            echo '<td class="' . $reminder_class . '">' . ($task['reminder_date']) . '</td>';
            echo '<td>';
            echo '<a class="btn" href="?action=modify&id=' . $task['id_task'] . '">Modifier</a>';
            echo '<a class="btn" href="?action=end&id=' . $task['id_task'] . '">Terminer</a>';
            echo '<a class="btn" href="?action=delete&id=' . $task['id_task'] . '">Supprimer</a>';
            echo '</td>';
            echo '</tr>';
        }

    } elseif (isset($_POST['Filtre']) && $_POST['Filtre'] === "1") {

        $query = $dbtodolist->prepare("SELECT id_task, priority, text, task_date, status, reminder_date FROM task WHERE status <> 'terminer' ORDER BY priority ASC ;");
        $query->execute();
        $result = $query->fetchAll();

        $current_date = date('Y-m-d');

        foreach ($result as $task) {
            $reminder_date = $task['reminder_date'];

            if ($reminder_date === $current_date) {
                $reminder_class = 'reminder-today';
            } else {
                $reminder_class = '';
            }


            echo '<tr>';
            echo '<td>';
            echo '<a href="?action=increase&id=' . $task['id_task'] . '">⬆️</a>';
            echo '<a href="?action=decrease&id=' . $task['id_task'] . '">⬇️</a>';
            echo '</td>';
            echo '<td scope="row">' . ($task['priority']) . '</td>';
            echo '<td>' . ($task['text']) . '</td>';
            echo '<td>' . ($task['task_date']) . '</td>';
            echo '<td>' . ($task['status']) . '</td>';
            echo '<td class="' . $reminder_class . '">' . ($task['reminder_date']) . '</td>';
            echo '<td>';
            echo '<a class="btn" href="?action=modify&id=' . $task['id_task'] . '">Modifier</a>';
            echo '<a class="btn" href="?action=end&id=' . $task['id_task'] . '">Terminer</a>';
            echo '<a class="btn" href="?action=delete&id=' . $task['id_task'] . '">Supprimer</a>';
            echo '</td>';
            echo '</tr>';
        }
    };
}
