<?php
// require_once('model.php');

define('HACKABLE', true);

// $model = new Model();

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
                        <th scope="col">Username</th>
                        <th scope="col">Hash</th>
                        <th scope="col">Comment</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">307</th>
                        <td>antonin.neumann</td>
                        <td>adb7d00889c0b317617fe20e06f8f13d</td>
                        <td>Potraviny</td>
                    </tr>
                    <tr>
                        <th scope="row">1760</th>
                        <td>ondrej.esler</td>
                        <td>d8578edf8458ce06fbc5bb76a58c5ca4</td>
                        <td>Obleceni</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>
