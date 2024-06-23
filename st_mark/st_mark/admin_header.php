

<?php
 include_once "header.php";  
session_start();
 $sql = "SELECT * FROM admins where id = '".$_SESSION['admin_id']."'";
            
    $query = mysqli_query($conn, $sql); 
          
    while ($row = mysqli_fetch_array($query)){
	$picture = $row['image'];
	$lastname = $row['name'];
}
?>
<br>
	<center>
	<div class="btn1">
	<a href="mang_accounts.php">
        <button type="button" 
        class="btn btn-lg btn-primary col-lg-3 col-md-4 col-sm-11 col-xs-11 button">
        جميع المستخدمين</button></a>
            
		<a href="create_account.php">
        <button type="button"
         class="btn btn-lg btn-warning col-lg-3 col-md-4 col-sm-11 col-xs-11 button">معلم جديد
      </button></a>
        
     
        
	 <a href="logout.php">
        <button type="button"
         class="btn btn-lg btn-success col-lg-3 col-md-4 col-sm-11 col-xs-11 button">تسجيل خروج
      </button></a>   
 
</center>  
  
        </div>



</body>
</html>