<?php
include '../../partials/header.php';
include '../../partials/menu.php';
include '../../inc/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    global $dbh;
    $sql = "UPDATE Anime SET type_id =:type, statut_id = :status, nom = :nom,  episode_nb= :nb,	note = :note, img = :img WHERE id = :id";
    $data = [
        'type' => $_POST['typeAnime'],
        'status' => $_POST['statusAnime'],
        'nom' => $_POST['nameAnime'],
        'nb' => $_POST['nombre_episodes'],
        'note' => $_POST['note'],
        'img' => $_POST['img'],
        'id' => $_GET['id']
    ];
    $sth = $dbh->prepare($sql);
    $is_successful = $sth->execute($data);
    if ($is_successful) {
        header('Location: ../../index.php');
    } else {
        print_r($sth->errorInfo());
    }
}

$sql = "SELECT * from Anime where id = :id";
$data = ['id' => $_GET['id']];

$sth = $dbh->prepare($sql);
$sth->execute($data);
$record = $sth->fetch();
// var_dump($record)
?>
<main class='container'>

    <form action='#' method='POST'>
        <div class="mb-3">
            <label for="nameAnime" class="form-label">Nom de l'anime</label>
            <input type="text" class="form-control" id="nameAnime" name="nameAnime" aria-describedby="nameAnime"
                placeholder="" value="<?= $record['nom'] ?>">
        </div>
        <div class="mb-3">
            <label for="nbEpisodesAnime" class="form-label">Nb Episodes</label>
            <input type="number" class="form-control" name="nombre_episodes" id="nbEpisodesAnime" min=0 step=1
                value="<?= $record['episode_nb'] ?>">
        </div>
        <div class="mb-3">
            <label for="noteAnime" class="form-label">Note</label>
            <input type="number" class="form-control" id="noteAnime" name="note" min=0 max=10 step=0.01
                value="<?= $record['note'] ?>">
        </div>
        <div cl* ass="mb-3">
            <label for="imgAnime" class="form-label">Image</label>
            <input type="url" class="form-control" id="imgAnime" name="img" value="<?= $record['img'] ?>">
        </div>
        <div class="mb-3">
            <label for="typeAnime" class="form-label">Type</label>
            <?= htmlSelectType("typeAnime", $record['type_id']) ?>
        </div>
        <div class="mb-3">
            <label for="statusAnime" class="form-label">Statut</label>
            <?= htmlSelectStatus("statusAnime", $record['status_id']) ?>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</main>
