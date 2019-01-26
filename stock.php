<?php
  //error_reporting(E_ALL ^ E_NOTICE);   

//placeholder
$output = NULL;

if(isset($_POST['submit'])){
    //connect to db
    
   $conn = mysqli_connect('localhost','root','','retail');
    

    $product = $_POST['product'];
    $quantity = $_POST['quantity'];
    
    foreach($product AS $key => $value){
        
        $productid = "SELECT pcid,productid FROM product WHERE pname = '$value'";
        
        $pidquery = mysqli_query($conn,$productid);
        $pidresult = mysqli_fetch_assoc($pidquery);
        $pid = $pidresult['productid'];
        $pcid = $pidresult['pcid'];
        
        $countpid = "SELECT count(productid) AS count FROM stock WHERE productid = '$pid'";
        $countquery = mysqli_query($conn,$countpid);
        $cfetch = mysqli_fetch_assoc($countquery);
        $cresult = $cfetch['count'];
     if($cresult >0){
        
        $stockq = "SELECT pquantity FROM stock WHERE productid = '$pid'";
        
        $stockquery = mysqli_query($conn,$stockq);
        $stockresult = mysqli_fetch_assoc($stockquery);
        $pstock = $stockresult['pquantity'];
        
        $stock = $pstock + $quantity[$key];
        
        
        $astock = "UPDATE stock SET pquantity = '$stock' WHERE productid = '$pid'";
        $asquery = mysqli_query($conn,$astock);
        if($asquery){
           echo "<script type='text/javascript'>alert('Stock Updated');</script>";
        }
        else{ echo "<script type='text/javascript'>alert('Stock Not Updated');</script>";}
    }
      else{
          
          $nstock = "INSERT INTO stock (categoryid,productid,pquantity) VALUES ('$pcid','$pid','$quantity[$key]')";
          $nsquery = mysqli_query($conn,$nstock);
        if($nsquery){
           echo "<script type='text/javascript'>alert('New Product Stock Created');</script>";
        }
        else{ echo "<script type='text/javascript'>alert('Product's Stock Not Created');</script>";}
      }
    }
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
               margin-top: 70px;
               padding-top: 30px;
               opacity: 0.9;
           }   
           
       
    
    
           

        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script>
            $(document).ready(function(e){
               //variables
                var html = '<p/><div id="contain">product:<input type ="text" name ="product[]" id="childproduct" /> quantity:<input type ="text" name ="quantity[]" id="childquantity" /><a href="#" id ="remove"></a></div>';
               
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
        <a href="addmore.php">Buy</a>
        <div class="dropdown">
          <button class="dropbtn">Add 
            <i class="fa fa-caret-down"></i>
          </button>
          <div class="dropdown-content">
            <a href="product.php">Add Product</a>
            <a href="category.php">Add Category</a>
            <a href="supplier.php">Add Supplier</a>
            <a class = "active" href="stock.php">Add Stock</a>
            
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
      <div id="main">
       <h1 style="margin-left:100px;">
       Add Stock
    </h1>
    
   
       
        <form method="post">
           <div id="container">
               product:<input type ="text" name ="product[]" id="product" />
               quantity:<input type ="text" name ="quantity[]" id="quantity" />
               <a href="#" id ="add"></a>
               
           </div>
           <p />
           <input type="submit" name="submit" class="btn" style="margin-left:100px;"/>
            
        </form>
        <?php echo $output; ?>
        </div>
    </body>
</html>

