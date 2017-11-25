<?php
session_start();

require_once('include/constants.php');
require_once('include/model.php');

// logout user
if (strcmp($_GET['path'], 'logout') == 0) {
    unset($_SESSION['user']);
}

$model = new Model();

// form handlers
if (isset($_REQUEST['submit'])) {
    // login
    if (strcmp($_REQUEST['submit'], 'login') == 0) {
        $user = $model->getUserByEmail($_POST['email']);
        // user is successfuly verified
        if ($user && password_verify($_POST['password'], $user['password'])) {
            $loginError = false;
            $_SESSION['user'] = $user;
        }
        // credentials are not valid
        else {
            $loginError = true;
            unset($_SESSION['user']);
        }
    }
    // add transtaction
    else if (strcmp($_REQUEST['submit'], 'create') == 0) {
        $result = $model->addTransaction(
            $_SESSION['user']['id'],
            $_REQUEST['receiver'],
            $_REQUEST['amount'],
            $_REQUEST['desc']
        );
        var_dump($result);
        exit('CREATE FORM SUBMIT');
    }
}
?>

<html>
    <head>
        <title>IW Coin</title>
        <meta charset='utf-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    </head>
    <body>
        <div class="container">
            <?php
                if(!isset($_SESSION['user'])) {
                    require_once('include/login.php');
                }
                else {
                    require_once('include/' . ($_GET['path'] ?? 'list') . '.php');
                }
            ?>
        </div>
    </body>
</html>
