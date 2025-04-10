<?php
  include("navandside.php");
  include("../config/database.php");
  include("../controller/methods.php");
  if(!empty($_POST))
  {
    if(isset($_POST['first_name'],$_POST['first_name'],$_POST['phone'],$_POST['email'],$_POST['password']))
    {
      AddUser($cnx,$_POST);
    }
  }
  ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="sign_login.css" />
  <link rel="stylesheet" href="navandside.css">

  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&family=Sen:wght@400..800&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />

  <title>Register</title>
</head>

<body>
  <div class="navbar">
    <div class="navbar-container">
      <div class="logo-container">
        <h1 class="logo">CinePhile</h1>
      </div>
      <div class="menu-container">
        <ul class="menu-list">
          <a href="index.php">Home</a>
          <a href="Movie.php">Movies</a>
          <a href="Series.php">Series</a>
          <a href="Popular.php">Popular</a>
          <a href="Arabic_Trends.php">Arabic Trends</a>
        </ul>
      </div>
      <div class="navbar-profile-section">
        <div class="toggle">
          <i class="fas fa-moon toggle-icon"></i>
          <i class="fas fa-sun toggle-icon"></i>
          <div class="toggle-ball"></div>
        </div>


      </div>
    </div>
  </div>

  <div class="sidebar">
    <i class="left-menu-icon fas fa-search"></i>
    <i class="left-menu-icon fas fa-home"></i>
    <i class="left-menu-icon fas fa-users"></i>
    <i class="left-menu-icon fas fa-bookmark"></i>
  </div>

  <div class="wrapper">
    <form action="signin.php" method="POST">
      <h2>Register</h2>

      <div class="input-field">
        <input type="text" name="last_name" placeholder="Enter Your Last Name" required />
      </div>

      <div class="input-field">
        <input type="text" name="first_name" placeholder="Enter Your First Name" required />
      </div>

      <div class="input-field">
        <input type="tel" name="phone" placeholder="Enter Your Phone Number" required />
      </div>



      <div class="input-field">
        <input type="email" name="email" placeholder="Enter Your Email" required />
      </div>

      <div class="input-field">
        <input type="password" name="password" placeholder="Enter Your Password" required />
      </div>

      <button type="submit">Sign Up</button>

      <div class="register">
        <p>Already have an account?</p>
        <a href="login.php">Sign In</a>
      </div>
    </form>
  </div>

  <script src="app.js"></script>
</body>

</html>