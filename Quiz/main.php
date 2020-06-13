<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "quiz";
    $message="";

    $conn = new mysqli($servername, $username, $password, $dbname);
    $i=0;
    if(isset($_SESSION['name'])==NULL){
        die("you are not loged in");
    }
    else{
    if(isset($_POST['math'])){
        $sql1="UPDATE quiz.check SET your_ans='".$_POST['math']."',correct='".$_POST['ans']."' 
        WHERE sno='".$_POST['sno']."'";
        $conn->query($sql1);
    }
}
    
    
?>
<!DOCTYPE HTML>
<html>
    <head>
    <title>Online:Quiz</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>ONLINE:Quiz</h1>
        <?php echo "<h2 style='font-style:italic'>Welcome ". $_SESSION['name']."</h2>"?>
        <form method="POST" action="logout.php" class="logout">
        <input type="hidden" name="logout">
        <input type="submit" name="logout" value="Log Out">
    </form>
    <hr class="hr">
        <div class="row1">
        <?php
            $sql="SELECT * FROM Math";
            $result=$conn->query($sql);
            while($row=$result->fetch_assoc()){ ?>
            <form method=POST>
                <div class="que">
                <?php echo "Q".$row["sno"].")".$row["ques"];?>
            </div>
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
            </div>
            <div class="row2">
                <h5>YOUR ANSWER</h5>
                <hr>
            <table >
            <?php
                $sql2="SELECT * FROM quiz.check";
                $res=$conn->query($sql2);
                 while($row1=$res->fetch_assoc()){ ?>
                <tr class="high">
                    <td><?php echo "Q".$row1["sno"].")";?></td>
                    <td><?php echo $row1["your_ans"];?></td>
                </tr>
                 <?php }?>
            </table>
                 </div>
            <form method="POST" action="result.php" class="sub">
            <input type="radio" name="cal" value="calc"> I want to submit my quiz
            <input type="submit" name="cal" value="submit Quiz">
            </form>
    </body>
</html>