<?php include_once('header.php');
     if(isset($_POST['add']))
	 {
	 $categoryname = $_POST['category_name'];
	 $cont = $_POST['cat_cont'];
	 $id = $_POST['id'];

	 mysql_query("update tbcategory set category_name='$categoryname',cat_content='$cont' where id = '$id'");
	 header("Location: category.php");
	 }
	 if(isset($_GET['id']))
	 {
	 $id = $_GET['id'];
	 $r = mysql_fetch_object(mysql_query("select * from tbcategory where id = '$id'"));
	 }
	 ?>
	 <form action="" method="post">

	 <br>
<div class="contentheader" style="float: left;">
			<i class="icon-table"></i> Update Category
			</div><br>
<ul class="breadcrumb" style="float: left; width: 845;">
			<li style="float: left;"><a href="category.php">Product Category</a></li> 
			<li class="active" style="float: left;">Udate Category</li>
			</ul><br>
       
         <table class="table">
		    <tr>
			 <input type="hidden" name="id" value="<?= $r->id ?>">
		     <td>
		     <label>Category Name</label>
		     <input type="text" value="<?= $r->category_name ?>" name="category_name" required class="form-control">
		     </td>
		    </tr>
		    <tr>
		     <td>
		     <label>Content (Liters)</label>
		     <input type="text" value="<?= $r->cat_content ?>" name="cat_cont" required class="form-control">
		     </td></tr>
		    <tr><td> <input type="submit" name="add" value="Update" class="btn btn-primay"></td></tr>
		 </table>
      </form>
<?php include_once('footer.php');?>