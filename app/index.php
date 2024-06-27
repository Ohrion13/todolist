<?php
include 'include/task.php';
include 'include/security.php';

if (isset($_SESSION['error'])) {
    echo '<p>' . $errors[$_SESSION['error']] . '</p>';
    unset($_SESSION['error']);
}

if (!empty($_POST)) {

    flawsCsrf();

    include 'include/add_to_database.php';
}

    include 'include/end_task.php';
    
    include 'include/modify_task.php';

    include 'include/delete_task.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Mytodolist</title>
</head>
<section class="vh-100" style="background-color: #eee;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-9 col-xl-7">
                <div class="card rounded-3">
                    <div class="card-body p-4">

                        <h1 class="text-center my-3 pb-3 ttl">Mytodolist</h4>

                            <form class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-2" action="" method="post">
                                <div class="col-12">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="text">Tâches</label>
                                        <input type="text" name="text" id="text" class="form-control" placeholder="Entrer une tâche" size="25" />

                                        <label class="form-label" for="priority">Niveau de priorité</label>
                                        <input type="text" name="priority" id="priority" class="form-control" placeholder="Entrer un nombre de 1 à 5" size="22" />

                                        <label class="form-label" for="status">Status</label>
                                        <input type="text" name="status" id="status" class="form-control" placeholder="Exemple : En attente" size="25" />

                                        <input type="hidden" name="myToken" value="<?= $_SESSION['myToken'] ?>" />
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary ">Ajouter une tâche</button>
                                </div>

                            </form>

                            <table class="table mb-4">
                                <thead>
                                    <tr>
                                        <th scope="col">Priorité</th>
                                        <th scope="col">Texte</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php
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

</html>