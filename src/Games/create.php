<?php
include '../../partials/header.php';
include '../../partials/menu.php';
include '../../inc/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    global $dbh;

    $sql = "INSERT INTO Duree(label) VALUES (:duration)";
    $data = ['duration' => $_POST['duration']];
    $sth = $dbh->prepare($sql);
    $sth->execute($data);

    $sql = "INSERT INTO `Anime` (`nom`, `episode_nb`, `note`, `img`, duration_id, `type_id`, `statut_id`) 
            VALUES (:nom, :episode_nb, :note, :img,  LAST_INSERT_ID() , :type_id, :statut_id);";
    $data = [
        "nom" => $_POST["nameAnime"] ?? null,
        "episode_nb" => $_POST["nombre_episodes"],
        "note" => $_POST["note"],
        "img" => $_POST["img"],
        "type_id" => $_POST["typeAnime"],
        "statut_id" => $_POST["statusAnime"]
    ];

    $sth = $dbh->prepare($sql);
    try {
        $is_successful = $sth->execute($data);
    } catch (PDOException $e) {
        echo "Oh no ...." . $e->getMessage();
        error_log($e->getMessage());
    }
    if ($is_successful) {
        header('Location: /index.php');
    } else {
        echo "Oh no ..";
    }
}
?>
<main class='container'>

    <form action='#' method='POST'>
        <div class="mb-3">
            <label for="nameAnime" class="form-label">Nom de l'anime</label>
            <input type="text" class="form-control" id="nameAnime" name="nameAnime" aria-describedby="nameAnime"
                placeholder="">
        </div>
        <div class="mb-3">
            <label for="nbEpisodesAnime" class="form-label">Nb Episodes</label>
            <input type="number" class="form-control" name="nombre_episodes" id="nbEpisodesAnime" min=0 step=1>
        </div>
        <div class="mb-3">
            <label for="duration" class="form-label">Duration</label>
            <input type="text" class="form-control" name="duration" id="duration">
        </div>
        <div class="mb-3">
            <label for="noteAnime" class="form-label">Note</label>
            <input type="number" class="form-control" id="noteAnime" name="note" min=0 max=10 step=0.01>
        </div>
        <div class="mb-3">
            <label for="imgAnime" class="form-label">Image</label>
            <input type="url" class="form-control" id="imgAnime" name="img">
        </div>
        <div class="mb-3">
            <label for="typeAnime" class="form-label">Type</label>
            <?= htmlSelectType("typeAnime") ?>
        </div>
        <div class="mb-3">
            <label for="statusAnime" class="form-label">Statut</label>
            <?= htmlSelectStatus("statusAnime") ?>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</main>
