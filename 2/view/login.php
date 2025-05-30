<?php
include("navandside.php");
include("../Config/database.php");
if(isset($_SESSION['user']))
  {
    header('Location:home.php');
  }
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    
    if ($email === 'admin@gmail.com') {
        $stmt = $cnx->prepare("SELECT * FROM admins WHERE AdminEmail = ?");
        $stmt->execute([$email]);
        $admin = $stmt->fetch();
        
        if ($admin['AdminPassword']==md5('cinephile')) {
            $_SESSION['user'] = [
                'id' => $admin['AdminId'],
                'name' => $admin['AdminName'],
                'email' => $admin['AdminEmail'],
                'role' => 'admin',
                'picture' => 'https://i.pravatar.cc/50'
            ];
            $_SESSION['test']=1;
            header("Location: admin_users.php");
            exit();
        }
    }
    
    $stmt = $cnx->prepare(query: "SELECT * FROM Users WHERE Email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if($user){
        if ($user['Password'] === md5($password)) {
            $_SESSION['user'] = [
                'id' => $user['UserId'],
                'name' => $user['FirstName'] . ' ' . $user['LastName'],
                'email' => $user['Email'],
                'role' => $user['Role'],
                'picture' => $user['PictureUrl'] ?? 'https://i.pravatar.cc/50'
            ];
            $_SESSION['test']=0;
            header("Location: Movie.php");
            exit();
        
        } }
    
    // Message d'erreur générique (pour sécurité)
    echo "<p style='color:red;text-align:center'>Identifiants incorrects</p>";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sign_login.css">
    <link rel="stylesheet" href="navandside.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Sen:wght@400..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <title>Login</title>
</head>
<body>
    <?php navbar(); ?>
    <!-- side-bar -->
    <?php sidebar(); ?>

    <div class="wrapper"> 
        <form method="POST" action="login.php">
            <h2>Login</h2>
            
            <div class="input-field">
                <input name="email" type="text" required placeholder="Enter Your Email">
            </div>
            <div class="input-field">
                <input name="password" type="password" required placeholder="Enter Your Password"> 
            </div>
            <div class="auth-options">
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">
                        <span class="custom-checkbox"></span>
                        Remember me
                    </label>
                </div>
                <a href="#" class="forgot-password">Forgot password?</a>
            </div>
            <button type="submit">Sign In</button>
            <div class="register">
                <p>Don't have an account ?</p>
                <a href="signin.php">Register Now</a>
            </div>
        </form>
    </div>

    <script src="app.js"></script>
</body>
</html>
