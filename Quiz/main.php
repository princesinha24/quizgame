<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "quiz";
    $message="";
    $k=0;
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
            $sql="SELECT DISTINCT * FROM Math";
            $result=$conn->query($sql);
            while($row=$result->fetch_assoc()){ 
                $k++;
                if($_SESSION['qno']<=$k AND $i<10){
                    $i++;
                    $sql2="SELECT * FROM quiz.check";
                    $res=$conn->query($sql2);
                    while($row1=$res->fetch_assoc()){
                    if($row1["sno"]==$i){ ?>
                <form method=POST>
                <div class="que">
                <?php if($row1["your_ans"]!=NULL){
                    echo "<span style='color:blue'>Q".$i.")".$row["ques"]."</span>";
                }
                else{
                 echo "Q".$i.")".$row["ques"];
                }?>
            </div>
                <input type="radio" name="math" value="A"><?php echo "A)".$row["optA"];?>
                <input type="radio" name="math" value="B"><?php echo "B)".$row["optB"];?>
                <input type="radio" name="math" value="C"><?php echo "C)".$row["optC"];?>
                <input type="radio" name="math" value="D"><?php echo "D)".$row["optD"];?>
                <input type="hidden" name="ans" value=<?php echo $row["ans"];?>>
                <input type="hidden" name="sno" value=<?php echo $i;?>>
                <input type="submit" name="button" value="submit">
                <span class="mark"><?php echo $row1["your_ans"];?></span>
                <hr>
            </form>
            <?php } } }
         }?>
            </div>
            <form method="POST" action="result.php" class="sub">
            <input type="radio" name="cal" value="calc"> I want to submit my quiz
            <input type="submit" name="cal" value="submit Quiz">
            </form>
    </body>
</html>