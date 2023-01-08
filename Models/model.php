<?php
$host = 'localhost';
$user = 'root';
$passwd = 'root';
$dbname = 'casteria';

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $passwd);




class Contact {
  private $pdo;

  function __construct($pdo) {
    $this->pdo = $pdo;
  }

  function index() {
    $sql = 'SELECT * FROM contacts';
    $stmt = $this->pdo->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
}

class Submit {
  private $pdo;

  function __construct(PDO $pdo) {
    $this->pdo = $pdo;
  }

  function index($name, $kana, $tel, $email, $body) {
    $stmt = $this->pdo->prepare('INSERT INTO contacts (name, kana, tel, email, body) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$name, $kana, $tel, $email, $body]);
  }
}

class Edit {
  private $pdo;

  function __construct(PDO $pdo, $id) {
    $this->pdo = $pdo;
    $this->id = $id;
  }


  function getData($id) {
    $stmt = $this->pdo->prepare('SELECT * FROM contacts WHERE id = :id');
    $stmt->execute([':id' => $id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
  }

  function index($id, $name, $kana, $tel, $email, $body) {
    $stmt = $this->pdo->prepare('UPDATE contacts SET name = :name, kana = :kana, tel = :tel, email = :email, body = :body WHERE id = :id');
    $stmt->execute(array(':name' => $_POST['name'], ':kana' => $_POST['kana'], ':tel' => $_POST['tel'], ':email' => $_POST['email'] , ':body' => $_POST['body'], ':id' => $_POST['id']));
  }
}

class Delete {
  private $pdo;
  private $id;

  function __construct(PDO $pdo, $id) {
    $this->pdo = $pdo;
    $this->id = $id;
  }

  function getData($id) {
    $stmt = $this->pdo->prepare('SELECT * FROM contacts WHERE id = :id');
    $stmt->execute([':id' => $id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
  }

  function index() {
    $delete = $this->pdo->prepare('DELETE contacts FROM contacts WHERE id = :id');
    $delete->execute([':id' => $this->id]);
  }
}
