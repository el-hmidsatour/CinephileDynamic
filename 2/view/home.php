<?php 
	include("navandside.php");
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
                                    <h2 class="featured-movie-title">Inception</h2>
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
                                        <img src="https://drive.google.com/thumbnail?id=1tGQlvz0xjj0TCqs4dWPRwYPvI7yWvLtT&sz=w1000" alt="Reminiscence" class="movie-poster">
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
                                      <img src="https://drive.google.com/uc?export=view&id=1tGQlvz0xjj0TCqs4dWPRwYPvI7yWvLtT" alt="Dachra" class="movie-poster">
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