
	<style>
img{
max-width: 80px;; 
max-height:80px;;
border-radius: 50%;
  
	    border: 2px solid #ccc;

}
tr,td,th{width: 8%;text-align: center}
</style>

<?php
require_once 'conn.php';
 include_once "../st_mark/st_mark/header.php";  


?>
<body>
	<center>
	
		<?php include('teacher_header.php');?>
	
	
        <table class="table table-responsive table-lg table-md 
		table-sm  table-hover   table-bordered">
         <thead>
		 <tr>
		      <th>#</th>
               <th>رقم المدرسي</th>
			   <th>الاسم </th>
			   <th>الايميل</th>
               <th>الصوره</th>

			   <th>الماده الاولى</th>
               <th>الماده الثانية</th>
			   <th>الماده الثالثة</th>
               <th>الماده الرابعة</th>
			   <th>النسبة</th>
			   <th>النتيجة</th>
             <th>إضافه الدرجات</th>
               <th>تعديل</th>
               <th>حذف</th>
            </tr>
			</thead>
						<?php
				
                            
      $sql = "SELECT * FROM  info_student where teacher_number = '".$_SESSION["user_id"]."'  ";
            
    $query = mysqli_query($conn, $sql); 
          
    while ($row = mysqli_fetch_array($query)){

				$id= $row['id'];
				$name = $row['name']; 
				$email = $row['email']; 
				$techid= $row['teacher_number'];
				$Quiz = $row['Quiz']; 
				$Assigment = $row['Assigment']; 
				$Course= $row['Course']; 
				$Attendence = $row['Attendence'];
				$final_mark  = ($Quiz + $Assigment
				 + $Course + $Attendence) / 4;
        
				if(($final_mark >=90) &&($final_mark <=100)){
					$remarks = "ممتاز";	
				}
                elseif(($final_mark >=70) &&($final_mark <=80)){
					$remarks = "جيد جدا";
                }
                 elseif (($final_mark >=60) &&($final_mark <=70)){
					$remarks = "جيد";	
				}
                    elseif(($final_mark >=50) &&($final_mark <=60)){
					$remarks = "مقبول";	
                    }else {
					$remarks = "راسب";
				}
				$picture = $row['picture'];

						
							?>
					
						<tr>
						      <td><?php echo $row ['id'];?></td>

							  <td><?php echo $techid;?></td>
                              <td><?php echo $name;?></td>
							  <td><?php echo $email;?></td>

							<td><img src="../uploaded_files/<?php echo "$picture";?>"></td>
                            
						
							<td ><?php echo "$Quiz";?></td>
							<td><?php echo "$Attendence";?></td>
							<td><?php echo "$Course";?></td>
							<td><?php echo "$Assigment";?></td>
                            
							<td style="background-color: #6fca5f;"><?php echo "$final_mark";?></td>
                            
							<td style="background-color: #ccc;"><?php echo "$remarks";?></td>

  
                            	<td>
						   
                             <a class="btn btn-outline-info btn-md" 
							 href="st_add.php?id=<?php echo $row['id'];?>"role="button">إضافه الدرجات</a>
                                
							</td>
                             
            
							<td>
						
                             <a class="btn btn-outline-warning btn-lg" 
							 href="st_edit.php?id=<?php echo $row['id'];?>"role="button">تعديل</a>
                                
							</td>
							<td>
							
                      
                             <a class="btn btn-outline-danger btn-lg" 
							 href="st_delete.php?id=<?php echo $row['id'];?>" role="button">حذف</a>
							</td>
                          

						</tr>
						
						<?php }?>
					</table>
    </center>

</body>
</html>