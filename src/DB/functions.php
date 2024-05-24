<?php
include __DIR__ . '/DB_Connect.php'; // Inclure le fichier de connexion

function fetchAllGameData() {
    global $dbh; // Assurer que $dbh est accessible
    $stmt = $dbh->prepare("SELECT * FROM games");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function htmlSelectType($fieldName, $id = null) {
    global $dbh; // Assurer que $dbh est accessible
    $sql = "SELECT id, nom FROM Type";
    $data = [];

    $sth = $dbh->prepare($sql);
    $is_successful = $sth->execute($data);

    if ($is_successful) {
        $html = "<select name='$fieldName' class='form-select' aria-label='Default select example'>";
        foreach ($sth->fetchAll() as $record) {
            $selected = ($id == $record['id']) ? "selected" : "";
            $html .= "<option $selected value='" . htmlspecialchars($record['id']) . "'>" . htmlspecialchars($record['nom']) . "</option>";
        }
        $html .= "</select>";
    }
    return $html;
}

function htmlSelectStatus($fieldName, $id = null) {
    global $dbh; // Assurer que $dbh est accessible
    $sql = "SELECT id, nom FROM Statut;";
    $data = [];

    $sth = $dbh->prepare($sql);
    $is_successful = $sth->execute($data);

    $html = "<select name='$fieldName' class='form-select' aria-label='Default select example'>";
    if ($is_successful) {
        foreach ($sth->fetchAll() as $record) {
            $selected = ($id == $record['id']) ? "selected" : "";
            $html .= "<option $selected value='" . htmlspecialchars($record['id']) . "'>" . htmlspecialchars($record['nom']) . "</option>";
        }
    }
    $html .= "</select>";
    return $html;
}
?>
