<?php
include 'include/task.php';
include 'include/security.php';

if (isset($_SESSION['error'])) {
    echo '<p>' . $errors[$_SESSION['error']] . '</p>';
    unset($_SESSION['error']);
}

if (!empty($_POST)) {

    // flawsCsrf();

    include 'include/add_to_database.php';
}

include 'include/end_task.php';

include 'include/modify_task.php';

include 'include/delete_task.php';


?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Mytodolist</title>
</head>

<body>
    <section>
        <div class="container">
            <div>
                <div>
                    <div class="card">
                        <div class="card-body">

                            <h1 class="title">Mytodolist</h1>

                            <form action="" method="post">
                                <div>
                                    <label for="text">Tâches</label>
                                    <input type="text" name="text" id="text" class="form-control" placeholder="Entrer une tâche" size="25" />

                                    <label for="status">Status</label>
                                    <input type="text" name="status" id="status" class="form-control" placeholder="Exemple : En attente, en cours" size="25" />

                                    <label for="reminder_date">Date de rappel</label>
                                    <input type="date" name="reminder_date" id="reminder_date" class="form-control" />

                                    <input type="hidden" name="myToken" value="<?= $_SESSION['myToken'] ?>" />

                                </div>

                                <button type="submit" name="submitTask" class="btn">Ajouter une tâche</button>
                            </form>

                            <form action="" method="post">

                                <label for="Filtre">Filtrer</label>
                                <select name="Filtre" id="Filtre">
                                    <option value="">Veuillez faire un choix</option>
                                    <option value="0">Date de création</option>
                                    <option value="1">Niveau de priorité</option>
                                </select>

                                <button type="submit" name="submitFilter" class="btn">Valider</button>
                        </div>

                        </form>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Priorité</th>
                                    <th>Texte</th>
                                    <th>Date de création</th>
                                    <th>Status</th>
                                    <th>Date de rappel</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php

                                include 'include/change_display_order.php';

                                include 'include/filter.php';

                                include 'include/recover_database.php';

                                ?>

                            </tbody>
                        </table>

                        <?php

                        if (!empty($errorsList)) {
                            echo '<ul>' . implode(array_map(fn ($e) => '<li>' . $e . '</li>', $errorsList)) . '</ul>';
                        }

                        ?>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
</body>

</html>