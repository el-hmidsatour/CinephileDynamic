<?php 
	include("navandside.php");
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
    <?php 
        navbar();
    ?>
    <!-- side-bar -->
    <?php 
        sidebar();
    ?>
    
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

           
    
           

          <!-- ... (contenu précédent inchangé jusqu'à après search-filter-container) ... -->

          <div class="movie-carousels-container">
            <!-- Carrousel Nouveautés -->
            <div class="carousel-section">
                <h2 class="carousel-title">New Releases <span class="see-all">See all</span></h2>
                <div class="carousel-container">
                    <button class="carousel-arrow carousel-prev"><i class="fas fa-chevron-left"></i></button>
                    <div class="carousel">
                        <div class="carousel-track">
                            <!-- Slide 1 - Reminiscence -->
                            <div class="carousel-slide">
                                <div class="movie-card">
                                    <img src="https://tse3.mm.bing.net/th?id=OIP.opA1o2AUbiKhLN8S8-DRnwHaK-&pid=Api" alt="Reminiscence" class="movie-poster">
                                    <div class="movie-info">
                                        <h3 class="movie-title">Reminiscence</h3>
                                        <div class="movie-meta">
                                            <span>2021</span>
                                            <span class="movie-rating"><i class="fas fa-star"></i> 5.9</span>
                                        </div>
                                        <p class="movie-desc"></p>
                                        <button class="watch-button">Watch Now</button>
                                    </div>
                                </div>
                            </div>
            
                            <!-- Slide 2 - The Marksman -->
                            <div class="carousel-slide">
                                <div class="movie-card">
                                    <img src="https://tse3.mm.bing.net/th?id=OIP.tySXNlW9lhiLLP9n4Lg0CgHaLH&pid=Api" alt="The Marksman" class="movie-poster">
                                    <div class="movie-info">
                                        <h3 class="movie-title">The Marksman</h3>
                                        <div class="movie-meta">
                                            <span>2021</span>
                                            <span class="movie-rating"><i class="fas fa-star"></i> 6.3</span>
                                        </div>
                                        <p class="movie-desc"></p>
                                        <button class="watch-button">Watch Now</button>
                                    </div>
                                </div>
                            </div>
            
                            <!-- Slide 3 - Dune -->
                            <div class="carousel-slide">
                                <div class="movie-card">
                                    <img src="https://tse1.mm.bing.net/th?id=OIP.JnSjX4aaYJAOjRXFE4Q4uAHaKx&pid=Api" alt="Dune" class="movie-poster">
                                    <div class="movie-info">
                                        <h3 class="movie-title">Dune</h3>
                                        <div class="movie-meta">
                                            <span>2021</span>
                                            <span class="movie-rating"><i class="fas fa-star"></i> 8.0</span>
                                        </div>
                                        <p class="movie-desc"></p>
                                        <button class="watch-button">Watch Now</button>
                                    </div>
                                </div>
                            </div>
            
                            <!-- Slide 4 - Spider-Man: No Way Home -->
                            <div class="carousel-slide">
                                <div class="movie-card">
                                    <img src="https://tse3.mm.bing.net/th?id=OIP.vcgpjxcMOiZ-5OHIUB-fTAHaJ4&pid=Api" alt="Spider-Man: No Way Home" class="movie-poster">
                                    <div class="movie-info">
                                        <h3 class="movie-title">Spider-Man: No Way Home</h3>
                                        <div class="movie-meta">
                                            <span>2021</span>
                                            <span class="movie-rating"><i class="fas fa-star"></i> 8.2</span>
                                        </div>
                                        <p class="movie-desc"></p>
                                        <button class="watch-button">Watch Now</button>
                                    </div>
                                </div>
                            </div>
            
                            <!-- Slide 5 - Venom: Let There Be Carnage -->
                            <div class="carousel-slide">
                                <div class="movie-card">
                                    <img src="https://tse3.mm.bing.net/th?id=OIP.qcJBuErkVKAnkggCrpKkmwHaLH&pid=Api" alt="Venom: Let There Be Carnage" class="movie-poster">
                                    <div class="movie-info">
                                        <h3 class="movie-title">Venom: Let There Be Carnage</h3>
                                        <div class="movie-meta">
                                            <span>2021</span>
                                            <span class="movie-rating"><i class="fas fa-star"></i> 5.9</span>
                                        </div>
                                        <p class="movie-desc"></p>
                                        <button class="watch-button">Watch Now</button>
                                    </div>
                                </div>
                            </div>
            
                            <!-- Slide 6 - Exemple supplémentaire (peut être supprimé ou remplacé) -->
                            <div class="carousel-slide">
                                <div class="movie-card">
                                    <img src="https://tse3.mm.bing.net/th?id=OIP.tySXNlW9lhiLLP9n4Lg0CgHaLH&pid=Api" alt="The Marksman" class="movie-poster">
                                    <div class="movie-info">
                                        <h3 class="movie-title">The Marksman</h3>
                                        <div class="movie-meta">
                                            <span>2021</span>
                                            <span class="movie-rating"><i class="fas fa-star"></i> 6.3</span>
                                        </div>
                                        <p class="movie-desc"></p>
                                        <button class="watch-button">Watch Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-arrow carousel-next"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>

            <!-- Carrousel Films Tunisiens -->
            <div class="carousel-section">
                <h2 class="carousel-title">Tunisian Movies <span class="see-all">See all</span></h2>
                <div class="carousel-container">
                    <button class="carousel-arrow carousel-prev"><i class="fas fa-chevron-left"></i></button>
                    <div class="carousel">
                        <div class="carousel-track">
                            <div class="carousel-slide">
                                <div class="movie-card">
                                    <img src="img/bolice.jpg" alt="Bolice" class="movie-poster">
                                    <div class="movie-info">
                                        <h3 class="movie-title">Bolice</h3>
                                        <div class="movie-meta">
                                            <span>2021</span>
                                            <span class="movie-rating"><i class="fas fa-star"></i> 7.2</span>
                                        </div>
                                        <button class="watch-button">Watch Now</button>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-slide">
                                <div class="movie-card">
                                    <img src="img/dachra.jpg" alt="Dachra" class="movie-poster">
                                    <div class="movie-info">
                                        <h3 class="movie-title">Dachra</h3>
                                        <div class="movie-meta">
                                            <span>2018</span>
                                            <span class="movie-rating"><i class="fas fa-star"></i> 6.8</span>
                                        </div>
                                        <button class="watch-button">Watch Now</button>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-slide">
                              <div class="movie-card">
                                  <img src="img/dachra.jpg" alt="Dachra" class="movie-poster">
                                  <div class="movie-info">
                                      <h3 class="movie-title">Dachra</h3>
                                      <div class="movie-meta">
                                          <span>2018</span>
                                          <span class="movie-rating"><i class="fas fa-star"></i> 6.8</span>
                                      </div>
                                      <button class="watch-button">Watch Now</button>
                                  </div>
                              </div>
                          </div>
                          <div class="carousel-slide">
                            <div class="movie-card">
                                <img src="img/dachra.jpg" alt="Dachra" class="movie-poster">
                                <div class="movie-info">
                                    <h3 class="movie-title">Dachra</h3>
                                    <div class="movie-meta">
                                        <span>2018</span>
                                        <span class="movie-rating"><i class="fas fa-star"></i> 6.8</span>
                                    </div>
                                    <button class="watch-button">Watch Now</button>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-slide">
                          <div class="movie-card">
                              <img src="img/dachra.jpg" alt="Dachra" class="movie-poster">
                              <div class="movie-info">
                                  <h3 class="movie-title">Dachra</h3>
                                  <div class="movie-meta">
                                      <span>2018</span>
                                      <span class="movie-rating"><i class="fas fa-star"></i> 6.8</span>
                                  </div>
                                  <button class="watch-button">Watch Now</button>
                              </div>
                          </div>
                      </div>
                      <div class="carousel-slide">
                        <div class="movie-card">
                            <img src="img/dachra.jpg" alt="Dachra" class="movie-poster">
                            <div class="movie-info">
                                <h3 class="movie-title">Dachra</h3>
                                <div class="movie-meta">
                                    <span>2018</span>
                                    <span class="movie-rating"><i class="fas fa-star"></i> 6.8</span>
                                </div>
                                <button class="watch-button">Watch Now</button>
                            </div>
                        </div>
                    </div>
                            <!-- Ajoutez d'autres slides ici -->
                        </div>
                    </div>
                    <button class="carousel-arrow carousel-next"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
          </div>
            <!-- Ajoutez d'autres carrousels pour différentes catégories -->
        
    











            
<!-- À placer avant les balises <script> de fin -->
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
    </body>
</html>