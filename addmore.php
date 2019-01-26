


<?php 
error_reporting(E_ALL ^ E_NOTICE);
$con = mysqli_connect('localhost','root','','retail');



    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit1'])) {

     
    add();
        //echo "SESSION[transid] =",$_SESSION['$transid'];
 }   
     function add(){
        global $con,$tid;
         
         
         
        session_id("session2");
       session_start();
         
        $tranidsql =   "SELECT MAX(tid) FROM transaction";
         mysqli_query($con,$tranidsql);
   /*     if(mysqli_query($con,$tranidsql)){
            echo "Executed ";
        }
           else{ echo "Not Executed"; }
*/
        $query = mysqli_query($con,$tranidsql);
            $result = mysqli_fetch_assoc($query);
            $lasttid = $result['MAX(tid)'];
        if($lasttid == NULL){
            $lasttid = 1;
        }    
        //echo "lasttid = ",$lasttid;

        $transid = $lasttid +1;
        $tid = $transid;
        //echo "tid = ",$tid;
$sid= $_SESSION['$storeid'];
         echo $sid;
        $inserttid = "INSERT INTO transaction (tid) VALUES ('$tid')";
         mysqli_query($con,$inserttid);
        /*if(mysqli_query($con,$inserttid)){
            echo "Executed transaction insertion ";
        }
           else{ echo "Not Executed"; }

*/
        $_SESSION['$transid'] = $tid;
        //echo "SESSION['transid'] =",$_SESSION['$transid'];
            
        //echo '<br><br><br>';

        
        
    } 

?>
    
    
<?php
  //error_reporting(E_ALL ^ E_NOTICE);   

//placeholder
$output = NULL;

if(isset($_POST['submit'])){
    //connect to db
    
   $con = mysqli_connect('localhost','root','','retail');
    
    
 session_start();
$tranid = $_SESSION['$transid'];
//echo "tid from buy= ",$tranid;
    
    
    
 
    $product = $_POST['product'];
    $quantity = $_POST['quantity'];
    
    foreach($product AS $key => $value){
        $productid = "SELECT productid FROM product WHERE pname = '$value'";
        
        $pidquery = mysqli_query($con,$productid);
        $pidresult = mysqli_fetch_assoc($pidquery);
        $pid = $pidresult['productid'];
        //echo "pid= ",$pid;
        
        $pamt = "SELECT pprice FROM product WHERE pname = '$value'";

        $pamtquery = mysqli_query($con,$pamt);
        $pamtresult = mysqli_fetch_assoc($pamtquery);
        $pamount = $pamtresult['pprice'];
        //echo "pprice = ",$pamount;

        $ptotamt = $quantity[$key] * $pamount;
       /* echo "ptotamt = ",$ptotamt;
        echo "t123= ",$tranid;
        echo "quantity",$quantity[$key];
        */
        
        $getstock = "SELECT pquantity FROM stock WHERE productid='$pid'";
        $squery = mysqli_query($con,$getstock);
        $sfetch = mysqli_fetch_assoc($squery);
        $pquantity = $sfetch['pquantity'];
        //echo $pquantity;
        $newquant = $pquantity - $quantity[$key];
        if($newquant <= 0){
            echo "<script type='text/javascript'>alert('$value. Not in Stock');</script>";
            
        }
        else{
        $newstock = "UPDATE stock SET pquantity = '$newquant' WHERE productid = '$pid'";
        mysqli_query($con,$newstock);
        /*if(mysqli_query($con,$newstock)){
            echo"<br>";
            echo "Executed newstock ";
            echo"<br>";
        }
           else{ echo "Not Executed newstock"; }
*/
        
        
        $insertsales = "INSERT INTO productsales (productid,tid,pnos,ptotamt) VALUES ('$pid','$tranid','$quantity[$key]','$ptotamt')";
        mysqli_query($con,$insertsales);
       /* if(mysqli_query($con,$insertsales)){
            echo"<br>";
            echo "Executed insertsales ";
            echo"<br>";
        }
           else{ echo "Not Executed sales"; }

        */
        
        
        }
        

    }
    
    //$mysqli->close();
}


 
?>




<html>
    <head>
       <meta charset="UTF-8">
       <title>Add Category</title>
       <link rel="stylesheet" href="index.css">
       <link rel="stylesheet" a href="font-awesome-4.7.0/css/font-awesome.min.css">
       <style>
           
        #add::before{
	content: "\f0fe";
	font-family: "FontAwesome";
	padding-left: 07px;
	padding-top: -10px;
	position: absolute;
	font-size: 25px;
	color: #444422; 
}

/*#add:nth-child(2)::before{
	content: "\f0fe";
}
  */      
        
        #remove::before{
	content: "\f146";
	font-family: "FontAwesome";
	padding-left: 07px;
	padding-top: -10px;
	position: absolute;
	font-size: 25px;
	color:#595959; 
}

/*#remove:nth-child(2)::before{
	content: "\f146";
}
  */  
           
