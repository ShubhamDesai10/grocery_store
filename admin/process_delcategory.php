<?php
require('includes/config.php');
	if(!empty($_POST))
	{
		$msg=array();
		if(empty($_POST['del']))
		{
			$msg[]="Please full fill all requirement";
		}
		
		if(!empty($msg))
		{
			echo '<b>Error:-</b><br>';
			
			foreach($msg as $k)
			{
				echo '<li>'.$k;
			}
		}
		else
		{
		
			$delcat=$_POST['del'];
			
			$query="select cat_id from category where cat_name ='$delcat' ";

			$res = mysqli_query($conn,$query) or die("can't execute...");

			$row = mysqli_fetch_assoc($res);

			$query="delete from category where cat_name ='$delcat' ";
		
			mysqli_query($conn,$query) or die("can't Execute...");

			$query = "delete from subcat where parent_id = ".$row['cat_id'];
			
			mysqli_query($conn,$query) or die("can't execute...");
			
			header("location:category.php");
		}
	}
	else
	{
		header("location:index.php");
	}
?>
	
	