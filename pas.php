<?php

<td align="right"><table width="300" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="150"><strong>Total Sales </strong></td>
              <td width="150">&nbsp;<?php 
                include('db/dbb.php');
               $age = $db->queryUniqueValue("SELECT sum(Amount) FROM salesdetails where date BETWEEN '$fromdate' AND '$todate'"); ?></td>
            </tr>
            <tr>
              <td><strong>Received Amount</strong></td>
              <td>&nbsp;<?php 
              $age = $db->queryUniqueValue("SELECT sum(Liters) FROM salesdetails where Productid=1 AND date BETWEEN '$fromdate' AND '$todate' ");?></td>
            </tr>
            <tr>
              <td width="150"><strong>Total OutStanding </strong></td>
              <td width="150">&nbsp;<?php $age = $db->queryUniqueValue("SELECT sum(profit) FROM salesdetails where Productid=1 AND date BETWEEN '$fromdate' AND '$todate' ");?></td>
            </tr>
            <tr>
          <td height="20"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="45"><strong>From</strong></td>
                <td width="393">&nbsp;<?php echo $fromdate; ?></td>
                <td width="41"><strong>To</strong></td>
                <td width="116">&nbsp;<?php echo $_GET['$todate']; ?></td>
              </tr>

/*
$fromdate = $_GET['from_sales_date'];
$todate = $_GET['to_sales_date'];
	include('db/dbb.php');

if(isset($_GET['from_sales_date']) && isset($_GET['to_sales_date'])&& isset($_POST['submit']) && $_GET['from_sales_date']!='' && $_GET['to_sales_date']!='' )
{

	error_reporting (E_ALL ^ E_NOTICE);
			$selected_date=$_GET['from_sales_date'];
		  	$selected_date=strtotime( $selected_date );
			$mysqldate = date( 'Y-m-d', $selected_date );
$fromdate=$mysqldate;
			$selected_date=$_GET['to_sales_date'];
		  	$selected_date=strtotime( $selected_date );
			$mysqldate = date( 'Y-m-d', $selected_date );

$todate=$mysqldate;
}
*/
?>