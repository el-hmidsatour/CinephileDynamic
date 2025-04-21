<?php 
include("navandside.php");
include("../Config/database.php");

try {
    $stmt = $cnx->query("SELECT Id,Title, MediaUrl, Year FROM Media where type='f'");
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
    
                    <!-- Slide 1 - Inception -->
                    <div class="featured-carousel-slide">
                        <div class="featured-movie-compact">
                            <!-- Affiche du film à gauche -->
                            <div class="featured-movie-poster">
                                <img src="https://m.media-amazon.com/images/M/MV5BMjAxMzY3NjcxNF5BMl5BanBnXkFtZTcwNTI5OTM0Mw@@._V1_.jpg" alt="Affiche Inception">
                            </div>
                            
                            <!-- Détails à droite -->
                            <div class="featured-movie-details">
                                <!-- Titre -->
                                <div class="movie-title-section">
                                    <h2 class="featured-movie-title"></h2>
                                </div>
                                
                                <!-- Ratings -->
                                <div class="ratings-box">
                                    <div class="rating-item">
                                        <i class="fas fa-star"></i>
                                        <span>8.8 <small>IMDb</small></span>
                                    </div>
                                    <div class="rating-item">
                                        <i class="fas fa-star"></i>
                                        <span>87% <small>Rotten</small></span>
                                    </div>
                                </div>
                                
                                <!-- Description -->
                                <div class="description-box info-box">
                                    <h3><i class="fas fa-align-left"></i> Synopsis</h3>
                                    <p class="movie-description">
                                        Dom Cobb est un voleur expérimenté qui subtilise les secrets les plus précieux enfouis dans le subconscient pendant que l'esprit de ses victimes est vulnérable lors du sommeil. 
                                    </p>
                                </div>
                                
                                <!-- Casting -->
                                <div class="info-box">
                                    <h3><i class="fas fa-users"></i> Casting</h3>
                                    <p>Leonardo DiCaprio, Joseph Gordon-Levitt, Ellen Page</p>
                                </div>
                                
                                <!-- Date de sortie -->
                                <div class="info-box">
                                    <h3><i class="far fa-calendar-alt"></i> Date de sortie</h3>
                                    <p>16 Juillet 2010</p>
                                </div>
                                
                                <!-- Durée -->
                                <div class="info-box">
                                    <h3><i class="far fa-clock"></i> Durée</h3>
                                    <p>2h 28min</p>
                                </div>
                                
                                <!-- Genre -->
                                <div class="info-box">
                                    <h3><i class="fas fa-tags"></i> Genre</h3>
                                    <p>Science-Fiction, Thriller</p>
                                </div>
                                
                                <!-- Bouton Watch -->
                                <div class="watch-button-container">
                                    <button class="watch-button">Regarder</button>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <!-- Slide 2 - The Dark Knight -->
                    <div class="featured-carousel-slide">
                        <div class="featured-movie-compact">
                            <!-- Affiche du film à gauche -->
                            <div class="featured-movie-poster">
                                <img src="https://m.media-amazon.com/images/M/MV5BMTMxNTMwODM0NF5BMl5BanBnXkFtZTcwODAyMTk2Mw@@._V1_.jpg" alt="Affiche The Dark Knight">
                            </div>
                            
                            <!-- Détails à droite -->
                            <div class="featured-movie-details">
                                <!-- Titre -->
                                <div class="movie-title-section">
                                    <h2 class="featured-movie-title">The Dark Knight</h2>
                                </div>
                                
                                <!-- Ratings -->
                                <div class="ratings-box">
                                    <div class="rating-item">
                                        <i class="fas fa-star"></i>
                                        <span>9.0 <small>IMDb</small></span>
                                    </div>
                                    <div class="rating-item">
                                        <i class="fas fa-star"></i>
                                        <span>94% <small>Rotten</small></span>
                                    </div>
                                </div>
                                
                                <!-- Description -->
                                <div class="description-box info-box">
                                    <h3><i class="fas fa-align-left"></i> Synopsis</h3>
                                    <p class="movie-description">
                                        Batman relève le défi ultime en affrontant le Joker, un criminel psychotique qui sème la terreur et le chaos dans Gotham City.
                                    </p>
                                </div>
                                
                                <!-- Casting -->
                                <div class="info-box">
                                    <h3><i class="fas fa-users"></i> Casting</h3>
                                    <p>Christian Bale, Heath Ledger, Aaron Eckhart</p>
                                </div>
                                
                                <!-- Date de sortie -->
                                <div class="info-box">
                                    <h3><i class="far fa-calendar-alt"></i> Date de sortie</h3>
                                    <p>13 Août 2008</p>
                                </div>
                                
                                <!-- Durée -->
                                <div class="info-box">
                                    <h3><i class="far fa-clock"></i> Durée</h3>
                                    <p>2h 32min</p>
                                </div>
                                
                                <!-- Genre -->
                                <div class="info-box">
                                    <h3><i class="fas fa-tags"></i> Genre</h3>
                                    <p>Action, Crime, Drame</p>
                                </div>
                                
                                <!-- Bouton Watch -->
                                <div class="watch-button-container">
                                    <button class="watch-button">Regarder</button>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <!-- Slide 3 - Pulp Fiction -->
                    <div class="featured-carousel-slide">
                        <div class="featured-movie-compact">
                            <!-- Affiche du film à gauche -->
                            <div class="featured-movie-poster">
                                <img src="https://m.media-amazon.com/images/M/MV5BNGNhMDIzZTUtNTBlZi00MTRlLWFjM2ItYzViMjE3YzI5MjljXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_.jpg" alt="Affiche Pulp Fiction">
                            </div>
                            
                            <!-- Détails à droite -->
                            <div class="featured-movie-details">
                                <!-- Titre -->
                                <div class="movie-title-section">
                                    <h2 class="featured-movie-title">Pulp Fiction</h2>
                                </div>
                                
                                <!-- Ratings -->
                                <div class="ratings-box">
                                    <div class="rating-item">
                                        <i class="fas fa-star"></i>
                                        <span>8.9 <small>IMDb</small></span>
                                    </div>
                                    <div class="rating-item">
                                        <i class="fas fa-star"></i>
                                        <span>92% <small>Rotten</small></span>
                                    </div>
                                </div>
                                
                                <!-- Description -->
                                <div class="description-box info-box">
                                    <h3><i class="fas fa-align-left"></i> Synopsis</h3>
                                    <p class="movie-description">
                                        Les vies de deux tueurs à gages, d'un boxeur, d'un gangster et de sa femme, et d'un couple de petits braqueurs s'entrecroisent dans une série d'histoires violentes et absurdes.
                                    </p>
                                </div>
                                
                                <!-- Casting -->
                                <div class="info-box">
                                    <h3><i class="fas fa-users"></i> Casting</h3>
                                    <p>John Travolta, Samuel L. Jackson, Uma Thurman</p>
                                </div>
                                
                                <!-- Date de sortie -->
                                <div class="info-box">
                                    <h3><i class="far fa-calendar-alt"></i> Date de sortie</h3>
                                    <p>21 Octobre 1994</p>
                                </div>
                                
                                <!-- Durée -->
                                <div class="info-box">
                                    <h3><i class="far fa-clock"></i> Durée</h3>
                                    <p>2h 34min</p>
                                </div>
                                
                                <!-- Genre -->
                                <div class="info-box">
                                    <h3><i class="fas fa-tags"></i> Genre</h3>
                                    <p>Crime, Drame</p>
                                </div>
                                
                                <!-- Bouton Watch -->
                                <div class="watch-button-container">
                                    <button class="watch-button">Regarder</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 4 - Parasite -->
                    <div class="featured-carousel-slide">
                        <div class="featured-movie-compact">
                            <!-- Affiche du film à gauche -->
                            <div class="featured-movie-poster">
                                <img src="https://m.media-amazon.com/images/M/MV5BYWZjMjk3ZTItODQ2ZC00NTY5LWE0ZDYtZTI3MjcwN2Q5NTVkXkEyXkFqcGdeQXVyODk4OTc3MTY@._V1_.jpg" alt="Affiche Parasite">
                            </div>
                            
                            <!-- Détails à droite -->
                            <div class="featured-movie-details">
                                <!-- Titre -->
                                <div class="movie-title-section">
                                    <h2 class="featured-movie-title">Parasite</h2>
                                </div>
                                
                                <!-- Ratings -->
                                <div class="ratings-box">
                                    <div class="rating-item">
                                        <i class="fas fa-star"></i>
                                        <span>8.5 <small>IMDb</small></span>
                                    </div>
                                    <div class="rating-item">
                                        <i class="fas fa-star"></i>
                                        <span>99% <small>Rotten</small></span>
                                    </div>
                                </div>
                                
                                <!-- Description -->
                                <div class="description-box info-box">
                                    <h3><i class="fas fa-align-left"></i> Synopsis</h3>
                                    <p class="movie-description">
                                        Toute la famille de Ki-taek est au chômage et s'intéresse fortement au train de vie de la richissime famille Park. Un jour, leur fils réussit à se faire recommander pour donner des cours particuliers d'anglais chez les Park.
                                    </p>
                                </div>
                                
                                <!-- Casting -->
                                <div class="info-box">
                                    <h3><i class="fas fa-users"></i> Casting</h3>
                                    <p>Song Kang-ho, Lee Sun-kyun, Cho Yeo-jeong</p>
                                </div>
                                
                                <!-- Date de sortie -->
                                <div class="info-box">
                                    <h3><i class="far fa-calendar-alt"></i> Date de sortie</h3>
                                    <p>5 Juin 2019</p>
                                </div>
                                
                                <!-- Durée -->
                                <div class="info-box">
                                    <h3><i class="far fa-clock"></i> Durée</h3>
                                    <p>2h 12min</p>
                                </div>
                                
                                <!-- Genre -->
                                <div class="info-box">
                                    <h3><i class="fas fa-tags"></i> Genre</h3>
                                    <p>Thriller, Drame</p>
                                </div>
                                
                                <!-- Bouton Watch -->
                                <div class="watch-button-container">
                                    <button class="watch-button">Regarder</button>
                                </div>
                            </div>
                        </div>
                     </div>
    
                     <!-- Slide 5 - Spider-Man: Across the Spider-Verse -->
                    <div class="featured-carousel-slide">
                        <div class="featured-movie-compact">
                            <!-- Affiche du film à gauche -->
                            <div class="featured-movie-poster">
                                <img src="https://m.media-amazon.com/images/M/MV5BMzI0NmVkMjEtYmY4MS00ZDMxLTlkZmEtMzU4MDQxYTMzMjU2XkEyXkFqcGdeQXVyMzQ0MzA0NTM@._V1_.jpg" alt="Affiche Spider-Verse">
                            </div>
                            
                            <!-- Détails à droite -->
                            <div class="featured-movie-details">
                                <!-- Titre -->
                                <div class="movie-title-section">
                                    <h2 class="featured-movie-title">Spider-Man: Across the Spider-Verse</h2>
                                </div>
                                
                                <!-- Ratings -->
                                <div class="ratings-box">
                                    <div class="rating-item">
                                        <i class="fas fa-star"></i>
                                        <span>8.7 <small>IMDb</small></span>
                                    </div>
                                    <div class="rating-item">
                                        <i class="fas fa-star"></i>
                                        <span>95% <small>Rotten</small></span>
                                    </div>
                                </div>
                                
                                <!-- Description -->
                                <div class="description-box info-box">
                                    <h3><i class="fas fa-align-left"></i> Synopsis</h3>
                                    <p class="movie-description">
                                        Miles Morales replonge dans le Multivers pour rejoindre Gwen Stacy et une nouvelle équipe de Spider-People qui doivent affronter un ennemi plus puissant que tout ce qu'ils ont connu.
                                    </p>
                                </div>
                                
                                <!-- Casting -->
                                <div class="info-box">
                                    <h3><i class="fas fa-users"></i> Casting</h3>
                                    <p>Shameik Moore, Hailee Steinfeld, Oscar Isaac</p>
                                </div>
                                
                                <!-- Date de sortie -->
                                <div class="info-box">
                                    <h3><i class="far fa-calendar-alt"></i> Date de sortie</h3>
                                    <p>2 Juin 2023</p>
                                </div>
                                
                                <!-- Durée -->
                                <div class="info-box">
                                    <h3><i class="far fa-clock"></i> Durée</h3>
                                    <p>2h 20min</p>
                                </div>
                                
                                <!-- Genre -->
                                <div class="info-box">
                                    <h3><i class="fas fa-tags"></i> Genre</h3>
                                    <p>Animation, Action, Aventure</p>
                                </div>
                                
                                <!-- Bouton Watch -->
                                <div class="watch-button-container">
                                    <button class="watch-button">Regarder</button>
                                </div>
                            </div>
                        </div>
                     </div>
    
                    <!-- Add more slides here if needed -->
    
                </div> <!-- End Track -->
    
                <!-- Pagination Dots -->
                <div class="carousel-dots">
                    <!-- Dots will be generated by JavaScript -->
                </div>
    
            </div><!-- End Track -->
    
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