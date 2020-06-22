<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "quiz";
    $message="";
    $_session['arr']=array("sd","gffd");
    date_default_timezone_set('Asia/Kolkata');
    if(isset($_POST["hai"])){
        if(empty($_POST["user"])){
            $message="Enter Your User Id";
        }
        elseif(empty($_POST["pwd"])){
            $message="Enter Your Password";
        }
        else{
            $conn = new mysqli($servername, $username, $password, $dbname);
            $sql="SELECT UserName FROM user WHERE UserName='".$_POST["user"]."'";
            $result=$conn->query($sql);
            $row=mysqli_num_rows($result);
            if($row==0){
                $message="Wrong User Id";
            }
            else{
                $sql="SELECT * FROM user WHERE UserName='".$_POST["user"]."'";
                $result=$conn->query($sql);
                $row=$result->fetch_assoc();
                if($row["Password"]==$_POST["pwd"]){
                    $_SESSION['account']=$row["UserName"];
                    $_SESSION['name']=$row["name"];
                    $_SESSION['qno']=$row["qno"];
                    $h=date("h");
                    $m=date("i");
                    $s=date("s");
                    $count=((($h*60)+$m)*60)+$s+600;
                    $_SESSION['time']=$count;
                    header("Location: main.php");
                }
                else{
                    $message="Incorrect Password";
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
    <title>Online:Quiz</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>ONLINE:Quiz</h1>
        <hr>
        <div class="new_account">
            <a href="new.php"><button>new account</button></a>
        </div>
        <form method="POST" action="add.php" class="logout">
        <input type="hidden" name="logout">
        <input type="submit" name="logout" value="Add Question">
    </form>
        <?php
            echo "<div style='color:red'>".$message."</div>";
        ?>
        <form class="form" method="POST">
            <h2>LOGIN</h2>
            <table class="for">
            <tr>
            <td>User name</td>
            <td><input type="text" name="user" placeholder="User name"></td>
            </tr>
            <td>password</td>
            <td><input type="password" name="pwd" id="pwd" placeholder="password">
            <input type="checkbox" onclick="show()">
            </td>
            </tr>
            </table>
            <input type="submit" value="Log In" name="hai" >
        </form>
        <script>
            function show(){
                var pas=document.getElementById("pwd");
                if(pas.type==="password"){
                    pas.type="text";
                }
                else{
                    pas.type="password";
                }
            }
        </script>
    </body>
</html>