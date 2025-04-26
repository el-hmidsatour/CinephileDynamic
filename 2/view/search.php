<?php
// Include the navigation bar and sidebar
include("navandside.php");
// Include the database connection
include("../Config/database.php");

// --- Configuration ---
// IMPORTANT: Double-check these absolute paths are correct for your system
$pythonExecutable = 'C:/Users/hmids/AppData/Local/Programs/Python/Python313/python.exe';
$searchScriptPath = 'C:/xampp/htdocs/CinePhileDynamic/2/controller/index_scripts/search_media.py';
// ------------------

// --- Initialize search variables ---
$searchTerm = $_GET['searchterm'] ?? '';
$type = $_GET['type'] ?? '%'; // '%' means all types (films and series)
$genre = $_GET['genre'] ?? ''; // Empty means all genres
// REMOVED: $searchDesc = isset($_GET['search_desc']);
// REMOVED: $searchActors = isset($_GET['search_actors']);

$movies = []; // Initialize array to hold final movie data
$search_error = null; // Variable for any errors during the process

// --- Call Python Search Script ---
$commandParts = [
    escapeshellcmd($pythonExecutable),          // Path to python.exe
    escapeshellarg($searchScriptPath),          // Path to search_media.py
    '--query=' . escapeshellarg($searchTerm)    // Search term argument
];

// Add optional arguments to the command
if (!empty($genre)) {
    $commandParts[] = '--genre=' . escapeshellarg($genre);
}
if (!empty($type) && $type !== '%') { // Only add if type is specified and not 'all'
    $commandParts[] = '--type=' . escapeshellarg($type);
}
// REMOVED: Conditional logic for --search-desc and --search-actors
// if ($searchDesc) { $commandParts[] = '--search-desc'; }
// if ($searchActors) { $commandParts[] = '--search-actors'; }
$commandParts[] = '--limit=100'; // Set a limit for results from Python

// Combine parts into a single command string
$command = implode(' ', $commandParts);

// Execute the command, redirecting standard error to standard output (2>&1)
$jsonOutput = shell_exec($command . ' 2>&1');

$mediaIds = [];    // Array to store IDs returned by Python
$scoresById = []; // Array to store relevance scores by ID

// --- Process Python Output (No changes needed in this block) ---
if ($jsonOutput === null || $jsonOutput === false) {
    $search_error = "Error executing Python search script. Check PHP/Apache error logs and script permissions.";
} else {
    $searchData = json_decode($jsonOutput, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        if (str_contains(strtolower($jsonOutput), 'error') || str_contains(strtolower($jsonOutput), 'traceback')) {
             $search_error = "Python script error: <pre>" . htmlspecialchars(substr($jsonOutput, 0, 500)) . "...</pre>";
        } else {
            $search_error = "Error decoding JSON output from Python script: " . json_last_error_msg();
        }
    } elseif (isset($searchData['error']) && $searchData['error'] !== null) {
         $search_error = "Python script error: " . htmlspecialchars($searchData['error']);
    } elseif (isset($searchData['results']) && !empty($searchData['results'])) {
        foreach ($searchData['results'] as $result) {
            $mediaIds[] = (int)$result['id'];
            $scoresById[(int)$result['id']] = $result['score'];
        }
    }
}

