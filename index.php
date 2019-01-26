<?php

session_start();
/*

if(!isset($_SESSION['$storeid']))
{
    // not logged in
    header('Location: login.php');
    exit();
}
else{echo "Storeid = ",$_SESSION['$storeid'];}
*/
/*

if (isset($_SESSION['storeid']))
{
     header('Location: index.php');
}
else
{
     echo 'Sorry please login first before visiting this page!'; //also a redirect can be made here instead.
}
*/

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="index1.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>

<body>
<div class="navbar">
        <a class = "active" href="index.php">Home</a>
        <a href="addmore.php">Buy</a>
        <div class="dropdown">
          <button class="dropbtn">Add 
            <i class="fa fa-caret-down"></i>
          </button>
          <div class="dropdown-content">
            <a href="product.php">Add Product</a>
            <a href="category.php">Add Category</a>
            <a href="supplier.php">Add Supplier</a>
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
              </div> 
              <a href="restorep.php">Restore Product</a>
      </div>
      <!--<img class = image src="pic6.png">-->
          <div class = "heading">
              Retail Store Management System
          </div>
      </body>
      </html>