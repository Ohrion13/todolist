<?php
$text = 'Mytodolist!';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Mytodolist</title>
</head>
<section class="vh-100" style="background-color: #eee;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-9 col-xl-7">
                <div class="card rounded-3">
                    <div class="card-body p-4">

                        <h4 class="text-center my-3 pb-3 ttl">Mytodolist</h4>

                        <form class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-2">
                            <div class="col-12">
                                <div data-mdb-input-init class="form-outline">
                                    <input type="text" id="form1" class="form-control" placeholder="Entrer une tâche" />
                                    <label class="form-label" for="form1"></label>
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                    class="btn btn-primary ">Ajouter une tâche</button>
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
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Buy groceries for next week</td>
                                    <td>01 Janvier 2020</td>
                                    <td>En cours</td>
                                    <td>
                                        <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                            class="btn btn-danger">Supprimer</button>
                                        <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                            class="btn btn-success ms-1">Terminer</button>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Renew car insurance</td>
                                    <td>01 Janvier 2020</td>
                                    <td>En cours</td>
                                    <td>
                                        <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                            class="btn btn-danger">Supprimer</button>
                                        <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                            class="btn btn-success ms-1">Terminer</button>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Sign up for online course</td>
                                    <td>01 Janvier 2020</td>
                                    <td>En cours</td>
                                    <td>
                                        <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                            class="btn btn-danger">Supprimer</button>
                                        <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                            class="btn btn-success ms-1">Terminer</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</html>
