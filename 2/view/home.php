<?php 
include("navandside.php");
include("../Config/database.php");
try {
    // Get all movies with their details
    $stmt = $cnx->query("
        SELECT m.Id, m.Title, m.MediaUrl, m.Year, m.Description, m.ExpertRating, 
               GROUP_CONCAT(DISTINCT a.FullName SEPARATOR ', ') AS Actors,
               GROUP_CONCAT(DISTINCT g.NameGenre SEPARATOR ', ') AS Genres
        FROM media m
        LEFT JOIN acted act ON m.Id = act.MediaId
        LEFT JOIN actors a ON act.ActorId = a.ActorId
        LEFT JOIN tagged t ON m.Id = t.MediaId
        LEFT JOIN genres g ON t.GenreId = g.GenreId
        WHERE m.type='f'
        GROUP BY m.Id
        LIMIT 7
    ");
    $featuredMovies = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Get all movies for the regular carousel
    $stmt = $cnx->query("SELECT Id, Title, MediaUrl, Year FROM Media where type='f'");
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

    <link rel="stylesheet" href="all.css">
    <link rel="stylesheet" href="navandside.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&family=Sen:wght@400..800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <title>our website </title>
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
    <!-- container for all the page-->
    <div class="container">
        <!-- container pushing on the sidebar-->
        <div class="content-container">
            <!-- giant carousel card here (push the top since the side bar is floating)-->
<div class="featured-carousel-container">
    <div class="featured-carousel-track">
        <?php foreach ($featuredMovies as $movie): ?>
            <div class="featured-carousel-slide">
                <div class="featured-movie-compact">
                    <!-- Movie poster -->
                    <div class="featured-movie-poster">
                        <img src="<?= htmlspecialchars($movie['MediaUrl']) ?>" alt="<?= htmlspecialchars($movie['Title']) ?>">
                    </div>
                    
                    <!-- Movie details -->
                    <div class="featured-movie-details">
                        <!-- Title -->
                        <div class="movie-title-section">
                            <h2 class="featured-movie-title"><?= htmlspecialchars($movie['Title']) ?></h2>
                        </div>
                        
                        <!-- Ratings - only IMDb (removed Rotten Tomatoes) -->
                        <div class="ratings-box">
                            <div class="rating-item">
                                <i class="fas fa-star"></i>
                                <span><?= htmlspecialchars($movie['ExpertRating']) ?> <small>IMDb</small></span>
                            </div>
                        </div>
                        
                        <!-- Description -->
                        <div class="description-box info-box">
                            <h3><i class="fas fa-align-left"></i> Synopsis</h3>
                            <p class="movie-description">
                                <?= htmlspecialchars($movie['Description']) ?>
                            </p>
                        </div>
                        
                        <!-- Casting -->
                        <div class="info-box">
                            <h3><i class="fas fa-users"></i> Casting</h3>
                            <p><?= htmlspecialchars($movie['Actors'] ?? 'Information not available') ?></p>
                        </div>
                        
                        <!-- Release Date -->
                        <div class="info-box">
                            <h3><i class="far fa-calendar-alt"></i> Date de sortie</h3>
                            <p><?= htmlspecialchars($movie['Year']) ?></p>
                        </div>
                        
                        <!-- Genres -->
                        <div class="info-box">
                            <h3><i class="fas fa-tags"></i> Genre</h3>
                            <p><?= htmlspecialchars($movie['Genres'] ?? 'Information not available') ?></p>
                        </div>
                        
                        <!-- Watch Button -->
                        <div class="watch-button-container">
                            <form method="post" action="contenu.php">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($movie['Id']) ?>">
                                <button type="submit" class="watch-button">View Details</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    
    <!-- Pagination Dots -->
    <div class="carousel-dots">
        <!-- Dots will be generated by JavaScript -->
    </div>
</div>
    
                <!-- Pagination Dots -->
                <div class="carousel-dots">
                    <!-- Dots will be generated by JavaScript -->
                </div>
    
            </div> <!-- End Container -->
            <!-- END: Featured Movie Carousel -->
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
                                        <form method="post" action="contenu.php">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($movie['Id']) ?>">
                                            <button type="submit" class="movie-card-button">
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
                                            </button>
                                        </form>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <button class="carousel-arrow carousel-next"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>

                <!-- Vous pouvez ajouter d'autres carrousels ici -->
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
                                        <form method="post" action="contenu.php">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($movie['Id']) ?>">
                                            <button type="submit" class="movie-card-button">
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
                                            </button>
                                        </form>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <button class="carousel-arrow carousel-next"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>

                <!-- Vous pouvez ajouter d'autres carrousels ici -->
            </div>
            </div>
                <!-- Ajoutez d'autres carrousels pour différentes catégories -->
            

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




            </div>
            <script src="app.js"></script>
            <script src="MV_CAROUSEL.js"></script>
            <script src="featured-carousel.js" defer></script>