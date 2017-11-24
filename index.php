<?php
require_once('include/constants.php');
require_once('model.php');

$model = new Model();
$transactions = $model->getAllTransactions();

// echo('<pre>');
// var_dump($transactions);
// echo('</pre>');
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
            <h1>IW Coin - Transaction</h1>

            <?php include_once('include/nav.php'); ?>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Amount</th>
                        <th scope="col">Payer</th>
                        <th scope="col">Receiver</th>
                        <th scope="col">Comment</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($transactions as $tr): ?>
                    <tr>
                        <th scope="row"><?= $tr['amount'] ?></th>
                        <td><?= $tr['payer'] ?></td>
                        <td><?= $tr['payee'] ?></td>
                        <td><?= $tr['desc'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
