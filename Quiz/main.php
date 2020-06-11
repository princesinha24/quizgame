<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "quiz";
    $message="";

    $conn = new mysqli($servername, $username, $password, $dbname);
    $i=0;
    if(isset($_POST['math'])){
        $sql1="UPDATE quiz.check SET your_ans='".$_POST['math']."',correct='".$_POST['ans']."' 
        WHERE sno='".$_POST['sno']."'";
        if($conn->query($sql1)){
            echo "ans saved";
        }
        else{
            echo $conn->error;
        }
    }
    
?>
<!DOCTYPE HTML>
<html>
    <head>
    <title>ONLINE:quiz</title>
    <meta charset="utf-8">
    </head>
    <body>
        <?php
            $sql="SELECT * FROM Math";
            $result=$conn->query($sql);
            while($row=$result->fetch_assoc()){ ?>
            <form method=POST>
                <?php echo "Q".$row["sno"].")".$row["ques"];?><br>
                <input type="radio" name="math" value="A"><?php echo "A)".$row["optA"];?>
                <input type="radio" name="math" value="B"><?php echo "B)".$row["optB"];?> 
                <input type="radio" name="math" value="C"><?php echo "C)".$row["optC"];?>
                <input type="radio" name="math" value="D"><?php echo "D)".$row["optD"];?>
                <input type="hidden" name="ans" value=<?php echo $row["ans"];?>>
                <input type="hidden" name="sno" value=<?php echo $row["sno"];?>>
                <input type="submit" name="button" value="submit">
                <hr>
            </form>
            <?php }?>
            <table>
            <?php
                $sql2="SELECT * FROM quiz.check";
                $res=$conn->query($sql2);
                 while($row1=$res->fetch_assoc()){ ?>
                <tr>
                    <td><?php echo "Q".$row1["sno"].")";?></td>
                    <td><?php echo $row1["your_ans"];?></td>
                </tr>
                 <?php }?>
            </table>
            <form method="POST" action="result.php">
            <input type="radio" name="cal" value="calc"> I want to submit my quiz
            <input type="submit" name="cal" value="submit Quiz">
            </form>
    </body>
</html>