// --- Fetch Full Movie Details from Database (No changes needed in this block) ---
if (!empty($mediaIds)) {
    $placeholders = implode(',', array_fill(0, count($mediaIds), '?'));
    $query = "SELECT m.* FROM media m WHERE m.Id IN ($placeholders)";
    try {
        $stmt = $cnx->prepare($query);
        foreach ($mediaIds as $k => $id) { $stmt->bindValue(($k + 1), $id, PDO::PARAM_INT); }
        $stmt->execute();
        $db_results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $moviesById = [];
        foreach ($db_results as $row) { $moviesById[$row['Id']] = $row; }
        foreach ($mediaIds as $id) {
            if (isset($moviesById[$id])) {
                $movie = $moviesById[$id];
                $movie['score'] = $scoresById[$id];
                $movies[] = $movie;
            }
        }
    } catch (PDOException $e) {
        $search_error = "Database error fetching movie details: " . $e->getMessage();
        $movies = [];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Results</title>
    <link rel="stylesheet" href="navandside.css">
    <link rel="stylesheet" href="all.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <style>
        /* Optional minimal styles */
        .error-message {
             color: red; background-color: #ffe0e0; border: 1px solid red;
             padding: 10px; margin: 15px 50px; border-radius: 4px;
         }
        .search-meta {
             margin: 0 50px 15px 50px;
             font-style: italic; color: #aaa;
         }
         .relevance-badge {
            position: absolute; bottom: 10px; right: 10px; font-size: 0.75em;
            background-color: rgba(0, 0, 0, 0.6); color: #eee;
            padding: 2px 5px; border-radius: 3px; z-index: 2;
        }
        .movie-info { position: relative; padding-bottom: 30px; }
    </style>
</head>
<body>
    <?php navbar(); ?>
    <?php sidebar(); ?>

    <div class="main-content">
        <div class="container py-5">

            <!-- Search Form Section -->
            <form action="search.php" method="get" id="searchForm">
                 <div class="search-filter-container">
                    <div class="search-box">
                        <input type="text" name="searchterm" placeholder="Search titles, actors, genres..." value="<?= htmlspecialchars($searchTerm) ?>" id="searchInput">
                    </div>
                     <input type="hidden" name="type" value="<?= htmlspecialchars($type) ?>">
                    <div class="filter-dropdown">
                        <select name="genre" onchange="this.form.submit()">
                            <option value="">All Genres</option>
                            <?php
                                try {
                                    $genre_stmt = $cnx->query("SELECT NameGenre FROM genres ORDER BY NameGenre");
                                    while ($g = $genre_stmt->fetch(PDO::FETCH_ASSOC)) {
                                        $g_name = htmlspecialchars($g['NameGenre']);
                                        $selected = ($genre === $g_name) ? 'selected' : '';
                                        echo "<option value=\"$g_name\" $selected>$g_name</option>";
                                    }
                                } catch (PDOException $e) { echo "<option value=''>Error loading genres</option>"; }
                            ?>
                        </select>
                    </div>
                    <!-- REMOVED: Checkbox options div -->
                    <!--
                    <div class="search-options">
                        <label><input type="checkbox" ...> Descriptions </label>
                        <label><input type="checkbox" ...> Actors</label>
                    </div>
                    -->
                     <button type="submit">Search</button>
                </div>
            </form>

            <!-- Display Error Message -->
            <?php if ($search_error): ?>
                <div class="error-message"><?= $search_error ?></div>
            <?php endif; ?>

            <!-- Display Search Meta Information -->
            <?php if (empty($search_error)): ?>
                <?php if (!empty($searchTerm)): ?>
                    <div class="search-meta"> Found <?= count($movies) ?> results for "<?= htmlspecialchars($searchTerm) ?>" <?= !empty($genre) ? ' in genre "' . htmlspecialchars($genre) . '"' : '' ?> </div>
                <?php elseif (!empty($genre)): ?>
                     <div class="search-meta"> Showing <?= count($movies) ?> results for genre "<?= htmlspecialchars($genre) ?>" </div>
                <?php endif; ?>
            <?php endif; ?>


             <!-- Search Results Area -->
            <div class="movies-grid">
                <?php if (!empty($movies)): ?>
                    <?php foreach ($movies as $movie): ?>
                        <!-- Card Structure -->
                        <form method="post" action="contenu.php">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($movie['Id']) ?>">
                            <button type="submit" class="movie-card-button">
                                <div class="movie-card">
                                    <img src="<?= htmlspecialchars($movie['MediaUrl']) ?>"
                                         alt="<?= htmlspecialchars($movie['Title']) ?>"
                                         class="movie-poster" loading="lazy">
                                    <div class="movie-info">
                                        <h3 class="movie-title" title="<?= htmlspecialchars($movie['Title']) ?>"><?= htmlspecialchars($movie['Title']) ?></h3>
                                        <div class="movie-meta">
                                            <span><?= htmlspecialchars($movie['Year']) ?></span>
                                            <span class="movie-rating">
                                                <i class="fas fa-star"></i> <?= number_format($movie['ExpertRating'], 1) ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </button>
                        </form>
                    <?php endforeach; ?>
                <?php elseif(empty($search_error)): ?>
                    <p style="color: #aaa; text-align: center; grid-column: 1 / -1; padding: 20px;">No results found matching your criteria.</p>
                <?php endif; ?>
            </div> <!-- End .movies-grid -->

        </div> <!-- End .container -->
    </div> <!-- End .main-content -->

    <script src="app.js"></script>
</body>
</html>