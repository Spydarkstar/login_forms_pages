<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_SESSION["user_email"])) {
        $email = $_SESSION["user_email"];
    } else {
        echo "not setted";
    }
    $password = $_POST["Password"];
    $cpassword = $_POST["cPassword"];

    $hashed_password = password_hash($cpassword, PASSWORD_BCRYPT);
    $connection = mysqli_connect("localhost", "root", "", "login_data");
    if ($connection) {
        $stmt = $connection->prepare("UPDATE `login_details` SET password = ? Where email = ?");
        $stmt->bind_param("ss", $hashed_password, $email);
        if ($stmt->execute()) {
        } else {
            echo "password not changed";
        }
    } else {
        echo "not connected";
    }
    mysqli_close($connection);
}
?>

<!DOCTYPE html>
<html>
<title>FORGET_PASSWORD</title>

<head>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer">

</head>

<style>
    body {
        background-image: url("https://i.pinimg.com/736x/a4/1a/39/a41a39c5137dbaa2ff4b85ced763e6cf.jpg");
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
        margin: 0;
    }

    .box {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: transparent;
        position: fixed;
        height: 100%;
        width: 100%;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: transparent;
        color: white;
        flex-direction: column;
        font-family: Arial, Helvetica, sans-serif;
        box-shadow: rgba(0, 0, 0, 0.56) 0px 22px 70px 4px;
        backdrop-filter: blur(20px);
        border-radius: 19px;
        border: 2px solid white;
        width: 300px;
        height: 400px;
        overflow: hidden;

    }

    .header {
        text-align: center;
        color: white;
        font-family: Arial, Helvetica, sans-serif;
        background-color: transparent;
        position: absolute;
        top: 1px;
    }

    .formcontainer {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .ifield>input,
    label {
        left: 20px;
        position: relative;
        font-size: large;
    }

    .ifield>input {
        outline: none;
        border: none;
        border-bottom: 2px solid white;
        background-color: transparent;
        width: 80%;
        position: relative;

    }

    .ifield>div {
        margin: 5px;
    }

    .btnp {
        display: flex;
        justify-content: center;
        align-items: center;
        transform: translateY(30px);
        background-color: transparent;
        width: 100%;
        height: auto;
    }

    .btn {
        background-color: white;
        width: 200px;
        height: 25px;
        border-radius: 19px;
        font-family: Arial, Helvetica, sans-serif;
        font-size: large;
        color: black;
        border: none;
        box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px, rgba(0, 0, 0, 0.22) 0px 15px 12px;
        position: relative;


    }

    .backlogin {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: transparent;
        width: 100%;
        position: relative;
        top: 45px;
    }

    .backlogin,
    a {
        color: white;
        text-decoration: none;
    }

    .icons {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: transparent;
        width: 100%;
        bottom: 5px;
        position: absolute;
    }

    .icons>i {
        margin: 15px;

    }

    .usericon>i {
        position: absolute;
        transform: translateX(245px) translateY(-27px);
    }

    .errormsg {
        position: absolute;
        font-size: smaller;
        transform: translateX(16px) translateY(-18px);
        color: red;
        font-family: Arial, Helvetica, sans-serif;
        display: none;
    }
</style>

<body>
    <section class="box">
        <div class="container">

            <div class="header">
                <h1 style="font-weight: lighter; font-size:x-large">Reset Password</h1>
            </div>


            <div class="formcontainer">
                <form method="POST">
                    <div class="ifield">

                        <label>New Password</label><br>
                        <input type="password" name="Password" id="pass">
                        <div class="usericon">
                            <i class="fa-solid fa-lock"></i>
                        </div>

                        <br>


                        <label>Confirm Password</label>
                        <input type="password" name="cPassword" id="cpass">
                        <div class="usericon">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <div id="error">
                            <p class="errormsg"></p>
                        </div>



                    </div>

                    <div class="btnp">
                        <button class="btn" type="submit" value="submit" id="sbtn">Reset</button>
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
        const err = document.querySelector(".errormsg");
        err.style.display = "none";
        document.getElementById("sbtn").addEventListener("click", function(e) {
            const p = document.getElementById("pass").value.trim();
            const cp = document.getElementById("cpass").value.trim();
            if (p === "" && cp === "") {
                err.textContent = "*Passwords Must be Filled";
                err.style.display = "block";
                e.preventDefault();
            } else if (cp === "") {
                err.textContent = "*Confirm Password Required";
                err.style.display = "block";
                e.preventDefault();
            } else if (p === "") {
                err.textContent = "*Password Required";
                err.style.display = "block";
                e.preventDefault();
            } else if (p != cp) {
                err.textContent = "*Password doesnt match";
                err.style.display = "block";
                e.preventDefault();
            } else {
                alert("Successfully Changed Password");
            }
        });
    </script>


</body>

</html>