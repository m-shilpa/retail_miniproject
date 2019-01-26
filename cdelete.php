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
                  <a href="cdelete.php">Delete Product</a>
                  <a class = "active" href="cdelete.php">Delete Category</a>
                  
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
        <h2>Delete Category</h2>
        <br>
        <form method="post">
            Enter Category Name:
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

$query = "SELECT categoryname FROM category";
$statement = mysqli_query($conn,$query);
echo "<select value= 'Select Category' name='cname'><option selected disabled hidden>Choose here</option>";
while($row = mysqli_fetch_array($statement)){
   echo "<option value='".$row['categoryname']."'>".$row['categoryname']."</option>";
    
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
     
     cdelete();
 }   
 
function cdelete(){
    global $conn;
    $cname =$_POST["cname"];
    //echo $cname;
    $cid = "SELECT categoryid FROM category WHERE categoryname='$cname'";
    
    $cidquery = mysqli_query($conn,$cid);
    $fetchcid = mysqli_fetch_assoc($cidquery);
    $cid =$fetchcid['categoryid'];
    
    //echo "cid= ", $cid;
    
    $deletecategory = "DELETE FROM category WHERE categoryid='$cid'";
     if(mysqli_query($conn,$deletecategory)){
         echo "<script type='text/javascript'>alert('Category .$cname. Deleted');</script>";
     }
    else{ echo "<script type='text/javascript'>alert('Category .$cname. Not Deleted');</script>"; }
    
    
    header("Refresh:0");

} 
mysqli_close($conn);
    
?>  
    
</body>
</html>