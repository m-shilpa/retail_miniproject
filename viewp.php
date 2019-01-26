<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Category</title>
    <link rel="stylesheet" href="index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <style>
    
     #main{
               
               background-color: white; 
               margin-left: 400px;
               margin-right: 400px;
               margin-top: 150px;
               padding-top: 30px;
                 padding-left: 50px;
        padding-bottom: 5px;
               opacity: 0.9;
         font-weight: bold;
           } 
        
        #main1{
            padding:30px; 
            background-color:white;
            margin-left:400px;
            margin-right:400px;
            margin-top: -18px;
            opacity: 0.9;
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
                  <a class = "active" href="viewp.php">View Product</a>
                  <a href="viewc.php">View List</a>
                 
                </div>
              </div> <a href="restorep.php">Restore Product</a>
      </div>
       <div id="main">
        <h2>View Product Details</h2>
        <br>
        <form method="post">
            Enter Product Name:
            <?php
//index.php

$servername="localhost";
    $username = "root";
    $password="";
    $dbname="retail";
    
    $conn = mysqli_connect($servername,$username,$password,$dbname);
    /*if(!$conn){
        die("Not Connected".mysqli_connect_error());
    }
    else{echo "<h1>Connected to db<h1>";}
       */

$query = "SELECT pname FROM product";
$statement = mysqli_query($conn,$query);
echo "<select value= 'Select Product' name='pname'><option selected disabled hidden>Choose here</option>";
while($row = mysqli_fetch_array($statement)){
   echo "<option value='".$row['pname']."'>".$row['pname']."</option>";
    
}
echo "</select>";

?>

            <br><br>
            <input type="submit" name = "submit">
        </form>
    </div>
</body>
</html>




<?php

$servername="localhost";
    $username = "root";
    $password="";
    $dbname="retail";
    
    $conn = mysqli_connect($servername,$username,$password,$dbname);
    /*if(!$conn){
        die("Not Connected".mysqli_connect_error());
    }
    else{echo "<h1>Connected to db<h1>";}
       */
 if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
     
     pinfo();
 }   

function pinfo(){
    
    global $conn;
    $pname =$_POST["pname"];
    //echo $pname;
    $productid = "SELECT productid FROM product WHERE pname='$pname'";
    
    $pidquery = mysqli_query($conn,$productid);
    $fetchpid = mysqli_fetch_assoc($pidquery);
    $pid =$fetchpid['productid'];
    
    //echo "pid= ", $pid;
    
    $product = "SELECT * FROM product WHERE productid='$pid'";
    
    $pquery = mysqli_query($conn,$product);
    $fetchp = mysqli_fetch_assoc($pquery);
    $pcid =$fetchp['pcid'];
    $pids =$fetchp['productid'];
    $pname =$fetchp['pname'];
    $pprice =$fetchp['pprice'];
    $pbrand =$fetchp['pbrand'];
    $pwt =$fetchp['pwt'];
    $pmanu =$fetchp['pmanu'];
    $pexpiry =$fetchp['pexpiry'];
    $pbb =$fetchp['pbb'];
    $pdesc=$fetchp['pdesc'];
    
    $category = "SELECT categoryname FROM category WHERE categoryid='$pcid'";
    
    $cquery = mysqli_query($conn,$category);
    $cfetch = mysqli_fetch_assoc($cquery);
    $cname = $cfetch['categoryname'];
    
    echo "<br>";
    echo "<p id='main1'>Product Id = ",$pids;  echo "<br>";
    echo "Product Name = ",$pname;  echo "<br>";  
    echo "Category = ",$cname;  echo "<br>";
    echo "Price = ",$pprice;  echo "<br>";
    echo "Brand = ",$pbrand;  echo "<br>";
    echo "Weight = ",$pwt;  echo "<br>";
    echo "Manufacturing Date = ",$pmanu;  echo "<br>";
    echo "Expiry Date = ",$pexpiry;  echo "<br>";
    echo "Expiry Date = ",$pbb;  echo "<br>";
    echo "Description = ",$pdesc;  echo "<br>";
    
}
 mysqli_close($conn);
?>