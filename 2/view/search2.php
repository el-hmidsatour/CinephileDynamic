<?php
// Include the navigation bar and sidebar
include("navandside.php");
// Include the database connection
include("../Config/database.php");

// Initialize search variables
$searchTerm = $_GET['searchterm'] ?? '';
$type = $_GET['type'] ?? '%';
$genre = $_GET['genre'] ?? '';
$searchDesc = isset($_GET['search_desc']);
$searchActors = isset($_GET['search_actors']);

// Prepare the base query
$query = "SELECT m.* FROM media m WHERE m.Type LIKE :type";
$params = ['type' => $type];

// Add conditions for search term if provided
if (!empty($searchTerm)) {
    $searchParts = [];
    $searchParts[] = "m.Title LIKE :search";

    if ($searchDesc) {
        $searchParts[] = "m.Description LIKE :search";
    }

    if ($searchActors) {
        $searchParts[] = "EXISTS (
            SELECT 1 FROM acted a
            JOIN actors ac ON a.ActorId = ac.ActorId
            WHERE a.MediaId = m.Id AND ac.FullName LIKE :search
        )";
    }

    // Always include genres in the search
    $searchParts[] = "EXISTS (
        SELECT 1 FROM tagged t
        JOIN genres g ON t.GenreId = g.GenreId
        WHERE t.MediaId = m.Id AND g.NameGenre LIKE :search
    )";

    $query .= " AND (" . implode(" OR ", $searchParts) . ")";
    $params['search'] = "%$searchTerm%";
}

// Add genre filter if applicable
if (!empty($genre)) {
    $query .= " AND EXISTS (
        SELECT 1 FROM tagged t2
        JOIN genres g2 ON t2.GenreId = g2.GenreId
        WHERE t2.MediaId = m.Id AND g2.NameGenre = :genre
    )";
    $params['genre'] = $genre;
}

// Execute the query
$stmt = $cnx->prepare($query);
$stmt->execute($params);
$movies = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Optional: Relevance scoring (if enabled)
if (!empty($searchTerm)) {
    foreach ($movies as &$movie) {
        $score = 0;

        // Score based on title match
        if (stripos($movie['Title'], $searchTerm) !== false) {
            $score += 3;
        }

        // Score based on description match
        if ($searchDesc && stripos($movie['Description'], $searchTerm) !== false) {
            $score += 1;
        }

        $movie['score'] = $score;
    }

    // Sort results by relevance score
    usort($movies, function($a, $b) {
        return $b['score'] <=> $a['score'];
    });
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Results</title>
    <link rel="stylesheet" href="navandside.css">
    <link rel="stylesheet" href="all.css">
    <link rel="stylesheet" href="Movies.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>
<body>
    <?php navbar(); ?>
    <?php sidebar(); ?>

    <div class="container py-5">
        <!-- Search Form -->
        <form action="search.php" method="get" id="searchForm">
            <div class="search-filter-container">
                <div class="search-box">
                    <input type="text" name="searchterm" placeholder="Search for movies..." value="<?= htmlspecialchars($searchTerm) ?>" id="searchInput">
                </div>
                <input type="hidden" name="type" value="<?= htmlspecialchars($type) ?>">
                <div class="filter-dropdown">
                    <select name="genre">
                        <option value="">All Genres</option>
                        <option value="action" <?= $genre === 'action' ? 'selected' : '' ?>>Action</option>
                        <option value="comedy" <?= $genre === 'comedy' ? 'selected' : '' ?>>Comedy</option>
                        <option value="drama" <?= $genre === 'drama' ? 'selected' : '' ?>>Drama</option>
                        <option value="horror" <?= $genre === 'horror' ? 'selected' : '' ?>>Horror</option>
                        <option value="sci-fi" <?= $genre === 'sci-fi' ? 'selected' : '' ?>>Sci-Fi</option>
                        <option value="tunisian" <?= $genre === 'tunisian' ? 'selected' : '' ?>>Tunisian</option>
                    </select>
                </div>
                <div class="search-options">
                    <label>
                        <input type="checkbox" name="search_desc" <?= $searchDesc ? 'checked' : '' ?>>
                        Include descriptions
                    </label>
                    <label>
                        <input type="checkbox" name="search_actors" <?= $searchActors ? 'checked' : '' ?>>
                        Include actors
                    </label>
                </div>
            </div>
        </form>

        <?php if (!empty($searchTerm)): ?>
            <div class="search-meta">
                Found <?= count($movies) ?> results for "<?= htmlspecialchars($searchTerm) ?>"
            </div>
        <?php endif; ?>

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
                                    <?php if (!empty($searchTerm) && $movie['score'] > 0): ?>
                                        <div class="relevance-badge">Relevance: <?= $movie['score'] ?></div>
                                    <?php endif; ?>
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
