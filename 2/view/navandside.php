<?php 
function navbar()
{
    session_start();
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
                                <span class="user-email"><?= htmlspecialchars($_SESSION['user']['email']) ?></php></span>


                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-user"></i>
                            <span>Mon Profil</span>
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-bookmark"></i>
                            <span>Ma Liste</span>
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-cog"></i>
                            <span>Paramètres</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item logout">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Déconnexion</span>
                        </a>
                    </div>
                </div>
            </div>
            <?php endif;?>
            <?php
            if (!isset($_SESSION['user'])):
            ?>
                <div class="user-profile">
                    <a href="login.php"></a>
                    <div class="profile-trigger">
                        <div class="avatar-wrapper">
                            <img class="profile-avatar" src="data:image/jpeg;base64,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" alt="Profile">
                            <div class="status-indicator"></div>
                        </div>
                        <div class="profile-badge">
                            <span class="username">Join Us </span>
                            <style>
                                .profil-badge username{
                                    color: red;
                                }
                            </style>
                            <i class="fas fa-chevron-down dropdown-arrow"></i>
                        </div>
                    </div>

                    
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
        <a href="login.php">
            <i class="left-menu-icon fas fa-home"></i></a>
        <i class="left-menu-icon fas fa-users"></i>
        <i class="left-menu-icon fas fa-bookmark"></i>
        <a href="search.php">
        <i class="left-menu-icon fas fa-search"></i>
        </a>

    </div>
<?php
}
?>

