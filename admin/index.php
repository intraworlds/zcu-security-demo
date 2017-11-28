<?php
define('TWO_FA_ENABLED', true);

function adminer_object() {

  class AdminerSoftware extends Adminer {

    // custom name in title and heading
    function name() {
      return 'Ledger admin';
    }

  /** Get key used for permanent login
    * @param bool
    * @return string cryptic string which gets combined with password or false in case of an error
    */
  function permanentLogin($create = false) {
      return "444b689db7545860a99e4932139c9326";
    }

    // server, username and password for connecting to database
    function credentials() {
      return ['mysql', getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD')];
    }

    // database name, will be escaped by Adminer
    function database() {
      return getenv('MYSQL_DATABASE');
    }

    // validate user submitted credentials
    function login($login, $password) {
      $_SESSION['phaseOne'] = $_SESSION['phaseOne'] ?: ($login == getenv('ADMIN_USER') && $password == getenv('ADMIN_PASSWORD'));

      if ($_SESSION['phaseOne'] && TWO_FA_ENABLED) {
        $phaseTwo = require __DIR__ . '/two_factor.php';
      } else {
        $phaseTwo = true;
      }

      return $_SESSION['phaseOne'] && $phaseTwo;
    }

    function tableName($tableStatus) {
      // tables without comments would return empty string and will be ignored by Adminer
      return h($tableStatus["Comment"]);
    }

    function fieldName($field, $order = 0) {
      // only columns with comments will be displayed and only the first five in select
      return ($order <= 5 && !preg_match('~_(md5|sha1)$~', $field["field"]) ? h($field["comment"]) : "");
    }

  }

  return new AdminerSoftware;
}
include '../lib/editor-4.3.1-mysql-en.php';
