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
   <label> Order Date:</label>
   <?= date('d-M-Y'); ?>
   </td>
   </tr>
   </table>
   <div class="row">
   <div class="col-md-6">
   <div class = "panel panel-default" style="width:500px; padding: 10px; margin: 10px">
   <div id = "Tabs" role = "tabpanel">
        <!-- unordered list -->
		
      <ul class = "nav nav-tabs" role = "tablist">
		 <li class = "active"><a href = "#personal" aria-controls = "personal" role = "tab" data-toggle = "tab">
		Personal </a></li>
		 <li><a href = "#employment" aria-controls = "employment" role = "tab" data-toggle = "tab">
		Employment </a></li>
		 
         </ul>		 
       <div class = "tab-content" style = "padding-top: 20px;">
         <div role = "tabpanel" class = "tab-pane " id = "personal">
		 This is the world for you
		 </div>
		 <div role = "tabpanel" class = "tab-pane active" id = "employment">
		 This is how we do it here
		 
		 <a class = "datavalue"href = "#" data-id = "<?= $r->id ?>" data-name = "<?= $r->product_name ?>"
	  data-price = "<?= $r->unit_price ?>">
	  <img width = "50" height = "50" src = "product/<?= $r->image ?>">
	  <h5 ><?= $r->product_name ?></h5>
		 </div>
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
   <tbody>
   <tr>
   <td><input type="text" name="product_name[]" class="form-control"></td>
   <td><input type="text" name="quantity[]" class="form-control"></td>
   <td><input type="text" name="price[]" class="form-control"></td>
   <td><input type="text" name="discount[]" class="form-control"></td>
   <td><input type="text" name="amount[]" class="form-control"></td>
   <td><a href = "#" class = "remove">Del</a></td>
   </tr>
   </tbody>
   </div>
   </div>
<?php include('footer.php'); ?>