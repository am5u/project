<?php

include '../components/connect.php';
session_start();
if(isset($_SESSION['user_id'])){
  $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
}

if(isset($_POST['submit'])){

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ? LIMIT 1");
   $select_user->execute([$user_id]);
   $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);

   $prev_pass = $_SESSION['user_password'];
   $prev_image = $_SESSION['user_image'];

   $name = $_POST['name'];

  if(!empty($name)){
   $update_name = $conn->prepare("UPDATE `users` SET name = ? WHERE id = ?");
   $update_name->execute([$name, $user_id]);
   $message[] = 'username updated successfully!';
   if(   $update_name->execute([$name, $user_id]) ){$_SESSION['user_name']=$name;}
   
  }

   $email = $_POST['email'];

   if(!empty($email)){
      $select_email = $conn->prepare("SELECT email FROM `users` WHERE email = ?");
      $select_email->execute([$email]);
      if($select_email->rowCount() > 0){
         $message[] = 'email already taken!';
      }else{
         $update_email = $conn->prepare("UPDATE `users` SET email = ? WHERE id = ?");
         $update_email->execute([$email, $user_id]);
         $message[] = 'email updated successfully!';
         if(   $update_email->execute([$email, $user_id]) ){$_SESSION['user_email']=$email;}

      }
   }

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $ext = pathinfo($image, PATHINFO_EXTENSION);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_files/'.$image;

   if(!empty($image)){
    
      
         $update_image = $conn->prepare("UPDATE `users` SET `image` = ? WHERE id = ?");
         $update_image->execute([$image, $user_id]);
         move_uploaded_file($image_tmp_name, $image_folder);
      
         $message[] = 'image updated successfully!';
      
   }

   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $old_pass = ($_POST['old_pass']);
   $new_pass = ($_POST['new_pass']);
   $cpass = ($_POST['cpass']);

   if($old_pass != $empty_pass){
      if($old_pass != $prev_pass){
         $message[] = 'old password not matched!';
      }elseif($new_pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         if($new_pass != $empty_pass){
            $update_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
            $update_pass->execute([$cpass, $user_id]);
            $message[] = 'password updated successfully!';
         }else{
            $message[] = 'please enter a new password!';
         }
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
   <title>update profile</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style.css">

</head>
<body>

<?php include '../components/user_header.php'; ?>

<section class="form-container" style="min-height: calc(100vh - 19rem);">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>update profile</h3>
      <div class="flex">
         <div class="col">
            <p>your name</p>
            <input type="text" name="name" placeholder="<?= $_SESSION['user_name']; ?>" maxlength="100" class="box">
            <p>your email</p>
            <input type="email" name="email" placeholder="<?= $_SESSION['user_email']; ?>" maxlength="100" class="box">
            <p>update pic</p>
            <input type="file" name="image" accept="image/*" class="box">
         </div>
         <div class="col">
               <p>old password</p>
               <input type="password" name="old_pass" placeholder="enter your old password" maxlength="50" class="box">
               <p>new password</p>
               <input type="password" name="new_pass" placeholder="enter your new password" maxlength="50" class="box">
               <p>confirm password</p>
               <input type="password" name="cpass" placeholder="confirm your new password" maxlength="50" class="box">
         </div>
      </div>
      <input type="submit" name="submit" value="update profile" class="btn">
   </form>

</section>

<!-- update profile section ends -->













<?php include '../components/footer.php'; ?>

<!-- custom js file link  -->
<script src="../js/script.js"></script>
   
</body>
</html>