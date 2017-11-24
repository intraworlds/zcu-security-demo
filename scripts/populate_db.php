<?php
require __DIR__ . '/../vendor/autoload.php';

$noUsers = 10;
$noTrans = 100;

$faker = Faker\Factory::create();

$dsn = 'mysql:dbname=' . getenv('MYSQL_DATABASE') . ';host=mysql';
$db  = new PDO($dsn, getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'));

$userIds = [];
$stmt = $db->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');

// generate users
for ($i = 0; $i < $noUsers; $i++) {
    $hash = password_hash($faker->password, PASSWORD_DEFAULT);
    $stmt->execute([$name = $faker->name, $faker->email, $hash]);
    $userIds[] = $id = $db->lastInsertId();
    printf('User %s [%d] created' . PHP_EOL, $name, $id);
}

// generate initial balance
$stmt = $db->prepare('INSERT INTO ledger (payer_id, payee_id, amount, `desc`) VALUES (?, ?, ?, ?)');
foreach ($userIds as $userId) {
    $stmt->bindValue(1, null, PDO::PARAM_NULL);
    $stmt->bindValue(2, $userId, PDO::PARAM_INT);
    $stmt->bindValue(3, $credit = 100, PDO::PARAM_INT);
    $stmt->bindValue(4, 'Initial credit');
    $stmt->execute();
    printf('Giving %d credits to user [%d]' . PHP_EOL, $credit, $userId);
}

// generate some bookkeeping
for ($i = 0; $i < $noTrans; $i++) {
    list($payerId, $payeeId) = array_rand(array_flip($userIds), 2);
    $stmt->execute([$payerId, $payeeId, $credit = rand(1,10), $faker->realText(30, 2)]);
    printf('[%d] is giving [%d] credits to user [%d]' . PHP_EOL, $payerId, $credit, $payeeId);
}
