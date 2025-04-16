<?php
include("../config/database.php");

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get form data
$UserId = $_POST['idu'] ?? null;
$FirstName = $_POST['FirstName'] ?? null;
$LastName = $_POST['LastName'] ?? null;
$Number = $_POST['Number'] ?? null;
$Email = $_POST['Email'] ?? null;
$Password = $_POST['Password'] ?? null;
$PictureUrl = $_POST['PictureUrl'] ?? null; // Optional field

// Validate required inputs
$required = ['idu', 'FirstName', 'LastName', 'Email', 'Password'];
foreach ($required as $field) {
    if (empty($_POST[$field])) {
        die("Error: Field '$field' is required");
    }
}

if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format");
}

try {
    // INSECURE MD5 HASHING (NOT RECOMMENDED FOR PRODUCTION)
    $hashedPassword = md5($Password);
    
    // Use prepared statement to prevent SQL injection
    $requete = "UPDATE users SET 
                FirstName = ?,
                LastName = ?,
                Number = ?,
                Email = ?,
                Password = ?,
                PictureUrl = ?
                WHERE UserId = ?";
    
    $stmt = $cnx->prepare($requete);
    
    // Execute with parameters
    $resultat = $stmt->execute([
        $FirstName,
        $LastName,
        $Number,
        $Email,
        $hashedPassword,
        $PictureUrl,
        $UserId
    ]);

    if ($resultat) {
        header('Location: ../view/users_list.php?modif=ok');
        exit();
    } else {
        die("Update failed: No rows affected");
    }
    
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    die("An error occurred while updating the user");
}