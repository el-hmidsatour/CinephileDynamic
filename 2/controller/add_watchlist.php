<?php

session_start();

if (!isset($_SESSION['user'])) {
    $_SESSION['watchlist_message'] = "You must be logged in to add to watchlist";
    header("Location: ../login.php");
    exit();
}
require_once("../Config/database.php");
if (!isset($_POST['id'])) {
    $_SESSION['watchlist_message'] = "Invalid request";
    header("Location: ../index.php");
    exit();
}
$userId = $_SESSION['user']['id'];
$mediaId = (int)$_POST['id'];
try {
    $checkStmt = $cnx->prepare("
        SELECT * FROM watchlist 
        WHERE UserId = ? AND MediaId = ?
    ");
    $checkStmt->execute([$userId, $mediaId]);
    
    if ($checkStmt->fetch()) {
        $_SESSION['watchlist_message'] = "This item is already in your watchlist";
    } else {
        $insertStmt = $cnx->prepare("
            INSERT INTO watchlist (UserId, MediaId, AddDate)
            VALUES (?, ?, CURDATE())
        ");
        $insertStmt->execute([$userId, $mediaId]);
        $_SESSION['watchlist_message'] = "Item successfully added to your watchlist";
    }
    header("Location: http://localhost/CinephileDynamic/2/view/contenu.php?id=$mediaId");
    exit();
    
} catch (PDOException $e) {
    $_SESSION['watchlist_message'] = "Error: " . $e->getMessage();
    header("Location: ../contenu.php?id=$mediaId");
    exit();
}
?>