<?php
include '../header.php';
include '../menu.php';
include '../DB/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    global $pdo;
    $sql = "UPDATE Games SET type_id =:type, statut_id = :status, nom = :nom, note = :note, img = :img WHERE id = :id";
    $data = [
        'type' => $_POST['typeGames'],
        'status' => $_POST['statusGames'],
        'nom' => $_POST['nameGames'],
        'note' => $_POST['note'],
        'img' => $_POST['img'],
        'id' => $_GET['id']
    ];
    $sth = $pdo->prepare($sql);
    $is_successful = $sth->execute($data);
    if ($is_successful) {
        header('Location: ../../index.php');
    } else {
        print_r($sth->errorInfo());
    }
}

$sql = "SELECT * from Games where id = :id";
$data = ['id' => $_GET['id']];

$sth = $pdo->prepare($sql);
$sth->execute($data);
$record = $sth->fetch();
// var_dump($record)
?>
<main class='container'>

    <form action='#' method='POST'>
        <div class="mb-3">
            <label for="nameGames" class="form-label">Nom du Jeux</label>
            <input type="text" class="form-control" id="nameGames" name="nameGames" aria-describedby="nameGames"
                placeholder="" value="<?= $record['nom'] ?>">
        </div>
        <div class="mb-3">
            <label for="noteGames" class="form-label">Note</label>
            <input type="number" class="form-control" id="noteGames" name="note" min=0 max=10 step=0.01
                value="<?= $record['note'] ?>">
        </div>
        <div cl* ass="mb-3">
            <label for="imgGames" class="form-label">Image</label>
            <input type="url" class="form-control" id="imgGames" name="img" value="<?= $record['img'] ?>">
        </div>
        <div class="mb-3">
            <label for="typeGames" class="form-label">Type</label>
            <?= htmlSelectType("typeGames", $record['type_id']) ?>
        </div>
        <div class="mb-3">
            <label for="statusGames" class="form-label">Statut</label>
            <?= htmlSelectStatus("statusGames", $record['status_id']) ?>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</main>
