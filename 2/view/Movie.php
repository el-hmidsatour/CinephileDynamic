<?php 
include("navandside.php");
include("../Config/database.php");

try {
    // Récupérer les films depuis la base de données
    $stmt = $cnx->query("SELECT Title, MediaUrl, Year FROM Media where type='f'");
    $movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur de base de données : " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CinePhile - Movies</title>
    <link rel="stylesheet" href="navandside.css">
    <link rel="stylesheet" href="all.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&family=Sen:wght@400..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>
<body>
    <!-- nav-bar -->
    <?php navbar(); ?>
    <!-- side-bar -->
    <?php sidebar(); ?>
    
    <div class="container">
        <div class="content-container">
            <div class="movies-header">
                <h1>Discover Movies</h1>
                <p>Browse our extensive collection of films from all genres</p>
            </div>
            
            <div class="search-filter-container">
                <div class="search-box">
                    <input type="text" placeholder="Search for movies...">
                </div>
                <div class="filter-dropdown">
                    <select>
                        <option value="">All Genres</option>
                        <option value="action">Action</option>
                        <option value="comedy">Comedy</option>
                        <option value="drama">Drama</option>
                        <option value="horror">Horror</option>
                        <option value="sci-fi">Sci-Fi</option>
                        <option value="tunisian">Tunisian</option>
                    </select>
                </div>
            </div>

            <div class="movie-carousels-container">
                <!-- Carrousel Principal -->
                <div class="carousel-section">
                    <h2 class="carousel-title">All Movies <span class="see-all">See all</span></h2>
                    <div class="carousel-container">
                        <button class="carousel-arrow carousel-prev"><i class="fas fa-chevron-left"></i></button>
                        <div class="carousel">
                            <div class="carousel-track">
                                <?php foreach ($movies as $movie): ?>
                                <div class="carousel-slide">
                                    <div class="movie-card">
                                        <img src="<?= htmlspecialchars($movie['MediaUrl']) ?>" alt="<?= htmlspecialchars($movie['Title']) ?>" class="movie-poster">
                                        <div class="movie-info">
                                            <h3 class="movie-title"><?= htmlspecialchars($movie['Title']) ?></h3>
                                            <div class="movie-meta">
                                                <span><?= htmlspecialchars($movie['Year']) ?></span>
                                                <span class="movie-rating"><i class="fas fa-star"></i> <?= rand(5, 9) ?>.<?= rand(0, 9) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <button class="carousel-arrow carousel-next"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>

                <!-- Vous pouvez ajouter d'autres carrousels ici -->
            </div>
            
            <section class="cine-team">
            <div class="team-container">
                <h3 class="section-title">Our Team
                </h3>
                <p class="section-subtitle">The enthusiasts behind CinePhile</p>
                
                <div class="team-grid">
                    <div class="team-member">
                        <div class="member-photo">
                            <div class="member-overlay">
                                <i class="fas fa-camera"></i>
                            </div>
                        </div>
                        <h4>Ahmed Ameur Mestiri</h4>
                        <p class="role"></p>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                    
                    <div class="team-member">
                        <div class="member-photo">
                            <div class="member-overlay">
                                <i class="fas fa-camera"></i>
                            </div>
                        </div>
                        <h4>Mohamed Rayen Touati</h4>
                        <p class="role"></p>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                    
                    <div class="team-member">
                        <div class="member-photo">
                            <div class="member-overlay">
                                <i class="fas fa-camera"></i>
                            </div>
                        </div>
                        <h4>Eya Lassoued</h4>
                        <p class="role"></p>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="cine-footer">
                    <p class="copyright">&copy; 2025 CinePhile. All rights reserved.</p>
                    <div class="legal-links">
                        <a href="about_us.html">About Us</a>

                        
                    </div>
                </div>
            </div>
        </section>

            <script src="app.js"></script>
            <script src="MV_CAROUSEL.js"></script>
        </div>
    </div>
</body>
</html>