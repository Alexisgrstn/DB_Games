<?php
$hostname = "10.36.0.45";
$dbname = 'infrastructure';
$dbuser = 'alexis';
$dbpass = 'JESAISPAS';

try {
    $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $dbuser, $dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit; // Arrête l'exécution du script en cas d'erreur de connexion
}
?>
