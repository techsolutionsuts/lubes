<?php include_once('db/db.php');
$page_rows = 10;
$count = mysql_query("select count('ProductName') from salesdetails");
$pages = ceil(mysql_result($count, 0) / $page_rows);
// another way to usse an if statement without bring calibrasis
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page-1) * $page_rows;
$query = mysql_query("select ProductName from salesdetails LIMIT $start, $page_rows");
//if($query):
while ($query_row = mysql_fetch_assoc($query)) {
	echo $query_row['ProductName'].'<br>';
}
//endif;
$prev = $page-1;
$next = $page+1;
if(!($page<=1)){
echo "<a href='page1.php?page=$prev'>Previous</a> ";
}
if ($pages>=1) {
	for ($x=1; $x <=$pages ; $x++) { 
		//echo '<a href="?page='.$x.'">'.$x.' </a>';
		echo ($x==$page) ? '<b><a href="?page='.$x.'">'.$x.'</a></b> ':'<a href="?page='.$x.'">'.$x.'</a> ';
	}
}
if(!($page>=$pages)){

echo "<a href='page1.php?page=$next'>Next</a> ";
}









?>