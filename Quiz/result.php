<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "quiz";
    $message="";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if(isset($_SESSION['name'])==NULL){
        die("you are not loged in");
    }
    else{
    $i=0;
    $j=0;
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
    if(isset($_POST['level'])){
        $_SESSION['qno']+=10;
        $sql="SELECT * from quiz.check";
        $res=$conn->query($sql);
        while($row2=$res->fetch_assoc()){
        $sql1="UPDATE quiz.check SET your_ans=NULL,correct=NUll WHERE sno='".$row2['sno']."'";
        $conn->query($sql1);
        }
        header("Location: main.php");
    }
}
   ?>
<!DOVTYPE html>
<html>
    <head>
        <title>Result</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <h1>ONLINE:Quiz</h1>
    <?php echo "<h2 style='font-style:italic'>Welcome ". $_SESSION['name']."</h2>"?>
    <form method="POST" class="home">
        <input type="hidden" name="back">
        <input type="submit" name="back" value="HOME">
    </form>
    <form method="POST" action="logout.php" class="logout">
        <input type="hidden" name="logout">
        <input type="submit" name="logout" value="Log Out">
    </form>
    <hr class="hr">
    <table border="1px">
    <?php
    while($row2=$res->fetch_assoc()){
        ?>
        <tr>
            <td><?php echo "Q".$row2["sno"].")";?></td>
        <td>Your answer is <?php echo $row2["your_ans"]?></td> 
           <td><?php
           
           if($row2["your_ans"]==NULL){
               echo "You didn't answer";
           } 
           elseif($row2["your_ans"]===$row2["correct"]){
                $i+=2;
                echo "<span style='color:green'>Correct</span>";
           }
            else{
                $i--;
                 echo "<span style='color:red'>Incorrect</span>";
            }?></td>
        </tr>
        <?php }?>
    <table>
    <div class="tot">
    <?php echo "<h2>Your Marks is ".$i."</h2>";
    if($i>=12){
        echo "<h3 style='color:green'>GOOD JOB 👍</h3>";?>
        <script> var audio = new Audio("winner.mp3");
        audio.play();
         </script>
         <form method="POST" class="next">
        <input type="hidden" name="level">
        <input type="submit" name="level" value="Next level">
    </form>
     <?php }
    else{
        echo "<h3 style='color:red'>BETTER LUCK NEXT TIME 😜</h3>";?>
        <script> var audio = new Audio("loser.mp3");
        audio.play();
         </script>
    <?php }?>
    </body>
</html>