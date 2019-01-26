


<?php 
//error_reporting(E_ALL ^ E_NOTICE);
$con = mysqli_connect('localhost','root','','retail');
//session_start();
global $sid;
//$sid= $_SESSION['$storeid'];

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit1'])) {
     
    add();
        //echo "SESSION[transid] =",$_SESSION['$transid'];
 }   
     function add(){
        global $con,$tid;
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



<?php

global $con;
$plist = "SELECT pname FROM product";
$plistq = mysqli_query($con,$plist);

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
            

        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script>
            $(document).ready(function(e){
               //variables
                var html = '<p /><div>product:<input type ="text" name ="product[]" id="childproduct" />quantity:<input type ="text" name ="quantity[]" id="childquantity" /><a href="#" id ="remove"></a></div>';
               
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
      
       
       <h1 class = "headline">
        Buyers List
    </h1>
    
    <form method="post">
        <input id ="new" class = "btn" onclick="showadd()" type = "submit" name = "submit1" value = "New Transaction">
    </form>
    <br><br>
       
       
       
        <form method="post">
           <div id="container">
               product:<select name ="product[]" id="product">
               <?php 
                
                   while($rows = mysqli_fetch_assoc($plistq)){
                       $pname = $rows['pname'];
                       echo "<option value='$pname'>$pname</option>";
                       
                   }
                   
                ?>
                   </select>
               
               
               quantity:<input type ="text" name ="quantity[]" id="quantity" />
               <a href="#" id ="add"></a>
               
           </div>
           <p />
           <input type="submit" name="submit" class="btn" />
            
        </form>
        <?php echo $output; ?>
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

        echo "totamt = ",$tottranamt;

        $insertamt = "UPDATE transaction SET tamt='$tottranamt' WHERE tid='$tranid'";
        mysqli_query($con,$insertamt);
        /*if(mysqli_query($con,$insertamt)){
            echo"<br>";
            echo "Executed insert amt ";
            echo"<br>";
        }
           else{ echo "Not Executed "; }
        echo"<br>";
        echo $tranid;
        echo"<br>";
*/

//mysqli_close($con);

?>




<?php
// remove all session variables
/*session_unset(); 

// destroy the session 
session_destroy();*/ 
?>