<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $loginexists = null;
    $username = $username = strtolower(trim($_POST["email"]));

    $_SESSION["user_email"] = $username;
    $connection = mysqli_connect("localhost", "root", "", "login_data");
    if ($connection) {
        $stmt = $connection->prepare("SELECT * FROM `login_details` WHERE email = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $loginexists = true;
            echo "true";
        } else {
            $loginexists = false;
            echo "false";
        }
    } else {
        echo "not connected";
    }
    $stmt->close();
    $connection->close();
}
?>


<!DOCTYPE html>
<html>
<title>FORGET_PASSWORD</title>

<head>
    <link rel="stylesheet" type="text/css" href="forgetpassword_cs.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer">

</head>
<script type="text/javascript" src="forget_password.js"></script>

<body>
    <section class="popup">

    </section>
    <section class="box">
        <div class="container">

            <div class="header">
                <h3 style="font-weight: lighter;">Recover Password</h3>
            </div>


            <div class="formcontainer">
                <form method="POST">
                    <div class="ifield">

                        <div class="emailcontainer">
                            <label>Enter Email</label><br>
                            <input type="email" name="email" id="userv">
                            <div class="usericon">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            <p class="emsg">hh</p>

                        </div>


                    </div>

                    <div class="btnp">
                        <button class="btn" type="submit" value="submit" id="sbtn">Continue</button>
                    </div>
                </form>
            </div>


            <div class="backlogin">
                <p>Back To <a href="http://localhost/php_files/loginpagesite.php">Login</a></p>
            </div>

            <div class="icons">
                <i class="fa-brands fa-google"></i>
                <i class="fa-brands fa-square-facebook"></i>
                <i class="fa-brands fa-square-twitter"></i>
                <i class="fa-brands fa-instagram"></i>
            </div>

        </div>
    </section>

    <script>
        document.getElementById("sbtn").addEventListener("click", function(e) {
            const user_val = document.getElementById("userv").value.trim();
            const lfound = <?= json_encode($loginexists) ?>;
            const err_ = document.querySelector(".emsg");
            if (user_val === "") {
                err_.textContent = "*Email Cannot be Empty";
                err_.style.display = "block";
                e.preventDefault();
            } else if (lfound === false) {
                err_.textContent = "*No Email Found";
                err_.style.display = "block";
                e.preventDefault();
            } else if (lfound === true) {
                window.open("http://localhost/php_files/forgetpasswordenter.php");
            }
        })
    </script>
</body>

</html>