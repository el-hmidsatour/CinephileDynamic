<?php
include("../config/database.php");

$csvFile = fopen("films.csv", "r");
if (!$csvFile) die("CSV not found");

$row = 0;
while (($data = fgetcsv($csvFile, 1000, ",")) !== FALSE) {
    if ($row++ === 0) continue; // Skip header

    list($title, $mediaUrl, $description, $type, $country, $year, $rating, $genresStr, $actorsStr) = $data;

    // 1. Insert movie
    $stmt = $cnx->prepare("INSERT INTO media (Title, MediaUrl, Description, Type, Country, Year, ExpertRating) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$title, $mediaUrl, $description, $type, $country, $year, $rating]);
    $mediaId = $cnx->lastInsertId();

    // 2. Insert genres and tag them
    $genres = array_map('trim', explode(',', $genresStr));
    foreach ($genres as $genreName) {
        // Check if genre exists
        $stmt = $cnx->prepare("SELECT GenreId FROM genres WHERE NameGenre = ?");
        $stmt->execute([$genreName]);
        $genreId = $stmt->fetchColumn();

        if (!$genreId) {
            $stmt = $cnx->prepare("INSERT INTO genres (NameGenre) VALUES (?)");
            $stmt->execute([$genreName]);
            $genreId = $cnx->lastInsertId();
        }

        $stmt = $cnx->prepare("INSERT INTO tagged (MediaId, GenreId) VALUES (?, ?)");
        $stmt->execute([$mediaId, $genreId]);
    }

    // 3. Insert actors and link them
    $actors = array_map('trim', explode(',', $actorsStr));
    foreach ($actors as $actorName) {
        // Check if actor exists
        $stmt = $cnx->prepare("SELECT ActorId FROM actors WHERE FullName = ?");
        $stmt->execute([$actorName]);
        $actorId = $stmt->fetchColumn();

        if (!$actorId) {
            // Insert dummy values for now
            $stmt = $cnx->prepare("INSERT INTO actors (FullName, YearOfBirth, ImageUrl) VALUES (?, 2000, '')");
            $stmt->execute([$actorName]);
            $actorId = $cnx->lastInsertId();
        }

        $stmt = $cnx->prepare("INSERT INTO acted (MediaId, ActorId) VALUES (?, ?)");
        $stmt->execute([$mediaId, $actorId]);
    }
}

fclose($csvFile);

echo "✅ All movies, genres, and actors inserted!";
?>