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
        $stmt->bindParam(':rating', $finalRating, PDO::PARAM_STR);
        
        return $stmt->execute();
        
    } catch (PDOException $e) {
        error_log("Erreur d'ajout de film: " . $e->getMessage());
        return false;
    }
}



?>