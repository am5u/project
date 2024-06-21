<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <section class="flex">

      <a href="home.php" class="logo">CODING HEROES</a>

      <form action="search_course.php" method="post" class="search-form">
         <input type="text" name="search_course" placeholder="search courses..." required maxlength="100">
         <button type="submit" class="fas fa-search" name="search_course_btn"></button>
      </form>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="search-btn" class="fas fa-search"></div>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="toggle-btn" class="fas fa-sun"></div>
         <?php if ( isset($_SESSION['user_id']) && $_SESSION['user_usertype']=='tutor') { ?>
         <button><a href="../admin/add_playlist.php"> add play list</a></button>
         <?php } ?>
      </div>

      <div class="profile">
<?php
         if(isset($_SESSION['user_id'])){

                       
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$_SESSION['user_id']]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <img src="../uploaded_files/<?=  $_SESSION['user_image']; ?>" alt="">
         <h3><?=  $_SESSION['user_name'] ?></h3>
         <?php }?>
         <span>student</span>
        
         <?php if ($_SESSION['user_usertype'] == 'tutor' ) { ?>
            <a href="../teacher/dashboard.php" class="btn">view profile</a>
            <?php }else { ?>
           
               <a href="profile.php" class="btn">view profile</a>
                     <?php }  ?>
              <div class="flex-btn">

                 <a href="../components/user_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
                   
         </div>
         <?php
            } else {
         ?>
         <h3>please login or register</h3>
          <div class="flex-btn">
            <a href="../view/login.php" class="option-btn">login</a>
            <a href="../view/register.php" class="option-btn">register</a>
         </div>
         <?php
                   }
         ?>
      </div>

   </section>

</header>

<!-- header section ends -->

<!-- side bar section starts  -->

<div class="side-bar">

   <div class="close-side-bar">
      <i class="fas fa-times"></i>
   </div>

   <div class="profile">
         <?php
         if(isset($_SESSION['user_id'])){
            
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$_SESSION['user_id']]);
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            }
         ?>
         <img src="../uploaded_files/<?= $_SESSION['user_image']; ?>" alt="">
         <h3><?=  $_SESSION['user_name']; ?></h3>
         <span><?= $_SESSION['user_usertype']?></span>
         <a href="profile.php" class="btn">view profile</a>
         <?php
            }else{
         ?>
         <h3>please login or register</h3>
          <div class="flex-btn" style="padding-top: .5rem;">
            <a href="login.php" class="option-btn">login</a>
            <a href="register.php" class="option-btn">register</a>
         </div>
         <?php
            }
         ?>
      </div>

   <nav class="navbar">
      <a href="../view/home.php"><i class="fas fa-home"></i><span>home</span></a>
      <a href="../view/about.php"><i class="fas fa-question"></i><span>about us</span></a>
      <a href="../view/courses.php"><i class="fas fa-graduation-cap"></i><span>courses</span></a>
      <a href="../view/teachers.php"><i class="fas fa-chalkboard-user"></i><span>teachers</span></a>
      <a href="../view/contact.php"><i class="fas fa-headset"></i><span>contact us</span></a>
   </nav>

</div>

<!-- side bar section ends -->