<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "quiz";
    $message="";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $i=0;
    $sql="SELECT * from quiz.check";
    $res=$conn->query($sql);
    if(isset($_POST['back'])){
        $sql="SELECT * from quiz.check";
        $res=$conn->query($sql);
        while($row2=$res->fetch_assoc()){
        $sql1="UPDATE quiz.check SET your_ans=NULL,correct=NUll WHERE sno='".$row2['sno']."'";
        if($conn->query($sql1)){
        }
        }
        header("Location: main.php");
    }
   ?>
<!DOVTYPE html>
<html>
    <head>
        <title>Result</title>
        <meta charset="utf-8">
    </head>
    <body>
    <form method="POST">
        <input type="hidden" name="back">
        <input type="submit" name="back" value="HOME">
    </form>
    <table border="1px">
    <?php
    while($row2=$res->fetch_assoc()){?>
        <tr>
        <td>Your answer is <?php echo $row2["your_ans"]?></td> 
           <td><?php
           
           if($row2["your_ans"]==NULL){
               echo "You didn't mark any answer";
           } 
           elseif($row2["your_ans"]===$row2["correct"]){
                $i++;
                echo "<span style='color:green'>Correct</span>";
           }
            else{
                 echo "<span style='color:red'>Incorrect</span>";
            }?></td>
        </tr>
        <?php }?>
    <table>
    <?php echo "Your Marks is ".$i;
    ?>
    </body>
</html>