.btn{
    margin: 20px;
	padding: 15px 25px;
	border: none;
	background-color: #47476b;
	color: white;
}

           #container{
               
               font-size: 20px;
               color: black;
               padding: 20px;
               word-spacing: 30px;
               background-color: white;
                padding-left: 100px;
           }
    
           #contain {
               
               font-size: 20px;
               color: black;
              word-spacing: 30px;
              background-color: white; 
               
           }         

           #main{
               
               background-color: white; 
               margin-left: 300px;
               margin-right: 300px;
               margin-top: 30px;
               padding-top: 30px;
               opacity: 0.9;
           }   
           
         #main1{
               
               background-color: white; 
               margin-left: 300px;
               margin-right: 300px;
               margin-top: -50px;
             padding-left: 100px;
             padding-bottom: 50px;
             padding-top: 0px;
             font-size: 20px;
              opacity: 0.9;
           }     
           #main3{
               
               background-color: white; 
               margin-left: 300px;
               margin-right: 300px;
               margin-top: -20px;
               margin-bottom: 40px;
             padding-left: 100px;
             padding-bottom: 50px;
            
             font-size: 20px;
              opacity: 0.9;
           }       
    table,th,td {
    border: 1px solid black;
         border-collapse: collapse;
        padding: 5px;
}
    
    
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script>
            $(document).ready(function(e){
               //variables
                var html = '<p /><div id=contain>product:<input type ="text" name ="product[]" id="childproduct" /> quantity:<input type ="text" name ="quantity[]" id="childquantity" /><a href="#" id ="remove"></a></div>';
               
                var maxRows =100;
                
                var x=1;
                
                //add rows
                $("#add").click(function(e){
                    
                    if(x <= maxRows){
                    $("#container").append(html);
                        x++;
                    }
                });
                
                //delete rows
                $("#container").on('click','#remove',function(e){
                    
                    $(this).parent('div').remove();
                    x--;
                });
                
                //populate values from the first row
                
                $("#container").on('dblclick','#childproduct',function(e){
                    $(this).val($('#product').val() );
                });
                
                $("#container").on('dblclick','#childquantity',function(e){
                    $(this).val($('#quantity').val() );
                });
                
                
            });
        
        </script>
    </head>
    <body>
      
      
      <div class="navbar">
        <a href="index.php">Home</a>
        <a class = "active" href="addmore.php">Buy</a>
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
      
       <div id ="main">
       <h1 class = "headline" style="margin-left: 100px;">
        Buyers List
    </h1>
    
    <form method="post">
        <input id ="new" class = "btn" style="margin-left: 100px;" onclick="showadd()" type = "submit" name = "submit1" value = "New Transaction">
    </form>
    <br><br>
       
       
       
        <form method="post">
           <div id="container">
              product:<input type ="text" name ="product[]" id="product" />
               quantity:<input type ="text" name ="quantity[]" id="quantity" />
               <a href="#" id ="add"></a>
               
           </div>
           <p />
           <input type="submit" name="submit" class="btn" style="margin-left: 100px;" />
            
        </form>
        <?php echo $output; ?>
        
        </div>
    </body>
</html>






<?php
error_reporting(E_ALL ^ E_NOTICE);
// session_start();


$tranid = $_SESSION['$transid'];
/*echo "SESSION[transid] tot =",$_SESSION['$transid'];
echo "tid from buy= ",$tranid;
    */

$tottran = "SELECT SUM(ptotamt) FROM productsales WHERE tid='$tranid'";

        $tottranquery = mysqli_query($con,$tottran);
        $tottranresult = mysqli_fetch_assoc($tottranquery);
        $tottranamt = $tottranresult['SUM(ptotamt)'];

       /* echo "<p id='main1'>totamt = ",$tottranamt,"</p>";*/

        $insertamt = "UPDATE transaction SET tamt='$tottranamt' WHERE tid='$tranid'";
        mysqli_query($con,$insertamt);
       

$list = "SELECT p.pname as pname,p.pprice as price,ps.pnos as pno,ps.ptotamt as amt FROM product p,productsales ps WHERE ps.productid=p.productid AND ps.tid ='$tranid'";
$query =mysqli_query($con,$list);

if(mysqli_num_rows($query) !=0){
    echo "<div id='main3'>";
    echo "Products Brought :";
    echo "<br>";
    echo "<table>";
    echo "<tr><th>Product Name   </th><th>Price</th><th>nos.</th><th>Amount</th></tr>";
    while($rows = mysqli_fetch_assoc($query)){
        
        echo "<tr>";
        echo "<td>";
        echo $rows['pname'];
        echo "</td>";
        echo "<td>";
        echo $rows['price'];
        echo "</td>";
        echo "<td>";
        echo $rows['pno'];
        echo "</td>";
        echo "<td>";
        echo $rows['amt'];
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
}

 echo "<p id='main1'>Total Amount = ",$tottranamt,"</p>";
//mysqli_close($con);

?>




<?php
// remove all session variables
/*session_unset(); 

// destroy the session 
session_destroy();*/ 
?>