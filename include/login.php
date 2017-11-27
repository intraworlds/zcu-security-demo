<h1>IW Coin - login</h1>
<?php if ($loginError): ?>
    <div class="alert alert-danger" role="alert">
      Your login or password are not valid.
    </div>
<?php
    endif;
    unset($loginError);
?>
<form method="POST">
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" class="form-control">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" class="form-control">
    </div>
    <button type="submit" name="submit" value="login" class="btn btn-primary">Login</button>
</form>
