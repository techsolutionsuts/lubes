<?php include('header.php'); ?>
         <table class = "table">
            <center><h3>Invoice</h3></center>
             <tr>
                 <td>
                     <label> Order Name:</label>
                     <?=$_SESSION['username'] ?>
                 </td>
                 <td>
                     <label> Location:</label>
                     Sunyani
                 </td>
             </tr>
             <tr>
                 <td>
                     <label>Order Date:</label>
                     <?= date('d-M-Y'); ?>
                 </td>
                 </tr>
    </table>  
    <div class="row">
        <div class="col-md-6">
          <div class = "panel panel-default">
            <div id = "Tabs" role = "tabpanel">
              <!-- unordered list -->
		
              <ul class = "nav nav-tabs" role = "tablis">
	             <?php
		            $q = mysql_query("select * from tbcategory");
		            while($row = mysql_fetch_object($q))
		            {
		              ?>
		               <li class = ""><a href="#"<?=$row->id ?>"" aria-controls = "personal" role ="tab"  
			             data-toggle = "tab"> 
	                <?= $row->category_name ?></a></li>
			            <?php
		            }
		           ?>
	     
	            </ul>
	            <div class = "tab-content" style = "padding-top: 20px;">
	               <?php
		              $q = mysql_query("select * from tbcategory");
		              while($row = mysql_fetch_object($q))
		              {
		                 ?>
	  
	                <div role="tabpanel" class="tab-pane" id="<?= $row->id?>">
			               <?php
			                  $p = mysql_query("select * from tbproduct where cat_id = '$row->id'");
			                  while($qry = mysql_fetch_object($p))
			                  {
			                    ?>
			                     <div class="col-md-4">
			                      <a class = "datavalue" href = "#" data-id = "<?= $qry->id ?>" data-name = "<?= $qry->product_name ?>" 
											        data-price = "<?= $qry->unit_price ?>">
			                        <img width="100" height="100"  src="product/<?= $qry->image ?> 
                              "
                              >
			                        <h5><?= $qry->product_name ?></h5>
			   
			                      </a>
			                      </div>
			                  <?php
	                   }			   			   
			             ?>
                  </div>
                  <?php
                 }
                ?>			
	    
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
           <table class="table table-bordered table-hover">
           <thead>
              <tr>
                <th>ProductName</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Amount</th>
                <th>X</th>
              </tr>
           </thead>
           <tbody class = "details">
   
           </tbody>
           </table>
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
<?php include('footer.php'); ?>