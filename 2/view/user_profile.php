<?php
require_once("../Config/database.php");
include("navandside.php"); 

// Redirect if not logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user']['id'];
$error = '';
$success = '';
// Get review count
$reviewCountStmt = $cnx->prepare("SELECT COUNT(*) as count FROM reviews WHERE UserId = ?");
$reviewCountStmt->execute([$userId]);
$reviewCount = $reviewCountStmt->fetch(PDO::FETCH_ASSOC)['count'];

// Get watchlist count
$watchlistCountStmt = $cnx->prepare("SELECT COUNT(*) as count FROM watchlist WHERE UserId = ?");
$watchlistCountStmt->execute([$userId]);
$watchlistCount = $watchlistCountStmt->fetch(PDO::FETCH_ASSOC)['count'];
// Handle profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);
    
    try {
        // Handle file upload if new image was selected
        $pictureUrl = $_SESSION['user']['picture']; // Keep current picture if no new one uploaded
        
        if (!empty($_FILES['profile_pic']['name'])) {
            $uploadDir = "../uploads/profiles/";
            // Create directory if it doesn't exist
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            $fileName = uniqid() . '_' . basename($_FILES['profile_pic']['name']);
            $targetFile = $uploadDir . $fileName;
            
            // Check image file type
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array($imageFileType, $allowedTypes)) {
                throw new Exception("Only JPG, JPEG, PNG & GIF files are allowed.");
            }
            
            // Check file size (max 2MB)
            if ($_FILES['profile_pic']['size'] > 2000000) {
                throw new Exception("File is too large. Max size is 2MB.");
            }
            
            if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $targetFile)) {
                // Delete old picture if it's not the default
                $oldPicture = $_SESSION['user']['picture'];
                if ($oldPicture && strpos($oldPicture, 'pravatar.cc') === false && file_exists($uploadDir . $oldPicture)) {
                    unlink($uploadDir . $oldPicture);
                }
                
                $pictureUrl = $fileName;
            }
        }
        
        // Update database
        $stmt = $cnx->prepare("UPDATE users SET FirstName = ?, LastName = ?, PictureUrl = ? WHERE UserId = ?");
        $stmt->execute([$firstName, $lastName, $pictureUrl, $userId]);
        
        // Update session
        $_SESSION['user'] = [
            'id' => $userId,
            'name' => $firstName . ' ' . $lastName,
            'email' => $_SESSION['user']['email'],
            'role' => $_SESSION['user']['role'],
            'picture' => $pictureUrl
        ];
        
        $success = "Profile updated successfully!";
    } catch (Exception $e) {
        $error = "Error updating profile: " . $e->getMessage();
    }
}

// Get current user data
try {
    $stmt = $cnx->prepare("SELECT FirstName, LastName, Email, PictureUrl FROM users WHERE UserId = ?");
    $stmt->execute([$userId]);
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = "Database error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - CinePhile</title>
    <link rel="stylesheet" href="all.css">
    <link rel="stylesheet" href="navandside.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php 
    navbar();
    sidebar();
    ?>
    <div class="container">
        <div class="content-container">
            <!-- Profile Header Section -->
            <div class="movies-header">
                <h1><i class="fas fa-user-circle"></i> My Profile</h1>
                <p>Manage your account settings and preferences</p>
            </div>

            <?php if ($error): ?>
                <div class="alert-danger" style="margin: 20px 50px; padding: 15px; border-radius: 8px;">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="info-box" style="margin: 20px 50px;">
                    <?= htmlspecialchars($success) ?>
                </div>
            <?php endif; ?>

            <!-- Profile Content - Using featured-movie-compact as base -->
            <div class="featured-movie-compact" style="margin: 20px 50px;">
                <div class="featured-movie-poster">
                    <img src="../uploads/profiles/<?= htmlspecialchars($userData['PictureUrl'] ?? 'default.jpg') ?>" 
                         alt="Profile Picture" id="profile-preview" class="movie-poster">
                </div>
                
                <div class="featured-movie-details">
                    <div class="movie-title-section">
                        <h2 class="featured-movie-title">
                            <?= htmlspecialchars($userData['FirstName'] ?? '') ?> <?= htmlspecialchars($userData['LastName'] ?? '') ?>
                        </h2>
                    </div>

                    <form method="POST" enctype="multipart/form-data" style="grid-column: 1 / -1;">
                        <div class="info-box">
                            <h3><i class="fas fa-camera"></i> Profile Picture</h3>
                            <div style="display: flex; gap: 15px; align-items: center;">
                                <label class="watch-button" style="cursor: pointer; padding: 8px 15px;">
                                    <i class="fas fa-upload"></i> Change Photo
                                    <input type="file" id="profile_pic" name="profile_pic" accept="image/*" 
                                           onchange="previewImage(this)" style="display: none;">
                                </label>
                                <small style="color: #aaa;">JPG, PNG or GIF (max 2MB)</small>
                            </div>
                        </div>

                        <div class="info-box">
                            <h3><i class="fas fa-user"></i> Personal Information</h3>
                            <div style="display: grid; gap: 15px;">
                                <div>
                                    <label style="display: block; color: #aaa; margin-bottom: 5px;">First Name</label>
                                    <input type="text" name="first_name" 
                                           value="<?= htmlspecialchars($userData['FirstName'] ?? '') ?>" 
                                           style="width: 100%; padding: 8px; background: #333; border: none; border-radius: 4px; color: white;">
                                </div>
                                <div>
                                    <label style="display: block; color: #aaa; margin-bottom: 5px;">Last Name</label>
                                    <input type="text" name="last_name" 
                                           value="<?= htmlspecialchars($userData['LastName'] ?? '') ?>" 
                                           style="width: 100%; padding: 8px; background: #333; border: none; border-radius: 4px; color: white;">
                                </div>
                            </div>
                        </div>

                        <div style="display: flex; gap: 15px; margin-top: 20px;">
                            <button type="submit" name="update_profile" class="watch-button">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- User Stats Section -->
            <div class="movies-header" style="margin-top: 40px;">
                <h2><i class="fas fa-chart-bar"></i> My Activity</h2>
            </div>

            <div class="movies-grid" style="margin: 20px 50px; grid-template-columns: repeat(3, 1fr);">
                <div class="movie-card" style="text-align: center; padding: 20px;">
                    <div style="font-size: 2.5rem; color: gold; margin-bottom: 10px;">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3 class="movie-title"><?= $reviewCount ?></h3>
                    <p style="color: #aaa;">Reviews</p>
                </div>

                <div class="movie-card" style="text-align: center; padding: 20px;">
                    <div style="font-size: 2.5rem; color: #540b0c; margin-bottom: 10px;">
                        <i class="fas fa-bookmark"></i>
                    </div>
                    <h3 class="movie-title"><?= $watchlistCount ?></h3>
                    <p style="color: #aaa;">Watchlist</p>
                </div>

                <div class="movie-card" style="text-align: center; padding: 20px;">
                    <div style="font-size: 2.5rem; color: #7a0f11; margin-bottom: 10px;">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h3 class="movie-title"><?= date('M Y', strtotime($_SESSION['user']['join_date'] ?? 'now')) ?></h3>
                    <p style="color: #aaa;">Member Since</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profile-preview').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script src="app.js"></script>
</body>
</html>