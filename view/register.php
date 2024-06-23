<?php

include '../components/connect.php';



if(isset($_POST['submit'])){

   $name = $_POST['name'];
   
   $email = $_POST['email'];
   $pass =  $_POST['pass'];
   $cpass = $_POST['cpass'];
   $image = $_FILES['image']['name'];

   $image = filter_var($image, FILTER_SANITIZE_STRING);
   
   $ext = pathinfo($image, PATHINFO_EXTENSION);
   
   $image_size = $_FILES['image']['size'];
   
   $image_tmp_name = $_FILES['image']['tmp_name'];
   
   $image_folder = '../uploaded_files/';
   
   $image_path = $image_folder . $image;
   move_uploaded_file($image_tmp_name, $image_path);


   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? ");
   $select_user->execute([$email]);
   
   if($select_user->rowCount() > 0){
      $message[] = 'email already taken!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm passowrd not matched!';
      }else{
         $insert_user = $conn->prepare("INSERT INTO `users`( name, email, password, image,usertype) VALUES(?,?,?,?,?)");
         $insert_user->execute([ $name, $email, $cpass, $image,'Student']);
         header('Location: home.php');
         $verify_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
         $verify_user->execute([$email, $pass]);
         $row = $verify_user->fetch(PDO::FETCH_ASSOC);
         session_start();

         $_SESSION['user_id'] = $row['id'];
     
         $_SESSION['user_name'] = $row['name'];
     
         $_SESSION['user_email'] = $row['email'];
     
         $_SESSION['user_image'] = $row['image'];
     
         $_SESSION['user_usertype'] = $row['usertype'];
         
          
      }
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

   <form class="register" action="" method="post" enctype="multipart/form-data">
      <h3>create account</h3>
      <div class="flex">
         <div class="col">
            <p>your name <span>*</span></p>
            <input type="text" name="name" placeholder="eneter your name"  required class="box">
            <p>your email <span>*</span></p>
            <input type="email" name="email" placeholder="enter your email" required class="box">
         </div>
         <div class="col">
            <p>your password <span>*</span></p>
            <input type="password" name="pass" placeholder="enter your password" maxlength="20" required class="box">
            <p>confirm password <span>*</span></p>
            <input type="password" name="cpass" placeholder="confirm your password" maxlength="20" required class="box">
         </div>
      </div>
      <p>select pic <span>*</span></p>
      <input type="file" name="image" accept="image/*" required class="box">
      <p class="link">already have an account? <a href="../view/login.php">login now</a></p>
      <input type="submit" name="submit" value="register now" class="btn">
   </form>

</section>












<?php include '../components/footer.php'; ?>

<!-- custom js file link  -->
<script src="../js/script.js"></script>
   
</body>
</html>