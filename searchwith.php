<?php include_once('headerad.php');?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">
</script>
<form action="searchwith.php" method="post" >

<center><h4><i class="icon-plus-sign icon-large"></i> Run a Searh</h4></center>

   <center>
  <div id="ac" style="background-color:    #FFE4C4  ; width: 850px;">
  <div class="contentheader" style="float: left; background:  #b1cbbb;">
      <i class="icon-table"></i>
      </div><br>
<ul class="breadcrumb" style="float: left; width: 845; background:   #7FFFD4 ;">
      <li style="float: left; "><a href="salessum.php">Sales Summary</a></li>
      <li style="float: left; "><a href="salesreport.php">Product By Product</a></li>
      <li style="float: left; "><a href="searchwith.php">Search</a></li>
      <li style="float: left; "><a href="customerreport.php">Customer</a></li>  
      <li class="active" style="float: left;">Search</li>      </ul>
      <br>
</form>
<script type="text/javascript">
  function searchq(){

    var searchtxt = $("input[name='search']").val();
    $.post("searchjq.php", {searchVal: searchtxt}, function(output){
    $("#output").html(output);

    });
  }

</script>
<form action="searchwith.php" method="post" style="background-color:   rgb(200,200,200); width: 840;">
    <br>
   <table class = "table">
    <div class="row">
    <div class="row">
    
<br><br>
<center><strong><input type="text"  placeholder="Search by date invoice number" style="width: 323px; height: 20px; padding:14px;" name="search" required  onkeydown="searchq();"></strong>
<div id="output">
  
</div>
       <Button type="submit" name=""class="btn btn-info" style="width: 120px; height:35px; left:10px; position:relative; margin-top: -5px; margin-right:340px"><i class="icon-plus-sign icon-large"></i> Search</button>
</center'>
       </div>
        <br><br>
        </table>
        </form>
  <div class="pull-right" style="margin-right:100px;">
    <a href="javascript:Clickheretoprint()" style="font-size:20px; position:absolute; margin-top: -10px; left: 800px"><button class="btn btn-success btn-large"><i class="icon-print"></i> Print</button></a>
    </div>
    <div class="content" id="content">
<center><div style="font:bold 25px 'Aleo';">Sunyani Shell Service Station</div>
  Sunyani Shell, Opp. Jubilee Park<br>
  0244413208<br>
  Customer Statement
      <img width="50" height="50" style="float: right; left: 590px; margin-top: -30px; position: absolute;" src="images/slide/slide1.png">

  </center>
      <br>
<div style="font-weight:bold; text-align:center;font-size:14px;margin-bottom: 15px;">
</div>

<table class="table table-bordered" id="resultTable" data-responsive="table">


           <thead>
              <tr>
              <th>Date</th>
                <th>ProductName</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Liters</th>
                <th>Profit</th>
                <th>Total</th>
              </tr>
           </thead>
          </table>
</div>
</form>

<?php include('footer.php'); ?>