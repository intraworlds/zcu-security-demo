<?php

class Model {

    private $_options  = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    );

    private $_pdo;

    public function __construct() {
        $dsn = 'mysql:dbname=' . getenv('MYSQL_DATABASE') . ';host=mysql';
        $this->_pdo = new PDO($dsn, getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'));
        $this->_pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
        return $this->_pdo;
    }

    public function errorInfo() {
        return $this->_pdo->errorInfo();
    }

    /*
     * USERS
     */

    public function getAllUsers() {
        $stmt = $this->_pdo->prepare('SELECT * FROM users');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserByEmail($email) {
        $stmt = $this->_pdo->prepare('SELECT * FROM users WHERE email LIKE ?');
        $stmt->execute(['%'.$email.'%']);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /*
     * TRANSACTION
     */

    public function getAllTransactions($limit=null) {
        $sql = 'SELECT l.*, u1.name as payer, u2.name as payee
            FROM ledger l
            LEFT JOIN users u1 ON u1.id = l.payer_id
            LEFT JOIN users u2 ON u2.id = l.payee_id
            ORDER BY id DESC';
        if (isset($limit)) {
            $sql .= ' LIMIT ' . (ENABLE_SQL_INJECTION ? $limit : intval($limit));
        }
        $stmt = $this->_pdo->prepare($sql);
        $q = $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addTransaction($payer, $receiver, $amount, $desc) {
        $statement = $this->_pdo->prepare('INSERT INTO ledger(payer_id, payee_id, amount, `desc`)
            VALUES(:payer, :payee, :amount, :description)');
        $statement->bindValue(':payer', $payer);
        $statement->bindValue(':payee', $receiver);
        $statement->bindValue(':amount', $amount);
        $statement->bindValue(':description', $desc);
        return $statement->execute();
    }

    /*
     * USER & TRANSACTION
     */

    public function getUserBalance($userId) {
        // Credit (-)
        $stmt = $this->_pdo->prepare('SELECT SUM(amount) as total
            FROM ledger l
            WHERE payer_id = ?');
        $stmt->execute([$userId]);
        $credit = $stmt->fetch();
        // Debit (+)
        $stmt = $this->_pdo->prepare('SELECT SUM(amount) as total
            FROM ledger l
            WHERE payee_id = ?');
        $stmt->execute([$userId]);
        $debit = $stmt->fetch();

        return intval($debit['total']) - intval($credit['total']);
    }

}
