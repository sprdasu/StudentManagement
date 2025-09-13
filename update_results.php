<?php 
    require_once "conn.php";

    if($_SERVER['REQUEST_METHOD']==='POST'){
        if (isset($_POST['submit'])) {
            $student_id=$_POST['stu_id'];
            $sub_code=$_POST['sub_code'];
            $sub_name=$_POST['sub_name'];
        }

        if(isset($_POST['save_results'])){
            $sql_stu_id=$_POST['hid_stu_id'];
            $sql_sub_code=$_POST['hid_course_code'];
            $grade=$_POST['grade'];
            $update_results_sql="update student_subject set grade=? where stu_id=? and sub_code=?";
            $update_statement=mysqli_prepare($conn,$update_results_sql);
            mysqli_stmt_bind_param($update_statement,"sss",$grade,$sql_stu_id,$sql_sub_code);
            $update_result=mysqli_stmt_execute($update_statement);
            if(!$update_result){
                echo "Error :".mysqli_error($conn);
            }
            else {
                header("Location:enter_results.php");
            }
        }
    }
    else {
        header("Location:enter_results.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Update Results</title>
</head>
<body>
    <div class="content px-3 py-2">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h2><?php echo "{$_POST['stu_id']} - {$_POST['sub_code']}";?></h2>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="subject_name" class="form-label"><strong>Subject Name</strong></label>
                            <input type="text" name="subject_name" class="form-control" value='<?php echo "{$sub_code}-{$sub_name}";?>' readonly>
                            <input type="hidden" name="hid_stu_id" value='<?php echo $student_id;?>'> 
                            <input type="hidden" name="hid_course_code" value='<?php echo $sub_code;?>'> 
                        </div>
                        <div class="mb-3">
                            <label for="grades" class="form-label"><strong>Grade</strong></label>
                            <select name="grade" id="grade" class="form-control">
                                <option value="A" selected>A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="S">S</option>
                                <option value="F">F</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <button type="submit" name="save_results" class="btn btn-primary">
                                Save Results
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php mysqli_close($conn);?>
</body>
</html>