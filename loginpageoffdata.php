<?php
$username = $_POST["username"];
$password = $_POST["Password"];

echo $username;

if(empty($username) || empty($password)){
    echo "required field is empty";
}else{
    $connection = mysqli_connect("localhost","root","","login_data");
if($connection){
    echo "connected";
}else{
    echo "Error While Connecting";
}
}

?>