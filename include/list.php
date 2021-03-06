<?php
$transactions = $model->getAllTransactions($_GET['limit']);
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
            <td class="font-weight-bold"><?= ENABLE_XSS ? $tr['payer'] : htmlentities($tr['payer']) ?></td>
            <th scope="row" class="h4">+<?= $tr['amount'] ?>¢</th>
            <td class="font-weight-bold"><?= ENABLE_XSS ? $tr['payee'] : htmlentities($tr['payee']) ?></td>
            <td><?= ENABLE_XSS ? $tr['desc'] : htmlentities($tr['desc']) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
