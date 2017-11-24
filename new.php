<?php
require_once('include/constants.php');
require_once('model.php');

$model = new Model();
$users = $model->getAllUsers();

if (isset($_REQUEST['submit'])) {
    $model->addTransaction($_REQUEST['receiver'], $_REQUEST['amount'], $_REQUEST['description']);
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
            <h1>IW Coin - Add new transaction</h1>

            <?php include_once('include/nav.php'); ?>

            <form method="POST">
                <div class="form-group">
                    <label for="receiver">Receiver</label>
                    <select class="form-control" id="receiver" name"receiver">
                        <?php foreach ($users as $user): ?>
                            <option value="<?= $user['id'] ?>"><?= $user['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" id="amount" name="amount" value="0" min="0" class="form-control">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" rows="3" id="description" name="description"></textarea>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </body>
</html>
