<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "quiz";
    $message="";
    $_session['arr']=array("sd","gffd");

    if(isset($_POST["login"])){
        if(empty($_POST["user"])){
            $message="Enter Your User Id";
        }
        elseif(empty($_POST["pwd"])){
            $message="Enter Your Password";
        }
        else{
            $conn = new mysqli($servername, $username, $password, $dbname);
            $sql="SELECT Password FROM user WHERE UserName='".$_POST["user"]."'";
            $result=$conn->query($sql);
            $row=$result->fetch_assoc();
            if($row==0){
                $message="Wrong User Id";
            }
            else{
                $message="Wrong password";
            }
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
    <title>Songify:Discover Your Music</title>
    <meta charset="utf-8">
    </head>
    <body>
        <h1>Online:QUIZ</h1>
        <hr>
        <?php
            echo "<div style='color:red'>".$message."</div>";
        ?>
        <div class="new_account">
            <a href="new.php"><button>new account</button></a>
            <a href="main.php"><button>home</button></a>
        </div>
        <form class="form" method="POST">
            <h2>LOGIN</h2>
            <label>Email Id</label>
            <input type="text" name="user" placeholder="email id"><br>
            <label>password</label>
            <input type="password" name="pwd" id="pwd" placeholder="password">
            <input type="checkbox" onclick="show()">
            <br>
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