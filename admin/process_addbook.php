<?php
require('includes/config.php');

	if(!empty($_POST))
	{
		$msg=array();
		if(empty($_POST['name']) || empty($_POST['description']) || empty($_POST['retailer'])|| empty($_POST['price']) || empty($_POST['qnt']))
		{
			$msg[]="Please full fill all requirement";
		}
		if(!(is_numeric($_POST['price'])))
		{
			$msg[]="Price must be in Numeric  Format...";
		}
		if(!(is_numeric($_POST['qnt'])))
		{
			$msg[]="Page must be in Numeric  Format...";
		}
		
		if(empty($_FILES['img']['name']))
		$msg[] = "Please provide a file";
	
		if($_FILES['img']['error']>0)
		$msg[] = "Error uploading file";
		
				
		if(!(strtoupper(substr($_FILES['img']['name'],-4))==".JPG" || strtoupper(substr($_FILES['img']['name'],-5))==".JPEG"|| strtoupper(substr($_FILES['img']['name'],-4))==".GIF"))
			$msg[] = "wrong file  type";
			
		if(file_exists("../upload_image/".$_FILES['img']['name']))
			$msg[] = "File already uploaded. Please do not update with same name";
		
		// if(empty($_FILES['ebook']['name']))
		// $msg[] = "Please provide a document file";
	
		// if($_FILES['ebook']['error']>0)
		// $msg[] = "Error uploading document file";
		
		
		// if(!(strtoupper(substr($_FILES['ebook']['name'],-4))==".PDF" || strtoupper(substr($_FILES['ebook']['name'],-4))==".PPT" ||strtoupper(substr($_FILES['ebook']['name'],-5))==".PPTX" ||  strtoupper(substr($_FILES['ebook']['name'],-4))==".DOC"|| strtoupper(substr($_FILES['ebook']['name'],-4))==".TXT"|| strtoupper(substr($_FILES['ebook']['name'],-5))==".DOCX"))
		// 	$msg[] = "wrong document file  type";
			
		// if(file_exists("../upload_ebook/".$_FILES['ebook']['name']))
		// 	$msg[] = "Document File already uploaded. Please do not updated with same name";
		
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
			move_uploaded_file($_FILES['img']['tmp_name'],"../upload_image/".$_FILES['img']['name']);
			$p_img = "upload_image/".$_FILES['img']['name'];	
			
			// move_uploaded_file($_FILES['ebook']['tmp_name'],"../upload_ebook/".$_FILES['ebook']['name']);
			// $b_pdf = "upload_ebook/".$_FILES['ebook']['name'];	
		
			$p_nm=$_POST['name'];
			$p_cat=$_POST['cat'];
			$p_desc=$_POST['description'];
			$p_qnt=$_POST['qnt'];
			$p_retailer=$_POST['retailer'];			
			// $b_isbn=$_POST['isbn'];
			// $b_pages=$_POST['pages'];
			$p_price=$_POST['price'];
			
			
		
			
			$query="insert into products(p_name,p_subcat,p_desc,p_retailer,p_price,p_img,p_qnt)
			values('$p_nm','$p_cat','$p_desc','$p_retailer',$p_price,'$p_img',$p_qnt)";
			
			mysqli_query($conn,$query) or die($query."Can't Connect to Query...");
			header("location:addbook.php");
		
		}
	}
	else
	{
		header("location:index.php");
	}
?>
	
	