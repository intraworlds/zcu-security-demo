<?php
$users = $model->getAllUsers();
?>
<h1>IW Coin - Add new transaction</h1>

<?php include_once('include/nav.php'); ?>

<?php if ($isError): ?>
    <div class="alert alert-danger" role="alert">
      <?= $errorMessage ?>
    </div>
<?php
    endif;
    unset($isError, $errorMessage);
?>

<form method="POST">
    <?php if (!ENABLE_CSRF): ?>
        <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
    <?php endif; ?>
    <div class="form-group">
        <label for="receiver">Receiver</label>
        <select class="form-control" id="receiver" name="receiver">
            <?php foreach ($users as $user): ?>
                <option value="<?= $user['id'] ?>"><?= $user['name'] ?> (<?= $user['email'] ?>)</option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="amount">Amount</label>
        <input type="number" id="amount" name="amount" value="0" min="0" class="form-control">
    </div>
    <div class="form-group">
        <label for="desc">Description</label>
        <textarea class="form-control" rows="3" id="desc" name="desc"></textarea>
    </div>
    <button type="submit" name="submit" value="create" class="btn btn-primary">Add</button>
</form>
