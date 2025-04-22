<?php
session_start();
if (!isset($_SESSION['user'])) {
    $_SESSION['watchlist_message'] = "You must be logged in to modify your watchlist";
    header("Location: ../login.php");
    exit();
}
require_once("../Config/database.php");
if (!isset($_POST['media_id'])) {
    $_SESSION['watchlist_message'] = "Invalid request";
    header("Location: ../watchlist.php");
    exit();
}
$userId = $_SESSION['user']['id'];
$mediaId = (int)$_POST['media_id'];
try {
    $stmt = $cnx->prepare("
        DELETE FROM watchlist 
        WHERE UserId = ? AND MediaId = ?
    ");
    $stmt->execute([$userId, $mediaId]);
        if ($stmt->rowCount() > 0) {
        $_SESSION['watchlist_message'] = "Item successfully removed from your watchlist";
    } else {
        $_SESSION['watchlist_message'] = "This item was not in your watchlist";
    }
        header("Location: ../view/watchlist.php");
    exit();

} catch (PDOException $e) {
    // Gestion des erreurs
    $_SESSION['watchlist_message'] = "Error: " . $e->getMessage();
    header("Location: ../watchlist.php");
    exit();
}
?>