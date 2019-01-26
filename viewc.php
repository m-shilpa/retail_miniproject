

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
         padding-bottom: 50px;
               opacity: 0.9;
         font-weight: bold;
           }  
         #main1{
               
               background-color: white; 
               margin-left: 400px;
               margin-right: 400px;
              margin-top: -10px;
               
                 padding-left: 50px;
         padding-bottom: 10px;
               opacity: 0.9;
         font-weight: bold;
           }   
         #main2{
               
               background-color: white; 
               margin-left: 400px;
               margin-right: 400px;
               margin-top: -55px;
               padding-right: 330px;
                 padding-left: 50px;
         padding-bottom: 50px;
               opacity: 0.9;
         font-weight: bold;
             word-spacing: 10px;
           }   
           
    table,th,td {
    border: 1px solid black;
         border-collapse: collapse;
        padding: 5px;
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
                  <a href="viewp.php">View Product</a>
                  <a class = "active" href="viewc.php">View List</a>
                  
                </div>
              </div> <a href="restorep.php">Restore Product</a>
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

$plist = "SELECT p.pname as pname,p.pprice as price,c.categoryname as cname,s.pquantity as quantity from product p,category c,stock s WHERE p.pcid=c.categoryid AND p.productid=s.productid";

$query = mysqli_query($conn,$plist);
if(mysqli_num_rows($query)!=0){
    echo "<div id='main'>";
    echo "<div style ='font-size:40px; text-decoration:underline;'>Products in Store</div>";
    echo "<br>";
    echo "<table>";
        echo "<tr><th>Product Name  </th><th>Price</th><th>Category</th><th>Stock</th></tr>";
    
    while($rows = mysqli_fetch_assoc($query)){
        
         echo "<tr>";
         echo "<td>";
         echo $rows['pname'] ;
         echo "</td>";
        echo "<td>";
         echo $rows['price'] ;
         echo "</td>";
        echo "<td>";
         echo $rows['cname'] ;
          echo "</td>";
        echo "<td>";
         echo $rows['quantity'] ;
        echo "</td></tr>";

    }
    echo "</table>";
    echo "</div>";
}

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
?>