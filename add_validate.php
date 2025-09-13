<?php
    require_once "conn.php";

    $course_id=$_POST['course_id'];
    $course_name=$_POST['course_name'];
    $course_credits=substr($course_id,-1);
    $isTheory=0;
    $isPractical=0;
    $course_types=$_POST['course_types'];

    foreach ($course_types as $type) {
        if ($type=="theory") {
            $isTheory=1;
        }

        if ($type=="practical") {
            $isPractical=1;
        }
    }

    if(!$isTheory && !$isPractical){
        header("Location:add_course.php?error=2");
    }
    else{
        $search_course_sql="select * from subject where sub_code='$course_id'";
        $course_result=mysqli_query($conn,$search_course_sql) or die(mysqli_error($conn));
        if(mysqli_num_rows($course_result)==0){
            $course_insert_sql="insert into subject values ('$course_id','$course_name',$course_credits,$isTheory,$isPractical)";
            $insert_result=mysqli_query($conn,$course_insert_sql);
            if (!$insert_result) {
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
    #echo $course_id." ".$course_name." ".$course_credits." ".strval($isTheory)." ".strval($isPractical);

?>