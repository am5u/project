
<?php
require_once 'conn.php';
include_once "../st_mark/st_mark/header.php";  
include('teacher_header.php');
if(!isset($_SESSION["user_id"])) 
{
	header('location: index.php');
}
$email='';
$id = $_GET['id'];
$sql = "SELECT * FROM  students WHERE id = '$id'";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
   $id= $row['id'];
	$name = $row['name']; 
	$email = $row['email']; 
   
   
}
$info_sql = "SELECT * FROM info_student WHERE teacher_number='".$_SESSION['user_id']."' AND email= '$email'";
$info_result = mysqli_query($conn,$info_sql);

$info_row = mysqli_fetch_array($info_result);

$upfirst = '';
$upsecond = '';
$upthird = '';
$upfourth = '';
if(mysqli_num_rows($info_result) > 0) {
   $id= $info_row['id'];
	$name =$info_row ['name']; 
	$email = $info_row['email']; 

    $upfirst = $info_row['Quiz'];

    $upsecond = $info_row['Assigment'];

    $upthird = $info_row['Course'];

    $upfourth = $info_row['Attendence'];

} else {
   $name='';
   $email='';
    $upfirst = '';

    $upsecond = '';

    $upthird = '';

    $upfourth = '';

}


if(!empty($_POST['name'])) 
{

   $email=$_POST['email'];
  $name = $_POST['name'];
	$upfirst = $_POST['first']; 
	$upsecond = $_POST['second']; 
	$upthird = $_POST['third']; 
	$upfourth = $_POST['fourth']; 
	
	$query = "INSERT INTO info_student (teacher_number,name, email, Quiz, Assigment, Course, Attendence) 
	           VALUES ('".$_SESSION['user_id']."','$name', '$email', '$upfirst', '$upsecond', '$upthird', '$upfourth') 
	           ON DUPLICATE KEY UPDATE 
	           Quiz='$upfirst', Assigment='$upsecond', Course='$upthird', Attendence='$upfourth'";
              
	
	if(mysqli_query($conn,$query))
	{	
		echo "<script>alert('تم الاضافه')</script>";
		echo '<script>windows: location="st_view.php"</script>';
	}
   else {
		echo "<script>alert('حدث خطا')</script>";
		echo '<script>windows: location="st_add.php?id='.$id.'"</script>"';
	}
   }

   ?>
<body>
	<center>
		
		

    
    
    
    
    
    <div class="container">
      <form action="" method="post" enctype="multipart/form-data">


            <div class="form-group">
               <label for="Title" class="col-sm-2 control-label">الاسم </label>
               <div class="col-sm-10">

           
                  <input type="text" class="form-control" name="name" placeholder="الاسم " value="<?php echo $name;?>" required>
               </div>
            </div>


            <div class="form-group col-lg-12 col-sm-8">
               <label for="Author" class="col-sm-2 control-label">الايميل </label>
               <div class="col-sm-10">
                  <input type="text" class="form-control" name="email" placeholder="الايميل" value="<?php echo $email;?>" required>
               </div>
            </div>
             
               <div class="form-group col-lg-12 col-sm-8">
               <label for="Author" class="col-sm-2 control-label">المادةالاولى</label>
               <div class="col-sm-10">
                  <input type="text" class="form-control" name="first" placeholder="المادةالاولى"  value="<?php echo $upfirst;?>" required>
               </div>
            </div>


              <div class="form-group col-lg-12 col-sm-8">
               <label for="Author" class="col-sm-2 control-label">المادةالثانية</label>
               <div class="col-sm-10">
                  <input type="text" class="form-control" name="second" placeholder="المادةالثانية" value="<?php echo $upsecond;?>"  required>
               </div>
            </div>
          
              <div class="form-group col-lg-12 col-sm-8">
               <label for="Author" class="col-sm-2 control-label">المادةالثالثة</label>
               <div class="col-sm-10">
                  <input type="text" class="form-control" name="third" placeholder="المادةالثالثة" value="<?php echo $upthird;?>" required>
               </div>
            </div>
              <div class="form-group col-lg-12 col-sm-8">
               <label for="Author" class="col-sm-2 control-label">المادةالرابعة</label>
               <div class="col-sm-10">
                  <input type="text" class="form-control" name="fourth" placeholder="المادةالرابعة"  value="<?php echo $upfourth;?>" required>
               </div>
            </div>
              
            <br>
            <div class="form-group">
               <div class="col-sm-offset-2 col-sm-10">
                  <button  name="update" class="btn btn-info col-lg-12" data-toggle="modal">
               تعديل
                  </button>
               </div>
             </div>
			 <br>
		

         </form>
		 
      </div>

    </center>
    
    
</body>
</html>