<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Course</title>
</head>
<body>
    <div class="content px-3 py-2">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h3>Add New Course</h3>
                </div>
                <div class="card-body">
                    <form action="add_validate2.php" method="post">
                        <div class="mb-3">
                            <label for="course_id" class="form-label"><strong>Course Code</strong></label>
                            <input type="text" id="course_id" name="course_id" class="form-control" pattern="^([A-Z]{3})\d(\d|b)\d{2}" required>
                        </div>
                        <div class="mb-3">
                            <label for="course_name" class="form-label"><strong>Course Name</strong></label>
                            <input type="text" id="course_name" name="course_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <h6><strong>Course Types</strong></h6>
                            <div class="form-check">
                                <input type="checkbox" id="chktheory" name="course_types[]" class="form-check-input" value="theory" checked>
                                <label for="chktheory" class="form-label">Theory</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" id="chkpractical" name="course_types[]" class="form-check-input" value="practical">
                                <label for="chkpractical" class="form-label">Practical</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit" name="btnsave">Save Course</button>
                        </div>
                    </form>
                </div>
            </div>
            <?php
                if(isset($_GET['error'])){
                    if ($_GET['error']==1) {
                        echo "<div class='alert alert-danger' role='alert'>Course Code Already Exist</div>";
                    }

                    if($_GET['error']==2){
                        echo "<div class='alert alert-danger' role='alert'>Please Select the Course Type</div>";
                    }
                }

                if(isset($_GET['success'])){
                    if($_GET['success']==1)
                    {
                        echo "<div class='alert alert-primary' role='alert'>Course Saved Successfully</div>";
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>