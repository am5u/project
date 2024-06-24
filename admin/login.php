<?php

include '../components/connect.php';

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $pass = $_POST['pass'];

   $select_tutor = $conn->prepare("SELECT * FROM `admins` WHERE email = ? AND  password = ? ");
   $select_tutor->execute([$email, $pass]);
   $row = $select_tutor->fetch(PDO::FETCH_ASSOC);
   
   if($select_tutor->rowCount() > 0){

         session_start();

         $_SESSION['admin_id'] = $row['id'];
     
         $_SESSION['admin_name'] = $row['name'];
     
         $_SESSION['admin_email'] = $row['email'];
     
         $_SESSION['admin_image'] = $row['image'];

         $_SESSION['admin_usertype'] = $row['usertype'];

     








     header('location:dashboard.php');



   }else{
      $message[] = 'incorrect email or password! or you donot admin ';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <!-- <link rel="stylesheet" href="../css/admin_style.css"> -->

   <style>
    body{
        background-color: #135D66;
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
        color:#E3FEF7;
        font-size: 16px;
        margin:auto;
        transition: 0.5s;
        border:1px solid #E3FEF7;
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
        color:#77B0AA;
    }
    .login-box .user-box{
        top:-85px;
        left:0px;
        font-size: 12px;
        color:#ecc57c;
    }
    .message form span{
      color:white;
      font-size:30px
    }
    </style>

</head>
<body style="padding-left: 0;">

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message form">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<!-- register section starts  -->

<section class="form-container">

<div class="login-box"data-aos="flip-left">
        <h2>Login</h2>
        <form action=""method="post" enctype="multipart/form-data" class="login">
            <div class="user-box">
                <input type="email" name="email" placeholder="email" required autofocus>
            </div>
            <div class="user-box">
            <input type="password" name="pass" placeholder="enter your password" maxlength="" required class="box">
            </div>
            <div class="button-form">
            <input type="submit" name="submit" value="login now"id="submit" >
                <!-- <div id="register">
                Don't have any account ?
                    <a href="register.php">Register</a>
                </div> -->
            </div>
             </form>

   <!-- <form action="" method="post" enctype="multipart/form-data" class="login">
      <h3>welcome back!</h3>
      <p>your email <span>*</span></p>
      <input type="email" name="email" placeholder="enter your email" maxlength="" required class="box">
      <p>your password <span>*</span></p>
      <input type="password" name="pass" placeholder="enter your password" maxlength="" required class="box">
      <p class="link">don't have an account? <a href="register.php">register new</a></p>
      <input type="submit" name="submit" value="login now" class="btn">
   </form> -->

</section>

<!-- registe section ends -->














<script>

let darkMode = localStorage.getItem('dark-mode');
let body = document.body;

const enabelDarkMode = () =>{
   body.classList.add('dark');
   localStorage.setItem('dark-mode', 'enabled');
}

const disableDarkMode = () =>{
   body.classList.remove('dark');
   localStorage.setItem('dark-mode', 'disabled');
}

if(darkMode === 'enabled'){
   enabelDarkMode();
}else{
   disableDarkMode();
}

</script>
   
</body>
</html>