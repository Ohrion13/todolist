<?php

if (!isset($_SESSION['myToken'])) {
    $_SESSION['myToken'] = md5(uniqid(mt_rand(), true));
}


function flawsCsrf (){

    if (!isset($_SERVER['HTTP_REFERER']) || !str_contains($_SERVER['HTTP_REFERER'], 'http://localhost:8080/')) {
        $_SESSION['error'] = 'referer';
        header('Location: http://localhost:8080/');
        exit;
    }
    
    if (!isset($_SESSION['myToken']) || !isset($_POST['myToken']) || $_SESSION['myToken'] !== $_POST['myToken']) {
        $_SESSION['error'] = 'csrf';
        header('Location: http://localhost:8080/');
        exit;
    }
    
}


function preventCSRFAPI(): void
{
    global $globalUrl;

    if (!isset($_SERVER['HTTP_REFERER']) || !str_contains($_SERVER['HTTP_REFERER'], $globalUrl)) {
        $error = 'referer';
    }

    if (!isset($_SESSION['myToken']) || !isset($_REQUEST['myToken']) || $_SESSION['myToken'] !== $_REQUEST['myToken']) {
        $error = 'csrf';
    }

    if (isset($error)) triggerError($error);
}


function triggerError(string $error): void
{
    global $errors;

    $response = [
        'isOk' => false,
        'errorMessage' => $errors[$error]
    ];
    echo json_encode($response);
    exit;
}

?>