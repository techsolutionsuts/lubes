<?php include('header.php'); ?>
<head>
<script src="js/jquery-1.7.2.min.js"></script>
</head>
   <table class = "table">
           <ul class="breadcrumb" style="float: left; width: 845;">
      <li style=""><center><h4>Daily Sales</h4></center></li></ul>
 
             <tr>
                  <div>
                 <td style="position: ; padding-top: 15px;">
                     <label> Cashier:</label>
                     <?=$_SESSION['username'] ?>
                 </td>
                 </div>
                 <td style="position: ; padding-top: 0px;">
                     
                     <select class ="text" name="salperson" style="">
                    <option> Select Sales RepShift</option>
                     
                     </select>
                 </td>
             </tr>
             <tr>
                 <td>
                     <label>Sales Date:</label>
                     <input type="date" name="saldate" value="Date">
                 </td>
                 </tr>
                 </div>
    </table>  
    <div class="row">
    <script src="js/jquery-1.7.2.min.js"></script>

    <form action="incoming.php" method="post">
    
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
       <input type="number" name="qty" value="1" min="1" placeholder="Qty" autocomplete="off" style="width: 68px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; margin-left: 50px; font-size:15px; left:5px; position:relative;" required>
         <input type="text" name="discount" value="" placeholder="Discount %" autocomplete="off" style="width: 105px; height:30px; padding-top:6px; left:5px; position:absolute; padding-bottom: 4px; margin-right: 4px; font-size:15px;">
       <Button type="submit" class="btn btn-info" style="width: 123px; height:35px; left:25px; position:relative; margin-top:-5px;"><i class="icon-plus-sign icon-large"></i> Add</button>
        <br><br>
          </form>
          <div class="">
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
        
          <a rel="facebox" href="checkout.php?pt=<?php echo $_GET['id']?>&invoice=<?php echo $_GET['invoice']?>&total=<?php echo $fgfg ?>&totalprof=<?php echo $asd ?>&cashier=<?php echo $_SESSION['SESS_FIRST_NAME']?>"><Button type="submit" class="btn btn-info" style="width: 400px; height:55px; left:5px;  margin-top:-5px;"/><i class="icon-plus-sign icon-large"></i> SUBMIT</button></a>
           </div>
     </div>
        <script type = "text/javascript">
		$(function(){
		$('.datavalue').click(function(){
		var id = $(this).data('id');
		var name = $(this).data('name');
		var price = $(this).data('price');
		addrow(name,price);
		});
		});
		function addrow(p,p2)
		{
		var tr = '<tr>'+
                '<td><input type="text" name="product_name[]" value="'+ p +'" class="form-control product_name"></td>'+
                '<td><input type="text" name="quantity[]" class="form-control quantity"></td>'+
                '<td><input type="text" name="price[]" value="'+ p2 +'" class="form-control price"></td>'+
                '<td><input type="text" name="discount[]" class="form-control discount"></td>'+
                '<td><input type="text" name="amount[]" class="form-control amount"></td>'+
                '<td><a href = "#" class = "remove">Del</a></td>'+
            '</tr>';
			$('.details').append(tr);
		}
		</script>
    <br>
<?php include('footer.php'); ?>