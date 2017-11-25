<?php
$transactions = $model->getAllTransactions();
?>

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
