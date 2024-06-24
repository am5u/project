<?php



include '../components/connect.php';



if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $pass = $_POST['pass'];

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email =? AND password =? LIMIT 1");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);
   
   if($select_user->rowCount() > 0){
     session_start();
     $_SESSION['user_id'] = $row['id'];
     $_SESSION['user_name'] = $row['name'];
     $_SESSION['user_email'] = $row['email'];
     $_SESSION['user_image'] = $row['image'];
     $_SESSION['user_usertype'] = $row['usertype'];
     // Add more columns as needed
     $_SESSION['user_column1'] = $row['column1'];
     $_SESSION['user_column2'] = $row['column2'];
     //...
     
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
   <title>login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <!-- <link rel="stylesheet" href="../css/style.css"> -->
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
        text-align: center;
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



    </style>
</head>
<body>




<section class="form-container">
<?php include '../components/user_header.php'; ?>

<div class="login-box"data-aos="flip-left">
        <h2>Login</h2>
        <form action="" method="post" enctype="multipart/form-data" class="login">
            <div class="user-box">
                <input type="email" name="email" placeholder="email" required autofocus>
            </div>
            <div class="user-box">
            <input type="password" name="pass" placeholder="enter your password" maxlength="" required class="box">
            </div>
            <div class="button-form">
            <input type="submit" name="submit" value="login now"id="submit" >
                <div id="register">
                Don't have any account ?
                    <a href="../view/register.php">Register</a>
                </div>
            </div>
             </form>


<!-- 
   <form action="" method="post" enctype="multipart/form-data" class="login">
      <h3>welcome back!</h3>
      <p>your email <span>*</span></p>
      <input type="email" name="email" placeholder="enter your email" maxlength="50" required class="box">
      <p>your password <span>*</span></p>
      <input type="password" name="pass" placeholder="enter your password" maxlength="20" required class="box">
      <p class="link">don't have an account? <a href="../view/register.php">register now</a></p>
      <input type="submit" name="submit" value="login now" class="btn">
   </form> -->

</section>












<?php include '../components/footer.php'; ?>

<!-- custom js file link  -->
<script src="../js/script.js"></script>
   
</body>
</html>