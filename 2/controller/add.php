<?php
include("../Config/cinephile.php");

function addFilm($pdo, $title, $url, $description, $year, $country = 'USA', $rating = null) {
    // Si aucune note n'est fournie, on génère une note aléatoire entre 5 et 10
    $finalRating = $rating ?? rand(5, 10);
    
    try {
        $stmt = $pdo->prepare("INSERT INTO media 
                              (Title, MediaUrl, Description, Type, Country, Year, ExpertRating) 
                              VALUES (:title, :url, :description, 'f', :country, :year, :rating)");
        
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':url', $url);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':country', $country);
        $stmt->bindParam(':year', $year, PDO::PARAM_INT);
        $stmt->bindParam(':rating', $finalRating, PDO::PARAM_INT);
        
        return $stmt->execute();
        
    } catch (PDOException $e) {
        error_log("Erreur lors de l'ajout du film '$title': " . $e->getMessage());
        return false;
    }
}

// Tableau des films à insérer
$films = [
    [
        'title' => 'Inception',
        'url' => 'https://m.media-amazon.com/images/M/MV5BMjAxMzY3NjcxNF5BMl5BanBnXkFtZTcwNTI5OTM0Mw@@._V1_.jpg',
        'description' => 'Un voleur qui s\'infiltre dans les rêves se voit confier la mission inverse : implanter une idée dans l\'esprit d\'une cible.',
        'year' => 2010,
        'country' => 'USA',
        'rating' => 9
    ],
    [
        'title' => 'The Dark Knight',
        'url' => 'https://m.media-amazon.com/images/M/MV5BMTMxNTMwODM0NF5BMl5BanBnXkFtZTcwODAyMTk2Mw@@._V1_.jpg',
        'description' => 'Batman affronte le Joker qui sème le chaos à Gotham City.',
        'year' => 2008,
        'country' => 'USA',
        'rating' => 10
    ],
    [
        'title' => 'Parasite',
        'url' => 'https://m.media-amazon.com/images/M/MV5BYWZjMjk3ZTItODQ2ZC00NTY5LWE0ZDYtZTI3MjcwN2Q5NTVkXkEyXkFqcGdeQXVyODk4OTc3MTY@._V1_.jpg',
        'description' => 'Une famille pauvre s\'infiltre dans une riche maison en se faisant passer pour des employés qualifiés.',
        'year' => 2019,
        'country' => 'South Korea',
        'rating' => 10
    ]
];

// Initialisation du compteur
$successCount = 0;

// Boucle d'insertion
foreach ($films as $film) {
    $result = addFilm(
        $pdo,
        $film['title'],
        $film['url'],
        $film['description'],
        $film['year'],
        $film['country'],
        $film['rating'] ?? null
    );
    
    if ($result) {
        $successCount++;
        echo "Film '{$film['title']}' ajouté avec succès.<br>";
    } else {
        echo "Échec lors de l'ajout du film '{$film['title']}'.<br>";
    }
}

// Résumé final
echo "<p>Opération terminée : $successCount films insérés sur " . count($films) . ".</p>";
?>