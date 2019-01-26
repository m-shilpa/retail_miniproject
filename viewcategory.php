

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
                  <a class = "active" href="viewc.php">View Category</a>
                  
                </div>
              </div> <a href="restorep.php">Restore Product</a>
      </div>
       <div id="main">
        <h2>View Category-Products</h2>
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
echo "<select value= 'Select Category' name='categoryname'><option selected disabled hidden>Choose here</option>";
while($row = mysqli_fetch_array($statement)){
   echo "<option value='".$row['categoryname']."'>".$row['categoryname']."</option>";
    
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
     
     clist();
 }   

function clist(){
    
    global $conn;
    
    $cname = $_POST['categoryname'];
    
    $categoryid = "SELECT categoryid FROM category WHERE categoryname = '$cname'";
    $cidquery = mysqli_query($conn,$categoryid);
    $cidfetch = mysqli_fetch_assoc($cidquery);
    $cid = $cidfetch['categoryid'];
    //echo $cid;
    
    echo "<p id = 'main1'>",$cname," Products : </p>";
    echo "<br>";
    echo "<br>";
    
    $plist = "SELECT pname,pbrand,pprice FROM product WHERE pcid='$cid'";
    
    $listquery = mysqli_query($conn,$plist);
    if(mysqli_num_rows($listquery) !=0)
    {
        echo "<div id='main2'> ";
        echo "<table>";
        echo "<tr><th>Product_Name</th><th>Brand</th><th>Price</th></tr>";
    
        while($rows = mysqli_fetch_assoc($listquery))
        {
            echo "<tr><td>";
            echo $rows['pname'] ;
            echo "</td><td>";
            echo $rows['pbrand'];
            echo "</td><td>";
            echo $rows['pprice'];
            echo "</td><td>";
            
    }
        echo "</table>";
    echo "</div>";
}
else{
    echo "no result";
}
     
    
    
    
}

?>