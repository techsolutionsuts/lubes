<?php include_once('headerad.php');
     if(isset($_POST['add']))
	 {
	 $categoryname = $_POST['category_name'];
	 $cont = $_POST['cat_cont'];
	 mysql_query("insert into tbcategory(category_name,cat_content) values('$categoryname','$cont')");
	 header("Location: category.php");
	 }
	 ?>
	 <form action="" method="post">
	 <br>
<div class="contentheader" style="float: left;">
			<i class="icon-table"></i> Add Category
			</div><br>
<ul class="breadcrumb" style="float: left; width: 845;">
			<li style="float: left;"><a href="category.php">Product Category</a></li> 
			<li class="active" style="float: left;">Add Category</li>
			</ul><br>
         <table class="table">
		    <tr>
		     <td>
		     <label>Category Name</label>
		     <input type="text" name="category_name" required class="form-control">
		     </td>
		    </tr>
		    <tr>
		     <td>
		     <label>Content (Liters)</label>
		     <select type="text" name="cat_cont" required class="form-control"> 
             <option value="0.50">500ml</option>
             <option value="1">1L</option>
             <option value="4">4L</option>
             <option value="5">5L</option>
             <option value="209">209L</option>
             <option value="214">214L</option>
			 <option value="1">50KgL</option>

		     </select>
		     </td></tr>
		    <tr><td> <input type="submit" name="add" value="Add" class="btn btn-primay"></td></tr>
		 </table>
      </form>
<?php include_once('footer.php');?>