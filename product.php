<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Product</title>
    <link rel="stylesheet" href="index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <style>
    
     #main{
               
               background-color: white; 
               margin-left: 500px;
               margin-right: 300px;
               margin-top: 70px;
               padding-top: 30px;
                 padding-left: 50px;
         padding-bottom: 20px;
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
            <a class = "active" href="product.php">Add Product</a>
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
              </div> <a href="restorep.php">Restore Product</a>
      </div>
      <div id = "main">
    <h1 class = "headline">
        Add a new Product
    </h1>

    <form method="post">
        Enter the name of the Product:
        <input type="text" name="pname">
        <br><br>
        Enter the price of each product:
        <input type="text" name="pprice">
        <br><br>
        Enter the quantity:
        <input type="text" name="pquantity">
        <br><br>
        Enter the category name:
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
echo "<select value= 'Select Category' name='pcname'><option selected disabled hidden>Choose here</option>";
while($row = mysqli_fetch_array($statement)){
   echo "<option value='".$row['categoryname']."'>".$row['categoryname']."</option>";
    
}
echo "</select>";

?>

        <br><br>
        Enter the brand:
        <input type="text" name="pbrand">
        <br><br>
        Enter the weight:
        <input type="text" name="pwt">
        <br><br>
        Enter the manufacturing date:
        <input type="text" name="pmanu">
        <br><br>
        Enter the expiry date:
        <input type="text" name="pexpiry">
        <br><br>
        Enter the best before:
        <input type="text" name="pbb">
        <br><br>
        Enter the product description:
        <textarea name="pdesc"></textarea>
        <br><br>
        <input type="submit" name="psubmit">
        
    </form>
    </div>
</body>
</html>



<?php

$servername ="localhost";
$username ="root";
$password = "";
$dbname = "retail";

$conn = mysqli_connect($servername,$username,$password,$dbname);
/*if(!$conn){
    die("Connection failed". mysqli_connect_error());
}
else{ echo "Connected to Database"; }*/
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['psubmit'])) {
     
     addp();
 } 

function addp(){

global $conn;

$pname = $_POST["pname"];
$pprice = $_POST["pprice"];
$pquantity = $_POST["pquantity"];
$pcname = $_POST["pcname"];
$pmanu = $_POST["pmanu"];
$pexpiry = $_POST["pexpiry"];
$pbb = $_POST["pbb"];
$pwt = $_POST["pwt"];
$pbrand = $_POST["pbrand"];
$pdesc = $_POST["pdesc"];
//echo $pcname;
    
$productcheck = "SELECT count(*) AS count FROM product WHERE pname = '$pname'";
$pcquery = mysqli_query($conn,$productcheck);
$pcfetch = mysqli_fetch_assoc($pcquery);
$pc = $pcfetch['count'];
    //echo "pc= ",$pc;
    
if($pc >0){
    echo "<script type='text/javascript'>alert('Product .$pname. Already exists');</script>";
}
else{  
$pcategoryid = "SELECT categoryid FROM category WHERE categoryname = '$pcname'";

$pcidquery = mysqli_query($conn,$pcategoryid);
$pcidresult = mysqli_fetch_assoc($pcidquery);
$pcid = $pcidresult['categoryid'];
/*
echo "pcid = ",$pcid; echo "<br>";
echo "pname= ",$pname;echo "<br>";
echo "pprice= ",$pprice;echo "<br>";
echo "pbrand= ",$pbrand;echo "<br>";
echo "pwt= ",$pwt;echo "<br>";
echo "pmanu= ",$pmanu;echo "<br>";
    echo "pexpiry= ",$pexpiry;echo "<br>";
echo "pbb = ",$pbb;echo "<br>";
    echo "pdesc= ",$pdesc;echo "<br>";
*/

$productsql = "INSERT INTO product (pcid,pname,pprice,pbrand,pwt,pmanu,pexpiry,pbb,pdesc) VALUES ('$pcid','$pname','$pprice','$pbrand','$pwt','$pmanu','$pexpiry','$pbb','$pdesc')";
if(mysqli_query($conn,$productsql)){
    echo "<b>New product </b>",$pname,"<b> created</b>";
}
else{
    echo "Error in product creation";
}

$productidsql = "SELECT productid FROM product WHERE pname = '$pname'";
//if(mysqli_query($conn,$productidsql)){
//    echo "Got productid";
//}
//else{
//    echo "didn't get productid";
//    echo "<br>";
//}

$query = mysqli_query($conn,$productidsql);
    $result = mysqli_fetch_assoc($query);
    $resultstring = $result['productid'];

    //echo "productid = ",$resultstring;


$stocksql = "INSERT INTO stock (categoryid,productid,pquantity) VALUES ('$pcid','$resultstring','$pquantity')";


if(mysqli_query($conn,$stocksql)){
    echo "<h2>New stock created</h2>";
}
else{
    echo "Error in stock";
}
}
}
mysqli_close($conn);
?>