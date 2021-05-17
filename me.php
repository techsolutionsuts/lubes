
<?php
mysql_connect("localhost","root","weert") or die("can conn");
mysql_select_db("lubessysdb") or die("do db");

$output = '';
if(isset($_Post['productname']))
{

$pname = $_Post['productname'];
$query = mysql_query("select * from tbproduct where product_name like '%$pname%'") or die("not selected");
$count = mysql_num_rows($query);
if($count == 0){
  $output = 'No item match your search';
}else{
while ($row = mysql_fetch_array($query))
 {

  $product = $row['product_name'];
  $price = $row['price'];
  $pid = $row['id'];
  $output .= '<div> '.$product.' '.$price.'</div>';


}

}


}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title></title>
	<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script type="text/javascript">

        function seacrhq() {
        var searchtxt = $("input[name='productname']").val();
        $.post("me1.php", {productnameVal: searchtxt}, function (output) {
        $("#output").html(output);
        });

        }	


        </script>
</head>
<body>

<form action="me.php" method="post" >

<input type="text" name="productname" placeholder="Search Product" autocomplete="off" onkeydown="seacrhq();">
<Button type="submit" class="btn btn-info" style="width: 123px; height:35px; left:25px; position:relative; margin-top:-5px;"><i class="icon-plus-sign icon-large"></i> Add</button></form>
<div id="output">
	

</div>
</body>
</html>