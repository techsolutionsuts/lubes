<?php include_once('header.php');?>

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

<input type="text" style="padding:15px; background-color: white;" name="filter" value="" id="filter" placeholder="Search by Receive date" autocomplete="off" /><br><br><br><br><br><br>
<div class="content" id="content">
<center><strong>All Products Inventory</strong></center>
<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th width="12%"> Rec Date </th>
			<th width="8%"> Person </th>
			<th width="9%"> Invoice</th>
			<th width="14%">Supplier </th>
			<th width="16%">Product Name </th>
			<th width="15%">Description </th>
			<th >QTY</th>
			<th width="8%">Unit Price</th>
			<th width="8%"> Total Amount </th>
		</tr>
	</thead>
	<tbody>
		
			<?php
			function formatMone($number, $fractional=false) {
					if ($fractional) {
						$number = sprintf('%.2f', $number);
					}
					while (true) {
						$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
						if ($replaced != $number) {
							$number = $replaced;
						} else {
							break;
						}
					}
					return $number;
				}
				include('db/connect.php');
				$result = $db->prepare("SELECT * FROM tballproduct ORDER BY date DESC");
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
			?>
			<tr class="record">
			<td><?php echo $row['date']; ?></td>
			<td><?php echo $row['receiver']; ?></td>
			<td><?php echo $row['invoice_num']; ?></td>
			<td><?php echo $row['suplierid']; ?></td>
			<td><?php echo $row['product_name']; ?></td>
			<td><?php echo $row['Description']; ?></td>
			<td><?php echo $row['quantity']; ?></td>

			<td><?php
			$price=$row['unit_price'];
			echo formatMone($price, true);
			?></td>
			<td><?php
			$oprice=$row['invoicevalue'];
			echo formatMone($oprice, true);
			?></td>				
			</tr>
			<?php
				}
			?>
		
				
			
			<tr>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th>Total Amount</th>
			<tr>
				
			<tr>
			<th></th>
				<th colspan="7"><strong style="font-size: 20px; color: #222222;">Total:</strong></th>
				<th colspan="1"><strong style="font-size: 13px; color: #222222;">
				<?php
				$resultas = $db->prepare("SELECT sum(invoicevalue) from tballproduct");
				$resultas->bindParam(':a', $sdsd);
				$resultas->execute();
				for($i=0; $rowas = $resultas->fetch(); $i++){
				$fgfg=$rowas['sum(invoicevalue)'];
				echo formatMone($fgfg, true);
				}
				?>
				</strong></th>
				
					
					<th></th>
			</tr>
		
		
		
		
		
	</tbody>
</table>
</div>
<?php include_once('footer.php');?>
