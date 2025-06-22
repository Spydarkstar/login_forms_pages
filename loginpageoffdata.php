<?php
$username = $_POST["username"];
$password = $_POST["Password"];

$bool =false;
$user = false;
$pmatch = false;
$connectionerror = false;
$noresultfound = false;
if(empty($username) || empty($password)){
    $bool = false;
}else{
    $bool = true;
    $connection = mysqli_connect("localhost","root","","login_data");
if($connection){
    $sql = "SELECT * FROM `login_details` WHERE email = '$username'";
    $result = $connection->query($sql);
    if($result->num_rows > 0){
        $noresultfound=false;
        $search = $result->fetch_assoc();
        if($search['email']==$username){
            $user = true;
            if($search['password']==$password){
                $pmatch=true;
            }else{
                $pmatch=false;
            }
        }else{
            $user=false;
        }
    }else{
        $noresultfound = true;
    }
}else{
     $connectionerror = true;
    echo "connection error<br>";
}
}

?>

<!DOCTYPE html>
<html>
<head>

</head>
<style>
body{
    background-image:url("https://i.pinimg.com/736x/a4/1a/39/a41a39c5137dbaa2ff4b85ced763e6cf.jpg");
    background-size: cover;
    background-attachment: fixed;
    background-repeat: no-repeat;
}
.header{
    color:white;
    display: none;
}
.container{
     display: flex;
    justify-content: center;
    align-items: center;
    font-family:Arial, Helvetica, sans-serif;
    font-size: large;
    color:white;
    color:white;
}



</style>

<body>
<div class="container" id="display">
</div>

<script>

const boolss = <?=json_encode($bool) ?>;
const nres = <?=json_encode($noresultfound) ?>;
const users = <?=json_encode($user) ?>;
const password = <?=json_encode($pmatch) ?>;


const list = document.getElementById("display");

if(boolss == true){
    if(nres==false){
        if(users==true && password==true){
            const content = document.createElement("h1");
            content.textContent = "LOGIN SUCCESSFULL";
            list.appendChild(content);
        }else if(users == true && password==false){
            const content = document.createElement("h1");
            content.textContent = "PASSWORD INCORRECT";
            list.appendChild(content);
        }

    }else{ 
    const content = document.createElement("h1");
    content.textContent = "USER NOT FOUND";
    list.appendChild(content);
    }
}else{
    const content = document.createElement("h1");
    content.textContent = "REQUIRED FIELD IS EMPTY";
    list.appendChild(content);
}

</script>
</body>
</html>