<?php
    include_once('Connection.php');
?>

<?php
    $emailE=$passwordE="";
    $email=$password="";
    $mark=false;
 
    if(isset($_GET['submit'])){
        if (empty($_GET["email"])){        //email
            $emailE = "Enter Email";
            $mark=true;
        }
        else{
            $email = test_input($_GET["email"]);
            if (!preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/",$email)){
                $emailE = "Enter Correct Email Format";
                $mark=true;
            }
        }

        if (empty($_GET["password"])) {       //email
            $passwordE = "Enter Password";
            $mark=true;
        }
        else{
            $password = test_input($_GET["password"]);
            if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}+$/",$password)){
                $passwordE = "Enter Correct password Format()";
                $mark=true;
            }
        }

        if(!$mark){
            $query="select user_id,first_name from user where email='".$email."' and password='".$password."';";
            $result=mysqli_query($con,$query);

            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    session_destroy();
                    session_start();
                    $_SESSION['user']=$row['user_id'];
                    $_SESSION['name']=$row['first_name'];
                    
                    if(!empty($_GET['flightId'])){
                        header("Location:Booking.php?flightId=".$_GET['flightId']);
                    }
                    else{
                        header("Location:Home.php");
                    }
                }
            }
            else{
                $passwordE="Username or Password is incorrect";
            }
            
        }
    }
    


    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="Login.css" /> 
        <link rel="stylesheet" type="text/css" href="header.css" /> 
        <style>
             header{
                background-color:#02122c;
                /* box-shadow: 2px 2px #02122c; */
                top:0;
                left:0;
            }
        </style>
    </head>
    <body>
            <?php require('Header.php'); ?>
            <div class="container">
                <h1>Login Page</h1>
                <p class="errorN"> * Required Fields </p><br>
                <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']."?flightId=".$_GET['flightId']) ?>" method="GET">
                    <div>
                        <label>Email:</label><br>
                        <input type="text" name="email" value="<?php echo $email; ?>">
                        <br><span class="error">* <?php echo $emailE;?> </span><br><br>
                    </div>

                    <div class="inp">
                        <label>Password:</label><br>
                        <input type="text" name="password" value="<?php echo $password;?>">
                        <br><span class="error">* <?php echo $passwordE;?> </span><br><br>
                    </div>
                    <button type="submit" class="submit" name="submit">Submit</button>
                </form>
                Don't have account??<a href="Register.php" style="color:#200220">Register kari le!!</a>
            </div>

    </body>
</html>