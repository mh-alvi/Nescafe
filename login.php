<?php include('./config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log-In</title>
    <!-- MATERIAL CDN -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e0836293cf.js" crossorigin="anonymous"></script>
    <!-- STYLESHEET -->
    <link rel="stylesheet" href="./login.css">
</head>

<body>
    <div class="container">






        <div class="wrapper">
            <div class="left">

                <img src="./images/Logo.png" alt="NesCafe">
            </div>
            <div class="right">
                <div class="tabs">
                    <ul>

                        <li class="login_li">NESCAFÉ</li>
                    </ul>
                </div>


                <form action="" method="post">

                    <div class="login">
                        <div class="input_field">
                            <input type="text" name="username" placeholder="Username" class="input">
                        </div>
                        <div class="input_field">
                            <input type="password" name="password" placeholder="Password" class="input" id="password">
                            <span class="material-icons-sharp" aria-hidden="true" id="eye" onclick="toggle()">
                                visibility
                            </span>
                        </div>
                        
                        <div class="btn-login">
                            <input type="submit" name="submit" value="Log-In">
                        </div>
                        <br>
                <?php
                    if(isset($_SESSION['login'])){
                        echo $_SESSION['login']; //display session message
                        unset($_SESSION['login']); //removing session message
                    }
                    if(isset($_SESSION['not-login-message'])){
                        echo $_SESSION['not-login-message']; //display session message
                        unset($_SESSION['not-login-message']); //removing session message
                    }
                ?>
                    </div>
                </form>

            </div>
        </div>

        <!---------------------------------- END OF Log-In ---------------------------------------->





    </div>
    <!-- ----------------------------------JAVASCRIPT FOR TOOGLE PASSW0RD ---------------------------->
    <script>
        var state = false;

        function toggle() {
            if (state) {
                document.getElementById("password").setAttribute("type", "password");
                document.getElementById("eye").style.color = '#dce1eb';
                state = false;

            } else {
                document.getElementById("password").setAttribute("type", "text");
                document.getElementById("eye").style.color = '#783D41';
                state = true;

            }
        }
    </script>

</body>

</html>

<?php
//Check whether the submit button is clicked or not

    if(isset($_POST['submit'])){
        //process for login
        //1. Get the data from form
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = $_POST['password'];

        //2. sql to check whether the user with username annd password exist or not
        $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";
        //3. Execute the query
        $res = mysqli_query($conn, $sql);
        //count rows to check the user exist or not
        $count = mysqli_num_rows($res);
        if($count==1){
            //user available and login success
            $_SESSION['login'] = "<div class='success'>Login Successfully!!</div>";
            //to check whether the user is login or not and logout will unset it
            $_SESSION['user'] = $username;
            //redirect to home page/dashboard
            header("location:" .SITEURL. 'index.php');
        }
        else{
            //user unavailable and login unsuccessful
            $_SESSION['login'] = "<div class='error'>Username or Password did not match</div>";
            header("location:" .SITEURL. 'login.php');
        }
    }

?>