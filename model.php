<?php

class Model {

    private $_options  = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    );

    private $_pdo;

    public function __construct() {
        $dsn = 'mysql:dbname=' . getenv('MYSQL_DATABASE') . ';host=mysql';
        $this->_pdo = new PDO($dsn, getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'));
        return $this->_pdo;
    }

    /*
     * USERS
     */

    public function getAllUsers() {
        $stmt = $this->_pdo->prepare('SELECT * FROM users');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserByUsername($username) {
        $stmt = $this->_pdo->prepare('SELECT * FROM users WHERE username LIKE ?');
        $stmt->execute(['%'.$username.'%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /*
     * TRANSACTION
     */

    public function getAllTransactions() {
        $stmt = $this->_pdo->prepare('SELECT l.*, u1.name as payer, u2.name as payee
            FROM ledger l
            LEFT JOIN users u1 ON u1.id = l.payer_id
            LEFT JOIN users u2 ON u2.id = l.payee_id
            ORDER BY id DESC');
        $q = $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addTransaction($amount, $hash, $comment) {
        $statement = $this->_pdo->prepare('INSERT INTO transaction(amount, hash, comment) VALUES(?, ?, ?)');
        $statement->execute([$amount, $hash, $comment]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
