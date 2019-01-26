<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <style>
    
     #main{
               
               background-color: white; 
               margin-left: 400px;
               margin-right: 400px;
               margin-top: 50px;
               padding-top: 30px;
                 padding-left: 50px;
         padding-bottom: 50px;
               opacity: 0.9;
         font-weight: bold;
           } 
        #main1{
             background-color:white;
            margin-left: 400px;
               margin-right: 400px;
            margin-top: -10px;
            opacity: 0.9;
            padding-left: 50px;
        }
        
        #main2{
            padding:30px;
            background-color:white;
            margin-left: 400px;
               margin-right: 400px;
            margin-top: -20px;
               opacity: 0.9; 
            padding-left: 50px;
            padding-right: 250px;
            font-size: 20px;

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
                  <a href="viewc.php">View List</a>
                  
                </div>
              </div> 
              <a class = "active" href="restorep.php">Restore Product</a>
      </div>
 <div id="main">
        <h1>Restore Deleted Product</h1>
        <br>
        
       
        

        
        <br><br>
        <form method="post">
            Enter Product Name to Restore :
           
            
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

$query = "SELECT pname FROM restoreproduct";
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
   // restorep();
     
function restorep(){
     global $conn;
     $resultSet = "SELECT pname,pbrand,pprice FROM restoreproduct";
     /*if(mysqli_query($conn,$resultSet)){
    echo "<h2>Executed</h2>";
    }
    else{ echo "<h2>Not Executed</h2>"; }
*/
     
     $dispquery = mysqli_query($conn,$resultSet);
    if(mysqli_num_rows($dispquery) !=0)
    {
        echo "<div id='main2'> ";
        echo "<table>";
        echo "<tr><th>Product Name  </th><th>Brand</th><th>Price</th></tr>";
    
        while($rows = mysqli_fetch_assoc($dispquery))
        {
            echo "<tr><td>";
            echo $rows['pname'] ;
            echo "</td><td>";
            echo $rows['pbrand'];
            echo "</td><td>";
            echo $rows['pprice'];
            echo "</td></tr>";
            
    }
        echo "</table>";
    echo "</div> ";
}
else{
    echo "no result";
}
     
     
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
     
     addp();
 } 

function addp(){

    global $conn;

    $pname = $_POST["pname"];
   // echo "pname = ",$pname;

    $pdetail = "SELECT pcid,pname,pprice,pbrand,pwt,pmanu,pexpiry,pbb,pdesc FROM restoreproduct WHERE pname = '$pname'";
    $detquery = mysqli_query($conn,$pdetail);
    $detfetch = mysqli_fetch_assoc($detquery);
    
    $pcid = $detfetch['pcid'];
    $pname = $detfetch['pname'];
    $pprice = $detfetch['pprice'];
    $pbrand = $detfetch['pbrand'];
    $pwt = $detfetch['pwt'];
    $pmanu = $detfetch['pmanu'];
    $pexpiry = $detfetch['pexpiry'];
    $pbb = $detfetch['pbb'];
    $pdesc = $detfetch['pdesc'];
    
   /* echo "pcid = ",$pcid; echo "<br>";
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
        echo $pname," Restored";
        //echo "<script type='text/javascript'>alert('Product .$pname. Restored');</script>";
    }
    else{
        echo $pname," Not Restored";
    }
    
    $deletep = "DELETE FROM restoreproduct WHERE pname = '$pname'";
    mysqli_query($conn,$deletep);
    /*if(mysqli_query($conn,$deletep)){
         echo $pname," Deleted";
     }
    else{ echo $pname," Not Deleted"; }
    */


}
   echo "<h2 id = 'main1'>Deleted Products List :</h2>";  
  restorep();  

mysqli_close($conn);
?>   
    