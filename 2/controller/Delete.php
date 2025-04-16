<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
include("../config/database.php");

// Verify the user ID exists and is valid
$id_user = $_GET['idu'] ?? null;
if (empty($id_user) || !is_numeric($id_user)) {
    die("Invalid user ID");
}

try {
    // Use prepared statement to prevent SQL injection
    $requete = "DELETE FROM users WHERE UserId = ?";
    $stmt = $cnx->prepare($requete);
    
    // Execute with parameter binding
    $resultat = $stmt->execute([$id_user]);

    if ($resultat && $stmt->rowCount() > 0) {
        // Successful deletion
        header('Location: ../view/users_list.php?delete=ok');
        exit();
    } else {
        // No rows affected (user didn't exist)
        header('Location: ../view/users_list.php?delete=notfound');
        exit();
    }
    
} catch (PDOException $e) {
    // Log the error and redirect
    error_log("Delete user error: " . $e->getMessage());
    header('Location: ../view/users_list.php?delete=error');
    exit();
}