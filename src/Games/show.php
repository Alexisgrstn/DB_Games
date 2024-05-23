<?php
include '../header.php';
include '../menu.php';

include "../DB/DB_Connect.php";
$sql = "Select * FROM Anime where id = :id";
$data = ["id" => $_GET['id']];

$sth = $pdo->prepare($sql);
$is_successful = $sth->execute($data);
if ($is_successful) {
    $record = $sth->fetch(PDO::FETCH_ASSOC);
    ?>

    <main class="container">
        <article class="col-12">
            <div class="card">
                <h1>
                    <?= $record['nom'] ?>
                </h1>
                <div class="card-body">
                    <img class="col-4 " src="<?= ($record['img'] ?? 'https://placewaifu.com/image/200') ?>"
                        alt="Card image cap">
                    <p class="card-text">Nothing to say actually.. we have no data yet...</p>
                </div>
            </div>
        </article>
    </main>






    <?php
}
