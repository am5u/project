
<?php
include 'components/connect.php';
 
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
    
    $image_folder = 'uploaded_files/';
    
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
          header('Location: coding heros/courses.html');
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-----------------css files-------------------->
    <link rel="stylesheet" href="../coding heros/CSS/bootstrap.min.css">
    
    <link rel="stylesheet" href="../coding heros/CSS/all.min.css">
    <link rel="stylesheet" href="../coding heros/CSS/style.css">
    <title>Coding Heros</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
</head>
<body>
       
   <!-------------------
      Start Navbar
   -------------------->
<header>
   <nav id="navbar" class="navbar  sticky-top navbar-expand-lg ">
      <div class="container-fluid">
      <a class="navbar-brand" href="">
         <img src="../coding heros/images/codingheros1.png" alt="">
      </a>
      <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <ul class="navbar-nav ms-auto p-3 mb-2 mb-lg-0">
            <li class="nav-item">
               <a class="nav-link active " aria-current="page" href="view/home.php">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link  dropdown-toggle" href="" id="navbarDropdown" role="link"  aria-expanded="false">
                    Courses
                </a>
                <ul class="dropdown-menu ">
                    <li><a class="dropdown-item" href="view/courses.php?level=kids 8-11">Kids</a></li>
                    <li><a class="dropdown-item" href="view/courses.php?level=juniors 5-7">Juniors</a></li>
                    <li><a class="dropdown-item" href="view/courses.php?level=Teens 12-18">Teenagers</a></li>

                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="view/about.php">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="view/contact.php">Contact Us</a>
            </li>
         
         </ul>
         
      </div>
      </div>
   </nav>
<div class="section__container header__container">
    <div class="header__content">
        <h1>Why Coding For Kids?</h1>
        <p>
            Arrow down icon Children spending their time playing games on their gadgets has been a huge concern for most of us as parents. However, we can help our child to shift their interest from playing games to developing their own games with the help of programming skill-set. Students from a very young age now can create their own games that can be uploaded to the Play Store! Using the famous game engine, Construct3 and Roblox Lua programming language, you can gradually shift their interest from playing too many games to developing their own games, mobile apps, and websites.</p>
        <button class="btn">See courses</button>
    </div>
    <div class="header__form">
    <form  action="" method="post" enctype="multipart/form-data">
      <h3>Book  Free Trial Now</h3>
    
       
            <input type="text" name="name" placeholder="eneter your name"  required >
            <p>your email <span>*</span></p>
            <input type="email" name="email" placeholder="enter your email" required >
            <input type="password" name="pass" placeholder="enter your password" maxlength="20" required >
            <input type="password" name="cpass" placeholder="confirm your password" maxlength="20" required class="box">
             <input type="file" name="image" accept="image/*" required class="box">
                <input type="submit" name="submit" value="register now" class="btn">
   </form>
    </div>







