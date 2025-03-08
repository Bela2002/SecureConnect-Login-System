<?php require "includes/header.php"; ?>

<?php require "config.php"; ?>

<?php 

if(isset($_SESSION['username'])){
  header("location: user.php");
}


#check for submit
if(isset($_POST['submit'])){

  if($_POST['email'] == '' OR $_POST['password'] == ''){
    echo '<div class="alert alert-danger text-center" role="alert">Some Inputs Are Empty.</div>';
  }
  else{
    $email = $_POST['email'];
    $password = $_POST['password'];

    #take data and do the query
    $login = $conn->query("SELECT * FROM users WHERE email = '$email'");

    #execute query
    $login->execute();

    #fetch data
    $data = $login->fetch(PDO::FETCH_ASSOC);

    
    #check for the row count
    if($login->rowCount() > 0){
      # echo $login->rowCount();  #1 for email in query


      #use password_verify function
      if(password_verify($password , $data['mypassword'])){
        #echo "Logged In.";

        $_SESSION['username'] = $data['username'];
        $_SESSION['email'] = $data['email'];

        header("location: user.php");
      }
      else{
        echo '<div class="alert alert-danger text-center" role="alert">User Email Or Password Is Wrong.</div>';
      }

    }
    else{
      echo '<div class="alert alert-danger text-center" role="alert">User Email Or Password Is Wrong.</div>';
    }


  }

}


?>

<main class="form-signin w-50 m-auto">
  <form method="POST" action="login.php">
    <h1 class="h3 mt-5 fw-normal text-center display-6 fw-bold text-secondary mb-4" style=" font-weight: bold; background: linear-gradient(45deg, #007bff, #00ff88); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Please Sign in</h1>

    <div class="form-floating mb-3">
      <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email Address</label>
    </div>

    <div class="form-floating mb-3">
      <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <div class="text-center">
      <button name="submit" class="btn btn-primary w-80 py-2" type="submit">Sign in</button>
    </div>

      <h6 class="mt-3 text-center">Don't have an account  <a class="text-info" href="register.php">Create your account</a></h6>
  </form>
</main>
<?php require "includes/footer.php"; ?>