<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "quiz";
    $message="";
    $k=0;
    date_default_timezone_set('Asia/Kolkata');
    $conn = new mysqli($servername, $username, $password, $dbname);
    $i=0;
    if(isset($_SESSION['name'])==NULL){
        die("you are not loged in");
    }
    else{
        $t=24*60*60;
        $h=date("h");
        $m=date("i");
        $s=date("s");
        $count1=((($h*60)+$m)*60)+$s;
        $p=($_SESSION['time']-$count1+$t)%$t;
    if(isset($_POST['math'])){
        if($p<=600){
        $sql1="UPDATE quiz.check SET your_ans='".$_POST['math']."',correct='".$_POST['ans']."' 
        WHERE sno='".$_POST['sno']."'";
        $conn->query($sql1);
    }
    else{
        $message="<div style='color:red'>Time is over</div>";
    }   
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
        <p id="demo"></p>

        <script>
        var myVar = setInterval(myTimer, 998);
        var t=<?php echo $p;?>;
        function myTimer() {
            if(t<=600 && t>=0){
            document.getElementById("demo").innerHTML = t;
            t--;
            }
            else if(t>=600){
                document.getElementById("demo").innerHTML = 0;
                alert("time is over click to submit quiz");
                t=-1;
            }
        }
</script>

        <?php echo "<h2 style='font-style:italic'>Welcome ". $_SESSION['name']."</h2>"?>
        <?php echo $message;?>
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
            <input type="hidden" name="cal" value="calc"> I want to submit my quiz
            <input type="submit" name="cal" value="submit Quiz">
            </form>
            
    </body>
</html>