<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Product</title>
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
            <a href="supplier.php">Add Supplier</a>
             <a href="stock.php">Add Stock</a>
          </div>
        </div> 
        <div class="dropdown">
                <button class="dropbtn">Delete 
                  <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                  <a class = "active" href="pdelete.php">Delete Product</a>
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
        <h2>Delete Product</h2>
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
echo "<select value= 'Select Product' name='productname'><option selected disabled hidden>Choose here</option>";
while($row = mysqli_fetch_array($statement)){
   echo "<option value='".$row['pname']."'>".$row['pname']."</option>";
    
}
echo "</select>";

?>
            <br><br>
            <input type="submit" name = "submit">
        </form>
    </div>
    
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
     
     pdelete();
     //; 
 }   
 
function pdelete(){
    global $conn;
    $pname =$_POST["productname"];
    //echo $pname;
    $productid = "SELECT productid FROM product WHERE pname='$pname'";
    
    $pidquery = mysqli_query($conn,$productid);
    $fetchpid = mysqli_fetch_assoc($pidquery);
    $pid =$fetchpid['productid'];
    
    //echo "pid= ", $pid;
    
    $deleteproduct = "DELETE FROM product WHERE productid='$pid'";
     if(mysqli_query($conn,$deleteproduct)){
         echo "<script type='text/javascript'>alert('Product .$pname. Deleted');</script>";
     }
    else{ echo $pname," Not Deleted"; }
    
    header("Refresh:0");
  

} 
    // header("Refresh:0"); 
mysqli_close($conn);
    
?>  
    
</body>
</html>