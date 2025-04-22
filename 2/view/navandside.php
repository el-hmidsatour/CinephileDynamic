<?php 
session_start();
function navbar()
{
    
    ?>
    <div class="navbar">
        <div class="navbar-container">
            <div class="logo-container">
                <h1 class="logo">CinePhile</h1>
            </div>
            <div class="menu-container">
                <ul class="menu-list">
                    <a href="home.php">Home</a>
                    <a href="Movie.php">Movies</a>
                    <a href="Series.php">Series</a>
                    <a href="Arabic_Trends.php">Arabic Trends</a>
                </ul>
            </div>
            <div class="navbar-profile-section">
                <div class="toggle">
                    <i class="fas fa-moon toggle-icon"></i>
                    <i class="fas fa-sun toggle-icon"></i>
                    <div class="toggle-ball"></div>
                </div>
                <?php
                if (isset($_SESSION['user'])):
                ?>
                <div class="user-profile">
                    <div class="profile-trigger">
                        <div class="avatar-wrapper">
                            <img class="profile-avatar" src="https://i.pravatar.cc/50?img=68" alt="Profile">
                            <div class="status-indicator"></div>
                        </div>
                        <div class="profile-badge">
                            <span class="username"><?= htmlspecialchars($_SESSION['user']['name']) ?></span>
                            <i class="fas fa-chevron-down dropdown-arrow"></i>
                        </div>
                    </div>

                    <div class="profile-dropdown-menu">
                        <div class="dropdown-header">
                            <img class="dropdown-avatar" src="https://i.pravatar.cc/50?img=68" alt="Profile">
                            <div class="user-info">
                                <span class="user-name"><?= htmlspecialchars($_SESSION['user']['name']) ?></span>
                                <?php
                                    $mail=$_SESSION['user']['email'];
                                ?>
                                <span class="user-email"><?php $mail ?></php></span>

                                
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-user"></i>
                            <span>Mon Profil</span>
                        </a>
                        <a href="watchlist.php" class="dropdown-item">
                            <i class="fas fa-bookmark"></i>
                            <span>Ma Liste</span>
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-cog"></i>
                            <span>Paramètres</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" onclick="confirmLogout()" class="dropdown-item logout">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Déconnexion</span>
                        </a>

<script>
function confirmLogout() {
    if (confirm('Êtes-vous sûr de vouloir vous déconnecter ?')) {
        window.location.href = '../controller/logout.php';
    }
}
</script>
                    </div>
                </div>
            </div>
            <?php endif;?>
            <?php
            if (!isset($_SESSION['user'])):
            ?>
                <div class="user-profile">
                    <a href="login.php">
                        <div class="profile-trigger">
                            <div class="avatar-wrapper">
                                <img class="profile-avatar" src="https://us.123rf.com/450wm/koblizeek/koblizeek1901/koblizeek190100017/115105685-utilisateur-de-membre-de-profil-d-ic%C3%B4ne-d-homme-vecteur-de-symbole-perconal-sur-fond-blanc-isol%C3%A9.jpg" alt="Profile">
                                <div class="status-indicator"></div>
                            </div>
                            <div class="profile-badge">
                                <span class="username">Join Us </span>
                                <style>
                                    .profil-badge username{
                                        color: red;
                                    }
                                </style>
                            </div>
                        </div>

                    </a>    
                    </div>
            </div>
            <?php endif;?>



        </div>
    </div>
    
<?php
}
function sidebar()

{?>
    <div class="sidebar">
    <a href="search.php">
        <i class="left-menu-icon fas fa-search"></i>
    </a>
    <a href="login.php">
        <i class="left-menu-icon fas fa-home"></i>
    </a>
    <a href="#">
        <i class="left-menu-icon fas fa-users"></i>
    </a>
    <a href="watchlist.php">
        <i class="left-menu-icon fas fa-bookmark"></i>
    </a>
</div>
        

    </div>
<?php
}
?>

