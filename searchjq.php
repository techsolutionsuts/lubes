<?php 
include_once('db/db.php');

$output='';
if (isset($_POST['searchVal'])) {
  $searchq = $_POST['searchVal'];

  $query = mysql_query("select * from sales where invoice like '%$searchq%' or salesDate like '%$searchq%' ") or die("cannot search");
  $count = mysql_num_rows($query);

  if ($count==0) {
    $output = "Nothing was found body";
  
  }
  else{
while($row=mysql_fetch_array($query)) {

$invoice = $row['invoice'];
$date = $row['salesDate'];
$id = $row['SalesID'];

$output .= '<div>'.$invoice.' '.$date.'</div>';
}

  }

}

echo "$output";
?>