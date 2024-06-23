
<style>
img{
	width: 20%; 
	height: 20%	;


}
</style>

<?php
 require_once './conn/conn.php';
 include_once "header.php";  
  session_start();
  $email= $_SESSION['admin_email'];
    

if(isset($_POST['login'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$query1 = "SELECT * FROM admins where email='$email' 
	and password = '$password' ";

	$result	= mysqli_query($conn,$query1);
	$row  = mysqli_fetch_array($result);

		





	
			header('location: mang_accounts.php');
	
	
	
}
?>


<div class="container">
<div class="mb-6 g-3 row justify-content-center">
<div class="col-lg-8">
    <br>
	<center>
	  <strong style="text-align:center">LOGIN FORM</strong>
	
      <div class="container">
         <form role="form" action="" method="post">
		 <strong>(<?php echo $_SESSION['admin_usertype'];?>)</strong>
								<br>
								<?php 
								if($_SESSION['admin_usertype'] == "ADMIN"){	           
								?>
			<img src="images/<?php echo $image;?>"
		 </center>
								<?php } ?>
             
            <div class="form-group">
               <label for="Title" class="col-sm-2 control-label">اسم المستخدم</label>
               <div class="col-sm-10">
                <input type="text" class="form-control" name="username"
                 placeholder="اسم المستخدم"  required>
               </div>
            </div>


            <div class="form-group col-lg-12 col-sm-8">
               <label for="Author" class="col-sm-2 control-label">كلمة المرور</label>
               <div class="col-sm-10">
                  <input type="password" class="form-control" name="password"
                   placeholder="كلمة المرور"  required>
               </div>
            </div>


            
            <br>
            <div class="form-group">
               <div class="col-sm-offset-2 col-sm-10">
                  <button  name="login" class="btn btn-info col-lg-12" data-toggle="modal">
               دخول
                  </button>
               </div>
             </div>
			 <br>
		

         </form>
		 <div class="form-group">
               <div class="col-sm-offset-2 col-sm-10">
			   <a href="mang_accounts.php"><button  name="login" 
            class="btn btn-warning col-lg-12" data-toggle="modal">
               رجوع
                  </button></a>
               </div>
     
          </div>
        </div>
    </center>
    </div>
    </div>
    </div>

	
</body>
