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
   <style>
    body{
      background: linear-gradient(#135D66,#003C43);
    }
    .login-box{
        position: absolute;
        top:50%;
        left:50%;
        padding:40px;
        width:400px;
        background: #003C43;
        border-radius: 10px;
        box-shadow: 0 15px 25px rgba(228,228,228,0.7);
        transform:translate(-50%,-50%)
    }
    .login-box h2{
        margin: 0 0 30px;
        padding:0;
        color:#fff;
        text-align: center
    }
    .login-box .user-box input{
        width: 100%;
        position: relative;
        padding:10px 0;
        font-size:16px;
        background-color: transparent ;
        border:none;
        outline:none;
        border-bottom: 1px solid #fff;
        margin-bottom:30px;
        color:#fff;
    }
    #submit{
        padding:10px 20px;
        color:#dbd1bd;
        font-size: 16px;
        margin:auto;
        transition: 0.5s;
        border:1px solid #e3fee3;
        letter-spacing: 4px;
        overflow: hidden;
        text-decoration: none;
        text-transform: uppercase;
        background-color: transparent
    }
    #submit:hover{
        color:black;
        border-radius: 5px;
        background:#E3FEF7;
        box-shadow: 0 0 5px whitesmoke, 0 0 25px whitesmoke, 0 0 100px whitesmoke;
    }
    .button-form{
        display:flex;
        flex-direction: row;
        margin-top: 20px;
    }
    #register{
        font-size: 14px;
        text-decoration: none;
        color:#dbd1bd;
        width:60%;
        margin:auto;
        text-align: center
    }
    #register a{
        margin:auto;
        text-decoration: none;
        color:#e9a916;
    }
    .login-box .user-box{
        top:-85px;
        left:0px;
        font-size: 12px;
        color:#ecc57c;
    }
    </style>
</head>
<body>

<body>
    <div class="login-box">
        <h2>Registration page</h2>
        <form class="register" action="" method="post" enctype="multipart/form-data">
            <div class="user-box">
            <input type="text" name="name" placeholder="eneter your name"  required class="box">
            </div>
            <div class="user-box">
            <input type="email" name="email" placeholder="enter your email" required class="box">
            </div>
            <div class="user-box">
            <input type="password" name="pass" placeholder="enter your password" maxlength="20" required class="box">
     
   </div>
   <div class="user-box">
            <input type="password" name="cpass" placeholder="confirm your password" maxlength="20" required class="box">
         </div>
      
            <div class="user-box">
            <!-- <p>select pic <span>*</span></p> -->
      <input type="file" name="image" accept="image/*" required class="box">
      <!-- <p  class="link">already have an account? <a href="../view/login.php">login now</a></p> -->
            </div>
            <div class="button-form">
            <input type="submit" name="submit" value="register now" class="btn"id="submit">
                <!-- <div id="register">
                Don't have any account ?
                    <a href="#">Register</a>
                </div> -->
            </div>

<!-- <section class="form-container">

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

</section> -->












<?php include '../components/footer.php'; ?>

<!-- custom js file link  -->
<script src="../js/script.js"></script>
   
</body>
</html>