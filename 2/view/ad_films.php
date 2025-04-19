<?php
//ad_films.php
include("../config/database.php");
include("../controller/add.php");
include("../controller/admin_movies/handle_post.php");
include("../controller/admin_movies/handle_delete.php");
include("../controller/admin_movies/handle_edit.php");
include("../controller/admin_movies/get_data.php");
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CinePhile - Gestion des Films</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body>
<div class="sidebar">
        <div class="sidebar-brand">
            <h2><i class="fas fa-film me-2"></i> CinePhile Admin</h2>
        </div>
        <div class="sidebar-menu">
            <div class="sidebar-item">
                <a href="admin.php" class="sidebar-link">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </div>
            <div class="sidebar-item">
                <a href="Media.php" class="sidebar-link active">
                    <i class="fas fa-video"></i>
                    <span>Media</span>
                </a>
            </div>
           
            <div class="sidebar-item">
                <a href="admin_users.php" class="sidebar-link ">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                </a>
            </div>
            <div class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="fas fa-comments"></i>
                    <span>Comments</span>
                </a>
            </div>
            
            <div class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="fas fa-cog"></i>
                    <span>Paramètres</span>
                </a>
            </div>
        </div>
    </div>


    <div class="main-content">
        <div class="header">
            <h4>Gestion des Films</h4>
            <?php if (isset($_SESSION['user'])): ?>
    <div class="user-menu">
        <img src="<?= htmlspecialchars($_SESSION['user']['picture'] ?? 'bolice.png') ?>" 
             alt="<?= htmlspecialchars($_SESSION['user']['name']) ?>" 
             class="user-img">
        <div>
            <h6 class="mb-0"><?= htmlspecialchars($_SESSION['user']['name']) ?></h6>
            <small><?= htmlspecialchars(ucfirst($_SESSION['user']['role'])) ?></small>
        </div>
        <form action="logout.php" method="post" class="logout-form">
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Déconnexion
            </button>
        </form>
    </div>
    <?php endif; ?>
        </div>

        <div class="search-container">
            <form method="POST">
                <input type="text" class="form-control" placeholder="Rechercher un film..." name="searchTitle" required>
            </form>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFilmModal">
                <i class="fas fa-plus me-2"></i>Ajouter
            </button>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Liste des Films</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Year</th>

                                <th>Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($searchResults as $movieRow) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($movieRow['Title']); ?></td>
                                <td><?php echo htmlspecialchars($movieRow['Year']); ?></td>

                                <td>
                                    <a href="?edit=true&id=<?php echo $movieRow['Id']; ?>" class="btn btn-warning">
                                        <i class="fas fa-edit"></i> Modify
                                    </a>
                                    <a href="?delete=true&id=<?php echo $movieRow['Id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this movie?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Add/Modify Film Modal -->
        <div class="modal fade" id="addFilmModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo isset($movie) ? 'Modifier le film' : 'Ajouter un film'; ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="filmForm" method="POST" action="ad_films.php">
                            <input type="hidden" name="id" value="<?php echo isset($movie) ? $movie['Id'] : ''; ?>">

                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="Title" value="<?php echo isset($movie) ? htmlspecialchars($movie['Title']) : ''; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="mediaUrl" class="form-label">Media URL</label>
                                <input type="url" class="form-control" id="mediaUrl" name="MediaUrl" value="<?php echo isset($movie) ? htmlspecialchars($movie['MediaUrl']) : ''; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="Description" rows="3" required><?php echo isset($movie) ? htmlspecialchars($movie['Description']) : ''; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Type</label>
                                <input type="text" class="form-control" id="type" name="Type" value="<?php echo isset($movie) ? htmlspecialchars($movie['Type']) : ''; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="country" class="form-label">Country</label>
                                <input type="text" class="form-control" id="country" name="Country" value="<?php echo isset($movie) ? htmlspecialchars($movie['Country']) : ''; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="year" class="form-label">Year</label>
                                <input type="number" class="form-control" id="year" name="Year" value="<?php echo isset($movie) ? htmlspecialchars($movie['Year']) : ''; ?>" min="1800" max="2100" required>
                            </div>
                            <div class="mb-3">
                                <label for="expertRating" class="form-label">Expert Rating (0–10)</label>
                                <input type="number" class="form-control" id="expertRating" name="ExpertRating" value="<?php echo isset($movie) ? htmlspecialchars($movie['ExpertRating']) : ''; ?>" step="0.1" min="0" max="10" required>
                            </div>
                            <label>Genres:</label>
                            <div class="genre-checkboxes">
                                <?php foreach ($allGenres as $genre): ?>
                                    <?php
                                    $isChecked = isset($movie['Genres']) && in_array($genre['GenreId'], $movie['Genres']);
                                    ?>
                                    <label>
                                        <input type="checkbox" name="Genres[]" value="<?= $genre['GenreId'] ?>" <?= $isChecked ? 'checked' : '' ?>>
                                        <?= htmlspecialchars($genre['NameGenre']) ?>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                            <div class="actor-select-box mb-3">
                                <label for="actorSelect">Actors:</label>
                                <select name="Actors[]" id="actorSelect" class="form-select" multiple>
                                    <?php foreach ($allActors as $actor): ?>
                                        <option value="<?= $actor['ActorId'] ?>">
                                            <?= htmlspecialchars($actor['FullName']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <!-- Button to open the actor add modal -->
                                <button type="button" class="btn btn-sm btn-link mt-2" data-bs-toggle="modal" data-bs-target="#addActorModal">
                                    <i class="fas fa-plus"></i> Add New Actor
                                </button>
                            </div>
                        </form> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" form="filmForm" class="btn btn-primary"><?php echo isset($movie) ? 'Modifier' : 'Enregistrer'; ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Actor Modal -->
<div class="modal fade" id="addActorModal" tabindex="-1" aria-labelledby="addActorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addActorModalLabel">Add New Actor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addActorForm" method="POST" action="add_actor.php">
                    <div class="mb-3">
                        <label for="actorName" class="form-label">Actor Full Name</label>
                        <input type="text" class="form-control" id="actorName" name="ActorFullName" required>
                    </div>
                    <div class="mb-3">
                        <label for="actorYearOfBirth" class="form-label">Year of Birth</label>
                        <input type="number" class="form-control" id="actorYearOfBirth" name="ActorYearOfBirth" required>
                    </div>
                    <div class="mb-3">
                        <label for="actorImageUrl" class="form-label">Image URL</label>
                        <input type="url" class="form-control" id="actorImageUrl" name="ActorImageUrl" required>
                    </div>
                    <div id="actorMessage" class="mt-3"></div>
                    <button type="submit" class="btn btn-primary">Add Actor</button>
                </form>
                
            </div>
        </div>
    </div>
</div>

    <?php if (isset($_GET['edit']) && $movie): ?>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const editModal = new bootstrap.Modal(document.getElementById('addFilmModal'));
            editModal.show();
        });
    </script>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/admin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#actorSelect').select2({
                width: '100%',
                placeholder: "Select actors",
                allowClear: true
            });
        });
    </script>
    
</body>
</html>
