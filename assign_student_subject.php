<?php 
    require_once 'conn.php';
    $sql_select_student="select * from student";
    $student_result=mysqli_query($conn,$sql_select_student);
?>
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
            $("#students").DataTable();
        });
    </script>
    <title>Assign Courses to Students</title>
</head>
<body>
    <h2>Registered Students</h2>
    <table id="students" class="table table-striped table-bordered" style="width:100%;">
        <thead>
            <tr>
                <td>Student ID</td>
                <td>First Name</td>
                <td>Last Name</td>
                <td>Enrolled Year</td>
                <td>&nbsp;</td>
            </tr>
         </thead>
        <tbody>
            <?php
                while ($row=mysqli_fetch_assoc($student_result)) {
                    $student_full_name=$row['stu_first_name']." ".$row['stu_last_name'];
                    echo "<tr><form action='select_subject.php' method='post'>";
                    echo "<td>{$row['stu_id']}
                    <input type=hidden name='stu_id' value={$row['stu_id']}>
                    <input type=hidden name='stu_name' value='{$student_full_name}'></td>";
                    echo "<td>{$row['stu_first_name']}</td>";
                    echo "<td>{$row['stu_last_name']}</td>";
                    echo "<td>{$row['stu_enroll_year']}</td>";
                    echo "<td><button type='submit' name='submit' class='btn btn-primary'>Assign Subject</button></td>";
                    echo "</form></tr>";
                }
            ?>
        </tbody>
    </table>
    <?php mysqli_close($conn);?>
</body>
</html>