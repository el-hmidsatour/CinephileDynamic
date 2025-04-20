<?php 
    include("navandside.php");
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
            <div class="watched-items-container">
                <!-- Movie Item Example -->
                <div class="watched-item">
                    <div class="item-poster">
                        <img src="https://m.media-amazon.com/images/M/MV5BMjAxMzY3NjcxNF5BMl5BanBnXkFtZTcwNTI5OTM0Mw@@._V1_.jpg" alt="Inception">
                        <div class="watched-badge">Watched</div>
                    </div>
                    <div class="item-details">
                        <h3 class="item-title">Inception <span class="item-year">(2010)</span></h3>
                        <div class="item-meta">
                            <span class="item-runtime">2h 28min</span>
                            <span class="item-genre">Sci-Fi, Action</span>
                        </div>
                        <div class="user-rating">
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span class="rating-value">4.5</span>
                            </div>
                            <span class="watch-date">Watched on: 15/06/2023</span>
                        </div>
                        <div class="item-actions">
                            <button class="action-btn"><i class="fas fa-edit"></i> Edit Rating</button>
                            <button class="action-btn"><i class="fas fa-trash"></i> Remove</button>
                        </div>
                    </div>
                </div>
                
                <!-- TV Show Item Example -->
                <div class="watched-item">
                    <div class="item-poster">
                        <img src="https://m.media-amazon.com/images/M/MV5BNGYyZGM5MGMtYTY2Ni00M2Y1LWIzNjQtYWUzM2VlNGVhMDNhXkEyXkFqcGdeQXVyMTMxODk2OTU@._V1_.jpg" alt="Stranger Things">
                        <div class="watched-badge">Watched</div>
                    </div>
                    <div class="item-details">
                        <h3 class="item-title">Stranger Things <span class="item-year">(2016-)</span></h3>
                        <div class="item-meta">
                            <span class="item-runtime">4 Seasons</span>
                            <span class="item-genre">Sci-Fi, Horror</span>
                        </div>
                        <div class="user-rating">
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <span class="rating-value">4.0</span>
                            </div>
                            <span class="watch-date">Last watched: 22/05/2023</span>
                        </div>
                        <div class="item-actions">
                            <button class="action-btn"><i class="fas fa-edit"></i> Edit Rating</button>
                            <button class="action-btn"><i class="fas fa-trash"></i> Remove</button>
                        </div>
                    </div>
                </div>
                
                <!-- Another Movie Item -->
                <div class="watched-item">
                    <div class="item-poster">
                        <img src="https://m.media-amazon.com/images/M/MV5BMTMxNTMwODM0NF5BMl5BanBnXkFtZTcwODAyMTk2Mw@@._V1_.jpg" alt="The Dark Knight">
                        <div class="watched-badge">Watched</div>
                    </div>
                    <div class="item-details">
                        <h3 class="item-title">The Dark Knight <span class="item-year">(2008)</span></h3>
                        <div class="item-meta">
                            <span class="item-runtime">2h 32min</span>
                            <span class="item-genre">Action, Crime</span>
                        </div>
                        <div class="user-rating">
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <span class="rating-value">5.0</span>
                            </div>
                            <span class="watch-date">Watched on: 10/04/2023</span>
                        </div>
                        <div class="item-actions">
                            <button class="action-btn"><i class="fas fa-edit"></i> Edit Rating</button>
                            <button class="action-btn"><i class="fas fa-trash"></i> Remove</button>
                        </div>
                    </div>
                </div>
                
                <!-- Add more watched items here -->
            </div>
            
            <!-- Pagination -->
            <div class="pagination">
                <button class="page-btn disabled"><i class="fas fa-chevron-left"></i></button>
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <button class="page-btn"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </div>
    
    <script src="app.js"></script>
</body>
</html>