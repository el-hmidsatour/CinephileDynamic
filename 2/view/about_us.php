<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CinePhile - Movies</title>
    <link rel="stylesheet" href="navandside.css">
    <link rel="stylesheet" href="all.css">
    <link rel="stylesheet" href="about_us.css">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&family=Sen:wght@400..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>
<body>
    <div class="navbar">
        <div class="navbar-container">
            <div class="logo-container"><h1 class="logo">CinePhile</h1></div>
            <div class="menu-container">
              <ul class="menu-list">
                  <a href="index.html">Home</a>
                  <a href="Movie.html">Movies</a>
                  <a href="Series.html">Series</a>
                  <a href="Popular.html">Popular</a>
                 <a href="Arabic_Trends.html">Arabic Trends</a>
              </ul>
            </div>
            <div class="navbar-profile-section">
      <div class="toggle">
          <i class="fas fa-moon toggle-icon"></i>
          <i class="fas fa-sun toggle-icon"></i>
          <div class="toggle-ball"></div>
      </div>
      
      <div class="user-profile">
          <div class="profile-trigger">
              <div class="avatar-wrapper">
                  <img class="profile-avatar" src="https://i.pravatar.cc/50?img=68" alt="Profile">
                  <div class="status-indicator"></div>
              </div>
              <div class="profile-badge">
                  <span class="username">Aziz</span>
                  <i class="fas fa-chevron-down dropdown-arrow"></i>
              </div>
          </div>
          
          <div class="profile-dropdown-menu">
              <div class="dropdown-header">
                  <img class="dropdown-avatar" src="https://i.pravatar.cc/50?img=68" alt="Profile">
                  <div class="user-info">
                      <span class="user-name">Aziz Ben Ammar</span>
                      <span class="user-email">aziz@cinephile.com</span>
                  </div>
              </div>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                  <i class="fas fa-user"></i>
                  <span>Mon Profil</span>
              </a>
              <a href="#" class="dropdown-item">
                  <i class="fas fa-bookmark"></i>
                  <span>Ma Liste</span>
              </a>
              <a href="#" class="dropdown-item">
                  <i class="fas fa-cog"></i>
                  <span>Paramètres</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item logout">
                  <i class="fas fa-sign-out-alt"></i>
                  <span>Déconnexion</span>
              </a>
          </div>
      </div>
  </div>
</div>
</div>
    

    <div class="sidebar">
        <i class="left-menu-icon fas fa-search"></i>
        <a href="login.html"><i class="left-menu-icon fas fa-home"></i></a> 
        <i class="left-menu-icon fas fa-users"></i>
        <i class="left-menu-icon fas fa-bookmark"></i>
    </div>
    
    <div class="about-main">
        <div class="about-content">
            <header class="about-header">
                <h1 class="cinematic-title">About <span class="cinephile-red">Cine</span><span class="cinephile-white">Phile</span></h1>
                <p class="tagline">Your ultimate destination for discovering and enjoying<br>the best movies and TV shows from around the world</p>
            </header>
            
            <section class="about-section">
                <h2>Our Story</h2>
                <p>Founded in 2025, CinePhile began as a passion project by a group of film enthusiasts who wanted to create a more personalized streaming experience. We noticed that most platforms were either too generic or too expensive, so we set out to build something different.</p>
                <p>Today, CinePhile has grown into a thriving community of movie lovers, offering carefully curated content from Hollywood blockbusters to independent films and regional cinema.</p>
            </section>
            
            <section class="about-section">
                <h2>How It Works</h2>
                <p>CinePhile makes discovering your next favorite movie or show effortless with our intelligent recommendation system and community-driven ratings.</p>
                
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-film"></i>
                        </div>
                        <h3>Personalized Recommendations</h3>
                        <p>Our algorithm learns your preferences to suggest titles you'll love based on your viewing history and ratings.</p>
                    </div>
                    
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3>Community Driven</h3>
                        <p>Real reviews from real people. No bots, no fake ratings - just honest opinions from fellow cinephiles.</p>
                    </div>
                    
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-globe"></i>
                        </div>
                        <h3>Global Cinema</h3>
                        <p>From Hollywood to Bollywood, Nollywood to Arab cinema - we celebrate films from every corner of the world.</p>
                    </div>
                </div>
            </section>
            
           
            
            <section class="about-section">
                <h2>Our Mission</h2>
                <p>At CinePhile, we believe that great cinema should be accessible to everyone, everywhere. We're committed to:</p>
                <ul style="color: #ddd; line-height: 1.6; margin-left: 20px;">
                    <li>Providing a diverse selection of high-quality films and shows</li>
                    <li>Supporting independent filmmakers and regional cinema</li>
                    <li>Creating an inclusive community for film lovers</li>
                    <li>Developing innovative features to enhance your viewing experience</li>
                </ul>
            </section>
        </div>
    </div>
    











            
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
                    <a href="#">About Us</a>
                    
                </div>
            </div>
        </div>
    </section>

                        <script src="app.js"></script>
                        <script src="MV_CAROUSEL.js"></script>
    </body>
</html>



