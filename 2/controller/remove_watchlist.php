<?php
// controller/remove_watchlist.php

session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    $_SESSION['watchlist_message'] = "You must be logged in to modify your watchlist";
    header("Location: ../login.php");
    exit();
}

// Inclut la configuration de la base de données
require_once("../Config/database.php");

// Vérifie si l'ID du média est présent
if (!isset($_POST['media_id'])) {
    $_SESSION['watchlist_message'] = "Invalid request";
    header("Location: ../watchlist.php");
    exit();
}

$userId = $_SESSION['user']['id'];
$mediaId = (int)$_POST['media_id'];

try {
    // Prépare et exécute la requête de suppression
    $stmt = $cnx->prepare("
        DELETE FROM watchlist 
        WHERE UserId = ? AND MediaId = ?
    ");
    $stmt->execute([$userId, $mediaId]);
    
    // Message de confirmation
    if ($stmt->rowCount() > 0) {
        $_SESSION['watchlist_message'] = "Item successfully removed from your watchlist";
    } else {
        $_SESSION['watchlist_message'] = "This item was not in your watchlist";
    }
    
    // Redirige vers la page watchlist
    header("Location: ../view/watchlist.php");
    exit();

} catch (PDOException $e) {
    // Gestion des erreurs
    $_SESSION['watchlist_message'] = "Error: " . $e->getMessage();
    header("Location: ../watchlist.php");
    exit();
}
?>