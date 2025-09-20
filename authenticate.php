<?php
require_once 'conn.php';

$user_input_hash = hash('sha256', $_POST['password']);
$select_user_sql = "select password_hash, role from useraccount where username='{$_POST['username']}'";
$result_set = mysqli_query($conn, $select_user_sql) or die(mysqli_error($conn));
$isLoginSuccess = FALSE;
$user_role = NULL;

while ($row = mysqli_fetch_assoc($result_set)) {
    if ($row['password_hash'] == $user_input_hash) {
        $isLoginSuccess = TRUE;
        $user_role = $row['role'];
        break;
    }
}

mysqli_close($conn);

if ($isLoginSuccess) 
    
    {
    if ($user_role == "admin") {
        header("Location:dashboard.php");
    }

    if ($user_role == "student") 
        {

        header("Location:student_dashboard.php");
    }
} 
else {
    header("Location:login.php?error=1");
}
