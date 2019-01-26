<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Category</title>
    <link rel="stylesheet" href="index.css">
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
            <a class = "active" href="category.php">Add Category</a>
            <a href="supplier.php">Add Supplier</a>
            
          </div>
        </div> 
        <div class="dropdown">
                <button class="dropbtn">Delete 
                  <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                  <a href="pdelete.php">Delete Product</a>
                  <a href="cdelete.php">Delete Category</a>
                  <a href="#">Delete Supplier</a>
                </div>
              </div>  
        <div class="dropdown">
                <button class="dropbtn">View 
                  <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                  <a href="viewp.php">View Product</a>
                  <a href="viewc.php">View Category</a>
                  <a href="#">Daily Sales</a>
                </div>
              </div> 
      </div>
       <div style="margin: 30px;">
        <h2>Daily Sales</h2>
        <br>
    </div>
</body>
</html>






<?php

$conn = mysqli_connect('localhost','root','','retail');
/*if(!$conn){
    die("Connection Failed".mysqli_connect_error);
}
else{
    echo "Connected";
}*/

dsales = "SELECT "

?>