<?php

include '../components/connect.php';
session_start();
$select_contents = $conn->prepare("SELECT * FROM `content` WHERE id = ?");
$select_contents->execute([$_SESSION['admin_id']]);
$total_contents = $select_contents->rowCount();

$select_playlists = $conn->prepare("SELECT * FROM `playlist` WHERE id = ?");
$select_playlists->execute([$_SESSION['admin_id']]);
$total_playlists = $select_playlists->rowCount();

$select_likes = $conn->prepare("SELECT * FROM `likes` WHERE id = ?");
$select_likes->execute([$_SESSION['admin_id']]);
$total_likes = $select_likes->rowCount();

$select_comments = $conn->prepare("SELECT * FROM `comments` WHERE id = ?");
$select_comments->execute([$_SESSION['admin_id']]);
$total_comments = $select_comments->rowCount();

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="stylesheet" href="../project/css/admin_style.css">
    
   


</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="dashboard">

   <h1 class="heading">dashboard</h1>

   <div class="box-container">

      <div class="box">
         <h3>welcome!</h3>
         <p><?=  $_SESSION['admin_name']; ?></p>
         <a href="profile.php" class="btn">view profile</a>
      </div>



 





      <!-- <div class="box">
         <h3>quick select</h3>
         <p>login or register</p>
         <div class="flex-btn">
            <a href="login.php" class="option-btn">login</a>
            <a href="register.php" class="option-btn">register</a>
         </div>
      </div> -->
      <div class="box">
         <h3>Manage Teachers </h3>
         <p>Add,Delete,Remove </p>
         <a href="../st_mark/st_mark/mang_accounts.php" class="btn">view Manage</a>
      </div>

   </div>

</section>















<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>