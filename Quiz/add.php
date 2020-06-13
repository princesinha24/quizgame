<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "quiz";
    $message="";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if(isset($_POST['add'])){
        if(!empty($_POST['question'])&& !empty($_POST['ans'])&& !empty($_POST['opta'])&& !empty($_POST['optb'])&& !empty($_POST['optc'])&& !empty($_POST['optd'])){
        $sql="SELECT ques from math where ques='".$_POST['question']."'";
        $result=$conn->query($sql);
        $row=mysqli_num_rows($result);
        if($row==0){
            $sql1="INSERT INTO math (ques,optA,optB,optC,optD,ans)
             VALUES('".$_POST['question']."','".$_POST['opta']."','".$_POST['optb']."','".$_POST['optc']."','".$_POST['optd']."','".$_POST['ans']."')";
             if($conn->query($sql1)){
                $message="<div style='color:green'>Question Is added</div>";
             }
        }
        else{
            $message="<div style='color:red'>Question already exist</div>";
        }
    }
    else{
        $message="<div style='color:red'>Fill the complete form</div>";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
    <title>Add Question</title>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
    <h1>ONLINE:Quiz</h1>
        <hr>
        <?php
            echo $message;
        ?>
        <div class="new_account">
            <a href="login.php"><button>Log In</button></a>
        </div>
        <form  method="POST" class="form">
            <h2>Add Question</h2>
            <table class="for">
            <tr>
            <td>Question</td>
            <td><input type="text" name="question" placeholder="Question"></td>
            </tr>
            <tr>
            <td>Option A</td>
            <td><input type="text" name="opta" placeholder="Option A"></td>
            </tr>
            <tr>
            <td>Option B</td>
            <td><input type="text" name="optb" placeholder="Option B"></td>
            </tr>
            <tr>
            <td>Option C</td>
            <td><input type="text" name="optc" placeholder="Option C"></td>
            </tr>
            <tr>
            <td>Option D</td>
            <td><input type="text" name="optd" placeholder="Option D"></td>
            </tr>
            <tr>
            <td>Answer</td>
            <td><input type="text" name="ans" placeholder="Answer"></td>
            </tr>
            </table>
            <input type="submit" value="Add question" name="add">
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
