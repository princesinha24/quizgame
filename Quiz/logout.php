<?php
        session_start();
        $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "quiz";
    $message="";

    $conn = new mysqli($servername, $username, $password, $dbname);
        $sql="SELECT * from quiz.check";
        $res=$conn->query($sql);
        while($row2=$res->fetch_assoc()){
        $sql1="UPDATE quiz.check SET your_ans=NULL,correct=NUll WHERE sno='".$row2['sno']."'";
        if($conn->query($sql1)){
        }
        }
        session_destroy();
        header("Location: login.php");
?>