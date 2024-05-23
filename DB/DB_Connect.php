<?php
    $hostname = "10.36.0.45";
    $dbname = 'infrastructure';
    $dbuser = 'alexis';
    $dbpass = 'JESAISPAS';
    $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $dbuser, $dbpass);

    $sth = $dbh->prepare($sql);
    $is_successful = $sth->execute($data);

    if($is_successful) {
        echo 'Success';
    } else {
        echo "Oh no... something wrong occured";
    }
?>