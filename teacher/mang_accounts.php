<style>
img{
	width: 80%; 
	/* height: 20%	; */
}
td{width: 20%;}
</style>

<?php
include 'conn.php';

include ('teacher_header.php');

if(!isset($_SESSION["user_id"]) && $_SESSION['user_usertype'] =='tutor' ) 
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
               <th>الاسم </th>
			   <th>الايميل</th>
			   <th>كلمة المرور</th>
         
			   <th>الصوره</th>
            
               <th>حذف</th>
            </tr>
			</thead>
        
	
			<?php
					
                            
 $sql = "SELECT * FROM students order by id ASC";
            
    $query = mysqli_query($conn, $sql); 
          
    while ($row = mysqli_fetch_array($query)){	?>
		<tbody>
			               <td><?php echo $row['id']; ?></td>
							<td><?php echo $row['name']; ?></td>
							<td><?php echo $row['email']; ?></td>
							<td><?php echo $row['password']; ?></td>
							<td><img src="../uploaded_files/<?php echo $row['image'];?>"></td>

						 <td>
							<a class="btn btn-outline-info btn-lg" 
							href="st_edit.php?id=<?php echo $row['id'];?>">تعديل</a>
							</td> 

							<td>
							<a class="btn btn-outline-danger btn-lg"
							 href="deletestudent.php?id=<?php echo $row['id'];?>" >حذف</a>
							</td>
					
							</tbody>
	                      <?php }?>
		</form>


</body>
</html>