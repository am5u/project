<?php
   include '../components/connect.php';
session_start();

   setcookie('user_id', '', time() - 1, '/');


   session_destroy();
   header('location:../view/home.php');

?>