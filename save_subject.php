<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Assign Courses to Students</title>
</head>
<body>
    <?php
    require_once "conn.php";
    if ($_SERVER['REQUEST_METHOD']==='POST') {
        if(isset($_POST['save'])){
            $student_id=$_POST['stu_id'];
            $subject=$_POST['subjects'];
            $select_type=$_POST['type'];

            $sql_save_course="insert into student_subject (stu_id,sub_code,choice) values (?,?,?)";
            $save_statement=mysqli_prepare($conn,$sql_save_course);
            mysqli_stmt_bind_param($save_statement,"sss",$student_id,$subject,$select_type);
            if(mysqli_stmt_execute($save_statement))
            {
                echo "<div class='alert alert-primary' role='alert'>Course Assigned Successfully
                <a href='assign_student_subject.php' class='btn btn-primary' role='button'>Back</a>
                </div>";
                
            }
            else{
                echo "<div class='alert alert-danger' role='alert'>Failed to assign the course
                <a href='assign_student_subject.php' class='btn btn-primary' role='button'>Back</a>
                </div>";
            }
        }
    }
    ?>
</body>
</html>

