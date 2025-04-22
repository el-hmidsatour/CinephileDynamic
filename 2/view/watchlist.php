<?php 
include("navandside.php");

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user']['id']; 

try {
    require_once("../Config/database.php");
    
    $stmt = $cnx->prepare("
        SELECT m.* FROM media m
        JOIN watchlist w ON m.Id = w.MediaId
        WHERE w.UserId = ?
        ORDER BY w.AddDate DESC
    ");
    $stmt->execute([$userId]);
    $watchlistItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    die("Erreur de base de données: " . $e->getMessage());
}
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user']['id'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Watchlist - CinePhile</title>
    <link rel="stylesheet" href="all.css">
    <link rel="stylesheet" href="navandside.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&family=Sen:wght@400..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>

<body>
    <!-- nav-bar -->
    <?php 
        navbar();
    ?>
    <!-- side-bar -->
    <?php 
        sidebar();
    ?>
    
    <!-- Main Content -->
    <div class="container">
        <div class="content-container">
            <!-- Watchlist Header -->
            <div class="watchlist-header">
                <h1><i class="fas fa-bookmark"></i> My Watchlist</h1>
                <div class="watchlist-stats">
                    <div class="stat-item">
                        <span class="stat-number">42</span>
                        <span class="stat-label">Movies Watched</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">18</span>
                        <span class="stat-label">TV Shows Watched</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">7.4</span>
                        <span class="stat-label">Average Rating</span>
                    </div>
                </div>
            </div>
            
            <!-- Filter Options -->
            <div class="watchlist-filters">
                <div class="filter-group">
                    <label for="content-type">Content Type:</label>
                    <select id="content-type">
                        <option value="all">All</option>
                        <option value="movies">Movies Only</option>
                        <option value="tv">TV Shows Only</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="sort-by">Sort By:</label>
                    <select id="sort-by">
                        <option value="recent">Recently Watched</option>
                        <option value="rating">Your Rating</option>
                        <option value="title">Title</option>
                        <option value="year">Release Year</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="rating-filter">Rating:</label>
                    <select id="rating-filter">
                        <option value="all">All Ratings</option>
                        <option value="5">★★★★★ Only</option>
                        <option value="4">★★★★ or Higher</option>
                        <option value="3">★★★ or Higher</option>
                    </select>
                </div>
            </div>
            
            <!-- Watched Items Grid -->
            <!-- Watched Items Grid -->
        <div class="watched-items-container">
        <?php if (empty($watchlistItems)): ?>
            <div class="empty-watchlist">
                <p>Votre watchlist est vide. Ajoutez des films en cliquant sur "Add to List".</p>
            </div>
        <?php else: ?>
         <?php foreach ($watchlistItems as $item): ?>
            <div class="watched-item">
                <div class="item-poster">
                    <img src="<?= htmlspecialchars($item['MediaUrl']) ?>" alt="<?= htmlspecialchars($item['Title']) ?>">
                </div>
                <div class="item-details">
                    <h3 class="item-title"><?= htmlspecialchars($item['Title']) ?> <span class="item-year">(<?= htmlspecialchars($item['Year']) ?>)</span></h3>
                    <div class="item-meta">
                        <span class="item-type"><?= $item['Type'] == 'f' ? 'Movie' : 'TV Show' ?></span>
                        <span class="item-country"><?= htmlspecialchars($item['Country']) ?></span>
                    </div>
                    <div class="item-actions">
                        <a href="contenu.php?id=<?= $item['Id'] ?>" class="action-btn"><i class="fas fa-eye"></i> View</a>
                        <!-- Dans la boucle d'affichage des éléments de la watchlist -->
                        <form method="POST" action="../controller/remove_watchlist.php">
                            <input type="hidden" name="media_id" value="<?= $item['Id'] ?>">
                            <button type="submit" class="remove-btn">
                                <i class="fas fa-trash-alt"></i> Remove
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
        </div>
    </div>
    
    <script src="app.js"></script>
</body>
</html>