<?php
    
    include_once './config.php';

    $student_id = $_GET['id'];
    $tables = ['applications', 'exam_details', 'upload_docs'];

    foreach($tables as $table){
        $sql = "delete from ".$table." where student_id=".$student_id ;
        if(mysqli_query($db,$sql)){
            $success="successfully Deleted";
        }else{
            echo mysqli_error($db);
        }
    }

    $sql1 = "delete from student where id=".$student_id;
    if(mysqli_query($db,$sql1)){
        $success="Successfully Deleted";
        header("location:student.php?success=$success");
    }else{
        $error = mysqli_error($db);
        header("location:student.php?error=$error");
    }

?>