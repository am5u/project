<?php
   session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <!-- <title>صقحه تسجيل الدخول</title> -->
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/login.css"/>
</head>
<body>
<?php
require_once './conn/conn.php';

    if (isset($_POST['username'])) {
        $username = stripslashes($_POST['username']); 
        $username = mysqli_real_escape_string($conn, $username);
        $password = stripslashes($_POST['password']);
        $password = mysqli_real_escape_string($conn, $password);

        $query    = "SELECT * FROM `user` WHERE username='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($conn, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
      
            header("Location: st_marks.php");
        } else {
            echo 
            
            "<div class='form alert alert-info'>
                  <h>Username or password is wrong</h3><br/>
                  <p class='link'>Submit <a href='st_login.php'>Try Again</a> </p>
                  </div>";
        }
    } else {
?>

  
<main class="form-signin">
  <form class="form" method="post" name="login">
    <img class="mb-4" src="admin.png" alt="" width="100" height="100">
    <h1 class="h3 mb-3 fw-normal">Enter your name </h1>

    <div class="form-floating">
      <input type="text" class="form-control" name="username" placeholder="ادخل الاسم">
      <label for="floatingInput" required>Username </label>
    </div>
    
    <div class="form-floating">
      <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="ادخل كلمه المرور">
      <label for="floatingPassword" required>Password </label>
    </div>

    <button class="w-100 btn btn-lg btn-primary"  name="submit" type="submit">سجل الان</button>

       <p class="link"> Dont have an account? <a href="registration.php">  </a>
    <p class="mt-5 mb-3 text-muted"></p>
  </form>

</main>
   
<?php
    }
?>
</body>
</html>
