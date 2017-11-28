<?php
use PragmaRX\Google2FA\Google2FA;

require __DIR__ . '/../vendor/autoload.php';

$google2fa = new Google2FA;

if (isset($_POST['secret2fa'])) {
  $phaseTwo = $google2fa->verifyKey($_SESSION['secret2fa'], $_POST['secret2fa']);
  unset($_SESSION['secret2fa']);

  return $phaseTwo;
} else {
  // WARNING! for demo purposes we're generating always new token,
  // in the real world you should generate token during user registration
  // and never change it! see https://en.wikipedia.org/wiki/Google_Authenticator
  $_SESSION['secret2fa'] = $google2fa->generateSecretKey();

  $google2faUrl = $google2fa->getQRCodeGoogleUrl(
    'IW Coin',
    $login,
    $_SESSION['secret2fa']
  );
?>
<!DOCTYPE html>
<html>
<head>
  <title>Second step</title>
</head>
<body>
  <h1>Use Google Authenticator</h1>
  <p>
    <img src="<?php echo $google2faUrl; ?>">
  </p>
  <form method="POST">
    <p>
      <input name="secret2fa">
    </p>
    <p>
      <input type="submit" value="Authenticate">
    </p>
  </form>
</body>
</html>
<?php
  exit;
}
