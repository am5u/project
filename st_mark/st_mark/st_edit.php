
<?php
require_once './conn/conn.php';
 include_once "header.php";  
session_start();
if(!isset($_SESSION["id"]) || $_SESSION["id"] == '') 
{
	header('location: index.php');
}

$id = $_GET['id'];
$sql = "SELECT * FROM  info_student WHERE id = '$id'";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
	$upfirstname = $row['firstname']; 
	$uplastname = $row['lastname']; 
	$upfirst = $row['Quiz'];
	$upsecond = $row['Attendence']; 
	$upthird = $row['Course']; 
	$upfourth = $row['Assigment'];
}

if(empty($_POST['firstname']))
{
	echo "";
} else {

	$upfirstname = $_POST['firstname']; 
	$uplastname = $_POST['lastname']; 
	$upfirst = $_POST['Quiz']; 
	$upsecond = $_POST['Assigment']; 
	$upthird = $_POST['Course']; 
	$upfourth = $_POST['Attendence']; 
	
			$query = "UPDATE  info_student SET firstname='$upfirstname',lastname='$uplastname',Quiz='$upfirst',Assigment='$upsecond',Course='$upthird',Attendence='$upfourth' where id='".$id."'";
			if(mysqli_query($conn,$query))
			{	
				echo "<script>alert('تم الاضافه')</script>";
				echo '<script>windows: location="st_view.php"</script>';
			}else{
				echo "<script>alert('حدث خطا')</script>";
				echo '<script>windows: location="st_add.php?id='.$id.'"</script>';
			}
			

		
	
}
?>
<body>
	<center>
		
		<?php include('teacher_header.php');?>

    
    
    
    
    
    <div class="container">
      <form action="" method="post" enctype="multipart/form-data">


            <div class="form-group">
               <label for="Title" class="col-sm-2 control-label">الاسم الاول</label>
               <div class="col-sm-10">
                  <input type="text" class="form-control" name="firstname" placeholder="الاسم الاول" value="<?php echo $upfirstname;?>" required>
               </div>
            </div>


            <div class="form-group col-lg-12 col-sm-8">
               <label for="Author" class="col-sm-2 control-label">الاسم الثاني</label>
               <div class="col-sm-10">
                  <input type="text" class="form-control" name="lastname" placeholder="الاسم الثاني" value="<?php echo $uplastname;?>" required>
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