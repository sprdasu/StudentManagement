<?php 
    require_once 'conn.php';

    if($_SERVER['REQUEST_METHOD']==='POST'){
        if (isset($_POST['submit'])) {
            $student_id=$_POST['stu_id'];
            $student_full_name=$_POST['stu_name'];
            $select_student_courses="select student_subject.sub_code,subject.sub_name from student_subject,subject
            where subject.sub_code=student_subject.sub_code and student_subject.stu_id='$student_id'";
            $result_student_courses=mysqli_query($conn,$select_student_courses) or die(mysqli_error($conn));
        }
    }
    else {
        header("Location:select_student_withdraw_course.php");
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
    <title>Widthdraw Subjects</title>
    <script type="text/javascript">
        function confirmDelete()
        {
            let selected_subjects=document.getElementsByName('checked_courses[]');
            let warning_msg="Are sure to delete the following courses:<ul>"
            for(let i=0;i< selected_subjects.length;i++){
                if(selected_subjects[i].checked){
                    warning_msg+="<li>"+selected_subjects[i].value+"</li>"
                }
            }

            document.getElementById("modalBodyContent").innerHTML=warning_msg;

            const modal=new bootstrap.Modal(document.getElementById("confirmWithDraw"));
            modal.show();
        }
    </script>
</head>
<body>
    <div class="content px-3 py-2">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h2>Withdraw Subjects -<?php echo $student_id;?></h2>
                </div>
                <div class="card-body">
                    <form action="process_widthdraw.php" method="post">
                        <div class="mb-3">
                            <label for="stu_name" class="form-label"><strong>Student Name</strong></label>
                            <input type="text" id="stu_name" class="form-control" value='<?php echo $student_full_name;?>' readonly>
                            <input type="hidden" id="stu_id" name="stu_id" value='<?php echo $student_id;?>'>
                        </div>
                        <div class="mb-3">
                            <h6>Registered Courses</h6>
                            <?php
                                while ($row=mysqli_fetch_assoc($result_student_courses)) {
                                    echo "<div class='form-check'>";
                                    echo "<input type='checkbox' id='{$row['sub_code']}' class='form-check-input' name='checked_courses[]' value='{$row['sub_code']}'>";
                                    echo "<label for='{$row['sub_code']}' class='form-check-label'>{$row['sub_name']}-{$row['sub_code']}</label>";
                                    echo "</div>";
                                }
                            ?>
                        </div>
                        <div class="mb-3">
                            <button type="button" class="btn btn-primary" onclick="confirmDelete()">Withdraw</button>
                        </div>

                    <!---------Start bootstrap model--------->
                    <div class="modal fade" id="confirmWithDraw" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="detailsModalLabel">Summary</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body" id="modalBodyContent">
                            <!-- Filled via JavaScript -->
                          </div>
                          <div class="modal-footer">
                            <button type="submit" name="delconfirm" class="btn btn-primary">Yes</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                          </div>
                        </div>
                      </div>
                    </div>
                   <!-------End bootstrap model-------->

                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<?php mysqli_close($conn);?>
</html>