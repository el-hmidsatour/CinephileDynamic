<?php
// Connexion à la base de données
require_once("../Config/database.php");

// Récupérer l'ID du film depuis l'URL
$movieId = $_GET['id'] ?? 1;

// Requête pour récupérer les détails du film
try {
    $stmt = $cnx->prepare("SELECT * FROM media WHERE Id = ?");
    $stmt->execute([$movieId]);
    $movie = $stmt->fetch(PDO::FETCH_ASSOC);
    
   
    
    // Requête pour les acteurs
    $actorsStmt = $cnx->prepare("
        SELECT a.* FROM actors a
        JOIN acted act ON a.ActorId = act.ActorId
        WHERE act.Media = ?
        LIMIT 5
    ");
    $actorsStmt->execute([$movieId]);
    $actors = $actorsStmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    die("Erreur de base de données: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="all.css">
    <link rel="stylesheet" href="navandside.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&family=Sen:wght@400..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <title><?= htmlspecialchars($movie['Title']) ?> - CinePhile</title>
</head>

<body>
    <!-- nav-bar -->
    <div class="navbar">
        <div class="navbar-container">
            <div class="logo-container">
                <h1 class="logo">CinePhile</h1>
            </div>
            <div class="menu-container">
                <ul class="menu-list">
                    <a href="index.php">Home</a>
                    <a href="Movie.php">Movies</a>
                    <a href="Series.php">Series</a>
                    <a href="Popular.php">Popular</a>
                    <a href="Arabic_Trends.php">Arabic Trends</a>
                </ul>
            </div>
            <div class="navbar-profile-section">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="user-profile">
                        <div class="profile-trigger">
                            <div class="avatar-wrapper">
                                <img class="profile-avatar" src="<?= htmlspecialchars($_SESSION['picture_url'] ?? 'https://i.pravatar.cc/50') ?>" alt="Profile">
                                <div class="status-indicator"></div>
                            </div>
                            <div class="profile-badge">
                                <span class="username"><?= htmlspecialchars($_SESSION['first_name'] ?? 'Utilisateur') ?></span>
                                <i class="fas fa-chevron-down dropdown-arrow"></i>
                            </div>
                        </div>
                        <div class="profile-dropdown-menu">
                            <div class="dropdown-header">
                                <img class="dropdown-avatar" src="<?= htmlspecialchars($_SESSION['picture_url'] ?? 'https://i.pravatar.cc/50') ?>" alt="Profile">
                                <div class="user-info">
                                    <span class="user-name"><?= htmlspecialchars($_SESSION['first_name'] . ' ' . $_SESSION['last_name'] ?? 'Utilisateur') ?></span>
                                    <span class="user-email"><?= htmlspecialchars($_SESSION['email'] ?? '') ?></span>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a href="profile.php" class="dropdown-item">
                                <i class="fas fa-user"></i>
                                <span>Mon Profil</span>
                            </a>
                            <a href="watchlist.php" class="dropdown-item">
                                <i class="fas fa-bookmark"></i>
                                <span>Ma Liste</span>
                            </a>
                            <a href="settings.php" class="dropdown-item">
                                <i class="fas fa-cog"></i>
                                <span>Paramètres</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="logout.php" class="dropdown-item logout">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Déconnexion</span>
                            </a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="login.php" class="login-button">Connexion</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- side-bar -->
    <div class="sidebar">
        <i class="left-menu-icon fas fa-search"></i>
        <a href="index.php">
            <i class="left-menu-icon fas fa-home"></i></a>
        <i class="left-menu-icon fas fa-users"></i>
        <i class="left-menu-icon fas fa-bookmark"></i>
    </div>
    
    <!-- Movie Details Container -->
    <div class="container">
        <div class="content-container">
            <!-- Movie Header Section -->
            <div class="movie-header-section">
                <div class="movie-title-container">
                    <h1 class="movie-page-title"><?= htmlspecialchars($movie['Title']) ?></h1>
                    <div class="movie-ratings">
                        <div class="rating-item">
                            <i class="fas fa-star"></i>
                            <span><?= htmlspecialchars($movie['ExpertRating']) ?>/10 <small>Critiques</small></span>
                        </div>
                    </div>
                </div>
                
                <!-- User Rating Section (Statique) -->
                <div class="user-rating-section">
                    <h3>Rate this movie:</h3>
                    <div class="star-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <span class="rating-text">Click to rate</span>
                </div>
                
                <!-- Movie Content Section -->
                <div class="movie-content-section">
                    <div class="movie-poster-container">
                        <img src="<?= htmlspecialchars($movie['MediaUrl']) ?>" alt="<?= htmlspecialchars($movie['Title']) ?>" class="movie-poster">
                    </div>
                    
                    <div class="movie-description-container">
                        <h2 class="section-title">Synopsis</h2>
                        <p class="movie-description">
                            <?= htmlspecialchars($movie['Description']) ?>
                        </p>
                        
                        <div class="movie-details-grid">
                            <div class="detail-item">
                                <h3><i class="fas fa-users"></i> Casting</h3>
                                <p>
                                    <?php 
                                    $actorNames = array_map(function($actor) {
                                        return htmlspecialchars($actor['FullName']);
                                    }, $actors);
                                    echo implode(', ', $actorNames) ?: 'Information non disponible';
                                    ?>
                                </p>
                            </div>
                            
                            <div class="detail-item">
                                <h3><i class="far fa-calendar-alt"></i> Année de sortie</h3>
                                <p><?= htmlspecialchars($movie['Year']) ?></p>
                            </div>
                            
                            <div class="detail-item">
                                <h3><i class="fas fa-globe"></i> Pays</h3>
                                <p><?= htmlspecialchars($movie['Country']) ?></p>
                            </div>
                        </div>
                        
                        <div class="bookmark-section">
                            <button class="bookmark-button"><i class="fas fa-bookmark"></i> Add to List</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Comments Section (Statique) -->
            <div class="comments-section">
                <h2 class="section-title">Comments</h2>
                
                <!-- Comment Form -->
                <div class="comment-form">
                    <div class="comment-avatar">
                        <img src="https://i.pravatar.cc/50?img=68" alt="User Avatar">
                    </div>
                    <div class="comment-input-container">
                        <textarea placeholder="Add your comment about this movie..." class="comment-input"></textarea>
                        <button class="submit-comment">Post</button>
                    </div>
                </div>
                
                <!-- Comments List -->
                <div class="comments-list">
                    <!-- Comment 1 -->
                    <div class="comment">
                        <div class="comment-avatar">
                            <img src="https://i.pravatar.cc/50?img=5" alt="User Avatar">
                        </div>
                        <div class="comment-content">
                            <div class="comment-header">
                                <span class="comment-author">Sarah Johnson</span>
                                <span class="comment-date">2 days ago</span>
                                <span class="comment-rating"><i class="fas fa-star"></i> 5/5</span>
                            </div>
                            <p class="comment-text">
                                Heath Ledger's performance as the Joker is simply legendary. One of the best performances in cinema history. The movie redefined what a superhero film could be.
                            </p>
                            <div class="comment-actions">
                                <button class="like-button"><i class="fas fa-thumbs-up"></i> 245</button>
                                <button class="reply-button">Reply</button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Comment 2 -->
                    <div class="comment">
                        <div class="comment-avatar">
                            <img src="https://i.pravatar.cc/50?img=12" alt="User Avatar">
                        </div>
                        <div class="comment-content">
                            <div class="comment-header">
                                <span class="comment-author">Michael Chen</span>
                                <span class="comment-date">1 week ago</span>
                                <span class="comment-rating"><i class="fas fa-star"></i> 4/5</span>
                            </div>
                            <p class="comment-text">
                                The pacing, the acting, the cinematography - everything is perfect. Nolan outdid himself with this one. The interrogation scene between Batman and Joker is my favorite.
                            </p>
                            <div class="comment-actions">
                                <button class="like-button"><i class="fas fa-thumbs-up"></i> 189</button>
                                <button class="reply-button">Reply</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="app.js"></script>
</body>
</html>