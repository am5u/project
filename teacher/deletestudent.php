
<style>
		img{
width: 10%;

 height:120px;
		}
</style>

<?php
require_once 'conn.php';
 include_once "../st_mark/st_mark/header.php";  



$id = $_GET['id'];


<<<<<<< HEAD
$query = "SELECT * FROM info_student where id = '$id' ";
=======
$query = "SELECT * FROM users where id = '$id' ";
>>>>>>> b9df638a7032794e58e32c680001589400898f57
$result = mysqli_query($conn,$query);
while ($row = mysqli_fetch_array($result))
{
	$delfirstname = $row['name']; 
	$dellastname = $row['email']; 
<<<<<<< HEAD
	$delpicture = $row['picture'];
}

if(isset($_POST['yes'])){
	$del = "DELETE from info_student where id = '$id' ";
	if(mysqli_query($conn,$del)){
		$del = "DELETE from students where id = '$id' ";
		mysqli_query($conn,$del);
?> 

	
=======
	$delusername = $row['password']; 
	$delpicture = $row['image'];
}

if(isset($_POST['yes'])){
	$del = "DELETE from tutors where id = '".$id."' ";
	mysqli_query($conn,$del);
?>
>>>>>>> b9df638a7032794e58e32c680001589400898f57
	<script>alert('تم الحذف')</script>
	<script>windows: location="mang_accounts.php"</script>
<?php
}

<<<<<<< HEAD
}

=======
>>>>>>> b9df638a7032794e58e32c680001589400898f57
if(isset($_POST['no'])){
	echo '<script>windows: location="mang_accounts.php"</script>';
}
?>
<body>

		<?php include('teacher_header.php');?>

					<form action="" method="post">
					<br>
					<center>					
	        <img src="../uploaded_files/<?php echo "$delpicture";?>" >
<<<<<<< HEAD
	
=======
			<h3> <?php echo "$delfirstname $dellastname";?></h3>	
			<h3> <?php echo "$delusername";?></h3>
>>>>>>> b9df638a7032794e58e32c680001589400898f57
			<strong>هل انت متاكد من الحذف؟</strong>	
	    <br>
        <input type="submit" name="yes"  value="نعم"
        class="btn btn-lg btn-outline-danger col-lg-3 col-md-4 col-sm-11 col-xs-11 button">
      
       <br>
	   <br>
        <input type="submit" name="no"  value="لا"
        class="btn btn-lg btn-outline-primary col-lg-3 col-md-4 col-sm-11 col-xs-11 button">
      	
           
           
      
                        </center>
						
				
              

							
					</form>
				
			
	
</body>
</html>