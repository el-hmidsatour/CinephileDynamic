<?php
// Connexion à la base de données
require_once("../Config/database.php");
include("../controller/traitement.php");
session_start();
// Récupération des utilisateurs
$users = [];
try {
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $users = searchUsers($cnx, $_GET['search']);
    } else {
        $users = getAllUsers($cnx);
    } 
} catch (PDOException $e) {
    $error = "Erreur lors de la récupération des utilisateurs: " . $e->getMessage();
}

// Traitement des actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                // Ajout d'un nouvel utilisateur
                try {
                    $hashedPassword = password_hash($_POST['Password'], PASSWORD_DEFAULT);
                    $stmt = $cnx->prepare("INSERT INTO users (FirstName, LastName, Number, Email, Password, PictureUrl) 
                                          VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->execute([
                        $_POST['FirstName'],
                        $_POST['LastName'],
                        $_POST['Number'],
                        $_POST['Email'],
                        $hashedPassword,
                        $_POST['PictureUrl'] ?? 'default.jpg'
                    ]);
                    header("Location: admin_users.php?success=add");
                    exit();
                } catch (PDOException $e) {
                    $error = "Erreur lors de l'ajout: " . $e->getMessage();
                }
                break;
                
            case 'edit':
                // Modification d'un utilisateur
                try {
                    $sql = "UPDATE users SET 
                            FirstName = ?, 
                            LastName = ?, 
                            Number = ?, 
                            Email = ?";
                    
                    $params = [
                        $_POST['FirstName'],
                        $_POST['LastName'],
                        $_POST['Number'],
                        $_POST['Email'],
                        $_POST['UserId']
                    ];
                    
                    if (!empty($_POST['NewPassword'])) {
                        $sql .= ", Password = ?";
                        $params[] = password_hash($_POST['NewPassword'], PASSWORD_DEFAULT);
                    }
                    
                    if (!empty($_FILES['PictureUrl']['name'])) {
                        $uploadDir = "../uploads/users/";
                        $fileName = uniqid() . '_' . basename($_FILES['PictureUrl']['name']);
                        move_uploaded_file($_FILES['PictureUrl']['tmp_name'], $uploadDir . $fileName);
                        $sql .= ", PictureUrl = ?";
                        $params[] = $fileName;
                    }
                    
                    $sql .= " WHERE UserId = ?";
                    
                    $stmt = $cnx->prepare($sql);
                    $stmt->execute($params);
                    
                    header("Location: admin_users.php?success=edit");
                    exit();
                } catch (PDOException $e) {
                    $error = "Erreur lors de la modification: " . $e->getMessage();
                }
                break;
                
            case 'delete':
                // Suppression d'un utilisateur
                try {
                    $stmt = $cnx->prepare("DELETE FROM users WHERE UserId = ?");
                    $stmt->execute([$_POST['userId']]);
                    header("Location: admin_users.php?success=delete");
                    exit();
                } catch (PDOException $e) {
                    $error = "Erreur lors de la suppression: " . $e->getMessage();
                }
                break;
        }
    }
}

// Récupérer un utilisateur pour l'édition
$editUser = null;
if (isset($_GET['edit'])) {
    try {
        $stmt = $cnx->prepare("SELECT * FROM users WHERE UserId = ?");
        $stmt->execute([$_GET['edit']]);
        $editUser = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $error = "Erreur lors de la récupération de l'utilisateur: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CinePhile - Gestion Utilisateurs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <!-- Sidebar -->
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
                <a href="admin_users.php" class="sidebar-link active">
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

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
    <h4>Gestion des Utilisateurs</h4>
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

        <!-- Search and Actions Bar -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <form method="GET" class="search-container" >
                            <input type="text" name="search" class="form-control" 
                                   placeholder="Rechercher par nom, email ou téléphone..." 
                                   value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                    <div class="col-md-4 text-end">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">
                            <i class="fas fa-plus me-2"></i>Nouvel utilisateur
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Table -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Liste des Utilisateurs</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Photo</th>
                                <th>Nom Complet</th>
                                <th>Téléphone</th>
                                <th>Email</th>
                                <th>Inscription</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= htmlspecialchars($user['UserId']) ?></td>
                                <td>
                                    <img src="<?= htmlspecialchars($user['PictureUrl'] ?: 'https://i.pravatar.cc/40') ?>" 
                                         alt="User" class="rounded-circle" style="width:40px;height:40px;object-fit:cover">
                                </td>
                                <td><?= htmlspecialchars($user['FirstName'] . ' ' . $user['LastName']) ?></td>
                                <td><?= htmlspecialchars($user['Number']) ?></td>
                                <td><?= htmlspecialchars($user['Email']) ?></td>
                                <td><?= date('d/m/Y', strtotime($user['created_at'] ?? 'now')) ?></td>
                                <td>
                                    <a href="admin_users.php?edit=<?= $user['UserId'] ?>" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" style="display:inline" onsubmit="return confirm('Supprimer cet utilisateur?')">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="userId" value="<?= $user['UserId'] ?>">
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

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="add">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Prénom *</label>
                                    <input type="text" name="FirstName" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nom *</label>
                                    <input type="text" name="LastName" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Téléphone *</label>
                                    <input type="tel" name="Number" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Email *</label>
                                    <input type="email" name="Email" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Mot de passe *</label>
                                    <input type="password" name="Password" class="form-control" required minlength="6">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Photo de profil</label>
                                    <input type="file" name="PictureUrl" class="form-control" accept="image/*">
                                </div>
                            </div>
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

    <!-- Edit User Modal (affiché si edit paramètre présent) -->
    <?php if ($editUser): ?>
    <div class="modal fade show" id="editUserModal" tabindex="-1" aria-hidden="false" style="display:block; background:rgba(0,0,0,0.5)">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier utilisateur</h5>
                    <a href="admin_users.php" class="btn-close"></a>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="UserId" value="<?= $editUser['UserId'] ?>">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Prénom *</label>
                                    <input type="text" name="FirstName" class="form-control" 
                                           value="<?= htmlspecialchars($editUser['FirstName']) ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nom *</label>
                                    <input type="text" name="LastName" class="form-control" 
                                           value="<?= htmlspecialchars($editUser['LastName']) ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Téléphone *</label>
                                    <input type="tel" name="Number" class="form-control" 
                                           value="<?= htmlspecialchars($editUser['Number']) ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Email *</label>
                                    <input type="email" name="Email" class="form-control" 
                                           value="<?= htmlspecialchars($editUser['Email']) ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Photo de profil</label>
                            <div class="d-flex align-items-center">
                                <img src="<?= htmlspecialchars($editUser['PictureUrl'] ?: 'https://i.pravatar.cc/40') ?>" 
                                     alt="Current" class="rounded-circle me-3" style="width:40px;height:40px;object-fit:cover">
                                <input type="file" name="PictureUrl" class="form-control" accept="image/*">
                            </div>
                            <small class="text-muted">Laisser vide pour garder l'image actuelle</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Réinitialiser le mot de passe</label>
                            <input type="password" name="NewPassword" class="form-control" placeholder="Laisser vide pour ne pas changer">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="admin_users.php" class="btn btn-secondary">Annuler</a>
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
        // Fermer la modal d'édition si on clique à l'extérieur
        document.addEventListener('DOMContentLoaded', function() {
            const editModal = document.getElementById('editUserModal');
            if (editModal) {
                editModal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        window.location.href = 'admin_users.php';
                    }
                });
            }
        });
    </script>
</body>
</html>