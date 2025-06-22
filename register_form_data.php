<?php

$email = $_POST['email'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];

$bool;

$connect = mysqli_connect("localhost", "root", "", "login_data");

/*if($connect){
    echo "Connected To Database<br>";
}else{
    echo "Issue While Connecting to Database<br>";
}*/


if ($password != $cpassword) {
    echo "Password Doesnt Match Check Password<br>";
} else {
    if (empty($email) || empty($password) || empty($cpassword)) {
        echo "Somedetails are not entered";
        echo " Details not stored";
    } else {
        $stmt = $connect->prepare("INSERT INTO login_data.login_details(email,password) VALUES(?,?)");
        $stmt->bind_param("ss", $email, $password);
        if ($stmt->execute()) {
            $bool = true;
        } else {
            $bool = false;
        }
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="registersubmitcs.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <section class="container">
        <div class="content">
            <h1>Registration Succesfull <i class="fa-solid fa-check" style="color:green"></i></h1>
            <div>
                <a href="http://localhost/php_files/loginpagesite.php">Go To Login</a>
            </div>
        </div>
    </section>

    <script>
        const variable = <?= json_encode($bool) ?>;
    </script>
</body>

</html>