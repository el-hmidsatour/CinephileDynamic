<?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Title'])) {
        $title = $_POST['Title'] ?? '';
        $url = $_POST['MediaUrl'] ?? '';
        $description = $_POST['Description'] ?? '';
        $type = $_POST['Type'] ?? 'f';
        $country = $_POST['Country'] ?? 'USA';
        $year = $_POST['Year'] ?? 2000;
        $rating = $_POST['ExpertRating'] ?? null;
        $selectedGenres = $_POST['Genres'] ?? [];
        $selectedActors = $_POST['Actors'] ?? [];

        if (!empty($_POST['id'])) {
            $id = $_POST['id'];
            $stmt = $cnx->prepare("UPDATE media SET Title = :title, MediaUrl = :url, Description = :description, Type = :type, Country = :country, Year = :year, ExpertRating = :rating WHERE Id = :id");
            $stmt->execute([
                'title' => $title, 'url' => $url, 'description' => $description,
                'type' => $type, 'country' => $country, 'year' => $year,
                'rating' => $rating, 'id' => $id
            ]);

            $cnx->prepare("DELETE FROM tagged WHERE MediaId = :id")->execute(['id' => $id]);
            foreach ($selectedGenres as $genreId) {
                $cnx->prepare("INSERT INTO tagged (MediaId, GenreId) VALUES (:mediaId, :genreId)")
                    ->execute(['mediaId' => $id, 'genreId' => $genreId]);
            }

            $cnx->prepare("DELETE FROM acted WHERE MediaId = :id")->execute(['id' => $id]);
            foreach ($selectedActors as $actorId) {
                $cnx->prepare("INSERT INTO acted (MediaId, ActorId) VALUES (:mediaId, :actorId)")
                    ->execute(['mediaId' => $id, 'actorId' => $actorId]);
            }

            $success = "Movie updated successfully!";
        } else {
            $success = addFilm($cnx, $title, $url, $description, $year, $country, $rating);
            $lastId = $cnx->lastInsertId();

            foreach ($selectedGenres as $genreId) {
                $cnx->prepare("INSERT INTO tagged (MediaId, GenreId) VALUES (:mediaId, :genreId)")
                    ->execute(['mediaId' => $lastId, 'genreId' => $genreId]);
            }
            foreach ($selectedActors as $actorId) {
                $cnx->prepare("INSERT INTO acted (MediaId, ActorId) VALUES (:mediaId, :actorId)")
                    ->execute(['mediaId' => $lastId, 'actorId' => $actorId]);
            }
        }
    }
