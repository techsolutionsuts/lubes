<?php
session_start();
include('db/connect.php');

$a = $_POST['invoice'];
$b = $_POST['product'];
$c = $_POST['qty'];
$w = $_POST['pt'];
$sp = $_POST['selperson'];
$date = $_POST['aridate'];
$discount = $_POST['discount'];
$result = $db->prepare("SELECT * FROM tbproduct WHERE id= :userid");
$result->bindParam(':userid', $b);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$asasa=$row['price'];
$code=$row['prod_code'];
$gen=$row['cat_id'];
$name=$row['product_name'];
$p=$row['content'];
$discrpt = $row['Description'];
}

//edit qty
$sql = "UPDATE tbproduct 
        SET quantity=quantity-?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($c,$b));
if($discount<0){

	$d=$c*$asasa;
	$content=$p*$c;
	//query
$sql = "INSERT INTO salesdetails (invoice,ProductCode,ProductName,Quantity,Amount,Content,Description,Liters,Price,Discount,date) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:k)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$code,':c'=>$b,':d'=>$c,':e'=>$d,':f'=>$p,':g'=>$discrpt, ':h'=>$content,':i'=>$asasa,':j'=>$discount,':k'=>$aridate));
header("location: sales.php?id=$w&invoice=$a");

}else{

$fffffff=($asasa*$discount)/100;
$d=$fffffff*$c;
$content=$p*$c;

$sql = "INSERT INTO salesdetails (invoice,ProductCode,ProductName,Quantity,Amount,Content,Description,Liters,Price,Discount,date) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:k)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$code,':c'=>$b,':d'=>$c,':e'=>$d,':f'=>$p,':g'=>$discrpt, ':h'=>$content,':i'=>$asasa,':j'=>$discount,':k'=>$aridate));
header("location: sales.php?id=$w&invoice=$a");

}
?>

	 <link rel="stylesheet" type="text/css" href="css/style2.css" media="screen" rel="stylesheet"/>
    <script src="js/application.js" type="text/javascript" charset="utf-8"></script>
    <script language="javascript">
function Clickheretoprint()
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes,width=700, height=400, left=100, top=25"; 
  var content_vlue = document.getElementById("content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('</head><body onLoad="self.print()" style="width: 700px; font-size:11px; font-family:arial; font-weight:normal;">');          
   docprint.document.write(content_vlue); 
   docprint.document.close(); 
   docprint.focus(); 
}
</script>


   <form action="" method="post" enctype="multipart/form-data">

<center><h4><i class="icon-plus-sign icon-large"></i>Lubes Inventory</h4></center>

   <center>
  <div id="ac" style="background-color:    #FFE4C4  ; width: 850px;">
  <div class="contentheader" style="float: left; background:  #b1cbbb;">
			<i class="icon-table"></i> Lubes Inventory
			</div><br>
<ul class="breadcrumb" style="float: left; width: 845; background:   #7FFFD4 ;">
			<li style="float: left; "><a href="product.php">Products</a></li> 
			<li class="active" style="float: left;">Lubes Inventory</li>
			</ul>

			<div style="float:right;">		
<button  style="float:left;" class="btn btn-success btn-mini"><a href="javascript:Clickheretoprint()"> Print</button></a>
</div>
<br>
<br>
<br>
    <a href="sales.php?id=cash&invoice=<?php echo $finalcode ?>">Cash</a>

<input type="hidden" name="pt" value="<?php echo $_GET['id']; ?>" />
    <input type="hidden" name="invoice" value="<?php echo $_GET['invoice']; ?>" />
    <select name="product" class="chzn-select" style="width:350px; height: 30; left:5px; position: absolute;" required>
   <option value="0">Select a Product....</option>
  <?php
  include('db/connect.php');
  $result = $db->prepare("SELECT * FROM tbproduct");
    $result->bindParam(':userid', $res);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
  ?>
    <option value="<?php echo $row['id'];?>"><?php echo $row['product_name']; ?></option>
  <?php
        }
      ?>
</select>
       <input type="number" name="qty" value="1" min="1" placeholder="Qty" autocomplete="off" style="width: 68px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; margin-left: 50px; font-size:15px; left:170px; position:relative;" required>
         <input type="number" name="discount" value="" placeholder="Discount %" autocomplete="off" style="float:right; margin-right:240px; margin-top: -1px; left: 10px; width:105px; height:30px;">
       <Button type="submit" class="btn btn-info" style="width: 123px; height:35px; left:450px; position:relative; margin-top:-5px;"><i class="icon-plus-sign icon-large"></i> Add</button>
        <br><br>
    <div class="content" id="content">
<center><strong>All Products Inventory</strong></center>
<table class="table table-bordered" id="resultTable" data-responsive="table">
           <thead>
              <tr>
                <th>ProductName</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Content</th>
                <th>Discount</th>
                <th>Amount</th>
                <th>Liters</th>
                <th>Cancel</th>
              </tr>
           </thead>
           <tbody class = "details">
                <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>           
                <td width="90"><a href="delete.php?id=<?php echo $row['transaction_id']; ?>&invoice=<?php echo $_GET['invoice']; ?>&dle=<?php echo $_GET['id']; ?>&qty=<?php echo $row['qty'];?>&code=<?php echo $row['product'];?>"><button class="btn btn-mini btn-warning"><i class="icon icon-remove"></i> Remove </button></a></td>
                </tr>
                <tr>
                  <th>  </th>
                  <th>  </th>
                  <th>  </th>
                  <th>  </th>
                  <th>  </th>
                  <th>  </th>
                  <td> Total Amount </td>
                  <td> Total Liters </td>
                  <th>  </th>

                </tr>
                <tr>
                  <th colspan="5"><strong style="font-size: 12px; color: #222222;">Total:</strong></th>
                  <td colspan="1"><strong style="font-size: 12px; color: #222222;"></strong></td>
        <td colspan="1"><strong style="font-size: 12px; color: #222222;">
        
        </td>
        <th></th>
           <th></th>
      </tr>
        
   
           </tbody>
           </table>
        
</div>
<?php include_once('footer.php');?>
