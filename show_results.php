<?php require_once 'conn.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
	<!-- DataTables Bootstrap 5 CSS -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- DataTables Core JS -->
	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

	<!-- DataTables Bootstrap 5 Integration JS -->
	<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#results").DataTable();
        });
    </script>
    <title>Add Results</title>
</head>
<body>
    <?php
        if($_SERVER['REQUEST_METHOD']==='POST'){
            if(isset($_POST['submit'])){
                $student_id=$_POST['stu_id'];
                $student_name=$_POST['stu_name'];
                $select_registered_course_sql="select student_subject.sub_code,subject.sub_name,student_subject.choice,student_subject.grade
                from student_subject,subject where student_subject.sub_code=subject.sub_code and  student_subject.stu_id='$student_id'";
                $result_registered_students=mysqli_query($conn,$select_registered_course_sql) or die(mysqli_error($conn));
            }
        }
    ?>
    <h2>Results-<?php echo $student_name;?></h2>
    <table id="results" class="table table-striped table-bordered" style="width:100%;">
        <thead>
            <tr>
                <td>Code</td>
                <td>Subject Name</td>
                <td>Core / Optional</td>
                <td>Grade</td>
                <td>&nbsp;</td>
            </tr>
        </thead>
         <tbody>
                <?php
                    while ($row=mysqli_fetch_assoc($result_registered_students)) {
                        echo "<tr><form action='update_results.php' method='post'>";
                        echo "<td>{$row['sub_code']}
                        <input type='hidden' name='sub_code' value={$row['sub_code']}>
                        <input type='hidden' name='stu_id' value={$student_id}></td>";
                        echo "<td>{$row['sub_name']}
                        <input type='hidden' name='sub_name' value='{$row['sub_name']}'> </td>";
                        echo "<td>{$row['choice']}</td>";
                        if ($row['grade']==NULL)
                        {
                            echo "<td>Pending</td>";
                        }
                        else{
                            echo "<td>{$row['grade']}</td>";
                        }
                        echo "<td><button type='submit' name='submit' class='btn btn-primary'>Update Results</button></td></form></tr>";
                    }
                ?>
        </tbody>
    </table>
</body>
</html>