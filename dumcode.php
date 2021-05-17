
<?php
$list = '';
$textline1='';
$textline2='';
$paginationCtrls='';


if(isset($_GET['id']))
{

$id = $_GET['id'];
$sql = "SELECT COUNT(productid) FROM tb_stock_dynamics WHERE productid='$id'";
$query = mysqli_query($db_conx, $sql);
$row = mysqli_fetch_row($query);
// Here we have the total row count
$rows = $row[0];
// Specify how many results per page
$page_rows = 10;
// This tells us the page number of our last page
$last = ceil($total_rows/$rpp);
// This makes sure $last cannot be less than 1
if($last < 1){
  $last = 1;
}
$pagenum = 1;
if (isset($_GET['pn'])) {
  $pagenum=preg_replace('#[^0-9]#', '', $_GET['pn']);
}
//pagenum shld be below 1
if ($pagenum<1) {
  $pagenum=1;
}
else{
  $pagenum=$last;
}
//number of rows to display
$limit= 'LIMIT' .($pagenum-1) * $page_rows .',' .$page_rows;

$sql = "select productid,date,open_stock,receipt_reduce_stock,total_stock,closing_stock,qty_sold,price,value,invoice,description,receive,user from tb_stock_dynamics WHERE productid = '&id' oder by productid  DESC $limit";
$query = mysqli_query($db_conx,$sql);
//this show the user the page they are in
$textline1 = 'History (<b>$row</b>)';
$textline2 = 'Page <b>$pagenum</b> of <b>$last</b>';

$paginationCtrls = '';

if ($last !=1) {
  
  if ($pagenum>1) {
    $previous = $pagenum-1;
    $paginationCtrls .='<a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'">Previous</a> &nbsp; &nbsp; ';
  for ($i=$pagenum-4; $i<$pagenum; $i++) {
  if ($i>0) {
    $paginationCtrls .='<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; ';
   } 
  }

  }

  $paginationCtrls .= ''.$pagenum.' &nbsp; ';
  for ($i=$pagenum+1; $i<=$last; $i++) {
    $paginationCtrls .='<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; ';
  if ($i>=$pagenum+4) {
break;   

}
}
if ($pagenum != $last) {
  $next = $pagenum + 1;
  $paginationCtrls .='<a &nbsp; &nbsp; href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'">Next</a> ';

}
}
while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
  $idd = $row['productid'];
  $date = $row['date'];
  $date = strftime("%b %d %Y", strtotime($date));
  $op = $row['open_stock'];
  $rec = $row['receipt_reduce_stock'];
  $ts = $row['total_stock'];
  $cs = $row['closing_stock'];
  $qtys = $row['qty_sold'];
  $price = $row['price'];
  $val = $row['value'];
  $iv = $row['invoice'];
  $user = $row['user'];
  $des = $row['description'];

  $list = '<p><a href="producthistory2.php?id='.$idd.'">'.$date.' '.$cs.'Product History</a>-Click link <br> What? '.$date.'</p>';
}
// Close the database connection
}
mysqli_close($db_conx);
?>
<script>
var rpp = <?php echo $rpp; ?>; // results per page
var last = <?php echo $last; ?>; // last page number
function request_page(pn){
  var results_box = document.getElementById("results_box");
  var pagination_controls = document.getElementById("pagination_controls");
  results_box.innerHTML = "loading results ...";
  var hr = new XMLHttpRequest();
    hr.open("POST", "pagination_parser.php", true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function() {
      if(hr.readyState == 4 && hr.status == 200) {
      var dataArray = hr.responseText.split("||");
      var html_output = "";
        for(i = 0; i < dataArray.length - 1; i++){
        var itemArray = dataArray[i].split("|");
        html_output += "ID: "+itemArray[0]+" - Testimonial from <b>"+itemArray[1]+"</b><hr>";
      }
      results_box.innerHTML = html_output;
      }
    }
    hr.send("rpp="+rpp+"&last="+last+"&pn="+pn);
  // Change the pagination controls
  var paginationCtrls = "";
    // Only if there is more than 1 page worth of results give the user pagination controls
    if(last != 1){
    if (pn > 1) {
      paginationCtrls += '<button onclick="request_page('+(pn-1)+')">&lt;</button>';
      }
    paginationCtrls += ' &nbsp; &nbsp; <b>Page '+pn+' of '+last+'</b> &nbsp; &nbsp; ';
      if (pn != last) {
          paginationCtrls += '<button onclick="request_page('+(pn+1)+')">&gt;</button>';
      }
    }
  pagination_controls.innerHTML = paginationCtrls;
}
</script>