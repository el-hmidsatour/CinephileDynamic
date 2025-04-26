<?php 
include("../Config/database.php");
session_start();
include("../controller/test_admin.php");
$stats = $cnx->query("
SELECT 
    (SELECT COUNT(*) FROM Media WHERE type='f') as nb_movies,
    (SELECT COUNT(*) FROM Media WHERE type='s') as nb_series,
    (SELECT COUNT(*) FROM users) as nb_users
")->fetch(PDO::FETCH_ASSOC);

$nb_movies = $stats['nb_movies'];
$nb_series = $stats['nb_series'];
$nb_users = $stats['nb_users'];
    

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CinePhile - Admin Dashboard</title>
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
                <a href="admin.php" class="sidebar-link active">
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
                <a href="admin_comment.php" class="sidebar-link ">
                    <i class="fas fa-comments"></i>
                    <span>Comments</span>
                </a>
            </div>
            
            <div class="sidebar-item">
                <a href="home.php" class="sidebar-link">
                    <i class="fas fa-home"></i>
                    <span>Home Page</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <h4>Tableau de Bord</h4>
            <div class="user-menu">
                <img src="https://i.pravatar.cc/50" alt="Admin" class="user-img">
                <div>
                    <h6 class="mb-0">Admin Aziz</h6>
                    <small>Administrateur</small>
                </div>
                <!-- Bouton de déconnexion ajouté ici -->
                <button id="logoutBtn" onclick="confirmLogout()" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                </button>
                <script>
                        function confirmLogout() {
                            if (confirm('Êtes-vous sûr de vouloir vous déconnecter ?')) {
                                window.location.href = '../controller/logout.php';
                            }
                        }
                </script>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row">
            <div class="col-md-3">
                <div class="card stat-card">
                    <i class="fas fa-film"></i>
                    <h3><?php echo htmlspecialchars($nb_movies) ?></h3>
                    <p>Films</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card">
                    <i class="fas fa-tv"></i>
                    <h3><?php echo htmlspecialchars($nb_series)?></h3>

                    <p>Séries</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card">
                    <i class="fas fa-users"></i>
                    <h3><?php echo htmlspecialchars($nb_users)?></h3>
                    <p>Utilisateurs</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card">
                    <i class="fas fa-comment"></i>
                    <h3>7</h3>
                    <p>Commentaires</p>
                </div>
            </div>
        </div>

        <!-- Recent Content and Users -->
        <div class="row mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Derniers Films Ajoutés</h5>
                        <a href="#" class="btn btn-sm btn-outline-primary">Voir tout</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Titre</th>
                                        <th>Genre</th>
                                        <th>Date</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Spider-Man: No Way Home</td>
                                        <td>Action, Aventure</td>
                                        <td>15/12/2021</td>
                                        <td><span class="badge bg-success">Publié</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dune</td>
                                        <td>Science-fiction</td>
                                        <td>22/09/2021</td>
                                        <td><span class="badge bg-success">Publié</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Bolice</td>
                                        <td>Comédie</td>
                                        <td>10/01/2022</td>
                                        <td><span class="badge bg-warning">Brouillon</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>The Matrix Resurrections</td>
                                        <td>Science-fiction</td>
                                        <td>22/12/2021</td>
                                        <td><span class="badge bg-success">Publié</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dachra</td>
                                        <td>Horreur</td>
                                        <td>05/03/2022</td>
                                        <td><span class="badge bg-danger">Archivé</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Derniers Utilisateurs</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                                <img src="https://i.pravatar.cc/40?img=1" alt="User" class="rounded-circle me-3">
                                <div>
                                    <h6 class="mb-0">Mohamed Ali</h6>
                                    <small class="text-muted">Inscrit le 15/06/2023</small>
                                </div>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                                <img src="https://i.pravatar.cc/40?img=2" alt="User" class="rounded-circle me-3">
                                <div>
                                    <h6 class="mb-0">Sarah Ben</h6>
                                    <small class="text-muted">Inscrit le 14/06/2023</small>
                                </div>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                                <img src="https://i.pravatar.cc/40?img=3" alt="User" class="rounded-circle me-3">
                                <div>
                                    <h6 class="mb-0">Ahmed Toumi</h6>
                                    <small class="text-muted">Inscrit le 13/06/2023</small>
                                </div>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                                <img src="https://i.pravatar.cc/40?img=4" alt="User" class="rounded-circle me-3">
                                <div>
                                    <h6 class="mb-0">Leila Jmal</h6>
                                    <small class="text-muted">Inscrit le 12/06/2023</small>
                                </div>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                                <img src="https://i.pravatar.cc/40?img=5" alt="User" class="rounded-circle me-3">
                                <div>
                                    <h6 class="mb-0">Youssef Ksouri</h6>
                                    <small class="text-muted">Inscrit le 11/06/2023</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Quick Add Form -->
                
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="admin.js"></script>
    
    
</body>
</html>