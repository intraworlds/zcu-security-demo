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
                    <label for="amount">Amount</label>
                    <input type="number" id="amount" name="amount" value="0" min="0" class="form-control">
                </div>
                <div class="form-group">
                    <label for="hash">Hash</label>
                    <input type="text" id="hash" name="hash" placeholder="Hash to commit transaction" class="form-control">
                </div>
                <div class="form-group">
                    <label for="comment">Comment</label>
                    <textarea class="form-control" rows="3" id="comment" name="comment"></textarea>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </body>
</html>
