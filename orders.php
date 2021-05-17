<?php include('header.php'); ?>

        <table class="table">
           <center><h3>Invoice</h3></center>
	        <tr>
		        <td>
		        	<label>Order Name</label>
		        	<?=$_SESSION['username'] ?>
		        </td>
		        <td>
		        	<label>Location</label>
		        	Sunyani
		        </td>
		        <td>
		        	<label>Order Date</label>
		        	<?= date('d-M-Y'); ?>
		        </td>
	        </tr> 
        </table>
        <div class="row">
        	<div class="col-md-6">
        		 <div class="panel panel-default">
        		      <div id="Tabs" role="tabpanel">
        		            <ul class="nav nav-tabs" role="tablist">
                              <?php
                                $q = mysql_query("select * from tbcategory");
                                while ($row = mysql_fetch_object($q)) 
                                {
                                	?>
                                	 <li><a href="#<?=$row->id?>" aria-control="personal" role="tabs" data-toggle="tab">       		              
                                	 <?= $row->category_name ?></a></li>
        		                    <?php
                                }

                              ?>
        		              
        		          	
        		          </ul>
        		          <div class="tab-content" style="padding-top: 20px">
        		             <?php
                                $q = mysql_query("select * from tbcategory");
                                while ($row = mysql_fetch_object($q)) 
                                {
                                	?>
        		               <div role="tabpanel" class="tab-pane active" id="<?= $row->id?>">
        		                    <?=$row->category_name?>
        		               	
        		               </div>
        		               <?php
        		            }
        		           ?>    
        		          	
        		          </div>
        		      	
        		      </div>
        		 	
        		 </div>
        	</div>
        	<div class="col-md-6">
        		<table class="table table-borderd table-hover">
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
        		<tbody>
        			<tr>
        				<td><input type="text" name="product_name[]" class="form_control"></td>
        				<td><input type="text" name="quantity[]" class="form_control"></td>
        				<td><input type="text" name="price[]" class="form_control"></td>
        				<td><input type="text" name="discount[]" class="form_control"></td>
        				<td><input type="text" name="amount[]" class="form_control"></td>
        				<td><a href="#" class="remove">Del</td>

        			</tr>
        		</tbody>     
        		</table>
        	</div>
        </div>
<?php include('footer.php'); ?>