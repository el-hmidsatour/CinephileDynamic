<?php
// Connexion à la base de données
require_once("../Config/database.php");
include("navandside.php");

// Récupérer l'ID du film depuis l'URL
$movieId = $_POST['id'] ?? 1;

// Requête pour récupérer les détails du film
try {
    $stmt = $cnx->prepare("SELECT * FROM media WHERE Id = ?");
    $stmt->execute([$movieId]);
    $movie = $stmt->fetch(PDO::FETCH_ASSOC);

    // Get actors
    $actorsStmt = $cnx->prepare("
        SELECT a.* FROM actors a
        JOIN acted act ON a.ActorId = act.ActorId
        WHERE act.MediaId = ?
        LIMIT 5
    ");
    $actorsStmt->execute([$movieId]);
    $actors = $actorsStmt->fetchAll(PDO::FETCH_ASSOC);

    // Get genres (using NameGenre and tagged table)
    $genresStmt = $cnx->prepare("
        SELECT g.NameGenre FROM genres g
        JOIN tagged t ON g.GenreId = t.GenreId
        WHERE t.MediaId = ?
    ");
    $genresStmt->execute([$movieId]);
    $genres = $genresStmt->fetchAll(PDO::FETCH_ASSOC);

    // Get reviews with user info
    $reviewsStmt = $cnx->prepare("
        SELECT r.*, u.FirstName, u.LastName, u.PictureUrl 
        FROM reviews r
        JOIN users u ON r.UserId = u.UserId
        WHERE r.MediaId = ?
        ORDER BY r.Date DESC
    ");
    $reviewsStmt->execute([$movieId]);
    $reviews = $reviewsStmt->fetchAll(PDO::FETCH_ASSOC);

    // Calculate average rating (1-5 scale)
    $avgRatingStmt = $cnx->prepare("SELECT AVG(Rating) as avg_rating FROM reviews WHERE MediaId = ?");
    $avgRatingStmt->execute([$movieId]);
    $avgRating = $avgRatingStmt->fetch(PDO::FETCH_ASSOC)['avg_rating'];
    
} catch (PDOException $e) {
    die("Erreur de base de données: " . $e->getMessage());
}

// Handle review submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_review'])) {
    if (!isset($_SESSION['user_id'])) {
        die("Vous devez être connecté pour poster un commentaire");
    }
    
    $rating = $_POST['rating'] ?? 0;
    $comment = $_POST['comment'] ?? '';
    
    if (empty($comment) || $rating < 1 || $rating > 5) {
        $reviewError = "Veuillez donner une note (1-5 étoiles) et écrire un commentaire";
    } else {
        try {
            // Store rating directly (1-5 scale)
            $stmt = $cnx->prepare("
                INSERT INTO reviews (UserId, MediaId, Rating, Comment, Date)
                VALUES (?, ?, ?, ?, NOW())
            ");
            $stmt->execute([
                $_SESSION['user_id'],
                $movieId,
                $rating, // Store as 1.0-5.0
                $comment
            ]);
            
            // Refresh page to show new review
            header("Location: contenu.php?id=$movieId");
            exit();
        } catch (PDOException $e) {
            $reviewError = "Erreur lors de l'envoi du commentaire: " . $e->getMessage();
        }
    }
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
    <style>
        .rating-stars {
            display: flex;
            gap: 5px;
            margin-bottom: 10px;
        }
        .rating-stars i {
            color: #ccc;
            cursor: pointer;
            font-size: 1.5em;
        }
        .rating-stars i.active {
            color: #ffc107;
        }
        .average-rating {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }
        .average-rating-value {
            font-size: 1.8em;
            font-weight: bold;
        }
        .genre-badge {
            display: inline-block;
            background: #333;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            margin-right: 8px;
            margin-bottom: 8px;
            font-size: 0.9em;
        }
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <?php
    navbar();
    sidebar();

        ?>
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
                
                <!-- Average Rating Display -->
                <div class="average-rating">
                    <div class="average-rating-value">
                        <?= number_format(($avgRating ?? 0), 1) ?>/10
                    </div>
                    <div class="average-rating-stars">
                        <?php
                        $filledStars = round($avgRating ?? 0);
                        for ($i = 1; $i <= 5; $i++): ?>
                            <i class="fas fa-star <?= $i <= $filledStars ? 'active' : '' ?>"></i>
                        <?php endfor; ?>
                        <span>(<?= count($reviews) ?> avis)</span>
                    </div>
                </div>
                
                <!-- Movie Content Section -->
                <div class="movie-content-section">
                    <div class="movie-poster-container">
                        <div class="contenu-movie-container">
                            <img src="<?= htmlspecialchars($movie['MediaUrl']) ?>" alt="<?= htmlspecialchars($movie['Title']) ?>" class="movie-poster">
                        </div>
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
                                <h3><i class="fas fa-tags"></i> Genres</h3>
                                <div class="genres-list">
                                    <?php foreach ($genres as $genre): ?>
                                        <span class="genre-badge"><?= htmlspecialchars($genre['NameGenre']) ?></span>
                                    <?php endforeach; ?>
                                </div>
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
                            <form method="POST" action="">
                                <input type="hidden" name="id" value="<?= $movieId ?>">
                                <button type="submit" name="add_to_watchlist" class="bookmark-button">
                                    <i class="fas fa-bookmark"></i> Add to List
                                </button>
                            </form>
                            <?php if (isset($_SESSION['watchlist_message'])): ?>
                                <div class="watchlist-message"><?= $_SESSION['watchlist_message'] ?></div>
                                <?php unset($_SESSION['watchlist_message']); ?>
                            <?php endif; ?>
</div>
                    </div>
                </div>
            </div>
            
            <!-- Reviews Section -->
            <div class="comments-section">
                <h2 class="section-title">User Reviews</h2>
                
                <!-- Review Form -->
                <?php if (isset($_SESSION['user_id'])): ?>
                <div class="comment-form">
                    <div class="comment-avatar">
                        <img src="<?= htmlspecialchars($_SESSION['picture_url'] ?? 'https://i.pravatar.cc/50') ?>" alt="User Avatar">
                    </div>
                    <div class="comment-input-container">
                        <form method="POST" action="">
                            <input type="hidden" name="id" value="<?= $movieId ?>">
                            
                            <div class="rating-stars" id="rating-stars">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="fas fa-star" data-rating="<?= $i ?>"></i>
                                <?php endfor; ?>
                                <input type="hidden" name="rating" id="selected-rating" value="0" required>
                            </div>
                            
                            <?php if (isset($reviewError)): ?>
                                <div class="alert alert-danger"><?= $reviewError ?></div>
                            <?php endif; ?>
                            
                            <textarea name="comment" placeholder="Share your thoughts about this movie..." class="comment-input" required></textarea>
                            <button type="submit" name="submit_review" class="submit-comment">Post Review</button>
                        </form>
                    </div>
                </div>
                <?php else: ?>
                    <p><a href="login.php">Log in</a> to post a review</p>
                <?php endif; ?>
                
                <!-- Reviews List -->
                <div class="comments-list">
                    <?php foreach ($reviews as $review): ?>
                        <div class="comment">
                            <div class="comment-avatar">
                                <img src="<?= htmlspecialchars($review['PictureUrl'] ?? 'https://i.pravatar.cc/50') ?>" alt="User Avatar">
                            </div>
                            <div class="comment-content">
                                <div class="comment-header">
                                    <span class="comment-author">
                                        <?= htmlspecialchars($review['FirstName'] . ' ' . $review['LastName']) ?>
                                    </span>
                                    <span class="comment-date">
                                        <?= date('M d, Y', strtotime($review['Date'])) ?>
                                    </span>
                                    <span class="comment-rating">
                                        <?php 
                                        $starRating = $review['Rating']; // Already 1-5 scale
                                        for ($i = 1; $i <= 5; $i++): ?>
                                            <i class="fas fa-star <?= $i <= $starRating ? 'active' : '' ?>"></i>
                                        <?php endfor; ?>
                                        (<?= number_format($review['Rating'], 1) ?>/10)
                                    </span>
                                </div>
                                <p class="comment-text">
                                    <?= htmlspecialchars($review['Comment']) ?>
                                </p>
                                <div class="comment-actions">
                                    <button class="like-button"><i class="fas fa-thumbs-up"></i> Like</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    
                    <?php if (empty($reviews)): ?>
                        <p>No reviews yet. Be the first to review!</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Star rating selection
        document.querySelectorAll('#rating-stars i').forEach(star => {
            star.addEventListener('click', () => {
                const rating = parseInt(star.dataset.rating);
                const stars = document.querySelectorAll('#rating-stars i');
                
                // Update visual stars
                stars.forEach((s, index) => {
                    if (index < rating) {
                        s.classList.add('active');
                    } else {
                        s.classList.remove('active');
                    }
                });
                
                // Update hidden input value
                document.getElementById('selected-rating').value = rating;
            });
        });
        
        // Form validation
        document.querySelector('form').addEventListener('submit', (e) => {
            const rating = document.getElementById('selected-rating').value;
            const comment = document.querySelector('textarea[name="comment"]').value;
            
            if (rating < 1 || rating > 5) {
                e.preventDefault();
                alert('Please select a rating between 1-5 stars');
                return false;
            }
            
            if (!comment.trim()) {
                e.preventDefault();
                alert('Please write a review');
                return false;
            }
        });

        document.querySelectorAll('.rating-stars i').forEach(star => {
            star.addEventListener('mouseover', () => {
                star.style.transform = 'scale(1.3)';
                star.style.transition = 'all 0.2s';
            });
            star.addEventListener('mouseout', () => {
                star.style.transform = 'scale(1)';
            });
        });
    </script>
</body>
</html>