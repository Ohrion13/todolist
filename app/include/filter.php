<?php

if (isset($_POST['Filtre'])) {

    if (isset($_POST['Filtre']) && $_POST['Filtre'] === "0") {

        $query = $dbtodolist->prepare("SELECT id_task, priority, text, task_date, status FROM task ORDER BY task_date ASC");
        $query->execute();
        $result = $query->fetchALL();
        
    } elseif (isset($_POST['Filtre']) && $_POST['Filtre'] === "1") {
        $query = $dbtodolist->prepare("SELECT id_task, priority, text, task_date, status FROM task ORDER BY priority ASC");
        $query->execute();
        $result = $query->fetchALL();
    };

}
