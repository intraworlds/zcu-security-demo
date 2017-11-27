<?php
session_start();

header('X-XSS-Protection: 0');

require_once('include/constants.php');
require_once('include/model.php');

// logout user
if (strcmp($_GET['path'], 'logout') == 0) {
    unset($_SESSION['user']);
}
$model = new Model();

if (isset($_SESSION['user'])) {
    $_SESSION['user']['balance'] = $model->getUserBalance($_SESSION['user']['id']);
}

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
        $balance = $_SESSION['user']['balance'];
        if ($balance >= intval($_REQUEST['amount'])) {
            if (!ENABLE_CSRF && strcmp($_REQUEST['csrf'], $_SESSION['csrf']) !== 0) {
                $isError = true;
                $errorMessage = 'CSRF token is not valid! Please reload page and try again...';
            }
            else {
                $result = $model->addTransaction(
                    $_SESSION['user']['id'],
                    $_REQUEST['receiver'],
                    $_REQUEST['amount'],
                    $_REQUEST['desc']
                );
            }
        }
        else {
            $isError = true;
            $errorMessage = 'You don\'t have enough coins. Your current balance is ' . $balance . ' IWC';
        }
    }
}

// generate new CSRF token
$_SESSION['csrf'] = md5(random_bytes(32));
?>

<html>
    <head>
        <title>IW Coin</title>
        <meta charset='utf-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="shortcut icon" type="image/x-icon" href="favicon.png" />
        <script src='lib/jquery-3.2.1.min.js'></script>
    </head>
    <body>
        <div class="container">
            <div class="float-right">
                <?= $_SESSION['user']['name'] ?>,
                current balance: <?= $_SESSION['user']['balance'] ?> IWC
            </div>
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
