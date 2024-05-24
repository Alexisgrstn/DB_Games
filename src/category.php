<?php
include '/header.php';
include '/menu.php';
?>
<main class="d-flex flex-wrap justify-content-between">
    <?php
    include 'inc/connectDB.php';

    $label = $_GET['name'];

    $sql = "Select Games.id, Games.nom, Games.note, Games.img, GROUP_CONCAT(Genre.nom) as 'genres'
    From Games
    JOIN Games_a_Genre aag ON aag.games_id = Games.id
    JOIN Genre ON Genre.id = aag.genre_id
    WHERE Games.id IN (Select Games.id
        From Games
        JOIN Games_a_Genre aag ON aag.games_id = Games.id
        JOIN Genre ON Genre.id = aag.genre_id
        WHERE Genre.nom = :label)
    GROUP BY Games.id
    ORDER BY note DESC";
    $data = ["label" => $label];

    $sth = $pdo->prepare($sql);
    $is_successful = $sth->execute($data);

    if ($is_successful) {

        $records = $sth->fetchAll();
        foreach ($records as $record) {
            if (!empty($record['genres'])) {
                $tags = '';
                foreach (explode(',', $record['genres']) as $genre) {
                    $tags .= " <a href='category.php?name=" . $genre . "'><span class='badge bg-secondary'>$genre</span></a>";
                }
            }
            $html = "
                <div class='card m-4 col-12 col-md-3' style=''>
                    <img src='" . ($record['img'] ?? 'https://placewaifu.com/image/200') . "' class='card-img-top' alt='...'>
                    <p class='position-absolute top-0 end-0'><i class='me-2 mt-2 fa-regular fa-star'></i></p>
                    <div class='position-absolute top-0 start-1 ranking'>" . $record['note'] . " / 10.0</div>
                    <div class='card-body'>
                        <h5 class='card-title'>" . $record['nom'] . "</h5>
                        $tags
                        
                        <a href='./src/Ga/show.php?id=" . $record['id'] . "' class='btn btn-primary'>View</a>
                    </div>
                </div>
            ";
            echo ($html);
        }
    } else {
        echo "Oh no... something wrong occured";
    }
    ?>
</main>
</body>

</html>
