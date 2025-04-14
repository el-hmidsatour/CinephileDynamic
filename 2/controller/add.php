<?php
include("../Config/database.php");

function addFilm($pdo, $title, $url, $description, $year, $country = 'USA', $rating = null) {
    // Si aucune note n'est fournie, on génère une note aléatoire entre 5 et 10
    $finalRating = $rating ?? rand(5, 10);
    
    try {
        // Version sécurisée avec PDO
        $req = "INSERT INTO media 
               (Title, MediaUrl, Description, Type, Country, Year, ExpertRating) 
               VALUES (:title, :url, :description, 'f', :country, :year, :rating)";
        
        $stmt = $pdo->prepare($req);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':url', $url);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':country', $country);
        $stmt->bindParam(':year', $year, PDO::PARAM_INT);
        $stmt->bindParam(':rating', $finalRating, PDO::PARAM_INT);
        
        return $stmt->execute();
        
    } catch (PDOException $e) {
        error_log("Erreur d'ajout de film: " . $e->getMessage());
        return false;
    }
}

// Tableau des films à insérer
$films = [
    [
        'title' => 'Bolice',
        'url' => 'https://m.media-amazon.com/images/M/MV5BMjAxMzY3NjcxNF5BMl5BanBnXkFtZTcwNTI5OTM0Mw@@._V1_.jpg',
        'description' => 'Ammar',
        'year' => 2024,
        'country' => 'Tunisia',
        'rating' => 6
    ]
];

// Initialisation du compteur
$successCount = 0;

// Boucle d'insertion
foreach ($films as $film) {
    $success = addFilm($cnx, $film['title'], $film['url'], $film['description'], $film['year'], $film['country'] ?? 'USA', $film['rating'] ?? null);
    echo $success ? "Film '{$film['title']}' ajouté.<br>" : "Échec ajout '{$film['title']}'.<br>";
    if ($success) $successCount++;
}

// Résumé final
echo "<p>Opération terminée : $successCount films insérés sur " . count($films) . ".</p>";
?>