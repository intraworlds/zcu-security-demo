<?php

class Model {

    private $_dsn      = 'mysql:host=localhost;port=8080;dbname=zcu-demo';
    private $_user     = 'root';
    private $_password = '';
    private $_options  = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    );

    private $_pdo;

    public function __construct() {
        $this->_pdo = new PDO($this->_dsn, $this->_user, $this->_password, $this->_options);
        return $this->_pdo;
    }

    /*
     * USERS
     */

    public function getUserByUsername($username) {
        $stmt = $this->_pdo->prepare('SELECT * FROM user WHERE username LIKE ?');
        $stmt->execute(['%'.$username.'%']);
    }

    /*
     * TRANSACTION
     */

    public function getAllTransactions() {
        $stmt = $this->_pdo->prepare('SELECT * FROM transaction ORDER BY transaction_id DESC');
        $stmt->execute();
    }

    public function addTransaction($amount, $hash, $comment) {
        $statement = $this->_pdo->prepare('INSERT INTO transaction(amount, hash, comment) VALUES(?, ?, ?)');
        $statement->execute([$amount, $hash, $comment]);
    }

}
