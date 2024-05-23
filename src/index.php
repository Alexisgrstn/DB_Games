<?php
include 'header.php';
?>

<main class="d-flex flex-wrap justify-content-between">
    <?php
    include 'inc/functions.php';

    $records = fetchAllAnimeData();


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
                    <p class='card-text'> Nb Episodes : " . $record['episode_nb'] . "</p>
                    
                    <a href='./src/animes/show.php?id=" . $record['id'] . "' class='btn btn-primary'>View</a>
                    <a href='./src/animes/edit.php?id=" . $record['id'] . "' class='btn btn-primary'>Edit</a>
                
                </div>
            </div>
        ";
        echo ($html);
    }

    ?>
</main>
</body>

</html>
