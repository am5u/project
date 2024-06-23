
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
include '../st_mark/st_mark/header.php';
session_start();

?>
<body>
	<center>
	
	
	
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

            </tr>
			</thead>
						<?php
				
                            
      $sql = "SELECT * FROM  info_student where email = '".$_SESSION['user_email']."'  ";
            
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

  
                            	 

						</tr>
						
						<?php }?>
					</table>
    </center>

</body>
</html>