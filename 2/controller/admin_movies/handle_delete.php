<?php

    if (isset($_GET['delete']) && isset($_GET['id'])) {
        $movieId = $_GET['id'];
        $cnx->prepare("DELETE FROM tagged WHERE MediaId = :id")->execute(['id' => $movieId]);
        $cnx->prepare("DELETE FROM acted WHERE MediaId = :id")->execute(['id' => $movieId]);
        $cnx->prepare("DELETE FROM media WHERE Id = :id")->execute(['id' => $movieId]);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }  