</div>
</header>
    <!-------------------
        End Navbar
    --------------------->
    <!-------------------
        Start About Us
    --------------------->
    <section class="section__container about__container">
        <div class="about__content" id="aboutus-1">
            <h2 class="section__header">About Us</h2>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit esse nobis suscipit modi assumenda voluptas id quis, animi et dolor nisi dicta quia aut facilis reprehenderit error similique placeat labore?
            </p>
            <p>
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Non numquam atque aut, eaque excepturi fugit facere beatae reprehenderit quasi harum tempore dolor earum facilis sed veniam blanditiis odio in rerum!
            </p>
        </div>
        <div class="about__image">
            <img src="../coding heros/images/aboutus.webp" alt="">
        </div>
    </section>
    <!-------------------
        End About Us
    --------------------->
    <!---------------------
        Start courses section
    ---------------------->
    <section class="section__container Curriculums_container">
        <div class="Curriculums__header">
            <div class="Curriculums__header__content">
                <h2 class="section__header">Our Curriculums</h2>
            </div>
        </div>
        <div class="Curriculums__grid">
            <div class="Curriculums__card">
                <div class="Curriculums__card__image">
                    <img src="../coding heros/images/html-img01.jpeg" alt="">
                    <div class="Curriculums__socials">
                        <button class="btn form__btn">Book Free Trial</button>
                    </div>
                </div>
                <h4>HTML</h4>
            </div>
            <div class="Curriculums__card">
                <div class="Curriculums__card__image">
                    <img src="../coding heros/images/CSS-IMG.jpeg" alt="">
                    <div class="Curriculums__socials">
                        <button class="btn form__btn">Book Free Trial</button>
                    </div>
                </div>
                <h4>CSS</h4>
            </div>
            <div class="Curriculums__card">
                <div class="Curriculums__card__image">
                    <img src="../coding heros/images/JS-IMG.png" alt="">
                    <div class="Curriculums__socials">
                        <button class="btn form__btn">Book Free Trial</button>
                    </div>
                </div>
                <h4>JAVASCRIPT</h4>
            </div>
        </div>
    </section>
    <!-------------PART2------------->
    <section class="section__container Curriculums_container">
        <div class="Curriculums__header">
        </div>
        <div class="Curriculums__grid">
            <div class="Curriculums__card">
                <div class="Curriculums__card__image">
                    <img src="../coding heros/images/PHP1-IMG.png" alt="">
                    <div class="Curriculums__socials">
                        <button class="btn form__btn">Book Free Trial</button>
                    </div>
                </div>
                <h4>PHP</h4>
            </div>
            <div class="Curriculums__card">
                <div class="Curriculums__card__image">
                    <img src="../coding heros/images/SCRATCH01.jpg" alt="">
                    <div class="Curriculums__socials">
                        <button class="btn form__btn">Book Free Trial</button>
                    </div>
                </div>
                <h4>SCRATCH</h4>
            </div>
            <div class="Curriculums__card">
                <div class="Curriculums__card__image">
                    <img src="../coding heros/images/Roblox-e1649840639388.webp" alt="">
                    <div class="Curriculums__socials">
                        <button class="btn form__btn">Book Free Trial</button>
                    </div>
                </div>
                <h4>ROBLOX</h4>
            </div>
        </div>
    </section>
    <!---------------------
        End courses section
    ---------------------->
    <!---------------------
        start last section
    ---------------------->
    <section class="section__container about__container">
        <div class="about__content">
            <h2 class="section__header">Junior Coder</h2>
            <p>
                Learn computers and code your simple 3D game! <br>
                our Junior Coders will be trained to learn the logic of programming algorithms using fun experiences through robots and games to create their own 3D games, design their virtual reality and also publish their simple websites.</p>
            
        </div>
        <div class="about__image">
            <img src="../coding heros/images/junior.png" alt="">
        </div>
    </section>
    <section class="section__container about__container">
        <div class="about__image">
            <img src="../coding heros/images/kids.png" alt="">
        </div>
        <div class="about__content">
            <h2 class="section__header">Kids Coder</h2>
            <p>
                Learn computers and code your simple 3D game! <br>
our Junior Coders will be trained to learn the logic of programming algorithms using fun experiences through robots and games to create their own 3D games, design their virtual reality and also publish their simple websites.</p>
            
        </div>
        
    </section>
    <section class="section__container about__container">
        <div class="about__content">
            <h2 class="section__header">Teens Coder</h2>
            <p>
                Learn computers and code your simple 3D game! <br>
our Junior Coders will be trained to learn the logic of programming algorithms using fun experiences through robots and games to create their own 3D games, design their virtual reality and also publish their simple websites.</p>
            
        </div>
        <div class="about__image">
            <img src="../coding heros/images/learn-5103075_640.jpg" alt="">
        </div>
    </section>

    <!---------------------
        end last section
    ---------------------->
    <!---------------------
        Start Footer section
    ---------------------->
    <footer class="footer-distributed" id="contactus-1">

        <div class="footer-left">
            <div class="img">
                <img src="../coding heros/images/photo_2024-06-22_23-57-47.jpg" alt="photo is not available" class="img">
                        </div>
            <!-- <h3>Coding<span>Heros</span></h3> -->

            <p class="footer-links">
                <a href="#">Home</a>
                |
                <a href="#">About</a>
                |
                <a href="#">Contact</a>
                |
                <a href="#">free trail</a>
            </p>

            <p class="footer-company-name">Copyright © 2024 <strong>coding Heros</strong> All rights reserved</p>
        </div>

        <div class="footer-center">
            <div>
                <i class="fa fa-map-marker"></i>
                <p><span>Egypt</span>
                    Greek Camps</p>
            </div>

            <div>
                <i class="fa fa-phone"></i>
                <p>+20 01142309475</p>
            </div>
            <div>
                <i class="fa fa-envelope"></i>
                <p><a href="mailto:sagar00001.co@gmail.com">codingheros@gmail.com</a></p>
            </div>
        </div>
        <div class="footer-right">
            <p class="footer-company-about">
                <span>About coding heros</span>
                <strong>coding heros</strong> is a programming website aims to separate coding knowledge in the future generatitions
               
            </p>
            <div class="footer-icons">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
               
            </div>
        </div>

    </footer>
    <!---------------------
        end Footer section
    ---------------------->
</body>
</html>