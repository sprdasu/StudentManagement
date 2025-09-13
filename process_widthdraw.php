<?php
    require_once 'conn.php';

    function widthdraw_subjects($stu_id,$sub_code){
        $delete_course_sql="delete from student_subject where stu_id=? and sub_code=?";
        $delete_stmt=mysqli_prepare($GLOBALS['conn'],$delete_course_sql);
        mysqli_stmt_bind_param($delete_stmt,"ss",$stu_id,$sub_code);
        $delete_result=mysqli_stmt_execute($delete_stmt);
        if(!$delete_result){
            die(mysqli_error($GLOBALS['conn']));
        }
        
    }
    
    if($_SERVER['REQUEST_METHOD']==='POST')
    {
        if (isset($_POST['delconfirm'])) {
            $selected_subjects=$_POST['checked_courses'];
            $student_id=$_POST['stu_id'];
            foreach ($selected_subjects as $subject) {
                widthdraw_subjects($student_id,$subject);
            }
        }

        header("Location:select_student_withdraw_course.php");
    }


    mysqli_close($conn);
?>