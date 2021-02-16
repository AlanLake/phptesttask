<?php

    // $host = '127.0.0.1';
    // $db = 'testtaskneva';
    // $user = 'root';
    // $pass = '';
    // $charset = 'utf8mb4';
    $host = 'eu-cdbr-west-03.cleardb.net';
    $db = 'heroku_6a09d810afc907f';
    $user = 'b579f94d90714d';
    $pass = 'c0a0634d';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";


$pdo = new PDO($dsn, $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);