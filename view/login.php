<?php



include '../components/connect.php';



if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $pass = $_POST['pass'];

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email =? AND password =? LIMIT 1");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);
   
   session_start();
   if($select_user->rowCount() > 0){
   
   
      
     $_SESSION['user_id'] = $row['id'];
     $_SESSION['user_name'] = $row['name'];
     $_SESSION['user_email'] = $row['email'];
     $_SESSION['user_image'] = $row['image'];
     $_SESSION['user_usertype'] = $row['usertype'];

     if($_SESSION['user_usertype']=='tutor'){

      $query = $conn->prepare("SELECT * FROM tutors WHERE email =?");
      $query->execute([ $_SESSION['user_email']]);
      $row = $query->fetch();
      
      // Store user data in session
      $_SESSION['teacher_id'] = $row['id'];    
      $_SESSION['teacher_name'] = $row['name'];
      $_SESSION['teacher_email'] =$row['email'];
      $_SESSION['teacher_image'] = $row['image'];
      $_SESSION['teacher_password'] =$row['password'];





     }
     // Add more columns as needed
    
     
     header('location:home.php');
   }else{
      $message[] = 'incorrect email or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style.css">

</head>
<body>

<?php include '../components/user_header.php'; ?>

<section class="form-container">

   <form action="" method="post" enctype="multipart/form-data" class="login">
      <h3>welcome back!</h3>
      <p>your email <span>*</span></p>
      <input type="email" name="email" placeholder="enter your email" maxlength="50" required class="box">
      <p>your password <span>*</span></p>
      <input type="password" name="pass" placeholder="enter your password" maxlength="20" required class="box">
      <p class="link">don't have an account? <a href="../view/register.php">register now</a></p>
      <input type="submit" name="submit" value="login now" class="btn">
   </form>

</section>












<?php include '../components/footer.php'; ?>

<!-- custom js file link  -->
<script src="../js/script.js"></script>
   
</body>
</html>