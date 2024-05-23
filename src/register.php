<?php
include 'header.php';
include 'menu.php';
include 'DB/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = '';
    global $pdo;

    assert(!empty($_POST['username']));
    assert(!empty($_POST['password']));

    $sql = "INSERT INTO Utilisateur(login, password) VALUES (:login, :password)";
    $data = [
        'login' => $_POST['username'],
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
    ];
    $sth = $pdo->prepare($sql);
    try {
        $is_successful = $sth->execute($data);
    } catch (PDOException $e) {
        $message = $e->getMessage();
    }
    if ($is_successful && empty($message)) {
        header('Location: login.php');
    } else {
        $message .= $sth->errorInfo()[2];
    }
}

?>
<h1>Register</h1>
<main class="container">
    <?php include 'form.php'; ?>

</main>
<?php
