<?php
function connexion() {
    try
    {
        // Pensez à modifier cette ligne avec le nom de votre base de données et vos identifiants
        return new PDO('mysql:host=localhost;dbname=artbox;charset=utf8', 'root', 'root');
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
}

function toutesLesOeuvres() {
    return connexion()->query('SELECT id, titre, artiste, description, image FROM oeuvres ORDER BY id ASC');
}

function uneOeuvre(int $id) {
    $oeuvreStatement = connexion()->prepare('SELECT * FROM oeuvres WHERE id = :id');
    $oeuvreStatement->execute([
        'id' => $id
    ]);
    return $oeuvreStatement->fetch();
}

function enregistreOeuvre($titre, $artiste, $description, $image) {
    $db = connexion();
    $sqlQuery = 'INSERT INTO oeuvres(titre, artiste, description, image) VALUES (:titre, :artiste, :description, :image)';
    
    // Préparation
    $insertOeuvre = $db->prepare($sqlQuery);

    $insertOeuvre->execute([
        'titre' => $titre,
        'artiste' => $artiste,
        'description' => $description,
        'image' => $image
    ]);

    header('Location: oeuvre.php?id=' . $db->lastInsertId());
}
?>
