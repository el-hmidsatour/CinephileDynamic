
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
</head>
<body>
    <!-- Sidebar Identique pour toutes les pages -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><i class="fas fa-film me-2"></i> CinePhile Admin</h2>
        </div>
        <div class="sidebar-menu">
            <div class="sidebar-item">
                <a href="dashboard.html" class="sidebar-link">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </div>
            <div class="sidebar-item">
                <a href="films.html" class="sidebar-link active">
                    <i class="fas fa-video"></i>
                    <span>Films</span>
                </a>
            </div>
            <div class="sidebar-item">
                <a href="users.html" class="sidebar-link">
                    <i class="fas fa-users"></i>
                    <span>Utilisateurs</span>
                </a>
            </div>
            <div class="sidebar-item">
                <a href="comments.html" class="sidebar-link">
                    <i class="fas fa-comments"></i>
                    <span>Commentaires</span>
                </a>
            </div>
            <!-- Autres liens... -->
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header Identique -->
        <div class="header">
            <h4>Gestion des Films</h4>
            <div class="user-menu">
                <img src="https://i.pravatar.cc/50" alt="Admin" class="user-img">
                <div>
                    <h6 class="mb-0">Admin Aziz</h6>
                    <small>Administrateur</small>
                </div>
                <button id="logoutBtn" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                </button>
            </div>
        </div>

        <!-- Contenu spécifique à la page Films -->
        <div class="search-container">
            <input type="text" class="form-control" placeholder="Rechercher un film...">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFilmModal">
                <i class="fas fa-plus me-2"></i>Ajouter
            </button>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Liste des Films</h5>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="showArchived">
                    <label class="form-check-label" for="showArchived">Afficher archivés</label>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <!-- Tableau des films... -->
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal d'ajout de film -->
        <div class="modal fade" id="addFilmModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ajouter un film</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="filmForm">
                            <!-- Formulaire d'ajout... -->
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" form="filmForm" class="btn btn-primary">Enregistrer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/admin.js"></script>
</body>
</html>