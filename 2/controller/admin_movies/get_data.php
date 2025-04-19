<?php
    if (isset($_POST['searchTitle'])) {
        $searchTitle = $_POST['searchTitle'];
        $stmt = $cnx->prepare("SELECT * FROM media WHERE Title LIKE :title");
        $stmt->execute(['title' => "%$searchTitle%"]);
        $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $stmt = $cnx->query("SELECT * FROM media");
        $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    $genreStmt = $cnx->query("SELECT * FROM genres");
    $allGenres = $genreStmt->fetchAll(PDO::FETCH_ASSOC);

    $actorStmt = $cnx->query("SELECT * FROM actors");
    $allActors = $actorStmt->fetchAll(PDO::FETCH_ASSOC);