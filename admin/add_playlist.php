<?php

include '../components/connect.php';
session_start();

if(isset($_POST['submit'])){

   $id = unique_id();
   $title = $_POST['title'];
   $description = $_POST['description'];
   $status = $_POST['status'];

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   
   $ext = pathinfo($image, PATHINFO_EXTENSION);
   
   $image_size = $_FILES['image']['size'];
   
   $image_tmp_name = $_FILES['image']['tmp_name'];
   
   $image_folder = '../uploaded_files/';
   
   $image_path = $image_folder . $image;
   move_uploaded_file($image_tmp_name, $image_path);

   $add_playlist = $conn->prepare("INSERT INTO `playlist`(tutor_id, title, description, thumb, status) VALUES(?,?,?,?,?)");
   $add_playlist->execute([ $_SESSION['user_id'], $title, $description, $image, $status]);


   $message[] = 'new playlist created!';  

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add Playlist</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/user_header.php'; ?>
   
<section class="playlist-form">

   <h1 class="heading">create playlist</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <p>playlist status <span>*</span></p>
      <select name="status" class="box" required>
         <option value="" selected disabled>-- select status</option>
         <option value="active">active</option>
         <option value="deactive">deactive</option>
      </select>
      <p>playlist title <span>*</span></p>
      <input type="text" name="title" maxlength="100" required placeholder="enter playlist title" class="box">
      <p>playlist description <span>*</span></p>
      <textarea name="description" class="box" required placeholder="write description" maxlength="1000" cols="30" rows="10"></textarea>
      <p>playlist thumbnail <span>*</span></p>
      <input type="file" name="image" accept="image/*" required class="box">
      <input type="submit" value="create playlist" name="submit" class="btn">
   </form>

</section>















<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>