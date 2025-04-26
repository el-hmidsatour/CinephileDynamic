<?php 
include("../config/database.php");

function AddUser($cnx, $data) {
    // Hash the password
    $hashed_password = md5($data['password']);
    
    // Prepare SQL statement
    $stmt = $cnx->prepare("INSERT INTO users (FirstName, LastName, Number, Email, Password, PictureUrl) 
                          VALUES (:first_name, :last_name, :phone, :email, :password, :picture)");
    
    // Execute with parameters
    $stmt->execute([
        ':first_name' => $data['first_name'],
        ':last_name' => $data['last_name'],
        ':phone' => $data['phone'],
        ':email' => $data['email'],
        ':password' => $hashed_password,
        ':picture' => $data['picture']
    ]);
    
    // Optionally log the user in immediately after registration
    $_SESSION['user'] = [
        'id' => $cnx->lastInsertId(),
        'name' => $data['first_name'] . ' ' . $data['last_name'],
        'email' => $data['email'],
        'picture' => $data['picture']
    ];
    
    // Redirect to home page
    header("Location: home.php");
    exit();
}
function getAllUsers($cnx) {
    $req = "SELECT * FROM users ORDER BY UserId DESC";
    $res = $cnx->query($req);
    return $res->fetchAll();
}

function searchUsers($cnx, $search) {
    $req = "SELECT * FROM users 
            WHERE FirstName LIKE '%$search%' 
            OR LastName LIKE '%$search%' 
            OR Email LIKE '%$search%' 
            OR Number LIKE '%$search%'";
    $res = $cnx->query($req);
    return $res->fetchAll();
}
/*
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'add') {
        if (AddUser($cnx, $_POST)) {
            header("Location: ../view/admin_users.php?success=add");
            exit();
        } else {
            $error = "Error adding user";
        }
    }
}

$Users = isset($_GET['search']) && !empty($_GET['search']) 
    ? searchUsers($cnx, $_GET['search']) 
    : getAllUsers($cnx);

*/
/**
 * INSECURE - Adds user with MD5 password hashing (for legacy systems only)
 * @param PDO $db Database connection
 * @param array $userData User data
 * @return array ['success' => bool, 'message' => string]
 */
function addUserWithMD5($db, $userData) {
    // Validate required fields
    $required = ['FirstName', 'LastName', 'Number', 'Email', 'Password'];
    foreach ($required as $field) {
        if (empty($userData[$field])) {
            return ['success' => false, 'message' => "$field is required"];
        }
    }

    try {
        // Check if email exists
        $stmt = $db->prepare("SELECT Email FROM users WHERE Email = ?");
        $stmt->execute([$userData['Email']]);
        if ($stmt->fetch()) {
            return ['success' => false, 'message' => "Email already exists"];
        }

        // INSECURE MD5 HASH - DO NOT USE IN PRODUCTION
        $hashedPassword = md5($userData['Password']);

        $stmt = $db->prepare("
            INSERT INTO users 
            (FirstName, LastName, Number, Email, Password, PictureUrl) 
            VALUES 
            (?, ?, ?, ?, ?, ?)
        ");

        $success = $stmt->execute([
            htmlspecialchars($userData['FirstName']),
            htmlspecialchars($userData['LastName']),
            htmlspecialchars($userData['Number']),
            filter_var($userData['Email'], FILTER_SANITIZE_EMAIL),
            $hashedPassword,
            $userData['PictureUrl'] ?? null
        ]);

        return [
            'success' => $success,
            'message' => $success ? "User added" : "Failed to add user"
        ];

    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        return ['success' => false, 'message' => "Database error"];
    }
}


?>