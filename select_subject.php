<?php require_once "conn.php";?>
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
        if($_SERVER['REQUEST_METHOD']==='POST'){
            if (isset($_POST['submit'])) {
                $student_id=$_POST['stu_id'];
                $student_name=$_POST['stu_name'];
                $sql_select_unassigned_courses="select * from subject where subject.sub_code 
                NOT in (select sub_code from student_subject where stu_id='$student_id')";
                $result_unassigned_courses=mysqli_query($conn,$sql_select_unassigned_courses);
                if(!$result_unassigned_courses){
                    die("Error in Query".mysqli_error($conn));
                }
            }
        }
        else
        {
          
            header("Location:assign_student_subject.php");    
        }
    ?>
    <div class="content px-3 py-2">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h2>Assign Course-<?php echo $student_id;?></h2>
                </div>
                <div class="card-body">
                    <form action="save_subject.php" method="post">
                        <div class="mb-3">
                            <label for="stu_name" class="form-label"><strong>Student Name</strong></label>
                            <input type="text" id="stu_name" name="stu_name" class="form-control" value='<?php echo $student_name?>' readonly>
                            <input type="hidden" id="stu_id" name="stu_id" class="form-control" value='<?php echo $student_id;?>'>
                        </div>
                        <div class="mb-3">
                            <label for="subjects" class="form-label"><strong>Select Course</strong></label>
                            <select name="subjects" id="subjects" class="form-select">
                                <?php
                                    while($row=mysqli_fetch_assoc($result_unassigned_courses))
                                    {
                                        echo "<option value='{$row['sub_code']}'>{$row['sub_code']}-{$row['sub_name']}</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <h6><strong>Selection Type</strong></h6>
                            <div class="form-check">
                                <input type="radio" name="type" value="core" id="radio_core" checked>
                                <label for="radio_core">Core</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="type" value="optional" id="radio_optional">
                                <label for="radio_optional">Optional</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" name="save" class="btn btn-primary">
                                Save Course
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