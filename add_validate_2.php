<?php
    require_once "conn.php";

    $course_id=$_POST['course_id'];
    $course_name=$_POST['course_name'];
    $course_credits=substr($course_id,-1);
    $isTheory=false;
    $isPractical=false;
    $course_types=$_POST['course_types'];

    foreach ($course_types as $type) {
        if ($type=="theory") {
            $isTheory=true;
        }

        if ($type=="practical") {
            $isPractical=true;
        }
    }

     if(!$isTheory && !$isPractical){
        header("Location:add_course.php?error=2");
    }
    else{
        $search_course_sql="select * from subject where sub_code='$course_id'";
        $course_result=mysqli_query($conn,$search_course_sql) or die(mysqli_error($conn));
        if(mysqli_num_rows($course_result)==0){
            #$course_insert_sql="insert into subject values ('$course_id','$course_name',$course_credits,$isTheory,$isPractical)";
            $course_insert_sql="insert into subject values (?,?,?,?,?)";
            $insert_statement=mysqli_prepare($conn,$course_insert_sql);
            mysqli_stmt_bind_param($insert_statement,"ssiii",$course_id,$course_name,$course_credits,$isTheory,$isPractical);
            if (!mysqli_stmt_execute($insert_statement)) {
                echo "Error Occurred:".mysqli_error($conn);
            }
            else
            {
                header("Location:add_course.php?success=1");
            }
        }
        else{
            header("Location:add_course.php?error=1");
        }
    }
    mysqli_close($conn);
?>