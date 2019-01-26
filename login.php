<!DOCTYPE html>
<html>
<head>
	<title> Login</title>
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
	height: 450px;
	text-align: center;
	margin: 0 auto;
	background-color: rgba(44, 62, 80,0.7);
	margin-top: 160px;
}

.container img{
	width: 150px;
	height: 150px;
	margin-top: -60px;
}

input[type="text"],input[type="password"]{
	margin-top: 30px;
	height: 45px;
	width: 300px;
	font-size: 18px;
	margin-bottom: 20px;
	background-color: #fff;
	padding-left: 40px;
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
	<img src="female.png"/>
		<form method="post">
			<div class="form-input">
				<input type="text" name="storeid" placeholder="Enter the Storeid"/>	
			</div>
			<div class="form-input">
				<input type="password" name="password" placeholder="password"/>
			</div>
			<br>
			
			<input type="submit" name="login" value="LOGIN" class="btn-login"/>
           <input type="button" class="btn-login" value="Sign Up" onclick="window.location.href='signup.php'" />
            
		</form>
	</div>
</body>
</html>


<?php 

$servername="localhost";
$username="root";
$password="";
$db="retail";

$conn = mysqli_connect($servername,$username,$password,$db);
session_id("session1");
session_start();
global $storeid,$sid;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    
    $storeid=$_POST['storeid'];
    $password=$_POST['password'];
    
    $sql="select storeid,spassword from store where storeid='$storeid' AND spassword='$password'";
    
    $result=mysqli_query($conn,$sql);
    
    if(mysqli_num_rows($result)!= 0){
        echo " You Have Successfully Logged in";
        header('Location: index.php');
    }
    else{
        echo " You Have Entered Incorrect Password";
        exit();
    }
        
}
$storeid = $sid;
$_SESSION['$storeid'] = $sid;

?>