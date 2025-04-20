<?php 
include("navandside.php");
include("../Config/database.php");

$searchTerm = $_GET['searchterm'] ?? '';
$type=$_GET['type'] ?? '%';
$genre=$_GET['genre']?? '';
$query = "SELECT * FROM media WHERE Type LIKE '$type'";
$params = [];


if (!empty($searchTerm)) {
    $query .= " AND Title LIKE :search";
    $params['search'] = "%$searchTerm%";
}
if(!empty($genre))
{
    $query .= " AND Id IN 
        (SELECT MediaId FROM tagged Where GenreId=
            (SELECT GenreId FROM genres where NameGenre='".$genre."'
        )
    )";
}

$stmt = $cnx->prepare($query);
$stmt->execute($params);
$movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Movies Grid</title>

    <link rel="stylesheet" href="navandside.css">
    <link rel="stylesheet" href="all.css">
    <link rel="stylesheet" href="Movies.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&family=Sen:wght@400..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>
<body>
    <!-- nav-bar -->
    <?php navbar(); ?>
    <!-- side-bar -->
    <?php sidebar(); ?>
    
    <div class="container py-5">
       <form action="search.php" method="get" id="searchForm">
                <div class="search-filter-container">
                    <div class="search-box">
                        <input type="text" name="searchterm" placeholder="Search for movies..." <?php echo "value=\"$searchTerm\""; ?> id="searchInput">
                    </div>
                    <input type="hidden" name="type" value="<?= $type?>">
                    <div class="filter-dropdown">
                        <select name="genre">
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
            </form>

        <div class="row">
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
    <script src="app.js"></script>
</body>
</html>