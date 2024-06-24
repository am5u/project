<?php
require_once './conn/conn.php';
 include_once "header.php";  
session_start();
if(!isset($_SESSION["admin_id"])) 
{
	header('location: index.php');
}
if(!isset($_FILES['image']['tmp_name']))
{
	echo "";
} else {

	$name = $_POST['name']; 
	$email = $_POST['email']; 
	$pass = $_POST['password']; 
	$usertype = "tutor";
	$dir = "../../uploaded_files/";
	$target_file = $dir.basename($_FILES["image"]["name"]);
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$file=$_FILES['image']['tmp_name'];
	$picture=$_FILES['image']['name'];
	if($picture == "")
	{
		echo "<script>alert('please choose image')</script>";
	} else {



			$image= addslashes(file_get_contents($_FILES['image']['tmp_name']));
			$image_name= addslashes($_FILES['image']['name']);

			move_uploaded_file($_FILES["image"]["tmp_name"], $dir . $_FILES["image"]["name"]);

			$query = "INSERT INTO tutors
			(name,email,password,image)
			 VALUES ('$name','$email','$password','$picture')";

			mysqli_query($conn,$query);
			echo "<script>alert('saved')</script>";
			echo '<script>windows: location="mang_accounts.php"</script>';

		}
	}
	

?>



		<br>

	


	<div class="container">
<div class="mb-6 g-3 row justify-content-center">
<div class="col-lg-8">
<strong style="text-align:center">LOGIN FORM</strong>
      <div class="container">
	  <form action="" method="post" enctype="multipart/form-data">


            <div class="form-group col-lg-12 col-sm-8">
               <label for="Author" class="col-sm-2 control-label">الاسم الاخير</label>
               <div class="col-sm-10">
                  <input type="text" class="form-control" name="name"
				   placeholder="الاسم" value="<?php echo '';?>"
				   required>
               </div>
            </div>

            <div class="form-group col-lg-12 col-sm-8">
               <label for="Publisher" class="col-sm-2 control-label">اسم المستخدم</label>
               <div class="col-sm-10">
                  <input type="text" class="form-control"
				   name="email" placeholder="الايميل " 
				  value="<?php echo '';?>" 
				   required>
               </div>
            </div>

			<div class="form-group col-lg-12 col-sm-8">
               <label for="Publisher" class="col-sm-2 control-label">كلمه المرور</label>
               <div class="col-sm-10">
                  <input type="password" class="form-control" name="password" placeholder="كلمة المرور" 
				  value="<?php echo '';?>" 
				   required>
               </div>
            </div>
          
			<div class="form-group col-lg-12 col-sm-8">
               <label for="Publisher" class="col-sm-2 control-label">الصوره</label>
               <div class="col-sm-10">
                  <input type="file" class="form-control" name="image" id="image" placeholder="كلمة المرور" 
				  value="<?php echo '';?>" 
				   required>
               </div>
            </div>
			
            <br>
            <div class="form-group">
               <div class="col-sm-offset-2 col-sm-10">
                  <button  name="save" class="btn btn-info col-lg-12" data-toggle="modal">
                إضافه معلم
                  </button>
               </div>
             </div>

         </form>
      </div>
</div>
   </div>
</div>


</body>
</html>