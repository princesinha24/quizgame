<?php

    $message="";

    if(isset($_POST['cre'])){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "quiz";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            $message="Connection failed";
            die("Connection failed: " . $conn->connect_error);
        }
        else{
            $name=$_POST['Name'];
            $gmail=$_POST['gmail'];
            $pwd=$_POST['pwd'];
            $UserName=$_POST['UserName'];
            if(!empty($name)&& !empty($gmail)&& !empty($pwd)&& !empty($UserName)){
            $select="SELECT UserName FROM user WHERE UserName='".$UserName."'";
            $result=$conn->query($select);
            $no=mysqli_num_rows($result);
            if($no==0){
                $sql="INSERT INTO user ( name,UserName, Password,Email,qno)
                 VALUES ('".$name."','".$UserName."','".$pwd."','".$gmail."',1)";
                if($conn->query($sql)){
                    $message="user id has been created";
                }
            }
            else{
                $message="userid already exist";
            }
        }
        else{
            $message="Fill the complete form";
        }
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
    <title>Online:Quiz</title>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
    <h1>ONLINE:Quiz</h1>
        <hr>
        <?php
            echo "<div style='color:red'>".$message."</div>";
        ?>
        <div class="new_account">
            <a href="login.php"><button>Log In</button></a>
        </div>
        <form  method="POST" class="form">
            <h2>Create Account</h2>
            <table class="for">
            <tr>
            <td>Name</td>
            <td><input type="text" name="Name" placeholder="Name"></td>
            </tr>
            <tr>
            <td>User name</td>
            <td><input type="text" name="UserName" placeholder="User name"></td>
            </tr>
            <tr>
            <td>email id</td>
            <td><input type="email" name="gmail" placeholder="email id"></td>
            </tr>
            <tr>
            <td>password</td>
            <td><input type="password" name="pwd" id="pwd" placeholder="password">
            <input type="checkbox" onclick="show()">
            </td>
            </tr>
            </table>
            <input type="submit" value="Create Account" name="cre">
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
