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
                                    if($_SESSION['test']===1){
                                        $mail=htmlspecialchars($_SESSION['user']['AdminEmail']);
                                    }else{
                                        $mail=htmlspecialchars($_SESSION['user']['email']);}
                                ?>
                                <span class="user-email"><?php $mail ?></php></span>

                                
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


        </div>
    </div>
    
<?php
}
function sidebar()

{?>
    <div class="sidebar">
        <i class="left-menu-icon fas fa-search"></i>
        <a href="login.php">
            <i class="left-menu-icon fas fa-home"></i></a>
        <i class="left-menu-icon fas fa-users"></i>
        <i class="left-menu-icon fas fa-bookmark"></i>

    </div>
<?php
}
?>

