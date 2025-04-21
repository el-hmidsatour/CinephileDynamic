<?php
require_once("../Config/database.php");
session_start();

// Handle search
$search = '';
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $_GET['search'];
    $query = $cnx->prepare("
        SELECT r.*, u.Email, m.Title 
        FROM reviews r
        JOIN users u ON r.UserId = u.UserId
        JOIN media m ON r.MediaId = m.Id
        WHERE u.Email LIKE ? OR m.Title LIKE ? OR r.Comment LIKE ?
    ");
    $query->execute(["%$search%", "%$search%", "%$search%"]);
    $reviews = $query->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Fetch all reviews if no search
    $query = $cnx->query("
        SELECT r.*, u.Email, m.Title 
        FROM reviews r
        JOIN users u ON r.UserId = u.UserId
        JOIN media m ON r.MediaId = m.Id
    ");
    $reviews = $query->fetchAll(PDO::FETCH_ASSOC);
}

// Handle delete action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    try {
        $stmt = $cnx->prepare("DELETE FROM reviews WHERE UserId = ? AND MediaId = ?");
        $stmt->execute([$_POST['userId'], $_POST['mediaId']]);
        header("Location: admin_comment.php?success=delete");
        exit();
    } catch (PDOException $e) {
        $error = "Erreur lors de la suppression: " . $e->getMessage();
    }
}
// Handle edit action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit') {
    try {
        $stmt = $cnx->prepare("UPDATE reviews SET Rating = ?, Comment = ?, Date = ? WHERE UserId = ? AND MediaId = ?");
        $stmt->execute([
            $_POST['Rating'],
            $_POST['Comment'],
            $_POST['Date'],
            $_POST['UserId'],
            $_POST['MediaId']
        ]);
        header("Location: admin_comment.php?success=edit");
        exit();
    } catch (PDOException $e) {
        $error = "Erreur lors de la modification: " . $e->getMessage();
    }
}

// Handle add action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    try {
        // Get user and media ID
        $stmt = $cnx->prepare("SELECT UserId FROM users WHERE Email = ?");
        $stmt->execute([$_POST['Email']]);
        $userId = $stmt->fetchColumn();

        $stmt = $cnx->prepare("SELECT Id FROM media WHERE Title = ?");
        $stmt->execute([$_POST['Title']]);
        $mediaId = $stmt->fetchColumn();

        if ($userId && $mediaId) {
            $stmt = $cnx->prepare("INSERT INTO reviews (UserId, MediaId, Rating, Comment, Date) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$userId, $mediaId, $_POST['Rating'], $_POST['Comment'], $_POST['Date']]);
            header("Location: admin_comment.php?success=add");
            exit();
        } else {
            $error = "Email utilisateur ou titre de film invalide.";
        }
    } catch (PDOException $e) {
        $error = "Erreur lors de l'ajout: " . $e->getMessage();
    }
}

// Get review to edit
$editReview = null;
if (isset($_GET['edit_user'])) {
    try {
        $stmt = $cnx->prepare("
            SELECT r.*, u.Email, m.Title 
            FROM reviews r
            JOIN users u ON r.UserId = u.UserId
            JOIN media m ON r.MediaId = m.Id
            WHERE r.UserId = ? AND r.MediaId = ?
        ");
        $stmt->execute([$_GET['edit_user'], $_GET['edit_media']]);
        $editReview = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $error = "Erreur lors de la récupération du commentaire: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CinePhile - Gestion des Commentaires</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <!-- Sidebar (unchanged from your original) -->
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
                <a href="ad_films.php" class="sidebar-link">
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
                <a href="#" class="sidebar-link active">
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

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <h4>Gestion des Commentaires</h4>
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

        <!-- Search and Add Comment Bar -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <form method="GET" class="search-container">
                            <input type="text" name="search" class="form-control" 
                                   placeholder="Rechercher par email, titre ou commentaire..." 
                                   value="<?= htmlspecialchars($search) ?>">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                    <div class="col-md-4 text-end">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCommentModal">
                            <i class="fas fa-plus me-2"></i>Nouveau Commentaire
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reviews Table -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Liste des Commentaires</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Email Utilisateur</th>
                                <th>Titre Film</th>
                                <th>Note</th>
                                <th>Commentaire</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reviews as $review): ?>
                                <tr>
                                    <td><?= htmlspecialchars($review['Email']) ?></td>
                                    <td><?= htmlspecialchars($review['Title']) ?></td>
                                    <td><?= htmlspecialchars($review['Rating']) ?>/10</td>
                                    <td><?= htmlspecialchars($review['Comment']) ?></td>
                                    <td><?= htmlspecialchars($review['Date']) ?></td>
                                    <td>
                                        <a href="admin_comment.php?edit_user=<?= $review['UserId'] ?>&edit_media=<?= $review['MediaId'] ?>" 
                                           class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form method="POST" style="display:inline" onsubmit="return confirm('Supprimer ce commentaire?')">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="userId" value="<?= $review['UserId'] ?>">
                                            <input type="hidden" name="mediaId" value="<?= $review['MediaId'] ?>">
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <nav aria-label="Page navigation" class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Précédent</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Suivant</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Add Comment Modal -->
    <div class="modal fade" id="addCommentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un Commentaire</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    <input type="hidden" name="action" value="add">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Email Utilisateur *</label>
                                    <input type="email" name="Email" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Titre Film *</label>
                                    <input type="text" name="Title" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Note *</label>
                                    <input type="number" name="Rating" step="0.1" min="0" max="10" 
                                           class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Date *</label>
                                    <input type="date" name="Date" class="form-control" 
                                           value="<?= date('Y-m-d') ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Commentaire *</label>
                            <textarea name="Comment" rows="4" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Review Modal -->
    <?php if ($editReview): ?>
    <div class="modal fade show" id="editReviewModal" tabindex="-1" aria-hidden="false" style="display:block; background:rgba(0,0,0,0.5)">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier Commentaire</h5>
                    <a href="admin_comment.php" class="btn-close"></a>
                </div>
                <form method="POST">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="UserId" value="<?= $editReview['UserId'] ?>">
                    <input type="hidden" name="MediaId" value="<?= $editReview['MediaId'] ?>">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Email Utilisateur</label>
                                    <input type="text" class="form-control" 
                                           value="<?= htmlspecialchars($editReview['Email']) ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Titre Film</label>
                                    <input type="text" class="form-control" 
                                           value="<?= htmlspecialchars($editReview['Title']) ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Note *</label>
                                    <input type="number" name="Rating" step="0.1" min="0" max="10" 
                                           class="form-control" value="<?= htmlspecialchars($editReview['Rating']) ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Date *</label>
                                    <input type="date" name="Date" class="form-control" 
                                           value="<?= htmlspecialchars($editReview['Date']) ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Commentaire *</label>
                            <textarea name="Comment" rows="4" class="form-control" required><?= htmlspecialchars($editReview['Comment']) ?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="admin_comment.php" class="btn btn-secondary">Annuler</a>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Close edit modal when clicking outside
        document.addEventListener('DOMContentLoaded', function() {
            const editModal = document.getElementById('editReviewModal');
            if (editModal) {
                editModal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        window.location.href = 'admin_comment.php';
                    }
                });
            }
        });
    </script>
</body>
</html>