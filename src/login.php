<?php
include '/header.php';
include '/menu.php';
include '/DB/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = '';
    global $pdo;

    assert(!empty($_POST['username']));
    assert(!empty($_POST['password']));

    $sql = "SELECT password FROM Utilisateur WHERE login = :login";
    $data = [
        'login' => $_POST['username'],
    ];
    $sth = $pdo->prepare($sql);
    try {
        $is_successful = $sth->execute($data);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        $is_successful = false;
    }
    if ($is_successful && empty($message)) {
        $record = $sth->fetch();
        if (password_verify($_POST['password'], $record['password'])) {
            $_SESSION['username'] = $_POST['username'];
            header('Location: index.php');

        } else {
            $message .= "Either your login or your password are incorrect";
        }



    } else {
        echo "lqksjdklqsjlkqsdjlksqdjlkqdj";
        $message .= $sth->errorInfo()[2];
    }
}

?>
<h1>Login</h1>
<main class="container">


    <?php include 'form.php'; ?>
</main>
<?php
