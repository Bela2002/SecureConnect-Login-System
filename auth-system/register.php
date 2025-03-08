<?php require "includes/header.php"; ?>

<?php require "config.php"; ?>

<?php

if(isset($_SESSION['username'])){
  header("location: index.php");
}

$registration_success = false;
$error_message = ''; 

if(isset($_POST['submit'])){

  if($_POST['email'] == '' OR $_POST['username'] == '' OR $_POST['password'] == '' OR $_POST['confirm_password'] == ''){
    echo '<div class="alert alert-danger text-center" role="alert">Some Inputs Are Empty.</div>';
  }
  else{
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];


    if(strlen($username) < 8){
      $error_message = '<div class="alert alert-danger text-center" role="alert">Username Must Be At Least 8 Characters Long.</div>';
    }
    elseif(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\W).+$/', $password)){
      $error_message = '<div class="alert alert-danger text-center" role="alert">Password Must Contain At Least One Lowercase Letter, One Uppercase Letter, And One Special Character.</div>';
    }
    elseif($password !== $confirm_password){
      $error_message = '<div class="alert alert-danger text-center" role="alert">Password And Confirm Password Do Not Match.</div>';
    }
    else {
      try {
        $check_email = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $check_email->execute([':email' => $email]);

        $check_username = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $check_username->execute([':username' => $username]);

        if($check_email->rowCount() > 0){
          $error_message = '<div class="alert alert-danger text-center" role="alert">Email Already Exists.</div>';
        }
        elseif($check_username->rowCount() > 0){
          $error_message = '<div class="alert alert-danger text-center" role="alert">Username Already Exists.</div>';
        }
        else {
          $insert = $conn->prepare("INSERT INTO users (email, username, mypassword) 
          VALUES (:email, :username, :mypassword)");

          $insert->execute([
            ':email' => $email,
            ':username' => $username,
            ':mypassword' => password_hash($password, PASSWORD_DEFAULT),
          ]);

          $registration_success = true;
        }
      } catch (PDOException $e) {
        $error_message = '<div class="alert alert-danger text-center" role="alert">Registration Failed. Please Try Again.</div>';
      }
    }
  }
}



?>



<main class="form-signin w-50 m-auto">
  <form method="POST" action="register.php">
    <h1 class="h3 mt-5 fw-normal text-center display-6 fw-bold text-secondary mb-4" style=" font-weight: bold; background: linear-gradient(45deg, #007bff, #00ff88); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Please Register Here</h1>


    <?php if(!empty($error_message)): ?>
      <?php echo $error_message; ?>
    <?php endif; ?>

    <?php if($registration_success): ?>
      <div class="alert alert-success text-center" role="alert">
        Registration Successful! You Will Be Redirected To The Login Page Shortly.
      </div>

      <script>
        setTimeout(function() {
          window.location.href = 'login.php';
        }, 2000); // 2000 milliseconds = 2 seconds
      </script>
    <?php endif; ?>

    
    <div class="form-floating mb-3">
      <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>

    <div class="form-floating mb-3">
      <input name="username" type="text" class="form-control" id="floatingInput" placeholder="username">
      <label for="floatingInput">Username</label>
    </div>

    <div class="form-floating mb-3">
      <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <div class="form-floating mb-3">
      <input name="confirm_password" type="password" class="form-control" id="floatingConfirmPassword" placeholder="Confirm Password">
      <label for="floatingConfirmPassword">Confirm Password</label>
    </div>

    <div class="text-center">
      <button name="submit" class="btn btn-primary w-80 py-2" type="submit">Register</button>
    </div>

    <h6 class="mt-3 text-center">Aleardy have an account?  <a class="text-info" href="login.php">Login</a></h6>
  </form>
</main>
<?php require "includes/footer.php"; ?>
