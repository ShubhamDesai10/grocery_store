<?php
require('includes/config.php');
	if(empty($_POST['subcatnm']))
		{
			echo "No Selected Category";
			
		}
		else
		{
	

			$cid=$_POST['subcatnm'];
			
			$q="delete from subcat where subcat_id = $cid";
			
			mysqli_query($conn,$q) or die("Can't Execute DELETE SUB CATEGORY....");	
			
			$q = "delete from products where p_subcat = ".$cid;
			mysqli_query($conn,$q);
			
			header("location:subcategory.php");
		}
?>
	
	