<style>
img{
	width: 80%; 
	/* height: 20%	; */
}
td{width: 20%;}
</style>

<?php
include 'conn/conn.php';

include ('admin_header.php');
include ('header.php');

if(!isset($_SESSION["admin_id"]) ) 
{
	header('location: index.php');
}
?>
<body>


	
	
		<br>
		<form action="" post="POST">
		<table class="table  table-responsive table-lg table-md table-sm  
		table-hover   table-bordered">
         <thead>
		 <tr>
		      <th>#</th>
               <th>First Name</th>
			   <!-- <th>Last name </th> -->
               <th>password </th>
			   <!-- <th>كلمة </th> -->
               <!-- <th>النوع</th> -->
			   <th>image</th>
               <th>Edit</th>
               <th>Delete</th>
            </tr>
			</thead>
        
	
			<?php
					
                            
 $sql = "SELECT * FROM tutors order by id ASC";
            
    $query = mysqli_query($conn, $sql); 
          
    while ($row = mysqli_fetch_array($query)){	?>
		<tbody>
			               <td><?php echo $row['id']; ?></td>
							<td><?php echo $row['name']; ?></td>
							<td><?php echo $row['email']; ?></td>
							<td><?php echo $row['password']; ?></td>
							<td><img src="../../uploaded_files/<?php echo $row['image'];?>"></td>

							<td>
							<a class="btn btn-outline-info btn-lg" 
							href="edit_account.php?id=<?php echo $row['id'];?>">تعديل</a>
							</td>

							<td>
							<a class="btn btn-outline-danger btn-lg"
							 href="delete_account.php?id=<?php echo $row['id'];?>" >حذف</a>
							</td>
					
							</tbody>
	                      <?php }?>
		</form>


</body>
</html>