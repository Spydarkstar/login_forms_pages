<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["Password"];

    $bool = false;
    $userval = false;
    $passval = false;
    $user = false;
    $pmatch = false;
    $connectionerror = false;
    $noresultfound = false;
    $both = false;

    if (empty($username) && empty($password)) {
        $both = true;
    } else if (empty($username)) {
        $userval = true;
    } else if (empty($password)) {
        $passval = true;
    } else {
        $bool = true;
        $connection = mysqli_connect("localhost", "root", "", "login_data");
        if ($connection) {
            $sql = "SELECT * FROM `login_details` WHERE email = '$username'";
            $result = $connection->query($sql);
            if ($result->num_rows > 0) {
                $noresultfound = false;
                $search = $result->fetch_assoc();
                if ($search['email'] == $username) {
                    $user = true;
                    if ($search['password'] == $password) {
                        $pmatch = true;
                    } else {
                        $pmatch = false;
                    }
                } else {
                    $user = false;
                }
            } else {
                $noresultfound = true;
            }
        } else {
            $connectionerror = true;
        }
    }
}


?>


<!DOCTYPE html>
<html>

<body>
    <title>LOGIN PAGE</title>

    <head>
        <link rel="stylesheet" type="text/css" href="loginpage.css">
        <link rel="stylesheet" href="styles.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer">
        <link rel="stylesheet" href="styles.css">
    </head>
    <script type="text/javascript" src="loginpage.js"></script>



    <section class="container">

        <div class="form_container">
            <div class="heading">SIGNUP</div>

            <div>
                <form method="POST" class="arrange">
                    <div>
                        <label>Email</label><br>
                        <input name="username" type="email" id="username">
                        <p id="user" class="emsg">Username Cannot be Empty*</p>
                        <i class="fa-regular fa-user"></i>
                    </div>

                    <div>
                        <label>Password</label><br>
                        <input name="Password" type="password" id="Password">
                        <p id="pass" class="emsg">Password cannot be Empty*</p>
                        <i class="fa-solid fa-lock"></i>

                        <a href="http://localhost/php_files/forgetpassword.php" style="color:white;text-decoration: none;font-size: smaller;
                        font-family: Arial, Helvetica, sans-serif;
                        position:relative; margin-left:160px;transform: translateX(128px) translateY(30px);">Forget Password?</a>


                    </div>

                    <div class="btnholder">
                        <button type="submit" value="submit" class="btn" id="subbtn">Login</button>
                    </div>

                </form>
            </div>

            <div class="registerpageholder" style="transform:translateY(-25px);">
                <p>Don't have an Account<a href="http://localhost/php_files/registerpage_.html"> Register</a></p>
            </div>

            <div class="icons" style="transform:translateY(-15px);">
                <i class=" fa-brands fa-google"></i>
                <i class="fa-brands fa-square-facebook"></i>
                <i class="fa-brands fa-square-twitter"></i>
                <i class="fa-brands fa-instagram"></i>
            </div>
        </div>
    </section>

    <script>
        const dispbar = document.querySelector(".msgbar");
        const usermsg = document.getElementById("user");
        const forms = document.querySelector(".arrange");
        usermsg.style.display = "none";
        const passmsg = document.getElementById("pass");
        passmsg.style.display = "none";
        const uservalue = <?= json_encode($userval) ?>;
        const passvalue = <?= json_encode($passval) ?>;
        const bothvalue = <?= json_encode($both) ?>;
        const allcorrect = <?= json_encode($pmatch) ?>;
        const submit = document.getElementById("subbtn");



        if (bothvalue == true) {
            usermsg.style.display = "block";
            passmsg.style.display = "block";
            e.preventDefault();
        } else if (uservalue == true) {
            usermsg.style.display = "block";
            e.preventDefault();
        } else if (passvalue == true) {
            passmsg.style.display = "block";
            e.preventDefault();
        } else if (allcorrect == true) {
            window.open("http://localhost/php_files/loginsucess.html");
        }
    </script>
</body>

</html>