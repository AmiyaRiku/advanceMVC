<?php
$host = 'localhost';
$user = 'root';
$passwd = 'root';
$dbname = 'casteria';

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $passwd);

try {
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->beginTransaction();

  $sql = 'SELECT * FROM contacts';
  $stmt = $pdo->query($sql);
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $pdo->commit();
  
} catch (Exception $e) {
    $pdo->rollBack();
}