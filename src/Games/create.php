<?php
include '../header.php';
include '../menu.php';
include '../DB/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    global $pdo;

    $sql = "INSERT INTO Edit(label) VALUES (:edition)";
    $data = ['edition' => $_POST['edition']];
    $sth = $pdo->prepare($sql);
    $sth->execute($data);

    $sql = "INSERT INTO `Games` (`nom`, `note`, `img`, edition_id, `type_id`, `statut_id`) 
            VALUES (:nom, :note, :img,  LAST_INSERT_ID() , :type_id, :statut_id);";
    $data = [
        "nom" => $_POST["nameGames"] ?? null,
        "note" => $_POST["note"],
        "img" => $_POST["img"],
        "type_id" => $_POST["typeGames"],
        "statut_id" => $_POST["statusGames"]
    ];

    $sth = $pdo->prepare($sql);
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
            <label for="nameGames" class="form-label">Nom de du jeux</label>
            <input type="text" class="form-control" id="nameGames" name="nameGames" aria-describedby="nameGames"
                placeholder="">
        </div>
        <div class="mb-3">
            <label for="edition" class="form-label">Edition</label>
            <input type="text" class="form-control" name="edition" id="edition">
        </div>
        <div class="mb-3">
            <label for="noteGames" class="form-label">Note</label>
            <input type="number" class="form-control" id="noteGames" name="note" min=0 max=10 step=0.01>
        </div>
        <div class="mb-3">
            <label for="imgGames" class="form-label">Image</label>
            <input type="url" class="form-control" id="imgGames" name="img">
        </div>
        <div class="mb-3">
            <label for="typeGames" class="form-label">Type</label>
            <?= htmlSelectType("typeGames") ?>
        </div>
        <div class="mb-3">
            <label for="statusGames" class="form-label">Statut</label>
            <?= htmlSelectStatus("statusGames") ?>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</main>
