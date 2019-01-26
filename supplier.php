<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Supplier</title>
    <link rel="stylesheet" href="index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <style>
    
     #main{
               
               background-color: white; 
               margin-left: 400px;
               margin-right: 400px;
               margin-top: 70px;
               padding-top: 30px;
                 padding-left: 50px;
         padding-bottom: 50px;
               opacity: 0.9;
         font-weight: bold;
           }   
           
    </style>
    
</head>

<body>
<div class="navbar">
        <a href="index.php">Home</a>
        <a href="addmore.php">Buy</a>
        <div class="dropdown">
          <button class="dropbtn">Add 
            <i class="fa fa-caret-down"></i>
          </button>
          <div class="dropdown-content">
            <a href="product.php">Add Product</a>
            <a href="category.php">Add Category</a>
            <a class = "active" href="supplier.php">Add Supplier</a>
             <a href="stock.php">Add Stock</a>
          </div>
        </div>
        <div class="dropdown">
                <button class="dropbtn">Delete 
                  <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                  <a href="pdelete.php">Delete Product</a>
                  <a href="cdelete.php">Delete Category</a>
                  
                </div>
              </div>  
        <div class="dropdown">
                <button class="dropbtn">View 
                  <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                  <a href="viewp.php">View Product</a>
                  <a href="viewc.php">View List</a>
                  
                </div>
              </div> <a href="restorep.php">Restore Product</a>
      </div>
<div id="main">
        <h2>Add Supplier</h2>
        <br>
        <form action ="supplier.php" method="post">
            Enter Supplier Name:
            <input type = "text" name = "suppliername">
            <br><br>
            Enter Supplier Address:
            <input type = "text" name = "supplieraddr">
            <br><br>
            Enter Supplier Phone:
            <input type = "text" name = "supplierph">
            <br><br>
            
            <input type="submit" name = "submit">
        </form>
    </div>
      </body>
      </html>
      
     
<?php
//error_reporting(E_ALL ^ E_NOTICE);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "retail";

$conn = mysqli_connect($servername,$username,$password,$dbname);
/*if(!$conn){
    die("Connection Failed". mysqli_connect_error());
}
else{ echo "Connected to Database"; }*/

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
     
     addcat();
 }   

function addcat(){
    global $conn;
    $suppliername = $_POST["suppliername"];
    $supplieraddr = $_POST["supplieraddr"];
    $supplierph = $_POST["supplierph"];
    $suppliersql = "INSERT INTO supplier (supname,supaddr,supph) VALUES ('$suppliername','$supplieraddr','$supplierph')";

    if(mysqli_query($conn,$suppliersql)){
    echo "<h2>New supplier Created</h2>";
    }
    else{ echo "<h2>supplier not created</h2>"; }

}
mysqli_close($conn);
?>