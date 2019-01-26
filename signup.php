<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" a href="font-awesome-4.7.0/css/font-awesome.min.css">
    <style>
    body{
	margin: 0 auto;
/*	background-image: url("retail2.jpg");*/
	background-repeat: no-repeat;
	background-size: 100% 720px;
}

.container{
	width: 500px;
	height: 710px;
	text-align: center;
	margin: 0 auto;
	background-color: skyblue;
	margin-top: 20px;
    margin-bottom: 20px;
}
        
input[type="text"],input[type="password"]{
	margin-top: 30px;
	height: 45px;
	width: 300px;
	font-size: 18px;
	margin-bottom: 20px;
	background-color: #fff;
	padding-left: 40px;
    align-content: center;
}

.form-input::before{
	content: "\f007";
	font-family: "FontAwesome";
	padding-left: 07px;
	padding-top: 40px;
	position: absolute;
	font-size: 35px;
	color: #2980b9;
    
}

.form-input:nth-child(2)::before{
	content: "\f2b9";
}
.form-input:nth-child(3)::before{
	content: "\f041";
}
.form-input:nth-child(4)::before{
	content: "\f095";
}

.form-input:nth-child(5)::before{
	content: "\f023";
}




        
.btn-login{
    margin: 20px;
	padding: 15px 25px;
	border: none;
	background-color: #27ae60;
	color: #fff;
}
    
    
    
    </style>
</head>
<body>
    <div class="container">
    <br>
    <br>
    <h1>Store Registration</h1>
    
    <form method="post">
			<div class="form-input" >
        <input type='text' name='sname' placeholder="Store Name">
        </div>
        <div class="form-input">
            <input type='text' name='saddr' placeholder="    Address" ></div>
        <div class="form-input">
            <input type="text" name = 'spincode' placeholder="Pincode"></div>
        <div class="form-input">
            <input type='text' name = 'sphone' placeholder="Phone No."></div>
        <div class="form-input">
            <input type="password" name='spassword' placeholder="Password"></div>
        
            <input type = 'submit' name = 'submit' class="btn-login">
        
    </form>    
    </div>
</body>
</html>


<?php

$conn = mysqli_connect('localhost','root','','retail');
/*if(!$conn){
    die("Connection Failed". mysqli_connect_error());
}
else{ echo "Connected to Database"; }*/
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        
$sname = $_POST["sname"];
$saddr = $_POST['saddr'];
$spin = $_POST['spincode'];
$sph = $_POST['sphone'];
$spass = $_POST['spassword'];


$sinsert = "INSERT INTO store (sname,saddr,spincode,sphone,spassword) VALUES('$sname','$saddr','$spin','$sph','$spass')";
$sinsertq = mysqli_query($conn,$sinsert);
/*if($sinsertq){
    echo "Success";
}
else { echo "Failure";}*/

$storeid = "SELECT storeid FROM store WHERE sname='$sname'";
$sidquery = mysqli_query($conn,$storeid);
$sidfetch = mysqli_fetch_assoc($sidquery);
$sid = $sidfetch['storeid'];
echo "<script type='text/javascript'>alert('Your storeid is .$sid. And Password is .$spass.');</script>";
   echo'<br>';
    echo'<br>';
    echo( "<button onclick= \"location.href='login.php'\">Login</button>");

}


?>