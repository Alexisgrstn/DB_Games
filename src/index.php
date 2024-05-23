<?php
include __DIR__ . '/header.php'; // Inclure le header
include __DIR__ . '/DB/functions.php'; // Utilise __DIR__ pour garantir le bon chemin
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Notation</title>
    <link rel="icon" type="image/jpg" href="logo.jpg" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="src/assets/style.css">
</head>
<body>
<?php session_start(); ?>

<main class="d-flex flex-wrap justify-content-between">
    <?php
    $records = fetchAllGameData();

    foreach ($records as $record) {
        if (!empty($record['genres'])) {
            $tags = '';
            foreach (explode(',', $record['genres']) as $genre) {
                $tags .= " <a href='category.php?name=" . $genre . "'><span class='badge bg-secondary'>$genre</span></a>";
            }
        }
        $html = "
            <div class='card m-4 col-12 col-md-3'>
                <img src='" . ($record['img'] ?? 'https://placewaifu.com/image/200') . "' class='card-img-top' alt='...'>
                <p class='position-absolute top-0 end-0'><i class='me-2 mt-2 fa-regular fa-star'></i></p>
                <div class='position-absolute top-0 start-1 ranking'>" . $record['note'] . " / 10.0</div>
                <div class='card-body'>
                    <h5 class='card-title'>" . $record['nom'] . "</h5>
                    $tags
                    <p class='card-text'> Nb Episodes : " . $record['episode_nb'] . "</p>
                    <a href='./src/Games/show.php?id=" . $record['id'] . "' class='btn btn-primary'>View</a>
                    <a href='./src/Games/edit.php?id=" . $record['id'] . "' class='btn btn-primary'>Edit</a>
                </div>
            </div>
        ";
        echo ($html);
    }
    ?>
</main>
<?php include __DIR__ . '/footer.php'; // Inclure le footer ?>
</body>
</html>
