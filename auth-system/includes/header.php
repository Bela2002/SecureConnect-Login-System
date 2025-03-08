<?php 
session_start();
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Secure Connect</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!--link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"-->

    <style>
      body {
        background-image: url('images/background.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        min-height: 100vh;
        margin: 0;
        padding: 0;
      }
    </style>


<meta name="theme-color" content="#712cf9">

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand fw-bold fs-3 text-primary" style=" font-size: 1.75rem; font-weight: bold; background: linear-gradient(45deg, #007bff, #00ff88); -webkit-background-clip: text; -webkit-text-fill-color: transparent;" href="#">SecureConnect</a>

    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active fw-bold px-3" aria-current="page" style="font-family: 'Poppins', sans-serif; color:rgb(68, 149, 236); font-weight: 200;" href="index.php">Home</a>
      </li>

      <?php if(!isset($_SESSION['username'])) : ?>
        <li class="nav-item">
          <a class="nav-link fw-bold px-3" style="font-family: 'Poppins', sans-serif; color:rgb(68, 149, 236); font-weight: 200;" href="login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-bold px-3" style="font-family: 'Poppins', sans-serif; color:rgb(68, 149, 236); font-weight: 200;" href="register.php">Register</a>
        </li>

        <?php else : ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle fw-bold px-3" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $_SESSION['username'] ?>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" style="font-family: 'Poppins', sans-serif; color:rgb(68, 149, 236); font-weight: 200;" href="logout.php">Logout</a></li> 
          </ul>
        </li>
        <?php endif; ?>   
    </ul>
  </div>
</nav>
