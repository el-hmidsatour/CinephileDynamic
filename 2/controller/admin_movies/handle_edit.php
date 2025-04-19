<?php

    if (isset($_GET['edit']) && isset($_GET['id'])) {
        $movieId = $_GET['id'];
        $stmt = $cnx->prepare("SELECT * FROM media WHERE Id = :id");
        $stmt->execute(['id' => $movieId]);
        $movie = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $cnx->prepare("SELECT GenreId FROM tagged WHERE MediaId = :id");
        $stmt->execute(['id' => $movieId]);
        $movie['Genres'] = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'GenreId');

        $stmt = $cnx->prepare("SELECT ActorId FROM acted WHERE MediaId = :id");
        $stmt->execute(['id' => $movieId]);
        $movie['Actors'] = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'ActorId');
    }
